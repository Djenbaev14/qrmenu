@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
	<div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
          <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Список категорий</h2>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="col-7">
                    <form action="{{ url('/admin/all-categories') }}" id="form" class="d-flex" method="GET">
                            <input type="search" class="form-control mr-3"  name="search" onkeyup="doSearch(this.value)" value="{{ request('search') }}" placeholder="Поиск"/>
                            <input type="hidden" name="page" value="1">
                            <a href="{{url('/admin/all-categories')}}" class="tetx-light btn btn-danger">Очистка</a>
                    </form>
                  </div>
                </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="categories-table">
                              <thead>
                                  <tr>
                                      <th scope="col">ID</th>
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
                                    <td >{{$category->id}}</td>
                                    <td ><img src="{{$category->photo}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$category->name_uz}}</td>
                                    <td><?=($category->main_category_id) ? $category->main_category->name_uz : ''?></td>
                                    <td >{{$category->product->count()}}</td>
                                    <td>{{$category->created_at->format('Y.m.d , H:i')}}</td>
                                    <td>
                                      <div style="cursor: pointer" class="dropdown ml-auto">
                                        <div class="btn-link" data-toggle="dropdown">
                                          <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                          <a href="{{route('categories.show',$category->id)}}" class="dropdown-item" ><i class="flaticon-381-view-2 text-success mr-2"></i> Видение</a>
                                          <a class="dropdown-item"  data-toggle="modal" data-target=".bs-example-modal-{{$category->id}}">
                                            <i class="flaticon-381-edit text-primary mr-2"></i> Редактировать
                                          </a>
                                          <a class="dropdown-item" href="{{route('all-categories.destroy',$category->id)}}"><i class="flaticon-381-trash-1 text-danger mr-2"></i> Удалить
                                          </a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="6" class="text-center"><h3 class="text-danger">Нет ресурса</h3></td>
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