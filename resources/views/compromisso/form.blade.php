<div class="row padding-1 p-1">
    <div class="col-md-12">
        <!-- Campo de seleção de Consultor -->
        <div class="form-group mb-2 mb20">
            <label for="consultor_id" class="form-label">{{ __('Consultor') }}</label>
            <select name="consultor_id" class="form-control @error('consultor_id') is-invalid @enderror">
                <option value="">Selecione um Consultor</option>
                @foreach($consultores as $consultor)
                    <option value="{{ $consultor->id }}" {{ old('consultor_id', $compromisso?->consultor_id) == $consultor->id ? 'selected' : '' }}>
                        {{ $consultor->nome_completo }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('consultor_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Outros campos do formulário -->
        <div class="form-group mb-2 mb20">
            <label for="data" class="form-label">{{ __('Data') }}</label>
            <input type="date" name="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data', $compromisso?->data) }}" id="data" placeholder="Data">
            {!! $errors->first('data', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_inicio" class="form-label">{{ __('Hora Início') }}</label>
            <input type="time" name="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio', $compromisso?->hora_inicio) }}" id="hora_inicio" placeholder="Hora Início">
            {!! $errors->first('hora_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_fim" class="form-label">{{ __('Hora Fim') }}</label>
            <input type="time" name="hora_fim" class="form-control @error('hora_fim') is-invalid @enderror" value="{{ old('hora_fim', $compromisso?->hora_fim) }}" id="hora_fim" placeholder="Hora Fim">
            {!! $errors->first('hora_fim', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="intervalo" class="form-label">{{ __('Intervalo') }}</label>
            <input type="time" name="intervalo" class="form-control @error('intervalo') is-invalid @enderror" value="{{ old('intervalo', $compromisso?->intervalo) }}" id="intervalo" placeholder="Intervalo">
            {!! $errors->first('intervalo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">salvar</button>
    </div>
</div>
