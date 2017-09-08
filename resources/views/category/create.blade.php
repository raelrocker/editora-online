@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>

            {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}

                 @include('category._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Criar categoria')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection