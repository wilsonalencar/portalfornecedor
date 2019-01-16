@extends('...layouts.master')

@section('content')
<div id="page-wrapper">
    <div id="page-inner"> 
        <form action="{{ action('PagesController@home') }}" method="get">
        <div class="main">
            <div class="card">
                <div class="card-action">
                    <div class="row">
                        <div class="col-md-12">
                            <span><h3>{!! Form::label('multiple_select_tributos[]', 'Selecionar Empresa', ['class' => 'with-gap'] )  !!}</h3></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            {!!  Form::select('empresa_selecionada', $empresas, array(), ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Selecionar', ['class' => 'btn btn-success-block']) !!}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@stop
