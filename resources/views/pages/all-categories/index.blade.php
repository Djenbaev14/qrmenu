@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <form action="{{route('all-categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="col-6 mb-3">
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
                          <label for="">Выберите компанию</label>
                          <select id="company-select" name="company_id" class="form-select" >
                            <option value="none" hidden>Выберите компанию</option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="mb-3">
                          <label for="">Основная Категория</label>
                          <select name="main_category_id" id="category-select" class="form-select" >
                            {{-- <option value="none">Выберите основную категорию</option> --}}
                            {{-- @foreach ($select_categories as $category)
                                <option value="{{$category->id}}">{{$category->name_uz}}</option>
                            @endforeach --}}
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
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Список категорий</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-lg-6 col-sm-12">
                          <form action="{{ url('/admin/all-categories') }}" id="form" class="row" method="GET">
                            <div class="col-sm-12  mb-2">
                              <input type="search" class="form-control"  name="search" onkeydown="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск по названию категории"/>
                              <input type="hidden" name="page"  value="{{ request('page') }}">
                            </div>
                          </form>
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
                                @forelse ($categories as $category)
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
		</div> <!-- container-fluid -->
	</div> 
@endsection
@push('css')
  <link href="{{asset('assets/css/logo-upload.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
  <script src="{{asset('assets/js/logo-upload.js')}}"></script>
  <script src="{{asset('assets/js/logo-upload2.js')}}"></script>
  <script>
    document.getElementById('company-select').addEventListener('change', function () {
    const companyId = this.value;

    // Kategoriyalarni tozalash
    const categorySelect = document.getElementById('category-select');
    categorySelect.innerHTML = '<option value="">Выберите основную категорию</option>';

    if (companyId) {
        fetch('/admin/get-categories', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ company_id: companyId })
        })
        .then(response => response.json())
        .then(data => {
            data.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name_uz;
                categorySelect.appendChild(option);
            });
            })
            .catch(error => console.error('Error:', error));
        }
    });
  </script>
@endpush