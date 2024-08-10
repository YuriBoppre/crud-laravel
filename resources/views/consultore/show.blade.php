@extends('layouts.app')

@section('template_title')
    {{ $consultore->name ?? __('Show') . " " . __('Consultore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Detalhes do Consultor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('consultores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nome Completo:</strong>
                                    {{ $consultore->nome_completo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Valor Hora:</strong>
                                    {{ $consultore->valor_hora }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
