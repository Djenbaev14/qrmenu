@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
  
  <div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
      <div class="mr-auto d-none d-lg-block">
        <h2 class="text-black font-w600 mb-0">Список категорий</h2>
      </div>
        {{-- <form action="{{route('categories.importPdf')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" required>
          <button type="submit">Import</button>
      </form> --}}
      <button type="button" class="btn btn-primary mb-2 btn btn-primary d-flex align-items-center " data-toggle="modal" data-target="#basicModal">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>Добавить категорию</button>
    </div>
    
    <div class="modal right fade " id="basicModal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header " >
                  <h5 class="modal-title ">Добавить категорию</h5>
                  <button type="button" class="close " data-dismiss="modal"><span>&times;</span>
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
                                  <input type="file" required name="photo" id="logo-upload" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                          </div>
                        </div>
                        
                        <ul class="nav nav-tabs" role="tablist">
                          @foreach (config('app.languages') as $i => $item)
                              <li class="nav-item " role="presentation">
                                  <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-toggle="tab" href="#tab_{{$item['code']}}" role="tab">
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
                            <input type="text" required name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
                        </div>
                        @endforeach
                      </div>
                      <div class="mb-3">
                        <label for="">Порядковый номер</label>
                        <input type="number" value="99" name="sequence_number" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="">Основная Категория</label>
                        <select name="main_category_id" class="form-control" id="single-select" >
                          <option value="none">Выберите основную категорию</option>
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
          </div>
      </div>
  </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-7">
              <form action="{{ url('/restaurant/categories') }}" id="form" class="d-flex" method="GET">
                      <input type="search" class="form-control mr-3"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                      <input type="hidden" name="page" value="1">
                      <a href="{{url('/restaurant/categories')}}" class="tetx-light btn btn-danger">Очистка</a>
              </form>
            </div>
          </div><!-- end card header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-responsive-sm display mb-4" id="example5"  style="min-width: 845px;">
                <thead>
                  <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название категории</th>
                    <th scope="col">Основная категория</th>
                    <th scope="col">Продукты</th>
                    <th scope="col">Порядковый номер</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($categories as $category)
                    <tr class="align-middle">
                      <td >{{$category->id}}</td>
                      <td ><img src="{{$category->photo}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$category->name_uz}}</td>
                      <td><?=($category->main_category_id) ? $category->main_category->name_uz : ''?></td>
                      <td >{{$category->product->count()}}</td>
                      <td >{{$category->sequence_number}}</td>
                      <td>{{$category->created_at->format('Y.m.d , H:i')}}</td>
                      <td>
                      <div style="cursor: pointer" class="dropdown ml-auto">
                        <div class="btn-link" data-toggle="dropdown">
                          <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item"  data-toggle="modal" data-target=".bs-example-modal-{{$category->id}}">
                            <i class="flaticon-381-edit text-primary mr-2"></i> Редактировать
                          </a>
                          <a class="dropdown-item" href="{{route('categories.destroy',$category->id)}}"><i class="flaticon-381-trash-1 text-danger mr-2"></i> Удалить
                          </a>
                        </div>
                      </div>
                      </td>
                        <div class="modal right fade bs-example-modal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-header " >
                                                      <h5 class="modal-title ">Изменить категорию</h5>
                                                      <button type="button" class="close " data-dismiss="modal"><span>&times;</span>
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
                                                                    <img id="logo-preview-2" src="{{$category->photo}}" alt="Yuklangan rasm" style="display: block;" />
                                                                  </label>
                                                                  <input type="file" required name="photo" id="logo-upload-2" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                                              </div>
                                                            </div>
                                                            <ul class="nav nav-tabs" role="tablist">
                                                              @foreach (config('app.languages') as $i => $item)
                                                                  <li class="nav-item " role="presentation">
                                                                      <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-toggle="tab" href="#update_tab_{{$category->id}}_{{$item['code']}}" role="tab">
                                                                          <span class="d-flex justify-content-center align-items-center">
                                                                              <img src="{{asset('images/flags/'.$item['code'].'.'.$item['format'])}}" width="20px"> 
                                                                              &nbsp;&nbsp;{{$item['name']}}</span> 
                                                                      </a>
                                                                  </li>
                                                              @endforeach
                                                          </ul>
                                                          <div class="tab-content pt-3 text-muted mb-3">
                                                            @foreach (config('app.languages') as $i => $item)
                                                            <div class="tab-pane <?=($i==0) ? 'show active' : '';?>" id="update_tab_{{$category->id}}_{{$item['code']}}" role="tabpanel">
                                                              <?php
                                                                  $name="name_".$item['code'];
                                                                ?>
                                                                <label for="">Название категории ({{$item['name']}})</label>
                                                                <input type="text" required name="name_{{$item['code']}}" value="{{$category->$name}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
                                                            </div>
                                                            @endforeach
                                                          </div>
                                                          <div class="mb-3">
                                                            <label for="">Порядковый номер</label>
                                                            <input type="number" required value="{{$category->sequence_number}}" name="sequence_number" class="form-control">
                                                          </div>
                                                          <div class="mb-3">
                                                            <label for="">Основная Категория</label>
                                                            <select required name="main_category_id" class="form-control" id="single-select" >
                                                              <option value="none">Выберите основную категорию</option>
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
                                      </div>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center"><h3 class="text-danger">Нет ресурса</h3></td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            @if ($categories->hasPages())
              <nav>
                  <ul class="pagination">
                      {{-- Назад sahifa tugmasi --}}
                      @if ($categories->onFirstPage())
                          <li class="page-item disabled"><a class="page-link">&laquo; Назад</a></li>
                      @else
                          <li class="page-item">
                              <a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo; Назад</a>
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

                      {{-- Следующий sahifa tugmasi --}}
                      @if ($categories->hasMorePages())
                          <li class="page-item">
                              <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">Следующий &raquo;</a>
                          </li>
                      @else
                          <li class="page-item disabled"><a class="page-link">Следующий &raquo;</a></li>
                      @endif
                  </ul>
              </nav>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('css')
  <link href="{{asset('css/logo-upload.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
  <script src="{{asset('js/logo-upload.js')}}"></script>
  <script src="{{asset('js/logo-upload2.js')}}"></script>
@endpush