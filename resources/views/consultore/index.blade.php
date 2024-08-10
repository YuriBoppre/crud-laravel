@extends('layouts.app')

@section('template_title')
Consultores
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form method="GET" action="{{ route('consultores.index') }}">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="data_inicio">Data Início</label>
                        <input type="text" name="nome_completo" class="form-control" placeholder="Filtrar por Nome"
                        value="{{ request('nome_completo') }}" style="width: 100%;">
                    </div>              
                </div>
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>    

            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Consultores') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('consultores.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                Novo
                            </a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Nome Completo</th>
                                    <th>Valor Hora</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultores as $consultore)
                                    <tr>
                                        <td>{{ $consultore->nome_completo }}</td>
                                        <td>{{ $consultore->valor_hora }}</td>
                                        <td>
                                            <form action="{{ route('consultores.destroy', $consultore->id) }}"
                                                method="POST">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('consultores.show', $consultore->id) }}"><i
                                                        class="fa fa-fw fa-eye"></i> Visualizar</a>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('consultores.edit', $consultore->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i> Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault(); confirm('Tem certeza que deseja deletar?') ? this.closest('form').submit() : false;"><i
                                                        class="fa fa-fw fa-trash"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $consultores->withQueryString()->links() !!}
        </div>
    </div>
</div>

@endsection