{!! Form::hidden('redirect_to', URL::previous()) !!}
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

{!! Html::openFormGroup(['categories', 'categories.*'], $errors) !!}
    {!! Form::label('categories[]', 'Categorias') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
    {!! Form::error('categories', $errors) !!}
    {!! Form::error('categories.*', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['dedication'], $errors) !!}
    {!! Form::label('dedication', 'Dedicatória', ['class' => 'control-label']) !!}
    {!! Form::textarea('dedication', null, ['class' => 'form-control']) !!}
    {!! Form::error('dedication', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['description'], $errors) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['website'], $errors) !!}
    {!! Form::label('websitewebsite', 'Website', ['class' => 'control-label']) !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
    {!! Form::error('website', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['percent_complete'], $errors) !!}
    {!! Form::label('percent_complete', 'Concluído (%)', ['class' => 'control-label']) !!}
    {!! Form::number('percent_complete', null, ['class' => 'form-control']) !!}
    {!! Form::error('percent_complete', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup() !!}
    <label>
        {!! Form::checkbox('published') !!} Publicado?
    </label>
{!! Html::closeFormGroup() !!}