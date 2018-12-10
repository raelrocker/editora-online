@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Capítulos de {{$book->title}}</h3>
            {!! Button::primary('Novo capítulo')->asLinkTo(route('chapters.create', ['book' => $book->id])) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET' ]) !!}
                {!! Form::label('search', 'Pesquisar por título:', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control']) !!}

                {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($chapters->items())
                    ->striped()
                    ->callback('Ações', function($field, $chapter) use ($book) {
                        $linkEdit = route('chapters.edit', ['book' => $book->id, 'chapter' => $chapter->id]);
                        $linkDestroy = route('chapters.destroy', ['book' => $book->id, 'chapter' => $chapter->id]);
                        $deleteForm = "delete-form-{$chapter->id}";
                        $form = Form::open([
                                    'route' => ['chapters.destroy', 'book' => $book->id, 'chapter' => $chapter->id],
                                    'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display: none']) .
                                Form::close();
                         $anchorDestroy = Button::link('Ir para a lixeira')->asLinkTo($linkDestroy)
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

            {!! $chapters->links() !!}
        </div>
    </div>
@endsection