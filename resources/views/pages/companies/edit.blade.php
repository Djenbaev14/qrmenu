@extends('layouts.main')

@section('title', 'Настройки')
@section('content')

<div class="content-body">
	<div class="container-fluid">

				<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
						<div class="flex-grow-1">
								<h4 class="fs-18 fw-semibold m-0">{{$company->name}}</h4>
						</div>
				</div>
        <!-- General Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form method="POST" action="{{route('companies.update',$company->id)}}" enctype="multipart/form-data">
                                  @csrf
                                  @method('PATCH')
                                  <div class="mb-3">
                                    <div id="upload-container" >
                                        <label for="logo-upload" id="upload-label">
                                            @if ($company->logo)
                                                <span id="change-icon" style="display: inline-block">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                <img id="logo-preview" src={{asset('images/company-logo/'.$company->logo)}} style="display:block" alt="Yuklangan rasm"/>
                                            @else
                                                <span id="change-icon">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                <img id="logo-preview" src="" style="display:none" alt="Yuklangan rasm"/>
                                                <div id="upload-area">
                                                    <div id="placeholder">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                        <p>Перенесите логотип сюда или <span class="select-text">выбрать</span></p>
                                                        <p>Размер файла до 10 МБ</p>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                        </label>
                                        <input type="file" name="logo" id="logo-upload" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                    </div>
                                  </div>
                                  <div class="mb-5">
                                    <div class="card" style="background-color: #EEF9F2">
                                        <div class="mt-3 mx-3">
                                            <p class="d-flex align-items-top"><svg class="mx-2" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11.4998" cy="6.70833" r="0.958333" fill="#5DC983"></circle><path d="M10.5415 9.58366H11.4998V16.292M21.0832 11.5003C21.0832 16.7931 16.7926 21.0837 11.4998 21.0837C6.20711 21.0837 1.9165 16.7931 1.9165 11.5003C1.9165 6.2076 6.20711 1.91699 11.4998 1.91699C16.7926 1.91699 21.0832 6.2076 21.0832 11.5003Z" stroke="#5DC983" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path></svg> Если вы хотите отобразить логотип на сайте, мы рекомендуем вам загрузить его 
                                            </p>
                                            <img src="{{asset('logo-image/restaurant_logo.png')}}" width="200px" alt="">
                                        </div>
                                    </div>
                                  </div>
                                  
                                <div class="mb-3">
                                    <div id="upload-container-2" >
                                        <label for="logo-upload-2" id="upload-label-2">
                                            @if ($company->banner_image)
                                                <span id="change-icon-2" style="display: inline-block">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                <img id="logo-preview-2" src="{{asset('images/banner/'.$company->banner_image)}}" alt="Yuklangan rasm" style="display: block;" />
                                            @else
                                                <span id="change-icon-2">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                <img id="logo-preview-2" src="#" alt="Yuklangan rasm" style="display: none;" />
                                                <div id="upload-area-2">
                                                    <div id="placeholder-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                        <p>Переместите баннер сюда или <span class="select-text">выбрать</span></p>
                                                        <p>Размер файла до 10 МБ</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </label>
                                        <input type="file" name="banner_image" id="logo-upload-2" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                    </div>
                                </div>
                                <div class="mb-5">
                                  <div class="card" style="background-color: #EEF9F2">
                                      <div class="mt-3 mx-3">
                                          <p class="d-flex align-items-top"><svg class="mx-2" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11.4998" cy="6.70833" r="0.958333" fill="#5DC983"></circle><path d="M10.5415 9.58366H11.4998V16.292M21.0832 11.5003C21.0832 16.7931 16.7926 21.0837 11.4998 21.0837C6.20711 21.0837 1.9165 16.7931 1.9165 11.5003C1.9165 6.2076 6.20711 1.91699 11.4998 1.91699C16.7926 1.91699 21.0832 6.2076 21.0832 11.5003Z" stroke="#5DC983" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path></svg> Если вы хотите показать баннер на сайте, мы рекомендуем вам загрузить его
                                          </p>
                                          <img src="{{asset('logo-image/restaurant_banner.png')}}" width="200px" alt="">
                                      </div>
                                  </div>
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">Контактный телефон:</label>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">+998</span>
                                                </div>
                                                <input name="telephone" maxlength="9" placeholder="1234567" value="{{$company->telephone}}" class="form-control" type="tel" />
                                            </div>
                                            @if($errors->has('telephone'))
                                                <div class="error text-danger">{{ $errors->first('telephone') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Ссылка на социальные сети:</label>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-2 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/instagram-new.png" alt="Instagram"></span>
                                                </div>
                                                <input id="Instagram" class="form-control" type="url" name="instagram" value="<?=($company) ? $company->instagram : ''   ?>" placeholder="Instagram"/>
                                            </div>
                                            @if($errors->has('instagram'))
                                                <div class="error text-danger">{{ $errors->first('instagram') }}</div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-lg-12 col-sm-12 mb-2 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/telegram-app.png" alt="Telegram"></span>
                                                </div>
                                                <input id="Telegram" class="form-control" value="<?=($company) ? $company->telegram : ''   ?>" name="telegram" type="url" placeholder="Telegram"/>
                                                @if($errors->has('telegram'))
                                                    <div class="error text-danger">{{ $errors->first('telegram') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="filial_nomi">Название компании:</label>
                                    <input id="filial_nomi" class="form-control form-control-lg" value="<?=($company) ? $company->name : ''   ?>" type="text" name="name" placeholder="Введите название компании">
                                    @if($errors->has('name'))
                                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="address">Введите адрес:</label>
                                    <input id="address" class="form-control form-control-lg" value="<?=($company) ? $company->address : ''   ?>" type="text" name="address" placeholder="Введите адрес">
                                    @if($errors->has('address'))
                                        <div class="error text-danger">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary " value="Сохранить">
                                </div>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


		</div> <!-- container-fluid -->
	</div> 
@endsection

@push('css')
    <link href="{{asset('css/logo-upload.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
        <script src="{{asset('js/logo-upload.js')}}"></script>
        <script src="{{asset('js/logo-upload2.js')}}"></script>
@endpush