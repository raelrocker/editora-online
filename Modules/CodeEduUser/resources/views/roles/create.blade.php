@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo Papel de Usuário</h3>

            {!! Form::open(['route' => 'codeeduuser.roles.store', 'class' => 'form']) !!}

                 @include('codeeduuser::roles._form')

                {!! Html::openFormGroup() !!}
                        {!! Button::primary('Criar papel de usuário')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection