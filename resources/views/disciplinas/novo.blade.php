@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Nova Disciplina </span>
        </div>
        {!! Form::open(['route'=>'disciplinas.salvar']) !!}
        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::text ('codigo', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('carga_horaria', 'Carga horária: ') !!}
            {!! Form::text ('carga_horaria', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('ementa', 'Ementa (link): ') !!}
            {!! Form::text ('ementa', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <fieldset>
                <ul id="pre_requisitos">
                    <legend>Pré-requisitos</legend>
                    @foreach($disciplinas as $disciplina)
                        {!! Form::checkbox('pre_requisitos[]', $disciplina->id, false, ['id'=>$disciplina->codigo, 'class'=>'filled-in']) !!}
                        {!! Form::label($disciplina->codigo, $disciplina->nome) !!}
                        <br/>
                    @endforeach
                </ul>
            </fieldset>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection