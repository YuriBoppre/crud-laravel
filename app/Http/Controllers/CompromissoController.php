<?php

namespace App\Http\Controllers;

use App\Models\Compromisso;
use App\Models\Consultore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CompromissoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Exception;

class CompromissoController extends Controller
{

    public function index(Request $request): View
    {
        $query = Compromisso::query();

        // Filtros
        if ($request->filled('data_inicio')) {
            $query->where('data', '>=', $request->input('data_inicio'));
        }

        if ($request->filled('data_fim')) {
            $query->where('data', '<=', $request->input('data_fim'));
        }

        if ($request->filled('consultor_id')) {
            $query->where('consultor_id', $request->input('consultor_id'));
        }

        $compromissos = $query->with('consultore')->paginate();
        $consultores = Consultore::all();
        
        // Totalizadores
        $totalHoras = 0;
        $valorTotal = 0;

        foreach ($compromissos as $compromisso) {
            try {
                $inicio = Carbon::createFromFormat('H:i', $compromisso->hora_inicio);
                $fim = Carbon::createFromFormat('H:i', $compromisso->hora_fim);
                $intervalo = Carbon::createFromFormat('H:i', $compromisso->intervalo);

                $totalMinutos = $fim->diffInMinutes($inicio) - $intervalo->diffInMinutes($inicio);
                $totalHoras += max($totalMinutos / 60, 0);

                $valorTotal += $totalHoras * ($compromisso->consultore->valor_hora ?? 0);
            } catch (Exception $e) {
                // Log ou tratar o erro
                continue;
            }
        }

        return view('compromisso.index', compact('compromissos', 'consultores', 'totalHoras', 'valorTotal'))
            ->with('i', ($request->input('page', 1) - 1) * $compromissos->perPage());
    }

    public function create(): View
    {
        $compromisso = new Compromisso();
        $consultores = Consultore::all();

        return view('compromisso.create', compact('compromisso', 'consultores'));
    }

    public function store(CompromissoRequest $request): RedirectResponse
    {
        Compromisso::create($request->validated());

        return Redirect::route('compromissos.index')
            ->with('success', 'Compromisso criado com sucesso!');
    }

    public function show($id): View
    {
        $compromisso = Compromisso::find($id);

        return view('compromisso.show', compact('compromisso'));
    }

    public function edit($id): View
    {
        $compromisso = Compromisso::find($id);
        $consultores = Consultore::all();

        return view('compromisso.edit', compact('compromisso', 'consultores'));
    }

    public function update(CompromissoRequest $request, Compromisso $compromisso): RedirectResponse
    {
        $compromisso->update($request->validated());

        return Redirect::route('compromissos.index')
            ->with('success', 'Compromisso alterado com sucesso!');
    }

    public function destroy($id): RedirectResponse
    {
        Compromisso::find($id)->delete();

        return Redirect::route('compromissos.index')
            ->with('success', 'Compromisso deletado com sucesso!');
    }
}
