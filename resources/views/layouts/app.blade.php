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
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <?php
            $navbar = Navbar::withBrand(config('app.name'), url('/'))->inverse();
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
                $logout = Navigation::links([
                    [
                        Auth::user()->name,
                        [
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
                $navbar->withContent($links)->withContent($logout);
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src='/js/ckeditor/ckeditor.js'></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            // Define changes to default configuration here.
            // For complete reference see:
            // http://docs.ckeditor.com/#!/api/CKEDITOR.config

            // The toolbar groups arrangement, optimized for two toolbar rows.
            toolbarGroups: [
                    // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                    // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
                    // { name: 'links' },
                    // { name: 'insert' },
                    // { name: 'forms' },
                    { name: 'tools' },
                    // { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },

                    // '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    // { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'styles' },
                    { name: 'others' }
                    // { name: 'colors' },
                    // { name: 'about' }
            ],

            // Remove some buttons provided by the standard plugins, which are
            // not needed in the Standard(s) toolbar.
            removeButtons: 'Underline,Subscript,Superscript',
            extraPlugins: 'markdown',  // this is the point!
            // Set the most common block elements.
            format_tags: 'p;h1;h2;h3;pre',

            // Simplify the dialog windows.
            removeDialogTabs: 'image:advanced;link:advanced'
        });
    </script>  
</body>
</html>
