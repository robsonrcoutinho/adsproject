@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Avaliações</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Semestre</th>
                <th>Início</th>
                <th>Término</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($avaliacoes as $avaliacao)
                <tr>
                    <td>{{$avaliacao->semestre->codigo}}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->termino)) }}</td>
                    <td>
                        @can('alterar', $avaliacao)
                        <a class="btn-flat disabled" href="{{ route('avaliacoes.editar', ['id'=>$avaliacao->id]) }}">Editar</a>
                        @endcan
                        @can('excluir', $avaliacao)
                        <a class="btn-flat disabled btn-excluir"
                           href="{{ route('avaliacoes.excluir', ['id'=>$avaliacao->id]) }}">Excluir</a>
                        @endcan
                        @can('relatorio', $avaliacao)
                        <a class="btn-flat disabled" target="_blank"
                           href="{{ route('avaliacoes.relatorio', ['id'=>$avaliacao->id]) }}">Relatório</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Sem Avaliações!</td>
                </tr>
            @endforelse
            </tbody>
            {!! $avaliacoes->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Avaliacao())
        <a href="{{ route('avaliacoes.novo')}}" class="btn btn-default"> Nova avaliação</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection