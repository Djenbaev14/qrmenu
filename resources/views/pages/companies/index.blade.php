@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Kompaniyalar ro'yxati</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-5">
                          <form action="{{ url('/companies') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Kompaniya nomini qidirish"/>
                            <button type="submit" class="btn btn-primary mx-2">Izlash</button>
                            <a href="{{route('companies.index')}}" class="btn btn-success mx-2">Tozalash</a>
                        </form>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="companies-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Kompaniya nomi</th>
                                      <th scope="col">Kategoriyalar soni</th>
                                      <th scope="col">Mahsulotlar soni</th>
                                      <th scope="col">Дата создания
                                      </th>
                                      <th scope="col">Действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($companies as $company)
                                    <tr class="align-middle">
                                      <td ><img src="{{asset('images/company-logo/'.$company->logo)}}" width="100px" style="object-fit: cover" height="50px" alt=""> {{$company->name}}</td>
                                      <td >{{$company->category->count()}}</td>
                                      <td >{{$company->product->count()}}</td>
                                      <td>{{$company->created_at->format('Y.m.d , H:i')}}</td>
                                      <td>
                                        <form class="d-inline-block " action="{{ route('companies.key',$company->user->id) }}" method="POST">
                                          @csrf
                                          <button class="btn btn-sm btn-success"><i class="mdi mdi-key  fs-18"></i></button>
                                        </form>
                                        <!--  Large modal example -->
                                        <div class="modal fade bs-example-modal-{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Kategoriyani o'zgartirish
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                        <div class="col-12">
                                                          <form action="{{route('companies.update',$company->id)}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                              <div class="mb-3">
                                                                <div id="upload-container-2" >
                                                                  <label for="logo-upload-2" id="upload-label-2">
                                                                      <span id="change-icon-2" style="display: inline-block">&#8635;</span> <!-- Unicode for a refresh icon -->
                                                                      <img id="logo-preview-2" src="{{asset('images/companies/'.$company->photo)}}" alt="Yuklangan rasm" style="display: block;" />
                                                                    </label>
                                                                    <input type="file" name="photo" id="logo-upload-2" accept="image/png, image/webp, image/jpeg,image/jpg" style="display: none;" />
                                                                </div>
                                                              </div>
                                                              
                                                              <ul class="nav nav-pills nav-justified bg-light" role="tablist">
                                                                @foreach (config('app.languages') as $i => $item)
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#update_{{$item['code']}}_{{$company->id}}" role="tab">
                                                                            <span class="d-flex justify-content-center align-items-center">
                                                                                <img src="{{asset('images/flags/'.$item['code'].'.'.$item['format'])}}" width="20px"> 
                                                                                &nbsp;&nbsp;{{$item['name']}}</span> 
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            
                                                            <div class="tab-content pt-3 text-muted mb-3">
                                                              @foreach (config('app.languages') as $i => $item)
                                                              <div class="tab-pane <?=($i==0) ? 'show active' : '';?>" id="update_{{$item['code']}}_{{$company->id}}" role="tabpanel">
                                                                <?php
                                                                  $name="name_".$item['code'];
                                                                ?>
                                                                  <label for="">Kategoriya nomi ({{$item['name']}})</label>
                                                                  <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting" value="{{$company->$name}}">
                                                              </div>
                                                              @endforeach
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                              <label for="">Asosiy Kategoriya</label>
                                                              <select name="main_company_id" class="form-select">
                                                                <option hidden value="none">Asosiy Kategoriyani tanlang</option>
                                                                @foreach ($companies as $c)
                                                                @if ($c->id == $company->main_company_id)
                                                                    <option selected value="{{$c->id}}">{{$c->name_uz}}</option>
                                                                @elseif($c->id != $company->id)
                                                                    <option  value="{{$c->id}}">{{$c->name_uz}}</option>
                                                                @endif
                                                              
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-end">
                                                                {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Bekor qilish</button> --}}
                                                                {{-- <button type="button" class="btn btn-primary">Qo'shish</button> --}}
                                                                <input type="submit" value="Tahrirlash" class="btn btn-primary">
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