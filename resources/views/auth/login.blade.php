<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Eatio - Restaurant Food Order Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="{{route('login')}}" class="my-4" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Телефон номер</strong></label>
                                            <input class="form-control" type="text" id="phone" required="" name="phone" placeholder="Введите свой номер телефона">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Пароль</strong></label>
                                            <input class="form-control" type="password" required="" id="password" name="password" placeholder="Введите свой пароль">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Авторизоваться</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>У вас нет учетной записи ? <a class="text-primary" href="{{route('register')}}">Зарегистрировать</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/deznav-init.js')}}"></script>

</body>

</html>