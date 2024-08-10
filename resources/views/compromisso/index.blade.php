@extends('layouts.app')

@section('template_title')
    Compromissos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form method="GET" action="{{ route('compromissos.index') }}" class="mb-3">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="data_inicio">Data Início</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="data_fim">Data Fim</label>
                            <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ request('data_fim') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="consultor_id">Consultor</label>
                            <select name="consultor_id" id="consultor_id" class="form-control">
                                <option value="">Todos</option>
                                @foreach($consultores as $consultore)
                                    <option value="{{ $consultore->id }}" {{ request('consultor_id') == $consultore->id ? 'selected' : '' }}>
                                        {{ $consultore->nome_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Compromissos') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('compromissos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                        <th>Consultor</th>
                                        <th>Data</th>
                                        <th>Hora Início</th>
                                        <th>Hora Fim</th>
                                        <th>Intervalo</th>
                                        <th>Total Horas</th>
                                        <th>Valor Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromissos as $compromisso)
                                        @php
                                            try {
                                                $inicio = \Carbon\Carbon::createFromFormat('H:i', $compromisso->hora_inicio);
                                                $fim = \Carbon\Carbon::createFromFormat('H:i', $compromisso->hora_fim);
                                                $intervalo = \Carbon\Carbon::createFromFormat('H:i', $compromisso->intervalo);

                                                $totalMinutos = $fim->diffInMinutes($inicio) - $intervalo->diffInMinutes($inicio);
                                                $totalHoras = max($totalMinutos / 60, 0);
                                                $valorTotal = $totalHoras * ($compromisso->consultore->valor_hora ?? 0);
                                            } catch (Exception $e) {
                                                $totalHoras = 0;
                                                $valorTotal = 0;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $compromisso->consultore->nome_completo ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($compromisso->data)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($compromisso->hora_inicio)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($compromisso->hora_fim)->format('H:i') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($compromisso->intervalo)->format('H:i') }}</td>
                                            <td>{{ number_format($totalHoras, 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($valorTotal, 2, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('compromissos.destroy', $compromisso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('compromissos.show', $compromisso->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> Visualizar
                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('compromissos.edit', $compromisso->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> Editar
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Tem certeza que deseja deletar?') ? this.closest('form').submit() : false;">
                                                        <i class="fa fa-fw fa-trash"></i> Deletar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total Geral:</th>
                                        <th>{{ number_format($totalHoras, 2, ',', '.') }} horas</th>
                                        <th>R$ {{ number_format($valorTotal, 2, ',', '.') }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compromissos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection