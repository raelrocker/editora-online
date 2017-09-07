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

            {!! Html::openFormGroup('title', $errors) !!}
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                {!! Form::error('title', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup('subtitle', $errors) !!}
                {!! Form::label('subtitle', 'Subtitle') !!}
                {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                {!! Form::error('subtitle', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup('author', $errors) !!}
                {!! Form::label('author', 'Author') !!}
                {!! Form::text('author', $book->user->name, ['class' => 'form-control', 'readonly' => 'true']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup('price', $errors) !!}
                {!! Form::label('price', 'Price') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
                {!! Form::error('price', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
                {!! Form::hidden('user_id', null) !!}
                {!! Form::submit('Salvar Livro', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection