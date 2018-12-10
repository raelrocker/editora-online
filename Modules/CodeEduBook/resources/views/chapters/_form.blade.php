{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name', 'Nome') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('order', $errors) !!}
    {!! Form::label('order', 'Ordem') !!}
    {!! Form::text('order', 1, ['class' => 'form-control']) !!}
    {!! Form::error('order', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('content', $errors) !!}
    {!! Form::label('content', 'Conteúdo') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    {!! Form::error('content', $errors) !!}
{!! Html::closeFormGroup() !!}