<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Eatio - Restaurant Food Order Bootstrap Admin Dashboard</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <link href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <style>
                
        .modal.right.fade.in .modal-dialog {
        right:0 !important;
        transform: translateX(-50%);
        }
        .modal.right .modal-content {
        height:100%;
        overflow:auto;
        border-radius:0;
        }
        .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
        }
        .modal.right.fade.in .modal-dialog {
        transform: translateX(0%);
        }
        .modal.right.fade .modal-dialog {
        right: 0px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
        }
        .modal.right .modal-header::after {content:""; display:inline-block;}
    </style>
    @stack('css')
</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('components.header')
        @include('components.navbar')
        @yield('content')
    </div>
    @include('sweetalert::alert')
    @stack('js')

    <script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
	<script src="{{asset('js/deznav-init.js')}}"></script>
    {{-- select2 --}}
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('js/plugins-init/select2-init.js')}}"></script>
</body>
</html>