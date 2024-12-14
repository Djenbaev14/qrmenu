@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
  
  <div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
      <div class="mr-auto d-none d-lg-block">
        <h2 class="text-black font-w600 mb-0">Список категорий</h2>
      </div>
        <button type="button" class="btn btn-primary mb-2 btn btn-primary d-flex align-items-center " data-toggle="modal" data-target="#basicModal">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>Добавить категорию</button>
    </div>
    
    <div class="modal right fade " id="basicModal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary" >
                  <h5 class="modal-title text-white">Добавить категорию</h5>
                  <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
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
                        
                        <ul class="nav nav-tabs" role="tablist">
                          @foreach (config('app.languages') as $i => $item)
                              <li class="nav-item mx-2 my-1" role="presentation">
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
                            <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-responsive-sm display mb-4" id="example5"  style="min-width: 845px;">
                <thead>
                  <tr>
                    <th scope="col">Название категории</th>
                    <th scope="col">Основная категория</th>
                    <th scope="col">Продукты</th>
                    <th scope="col">Дата создания
                    </th>
                    <th scope="col">Действие</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($categories as $category)
                    <tr class="align-middle">
                      <td ><img src="{{asset('images/categories/'.$category->photo)}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$category->name_uz}}</td>
                      <td><?=($category->main_category_id) ? $category->main_category->name_uz : ''?></td>
                      <td >{{$category->product->count()}}</td>
                      <td>{{$category->created_at->format('Y.m.d , H:i')}}</td>
                    <td>
                      <div style="cursor: pointer" class="dropdown ml-auto text-right">
                        <div class="btn-link" data-toggle="dropdown">
                          <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{route('categories.show',$category->id)}}"><i class="flaticon-381-view-2 text-success mr-2"></i> Видение</a>
                          <a class="dropdown-item"  data-toggle="modal" data-target=".bs-example-modal-{{$category->id}}"><i class="flaticon-381-edit
 text-primary mr-2"></i> редактировать</a>
                          <a class="dropdown-item" href="{{route('categories.destroy',$category->id)}}"><i class="flaticon-381-trash-1 text-danger mr-2"></i> удалить</a>
                        </div>
                      </div>
                      
                    </td>
                    		
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center"><h3 class="text-danger">Нет ресурса</h3></td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
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
	<!-- Datatable -->
	
	<script>
    (function($) {
     
      var table = $('#example5').DataTable({
        searching: false,
        paging:true,
        select: false,
        //info: false,         
        lengthChange:false 
        
      });
      $('#example tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        
      });
       
    })(jQuery);z
  </script>
	
@endpush