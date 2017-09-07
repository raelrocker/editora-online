@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Livro</h3>
            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

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

            {!! Html::openFormGroup('price', $errors) !!}
                {!! Form::label('price', 'Price') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
                {!! Form::error('price', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup() !!}
                {!! Form::hidden('user_id', Auth::user()->id) !!}
                {!! Form::submit('Criar Livro', ['class' => 'btn btn-primary']) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection