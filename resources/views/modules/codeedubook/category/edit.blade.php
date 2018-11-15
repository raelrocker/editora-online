@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>
            {!! Form::model($category, [
                'route' => ['categories.update', 'category' => $category->id],
                'class' => 'form',
                'method' => 'PUT'
            ]) !!}

            @include('codeedubook::category._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar categoria')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection