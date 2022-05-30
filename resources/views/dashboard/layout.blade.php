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
        <style type="text/css">
            textarea {
                resize: none;
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
                    {{-- container-xl px-4 mt-5 --}}
                    <div class="container-xl px-4 mt-5">
                        {{-- d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4 --}}
                        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                            <div class="me-4 mb-3 mb-sm-0">
                                @yield('pageName')
                            </div>
                        </div>
                        {{-- ./ d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4 --}}

                        @yield('contents')
                    </div>
                    {{-- ./ container-xl px-4 mt-5 --}}
                </main>
            </div>

        </div>
        {{-- ./ layoutSidenav --}}

        <script src="//code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        </script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('dashboard/js/scripts.js') }}"></script>

        @yield('scripts')

    </body>
</html>