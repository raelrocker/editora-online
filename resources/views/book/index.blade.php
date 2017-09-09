@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de livros</h3>
            {!! Button::primary('Novo livro')->asLinkTo('books.create') !!}
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Price</th>
                        <th>Author</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->subtitle }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->user->name }}</td>
                        <td>
                            <ul class="list-inline">
                                <li>
                                    <a href="{{ route('books.edit', ['book' => $book->id]) }}">Editar</a>
                                </li>
                                <li>|</li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{ route('books.destroy', ['book' => $book->id]) }}"
                                        onclick="event.preventDefault(); document.getElementById('{{ $deleteForm }}').submit();">Excluir</a>
                                    {!! Form::open([
                                        'route' => ['books.destroy', 'book' => $book->id],
                                        'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display: none']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>


                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {!! $books->links() !!}
        </div>
    </div>
@endsection