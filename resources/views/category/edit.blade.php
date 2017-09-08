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

            @include('category._form')

            {!! Html::openFormGroup() !!}
                {!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection