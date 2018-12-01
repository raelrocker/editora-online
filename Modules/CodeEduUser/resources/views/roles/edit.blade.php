@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Papel de Usuário</h3>
            {!! Form::model($role, [
                'route' => ['codeeduuser.roles.update', 'role' => $role->id],
                'class' => 'form',
                'method' => 'PUT'
            ]) !!}

            @include('codeeduuser::roles._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar Papel de Usuário')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection