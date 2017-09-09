@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Livro</h3>
            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

            @include('book._form')

            {!! Html::openFormGroup() !!}
                {!! Form::hidden('user_id', Auth::user()->id) !!}
                {!! Button::primary('Criar livro')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection