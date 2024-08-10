@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Compromisso
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Novo Compromisso</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('compromissos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('compromisso.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
