<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/store.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::check() ? Auth::user()->id : null
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <?php
            $appName = config('app.name');

            $navbar = Navbar::withBrand("<img src=\"img/logo.png\" title=\"$appName\" alt=\"$appName\">", url('/'));
            if (Auth::check()) {
                $arrayLinks = [
                    [
                        'link' => route('categories.index'),
                        'title' => 'Categoria',
                        'permission' => 'categorias-admin/list'
                    ],
                    [
                        'Livro',
                        [
                            [
                                'link' => route('books.index'),
                                'title' => 'Listar',
                                'permission' => 'books-admin/list'
                            ],
                            [
                                'link' => route('trashed.books.index'),
                                'title' => 'Lixeira',
                                'permission' => 'books-trashed-admin/list'
                            ]
                        ]
                    ],
                    [
                        'Usuários',
                        [
                            [
                                    'link' => route('codeeduuser.users.index'),
                                    'title' => 'Listar',
                                    'permission' => 'user-admin/list'
                            ],
                            [
                                    'link' => route('codeeduuser.roles.index'),
                                    'title' => 'Papel de usuário',
                                    'permission' => 'roles-admin/list'
                            ]
                        ]
                    ]
                ];
                $links = Navigation::links(\NavbarAuthorization::getLinksAuthorized($arrayLinks));
                $menuRight = Navigation::links([
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => route('store.orders'),
                                'title' => "Minhas Compras"
                            ],
                            [
                                'link' => url('/logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                        'onclick' => "event.preventDefault(); document.getElementById(\"logout-form\").submit();"
                                ]
                            ]
                        ]
                    ]
                ])->right();
                $navbar->withContent($links)->withContent($menuRight);
            } else {
                $formSearch = Form::open(['url' => route('store.search'), 'class' => 'form-inline form-search navbar-right', 'method' => 'GET']) .
                              Html::openFormGroup() .
                              InputGroup::withContents(Form::text('search', null, ['class' => 'form-control']))
                                ->append(Form::submit('', ['class' => 'btn-search'])) .
                            Html::closeFormGroup() .
                Form::close();

                $menuRight = Navigation::pills([

                        [
                                'link' => url('/logout'),
                                'title' => 'Registrar',
                                'linkAttributes' => [
                                        'class' => "btnnew btnnew-default"
                                ]
                        ],
                        [
                                'link' => url('/logout'),
                                'title' => 'Login',
                                'linkAttributes' => [
                                        'class' => "btnnew btnnew-default"
                                ]
                        ]
                ])->right()->render();
                $navbar->withContent($menuRight)->withContent("<div>$formSearch</div>");
            }
        ?>
        {!! $navbar !!}
        {!! Form::open(['url' => url('/logout'), 'id' => 'logout-form', 'style' => 'display: none']) !!}
        {!! Form::close() !!}

        @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="container">
                {!! Alert::danger(Session::get('error'))->close() !!}
            </div>
        @endif

        @yield('banner')
        @yield('menu')
        <section>
            @yield('content')
        </section>

    </div>
    <footer class="text-center">
        <p>@CodePub {{date('Y')}}</p>
    </footer>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @stack('scripts')  
</body>
</html>
