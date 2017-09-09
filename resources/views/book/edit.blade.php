@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>
            {!! Form::model($book, [
                'route' => ['books.update', 'book' => $book->id],
                'class' => 'form',
                'method' => 'PUT'
            ]) !!}

            {!! Html::openFormGroup('author', $errors) !!}
                {!! Form::label('author', 'Author') !!}
                {!! Form::text('author', $book->user->name, ['class' => 'form-control', 'readonly' => 'true']) !!}
            {!! Html::closeFormGroup() !!}

            @include('book._form')

            {!! Html::openFormGroup() !!}
                {!! Form::hidden('user_id', null) !!}
                {!! Button::primary('Salvar livro')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection