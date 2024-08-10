<?php

namespace App\Http\Controllers;

use App\Models\Consultore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ConsultoreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ConsultoreController extends Controller
{

    public function index(Request $request): View
    {
        $query = Consultore::query();

        if ($request->filled('nome_completo')) {
            $query->where('nome_completo', 'like', '%' . $request->nome_completo . '%');
        }

        $consultores = $query->paginate();

        return view('consultore.index', compact('consultores'))
            ->with('i', ($request->input('page', 1) - 1) * $consultores->perPage());
    }

    public function create(): View
    {
        $consultore = new Consultore();

        return view('consultore.create', compact('consultore'));
    }

    public function store(ConsultoreRequest $request): RedirectResponse
    {
        Consultore::create($request->validated());

        return Redirect::route('consultores.index')
            ->with('success', 'Consultor cadastrado com sucesso!');
    }

    public function show($id): View
    {
        $consultore = Consultore::find($id);

        return view('consultore.show', compact('consultore'));
    }

    public function edit($id): View
    {
        $consultore = Consultore::find($id);

        return view('consultore.edit', compact('consultore'));
    }

    public function update(ConsultoreRequest $request, Consultore $consultore): RedirectResponse
    {
        $consultore->update($request->validated());

        return Redirect::route('consultores.index')
            ->with('success', 'Consultore updated successfully');
    }

    public function destroy(Consultore $consultore): RedirectResponse
    {

        // Verifica compromissos vinculados
        if ($consultore->compromissos()->count() > 0) {
            return Redirect::route('consultores.index')
                ->with('error', 'Não é possível excluir um consultor, pois possui compromissos vinculados.');
        }
    
        // Se não houver compromissos, exclui o consultor
        $consultore->delete();
    
        return Redirect::route('consultores.index')
            ->with('success', 'Consultor excluído com sucesso!');
    }
}
