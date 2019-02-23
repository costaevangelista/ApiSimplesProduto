<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CW Produtos - Painel Administrativo SPA - Laravel|VUE|MYSQL</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">


        <!-- Compiled and minified CSS -->
        <!-- Styles -->
        <link href="{{asset('css/app.css') }}" rel="stylesheet" />

    </head>
    <body>
            <div id="app">
            <div class="container-fluid">

                <!-- Image and text -->

                    <nav class="navbar navbar-light alert bg-light">
                        <a class="navbar-brand" href="#">
                        <img src="http://costawebs.com.br/_images_clientes/icone_frete.png" width="30" height="30" class="d-inline-block align-top" alt="">
                        Cw Produto
                        </a>
                    </nav>
                    <p></p>
                    <div class="row flex-xl-nowrap">
                    <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                              <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Produtos</a>
                              <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Usuários</a>
                              <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Categorias</a>
                              <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Dashboard</a>
                            </div>
                    </div>

                    <div class="col-10">
                            @yield('content')
                    </div>


                </div>


                <footer class="text-center alert bg-light col-12">
                    ©2018- {{ date("Y") }} CostaWebs, CW. Todos os direitos reservados
                </footer>
            </div>

        </div>
        <script src={{asset('js/app.js') }}></script>
    </body>
</html>
