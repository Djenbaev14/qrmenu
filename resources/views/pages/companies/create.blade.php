@extends('layouts.main')

@section('title', 'Настройки')
@section('content')

<div class="content-body">
	<div class="container-fluid">

				<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
						<div class="flex-grow-1">
								<h4 class="fs-18 fw-semibold m-0">Настройки</h4>
						</div>
				</div>
        <!-- General Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" action="{{route('companies.store')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="filial_nomi">Название компании:</label>
                                        <input id="filial_nomi" class="form-control form-control-lg" value="{{old('name')}}" type="text" name="name" placeholder="Введите название компании">
                                        @if($errors->has('name'))
                                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-6">
                                      <div id="upload-container" >
                                          <label for="logo-upload" id="upload-label">
                                                  <span id="change-icon">&#8635;</span> 
                                                  <img id="logo-preview" src="" style="display:none" alt="Yuklangan rasm"/>
                                                  <div id="upload-area">
                                                      <div id="placeholder">
                                                          <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                          <p>Перенесите логотип сюда или <span class="select-text">выбрать</span></p>
                                                          <p>Размер файла до 10 МБ</p>
                                                      </div>
                                                  </div>
                                              
                                          </label>
                                          <input type="file" name="logo" id="logo-upload" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                          @if($errors->has('logo'))
                                              <div class="error text-danger">{{ $errors->first('logo') }}</div>
                                          @endif
                                      </div>
                                    </div>
                                    
                                  <div class="mb-3 col-6">
                                      <div id="upload-container-2" >
                                          <label for="logo-upload-2" id="upload-label-2">
                                                  <span id="change-icon-2">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                  <img id="logo-preview-2" src="#" alt="Yuklangan rasm" style="display: none;" />
                                                  <div id="upload-area-2">
                                                      <div id="placeholder-2">
                                                          <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                          <p>Переместите баннер сюда или <span class="select-text">выбрать</span></p>
                                                          <p>Размер файла до 10 МБ</p>
                                                      </div>
                                                  </div>
                                          </label>
                                          <input type="file" name="banner_image" id="logo-upload-2" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                          @if($errors->has('banner_image'))
                                              <div class="error text-danger">{{ $errors->first('banner_image') }}</div>
                                          @endif
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
                                                  <input name="telephone" maxlength="9" placeholder="1234567" value="{{old('telephone')}}" class="form-control" type="tel" />
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
                                                  <input id="Instagram" class="form-control" type="url" name="instagram" value="{{old('instagram')}}" placeholder="Instagram"/>
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
                                                  <input id="Telegram" class="form-control" value="{{old('telegram')}}" name="telegram" type="url" placeholder="Telegram"/>
                                                  @if($errors->has('telegram'))
                                                      <div class="error text-danger">{{ $errors->first('telegram') }}</div>
                                                  @endif
                                              </div>
                                          </div>
                                          
                                      </div>
                                  </div>
                                  <div class="mb-3">
                                      <label for="address">Введите адрес:</label>
                                      <input id="address" class="form-control form-control-lg" value="{{old('address')}}" type="text" name="address" placeholder="Введите адрес">
                                      @if($errors->has('address'))
                                          <div class="error text-danger">{{ $errors->first('address') }}</div>
                                      @endif
                                  </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Сохранить">
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