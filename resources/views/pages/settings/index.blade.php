@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

				<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
						<div class="flex-grow-1">
								<h4 class="fs-18 fw-semibold m-0">Settings</h4>
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
                                        <label for="simpleinput" class="form-label">Company Logo</label>
                                        <input type="file" <?=($company && $company->logo) ? 'hidden' : ''?> name="logo" id="logoInput" accept="image/*" class="form-control">
                                        <img id="preview" <?=($company && $company->logo) ? "src='".asset('images/company-logo/'.$company->logo)."' class='d-block'" : ''?>   alt="Logotip oldindan ko'rish">
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
                                        <label for="">Biz haqimizda ({{$item['name']}})</label>
                                        {{-- <div id="quill-editor-{{$item['code']}}" style="height: 100px;">
                                        </div> --}}
                                        <?php
                                            $desc='description_'.$item['code'];
                                        ?>
                                        <textarea class="form-control" id="description_{{$item['code']}}" name="description_{{$item['code']}}" rows="10" placeholder="Введите текст"><?=($company) ? $company->$desc : ''   ?></textarea>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Aloqa uchun telefon raqami:</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">+998</span>
                                                <input name="telephones[]" maxlength="9" placeholder="1234567" value="<?=($company && $company->telephones) ? $company->telephones[0] : ''   ?>" class="form-control" type="tel" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">+998</span>
                                                <input name="telephones[]" maxlength="9" placeholder="1234567" value="<?=($company && $company->telephones) ? $company->telephones[1] : ''   ?>" class="form-control" type="tel" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Ijtimoiy tarmoqlarga havola:</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/instagram-new.png" alt="Instagram"></div>
                                                <input id="Instagram" class="form-control" type="url" name="instagram" value="<?=($company) ? $company->instagram : ''   ?>" placeholder="Instagram"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="input-group">
                                                <div class="input-group-text"><img width="20px" src="https://img.icons8.com/ios-filled/50/telegram-app.png" alt="Telegram"></div>
                                                <input id="Telegram" class="form-control" value="<?=($company) ? $company->telegram : ''   ?>" name="telegram" type="url" placeholder="Telegram"/>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="filial_nomi">Filial nomi:</label>
                                    <input id="filial_nomi" class="form-control form-control-lg" value="<?=($company) ? $company->name : ''   ?>" type="text" name="name" placeholder="Filial nomini kiriting">
                                </div>
                                <div class="mb-3">
                                    <label for="address">Manzilni kiriting:</label>
                                    <input id="address" class="form-control form-control-lg" value="<?=($company) ? $company->address : ''   ?>" type="text" name="address" placeholder="Manzilni kiriting">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary btn-lg" value="O'zgarishlarni saqlash">
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
        <!-- CSS -->

    
        <!-- Quill css -->
        <link href="{{asset('assets/libs/quill/quill.core.js')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('js')

        <script>
            const logoInput = document.getElementById('logoInput');
            const preview = document.getElementById('preview');

            logoInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>

        <!-- JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script>
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "uz",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // formatlash uchun kerak
            });
            
        </script>
 
@endpush