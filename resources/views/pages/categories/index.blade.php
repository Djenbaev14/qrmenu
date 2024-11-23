@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список категорий</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-lg-6 col-sm-12">
                          <form action="{{ url('/categories') }}" class="row " method="GET">
                            <div class="col-sm-12 col-lg-7 mb-2">
                              <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Поиск по названию категории"/>
                            </div>
                            <div class="col-sm-12 col-lg-5 mb-2">
                              <button type="submit" class="btn btn-primary">Поиск</button>
                              <a href="{{route('categories.index')}}" class="btn btn-success">Очистка</a>
                            </div>
                          </form>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавить категорию</button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="categories-table">
                              <thead>
                                  <tr>
                                      <th scope="col">название категории</th>
                                      <th scope="col">основная категория</th>
                                      <th scope="col">продукты</th>
                                      <th scope="col">дата создания
                                      </th>
                                      <th scope="col">действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($categories as $category)
                                    <tr class="align-middle">
                                      <td ><img src="{{asset('images/categories/'.$category->photo)}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$category->name_uz}}</td>
                                      <td><?=($category->main_category_id) ? $category->main_category->name_uz : ''?></td>
                                      <td >{{$category->product->count()}}</td>
                                      <td>{{$category->created_at->format('Y.m.d , H:i')}}</td>
                                      <td>
                                        <a href="{{route('categories.show',$category->id)}}" class="btn btn-sm btn-primary" style="margin-right: 10px" ><i data-feather="eye"></i></a>
                                        <button type="button" class="btn btn-sm btn-success" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$category->id}}">
                                          <i class="mdi mdi-pencil  fs-18"></i></button>
                                        <form class="d-inline-block " action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete  fs-18"></i></button>
                                        </form>
                                        <!--  Large modal example -->
                                        <div class="modal fade bs-example-modal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Изменить категорию
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                        <div class="col-12">
                                                          <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                              <div class="mb-3">
                                                                <div id="upload-container-2" >
                                                                  <label for="logo-upload-2" id="upload-label-2">
                                                                      <span id="change-icon-2" style="display: inline-block">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                                      <img id="logo-preview-2" src="{{asset('images/categories/'.$category->photo)}}" alt="Yuklangan rasm" style="display: block;" />
                                                                    </label>
                                                                    <input type="file" name="photo" id="logo-upload-2" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                                                </div>
                                                              </div>
                                                              
                                                              <ul class="nav nav-pills nav-justified bg-light" role="tablist">
                                                                @foreach (config('app.languages') as $i => $item)
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#update_{{$item['code']}}_{{$category->id}}" role="tab">
                                                                            <span class="d-flex justify-content-center align-items-center">
                                                                                <img src="{{asset('images/flags/'.$item['code'].'.'.$item['format'])}}" width="20px"> 
                                                                                &nbsp;&nbsp;{{$item['name']}}</span> 
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            
                                                            <div class="tab-content pt-3 text-muted mb-3">
                                                              @foreach (config('app.languages') as $i => $item)
                                                              <div class="tab-pane <?=($i==0) ? 'show active' : '';?>" id="update_{{$item['code']}}_{{$category->id}}" role="tabpanel">
                                                                <?php
                                                                  $name="name_".$item['code'];
                                                                ?>
                                                                  <label for="">Название категории ({{$item['name']}})</label>
                                                                  <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting" value="{{$category->$name}}">
                                                              </div>
                                                              @endforeach
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                              <label for="">Основная Категория</label>
                                                              <select name="main_category_id" class="form-select">
                                                                <option hidden value="none">Выберите основную категорию</option>
                                                                @foreach ($select_categories as $c)
                                                                @if ($c->id == $category->main_category_id)
                                                                    <option selected value="{{$c->id}}">{{$c->name_uz}}</option>
                                                                @elseif($c->id != $category->id)
                                                                    <option  value="{{$c->id}}">{{$c->name_uz}}</option>
                                                                @endif
                                                              
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-end">
                                                                <input type="submit" value="Изменение" class="btn btn-primary">
                                                            </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                  
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                      @if ($categories->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($categories->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif
  
                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                      @if ($page == $categories->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach
  
                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($categories->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
                                      </li>
                                  @else
                                      <li class="page-item disabled"><a class="page-link">Кейинги &raquo;</a></li>
                                  @endif
                              </ul>
                          </nav>
                      @endif
                  </div>
              </div>
          </div>
      </div>
      <!--  Large modal example -->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="myLargeModalLabel">Добавить категорию
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-12">
                        <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                            <div class="mb-3">
                              <div id="upload-container" >
                                        <label for="logo-upload" id="upload-label">
                                              <span id="change-icon">&#8635;</span> <!-- Unicode for a refresh icon -->
                                              <img id="logo-preview" src="" style="display:none" alt="Yuklangan rasm"/>
                                              <div id="upload-area">
                                                  <div id="placeholder">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                                      <p>Перенесите логотип сюда или <span class="select-text">выбрать</span></p>
                                                      <p>Размер файла до 10 МБ</p>
                                                  </div>
                                              </div>
                                      </label>
                                      <input type="file" name="photo" id="logo-upload" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                              </div>
                            </div>
                            
                            <ul class="nav nav-pills nav-justified bg-light rounded shadow-sm" role="tablist">
                              @foreach (config('app.languages') as $i => $item)
                                  <li class="nav-item mx-2 my-1" role="presentation">
                                      <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#tab_{{$item['code']}}" role="tab">
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
                                <label for="">Название категории ({{$item['name']}})</label>
                                <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
                            </div>
                            @endforeach
                          </div>
                          
                          <div class="mb-3">
                            <label for="">Основная Категория</label>
                            <select name="main_category_id" class="form-select">
                              <option hidden value="none">Выберите основную категорию</option>
                              @foreach ($select_categories as $category)
                                  <option value="{{$category->id}}">{{$category->name_uz}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="d-flex align-items-center justify-content-end">
                              <input type="submit" value="Добавить" class="btn btn-primary">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
		</div> <!-- container-fluid -->
	</div> 
@endsection
@push('css')
<style>
  #upload-label{
      width: 100%;
  }
  #upload-area{
      border: 2px dashed #ccc;
      border-radius: 20px;
      background-color: #FAFAFF;
      padding: 20px;
      width: 100%;
      margin: 0 auto 20px auto;
      cursor: pointer;
      position: relative;
  }

  #logo-preview,#logo-preview-2 {
      border-radius: 8px;
      width: 200px;
      height: 100px;
  }

  #placeholder{
      color: #333;
      text-align: center;
  }

  .select-text {
      color: #6c63ff; /* Link rang */
      cursor: pointer;
      text-decoration: underline;
  }

  #change-icon,#change-icon-2{
      display: none;
      margin-bottom: 5px;
      object-fit: fill;
      cursor: pointer;
      font-size: 20px;
      color: #6c63ff;
      background-color: white;
      border-radius: 50%;
      padding: 2px 8px;
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
                        
                        document.getElementById("change-icon-2").style.display = "inline-block";
                    };
                    reader.readAsDataURL(file);
                } 
            });
        </script>
  </script>
@endpush