@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
	<div class="container-fluid">


    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
      <div class="flex-grow-1">
          <h4 class="fs-18 fw-semibold m-0">Компании</h4>
      </div>
    </div>
				<!-- start row -->
		<div class="row">
          <div class="col-md-12 col-xl-12">
              <div class="row g-3">

                  <div class="col-md-6 col-xl-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex align-items-center">
                                  <div class="fs-14 mb-1">Всего компаний</div>
                              </div>

                              <div class="d-flex align-items-baseline mb-2">
                                  <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{$companies->count()}}</div>
                                  <div class="me-auto">
                                      <span class="text-primary d-inline-flex align-items-center">
                                          <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                      </span>
                                  </div>
                              </div>
                              <div id="website-visitors" class="apex-charts"></div>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6 col-xl-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex align-items-center">
                                  <div class="fs-14 mb-1">Активные компании</div>
                              </div>

                              <div class="d-flex align-items-baseline mb-2">
                                  <div class="fs-22 mb-0 me-2 fw-semibold text-black">0</div>
                                  <div class="me-auto">
                                      <span class="text-danger d-inline-flex align-items-center">
                                          0
                                          <i data-feather="trending-down" class="ms-1" style="height: 22px; width: 22px;"></i>
                                      </span>
                                  </div>
                              </div>
                              <div id="conversion-visitors" class="apex-charts"></div>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6 col-xl-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex align-items-center">
                                  <div class="fs-14 mb-1">Неактивные компании</div>
                              </div>

                              <div class="d-flex align-items-baseline mb-2">
                                  <div class="fs-22 mb-0 me-2 fw-semibold text-black">0 </div>
                                  <div class="me-auto">
                                      <span class="text-success d-inline-flex align-items-center">
                                          0
                                          <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                      </span>
                                  </div>
                              </div>
                              <div id="session-visitors" class="apex-charts"></div>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6 col-xl-3">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex align-items-center">
                                  <div class="fs-14 mb-1">Новые рестораны</div>
                              </div>

                              <div class="d-flex align-items-baseline mb-2">
                                  <div class="fs-22 mb-0 me-2 fw-semibold text-black">0</div>
                                  <div class="me-auto">
                                      <span class="text-success d-inline-flex align-items-center">
                                          0
                                          <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                      </span>
                                  </div>
                              </div>
                              <div id="active-users" class="apex-charts"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div> <!-- end sales -->
      </div> <!-- end row -->

        <div class="row ">
          <div class="col-12">
              <div class="card">
                  <div class="card-header row align-items-center">
                      <h4 class="card-title fw-bold mb-3">Список компаний</h4>
                      <div class="row justify-content-between p-2 col-5" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-12">
                          <form action="{{ url('/admin/companies') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control "  name="search" oninput="this.form.submit()" value="{{ request('search') }}" placeholder="Поиск"/>
                            </form>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table table-hover table-bordered table-responsive-sm mb-0">
                              <thead>
                                  <tr>
                                      <th scope="col">Название</th>
                                      <th scope="col">Инфо о владельце</th>
                                      <th scope="col">Кол категорий</th>
                                      <th scope="col">Количество продуктов</th>
                                      <th scope="col">Дата создания
                                      </th>
                                      <th scope="col">Действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($companies as $company)
                                  <tr class="align-middle">
                                    <td ><img src="{{asset('images/company-logo/'.$company->logo)}}" width="100px" style="object-fit: cover" height="50px" alt=""> {{$company->name}}</td>
                                    <td>{{$company->user->name}} <br> {{$company->user->phone}}</td>
                                    <td >{{$company->category->count()}}</td>
                                    <td >{{$company->product->count()}}</td>
                                    <td>{{$company->created_at->format('Y.m.d , H:i')}}</td>
                                    <td>
                                      <form class="d-inline-block " action="{{ route('companies.key',$company->user->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success"><i class="mdi mdi-key  fs-18"></i></button>
                                      </form>
                                      <a href="{{route('companies.edit',$company->id)}}" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil  fs-18"></i></a>
                                    </td>
                                  </tr>
                                @empty
                                    <tr>
                                      <td colspan="6" class="text-danger text-center "><h3>Нет ресурс</h3></td>
                                    </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                      @if ($companies->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($companies->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $companies->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif
  
                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                      @if ($page == $companies->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach
  
                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($companies->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $companies->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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