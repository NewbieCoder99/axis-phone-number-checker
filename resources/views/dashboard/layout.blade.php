<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ @$pageName }} - {{ env('APP_NAME') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.css"/>
        <style type="text/css">
            textarea {
                resize: none;
            }

            label {
                cursor: pointer;
            }
        </style>
        @yield('css')

    </head>
    <body class="nav-fixed">

        @include('dashboard.includes.navigation')

        {{-- layoutSidenav --}}
        <div id="layoutSidenav">

            {{-- layoutSidenav_nav --}}
            <div id="layoutSidenav_nav">
                {{-- sidenav shadow-right sidenav-light --}}
                <nav class="sidenav shadow-right sidenav-light">

                    {{-- sidenav-menu --}}
                    <div class="sidenav-menu">
                        @include('dashboard.includes.sidenav-menu')
                    </div>
                    {{-- ./ sidenav-menu --}}

                    {{-- sidenav-footer --}}
                    <div class="sidenav-footer">
                        @include('dashboard.includes.sidenav-footer')
                    </div>
                    {{-- ./ sidenav-footer --}}

                </nav>
                {{-- ./ sidenav shadow-right sidenav-light --}}
            </div>
            {{-- ./ layoutSidenav_nav --}}

            <div id="layoutSidenav_content">
                <main>

                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        @yield('pageName')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <div class="container-xl px-4 mt-n10">
                        <div class="row">
                            @yield('contents')
                        </div>
                    </div>

                </main>
            </div>

        </div>
        {{-- ./ layoutSidenav --}}

        <script src="//code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        </script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/scripts.js') }}"></script>
        <script src="{{ asset('dashboard/js/litepicker.js') }}"></script>

        @yield('scripts')

    </body>
</html>