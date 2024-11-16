@extends('layouts.main')

@section('title', 'Настройки')
@section('content')

<div class="content">
	<div class="container-xxl">

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
                            <div class="col-lg-6">
                                <form method="POST" action="{{route('settings.store')}}" enctype="multipart/form-data">
                                  @csrf
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
                                                <img src="{{asset('assets/images/logo.png')}}" width="200px" alt="">
                                            </div>
                                    </div>
                                  </div>
                                  
                                <div class="mb-3">
                                    <ul class="nav nav-pills nav-justified bg-light rounded shadow-sm" role="tablist">
                                        @foreach (config('app.languages') as $i => $item)
                                            <li class="nav-item mx-2 my-1" role="presentation">
                                                <a class="nav-link  <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#banner_{{$item['code']}}" role="tab">
                                                    <span class="d-flex justify-content-center align-items-center">
                                                        <img src="{{asset('images/flags/'.$item['code'].'.'.$item['format'])}}" width="20px"> 
                                                        &nbsp;&nbsp;{{$item['name']}}</span> 
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    
                                    <div class="tab-content pt-3 text-muted mb-3">
                                        @foreach (config('app.languages') as $i => $item)
                                        <div class="tab-pane <?=($i==0) ? 'show active' : '';?>" id="banner_{{$item['code']}}" role="tabpanel">
                                            <label for="">Баннерные тексты ({{$item['name']}})</label>
                                            <?php
                                                $desc='banner_text_'.$item['code'];
                                            ?>
                                            <input type="text" class="form-control" id="banner_{{$item['code']}}" placeholder="Введите текст баннера" name="banner_text_{{$item['code']}}" rows="10" placeholder="Введите текст" value="<?=($company) ? $company->$desc : ''   ?>">
                                        </div>
                                        @endforeach
                                    </div>
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
                                              <img src="{{asset('assets/images/image.png')}}" width="200px" alt="">
                                          </div>
                                  </div>
                                </div>
                                    
                                <ul class="nav nav-pills nav-justified bg-light rounded shadow-sm" role="tablist">
                                    @foreach (config('app.languages') as $i => $item)
                                        <li class="nav-item mx-2 my-1" role="presentation">
                                            <a class="nav-link  <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#tab_{{$item['code']}}" role="tab">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <img src="{{asset('images/flags/'.$item['code'].'.'.$item['format'])}}" width="20px"> 
                                                    &nbsp;&nbsp;{{$item['name']}}</span> 
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content pt-3 text-muted mb-3">
                                    @foreach (config('app.languages') as $i => $item)
                                    <div class="tab-pane <?=($i==0) ? 'show active' : '';?>" id="tab_{{$item['code']}}" role="tabpanel">
                                        <label for="">О нас ({{$item['name']}})</label>
                                        {{-- <div id="quill-editor-{{$item['code']}}" style="height: 100px;">
                                        </div> --}}
                                        <?php
                                            $desc='description_'.$item['code'];
                                        ?>
                                        <textarea class="form-control" id="description_{{$item['code']}}" name="description_{{$item['code']}}" rows="10" placeholder="Введите текст"><?=($company) ? $company->$desc : ''   ?></textarea>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">Контактный телефон:</label>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">+998</span>
                                                <input name="telephones[]" maxlength="9" placeholder="1234567" value="<?=($company && $company->telephones) ? $company->telephones[0] : ''   ?>" class="form-control" type="tel" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">+998</span>
                                                <input name="telephones[]" maxlength="9" placeholder="1234567" value="<?=($company && $company->telephones) ? $company->telephones[1] : ''   ?>" class="form-control" type="tel" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Ссылка на социальные сети:</label>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12 mb-2 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/instagram-new.png" alt="Instagram"></div>
                                                <input id="Instagram" class="form-control" type="url" name="instagram" value="<?=($company) ? $company->instagram : ''   ?>" placeholder="Instagram"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-12 mb-2 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/telegram-app.png" alt="Telegram"></div>
                                                <input id="Telegram" class="form-control" value="<?=($company) ? $company->telegram : ''   ?>" name="telegram" type="url" placeholder="Telegram"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/facebook-new.png" alt="Facebook"></div>
                                                <input id="Facebook" class="form-control" type="url" name="facebook" value="<?=($company) ? $company->facebook : ''   ?>" placeholder="Facebook"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-sm-12 mb-2">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/?size=100&id=25654&format=png&color=000000" alt="youtube"></div>
                                                <input id="youtube" class="form-control" value="<?=($company) ? $company->youtube : ''   ?>" name="youtube" type="url" placeholder="Youtube"/>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="filial_nomi">Название компании:</label>
                                    <input id="filial_nomi" class="form-control form-control-lg" value="<?=($company) ? $company->name : ''   ?>" type="text" name="name" placeholder="Введите название компании">
                                </div>
                                <div class="mb-3">
                                    <label for="address">Введите адрес:</label>
                                    <input id="address" class="form-control form-control-lg" value="<?=($company) ? $company->address : ''   ?>" type="text" name="address" placeholder="Введите адрес">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Сохранение изменений">
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
        <!-- Quill css -->
    <link href="{{asset('assets/libs/quill/quill.core.js')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #upload-label,#upload-label-2{
            width: 100%;
        }
        #upload-area,#upload-area-2 {
            border: 2px dashed #ccc;
            border-radius: 20px;
            background-color: #FAFAFF;
            padding: 20px;
            width: 100%;
            margin: 20px auto;
            cursor: pointer;
            position: relative;
        }

        #logo-preview{
            border-radius: 8px;
            object-fit:cover;
            width: 150px;
            height: 62px;
        }
        #logo-preview-2 {
            border-radius: 8px;
            width: 200px;
            height: 100px;
        }

        #placeholder,#placeholder-2 {
            color: #333;
            text-align: center;
        }

        .select-text {
            color: #6c63ff; /* Link rang */
            cursor: pointer;
            text-decoration: underline;
        }

        #change-icon,#change-icon-2 {
            display: none;
            /* position: absolute;
            top: 0px;
            left: 105px; */
            margin-bottom: 5px;
            object-fit: fill;
            cursor: pointer;
            font-size: 20px;
            color: #6c63ff;
            background-color: white;
            border-radius: 50%;
            padding: 2px 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        


    </style>
@endpush
@push('js')
        <script>
            document.getElementById("logo-upload").addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file && file.size <= 10 * 1024 * 1024) { // 10 MB
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const logoPreview = document.getElementById("logo-preview");
                        logoPreview.src = e.target.result;
                        logoPreview.style.display = "block";
                        
                        // Placeholderni yashirish
                        document.getElementById("placeholder").style.display = "none";
                        document.getElementById("change-icon").style.display = "inline-block";
                        document.getElementById("upload-area").style.display = "none";
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Fayl hajmi 10 MB'dan oshmasligi kerak.");
                }
            });
            
            document.getElementById("logo-upload-2").addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file && file.size <= 10 * 1024 * 1024) { // 10 MB
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const logoPreview = document.getElementById("logo-preview-2");
                        logoPreview.src = e.target.result;
                        logoPreview.style.display = "block";
                        
                        // Placeholderni yashirish
                        document.getElementById("placeholder-2").style.display = "none";
                        document.getElementById("change-icon-2").style.display = "inline-block";
                        document.getElementById("upload-area-2").style.display = "none";
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Fayl hajmi 10 MB'dan oshmasligi kerak.");
                }
            });
        </script>
@endpush