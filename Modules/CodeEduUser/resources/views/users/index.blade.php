@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary('Novo usuário')->asLinkTo(route('codeeduuser.users.create')) !!}
        </div>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET' ]) !!}
            {!! Form::label('search', 'Pesquisar por nome:', ['class' => 'control-label']) !!}
            {!! Form::text('search', null, ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($users->items())
                    ->striped()
                    ->callback('Ações', function($field, $user) {
                        $linkEdit = route('categories.edit', ['user' => $user->id]);
                        $linkDestroy = route('categories.destroy', ['user' => $user->id]);
                        $deleteForm = "delete-form-{$user->id}";
                        $form = Form::open([
                                    'route' => ['categories.destroy', 'user' => $user->id],
                                    'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display: none']) .
                                Form::close();
                         $anchorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)
                                            ->addAttributes([
                                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                            ]);

                        return "<ul class=\"list-inline\">" .
                                  "<li>" . Button::link('Editar')->asLinkTo($linkEdit) . "<li>" .
                                  "<li>|</li>" .
                                  "<li>" . $anchorDestroy . "<li>" .
                               "</ul>" .
                               $form;
                    })
            !!}

            {!! $users->links() !!}
        </div>
    </div>
@endsection