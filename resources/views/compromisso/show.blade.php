@extends('layouts.app')

@section('template_title')
    {{ $compromisso->name ?? __('Show') . " " . __('Compromisso') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Detalhes do Compromisso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('compromissos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Consultor:</strong>
                                    {{ $compromisso->consultore->nome_completo ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Data:</strong>
                                    {{ \Carbon\Carbon::parse($compromisso->data)->format('d/m/Y') }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora Inicio:</strong>
                                    {{ \Carbon\Carbon::parse($compromisso->hora_inicio)->format('H:i') }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora Fim:</strong>
                                    {{ \Carbon\Carbon::parse($compromisso->hora_fim)->format('H:i') }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Intervalo:</strong>
                                    {{ \Carbon\Carbon::parse($compromisso->intervalo)->format('H:i') }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
