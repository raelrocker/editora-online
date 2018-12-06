@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Permissões de {{$role->name}}</h3>
        </div>
        <div class="row">
            {!! Form::open(['route' => ['codeeduuser.roles.permissions.edit', $role->id], 'class' => 'form', 'method' => 'PUT']) !!}
                <ul class="list-inline">
                    @foreach($permissions as $permission)
                        <li>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> {{$permission->resource_description}}
                                </label>
                            </div>
                        </li>
                    }
                    @endforeach
                </ul>
                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Salvar')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection