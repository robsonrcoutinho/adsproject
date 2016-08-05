@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Documentos</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Título</th>
                <th>Link</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documentos as $documento)

                <tr>
                    <td>{{$documento->titulo}}</td>
                    <td>
                        @if($documento->url !=null && $documento->url != '' )
                            <a href="{{ $documento->url }}" class="btn blue">LINK</a>
                        @endif
                    </td>
                    <td>
                        @can('alterar', $documento)
                        <a href="{{ route('documentos.editar', ['id'=>$documento->id]) }}"
                           class="btn green">Editar</a>
                        @endcan
                        @can('excluir', $documento)
                        @if($documento->id>5)
                            <a href="{{ route('documentos.excluir', ['id'=>$documento->id]) }}"
                               class="btn-danger btn red">Excluir</a>
                        @endif
                        @endcan
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <!--@can('salvar', new Documento())
                <a href="{{ route('documentos.novo')}}" class="btn btn-default"> Novo documento</a>
        @endcan -->
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
