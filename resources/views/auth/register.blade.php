<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Eatio - Restaurant Food Order Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6 mt-5">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4 card-title">Регистрация</h4>
                                    <form action="{{route('register.post')}}" method="POST" class="my-4">
                                      @csrf
                                      <div class="form-group mb-3">
                                          <label for="company_name" class="form-label">Название компании</label>
                                          <input class="form-control" name="company_name" value="{{old('company_name')}}" type="text" id="company_name" required="" placeholder="Введите название компании">
                                      </div>
                                        <div class="form-group  mb-3">
                                            <label for="username" class="form-label">Ваше имя</label>
                                            <input class="form-control" name="name" type="text" value="{{old('name')}}" id="username" required="" placeholder="Введите свое имя">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="emailaddress" class="form-label">Номер телефона</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+998</span>    
                                                </div>
                                              <input class="form-control" type="text" value="{{old('phone')}}" name="phone" maxlength="9" id="emailaddress" required="" placeholder="Введите номер телефона">
                                            </div>
                                        </div>
            
                                        <div class="form-group mb-3">
                                          <label for="password" class="form-label">Введите пароль</label>
                                          <input class="form-control" name="password" value="{{old('password')}}" type="password" required="" id="password" placeholder="Введите пароль">
                                      </div>
                                      <div class="form-group mb-3">
                                          <label for="password" class="form-label">Введите пароль еще раз</label>
                                          <input class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" type="password" required="" id="password" placeholder="Введите пароль еще раз">
                                      </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit"> Зарегистрировать</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="text-center text-muted mt-4 new-account">
                                        <p class="mb-0">У вас уже есть учетная запись ?<a class='text-primary ms-2 fw-medium' href='{{route('login')}}'><br>Войдите в систему здесь</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

    <!-- Jquery Validation -->
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="./js/plugins-init/jquery.validate-init.js"></script>

</body>
</html>