<!DOCTYPE html>
<html lang="en">


<head>
    <meta name="description" content="">
{{--    {{ config('app.name') }}--}}
    <title>Movies</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/main-teal.css') }}" media="all">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">

    @if (app()->getLocale() == 'ar')

        {{--google font--}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600&display=swap">

        <style>
            body {
                font-family: 'cairo', 'sans-serif';
            }

            .breadcrumb-item + .breadcrumb-item {
                padding-left: .5rem;
            }

            .breadcrumb-item + .breadcrumb-item::before {
                padding-left: .5rem;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                margin: 2px 2px;
            }
        </style>
    @endif

    {{--jquery--}}
    <script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-ui.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin_assets/plugins/noty/noty.min.js') }}"></script>

    {{--datatable--}}
    <script type="text/javascript" src="{{ asset('admin_assets/plugins/jquery.dataTables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_assets/plugins/dataTables.bootstrap/dataTables.bootstrap.min.js') }}"></script>

    {{--magnific-popup--}}
    <link rel="stylesheet" href="{{ asset('admin_assets/plugins/magnific-popup/magnific-popup.css') }}">

{{--    apexchar--}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    {{--<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>--}}
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    <link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css')}}">

    <style>
        .loader {
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        .loader-sm {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #009688;
            width: 40px;
            height: 40px;
        }

        .loader-md {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #009688;
            width: 60px;
            height: 60px;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>





<body class="app sidebar-mini">
<!-- Navbar-->
@include('layouts.includes.header')
@include('layouts.includes.aside')
<main class="app-content">
    @include('layouts.includes.partials._session')
    @yield('content')
    @yield('modal')
</main>
@include('layouts.includes.footer')
@stack('scripts')
@yield('script')

