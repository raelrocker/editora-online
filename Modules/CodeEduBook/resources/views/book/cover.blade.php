@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Cover de: {{$book->title}} </h2>
            {!! Form::open(['route' => ['books.cover.store', $book->id], 'files' => true]) !!}
            
            {!! Form::hidden('redirect_to', URL::previous()) !!}
            
            {!! Html::openFormGroup('file', $errors) !!}
                {!! Form::label('file', 'Cover (formato aceito: .jpg)') !!}
                {!! Form::file('file', null, ['class' => 'form-control']) !!}
                {!! Form::error('file', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection