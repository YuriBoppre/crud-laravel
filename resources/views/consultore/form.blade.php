<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nome_completo" class="form-label">{{ __('Nome Completo') }}</label>
            <input type="text" name="nome_completo" class="form-control @error('nome_completo') is-invalid @enderror" value="{{ old('nome_completo', $consultore?->nome_completo) }}" id="nome_completo" placeholder="Nome Completo">
            {!! $errors->first('nome_completo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="valor_hora" class="form-label">{{ __('Valor Hora') }}</label>
            <input type="text" name="valor_hora" class="form-control @error('valor_hora') is-invalid @enderror" value="{{ old('valor_hora', $consultore?->valor_hora) }}" id="valor_hora" placeholder="Valor Hora">
            {!! $errors->first('valor_hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>