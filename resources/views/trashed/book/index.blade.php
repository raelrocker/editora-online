@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Lixeira de livros</h3>
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
                Table::withContents($books->items())
                    ->striped()
                    ->callback('Ações', function($field, $book) {
                        $linkView = route('trashed.books.show', ['book' => $book->id]);
                        $linkDestroy = route('books.destroy', ['book' => $book->id]);
                        $deleteForm = "delete-form-{$book->id}";
                        $form = Form::open([
                                    'route' => ['books.destroy', 'book' => $book->id],
                                    'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display: none']) .
                                Form::close();
                         $anchorDestroy = Button::link('Excluir')->asLinkTo($linkDestroy)
                                            ->addAttributes([
                                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteForm}\").submit();"
                                            ]);

                        return "<ul class=\"list-inline\">" .
                                  "<li>" . Button::link('Ver')->asLinkTo($linkView) . "<li>" .
                                  "<li>|</li>" .
                                  "<li>" . $anchorDestroy . "<li>" .
                               "</ul>" .
                               $form;
                    })
            !!}

            {!! $books->links() !!}
        </div>
    </div>
@endsection