@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de livros</h3>
            {!! Button::primary('Novo livro')->asLinkTo(route('books.create')) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'), ['class' => 'form-inline', 'method' => 'GET' ]) !!}
                {!! Form::label('search', 'Pesquisar por título ou categoria:', ['class' => 'control-label']) !!}
                {!! Form::text('search', null, ['class' => 'form-control']) !!}

                {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($books->items())
                    ->striped()
                    ->callback('Ações', function($field, $book) {
                        $linkEdit = route('books.edit', ['book' => $book->id]);
                        $linkDestroy = route('books.destroy', ['book' => $book->id]);
                        $linkChapters = route('chapters.index', ['book' => $book->id]);
                        $linkCover = route('books.cover.create', ['book' => $book->id]);
                        $linkExport = route('books.export', ['book' => $book->id]);
                        
                        $deleteFormId = "delete-form-{$book->id}";
                        $deleteForm = Form::open([
                                        'route' => ['books.destroy', 'book' => $book->id],
                                        'method' => 'DELETE', 'id' => $deleteFormId, 'style' => 'display: none']) .
                                      Form::close();
                         $anchorDestroy = Button::link('Ir para a lixeira')->asLinkTo($linkDestroy)
                                            ->addAttributes([
                                                'onclick' => "event.preventDefault(); document.getElementById(\"{$deleteFormId}\").submit();"
                                            ]);
                        $exportFormId = "export-form-{$book->id}";
                        $exportForm = Form::open([
                                        'route' => ['books.export', 'book' => $book->id],
                                        'method' => 'POST', 'id' => $exportFormId, 'style' => 'display: none']) .
                                      Form::close();
                         $anchorExport = Button::link('Exportar')->asLinkTo($linkExport)
                                            ->addAttributes([
                                                'onclick' => "event.preventDefault(); document.getElementById(\"{$exportFormId}\").submit();"
                                            ]);
                        return "<ul class=\"list-inline\">" .
                                  "<li>" . $anchorExport . "<li>" .
                                      "<li>|</li>" .
                                  "<li>" . Button::link('Capítulos')->asLinkTo($linkChapters) . "<li>" .
                                  "<li>|</li>" .
                                  "<li>" . Button::link('Cover')->asLinkTo($linkCover) . "<li>" .
                                  "<li>|</li>" .
                                  "<li>" . Button::link('Editar')->asLinkTo($linkEdit) . "<li>" .
                                  "<li>|</li>" .
                                  "<li>" . $anchorDestroy . "<li>" .
                               "</ul>" .
                               $deleteForm . $exportForm;
                    })
            !!}

            {!! $books->links() !!}
        </div>
    </div>
@endsection