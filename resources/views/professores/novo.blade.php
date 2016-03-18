@extends('layout')
@section('conteudo')

<div class="container">

    <h1>Novo Professor</h1>

    @if($errors->any())
        <ul class="alert alert-warning">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
        </ul>
    @endif
    {!! Form::open(['route'=>'professores.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('matricula', 'Matricula: ') !!}
        {!! Form::text ('matricula', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('Curriculo', 'Curriculo (link): ') !!}
        {!! Form::text ('curriculo', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection