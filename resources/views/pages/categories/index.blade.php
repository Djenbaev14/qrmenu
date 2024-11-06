@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Kategoriyalar ro'yxati</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-5">
                          <form action="{{ url('/categories') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Kategoriya nomini qidirish"/>
                            <button type="submit" class="btn btn-primary mx-2">Izlash</button>
                            <a href="{{route('categories.index')}}" class="btn btn-success mx-2">Tozalash</a>
                        </form>
                        </div>
                        <div class="col-3 ">
                          <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Kategoriya qo'shish</button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="categories-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Kategoriya nomi</th>
                                      <th scope="col">Asosiy kategoriya</th>
                                      <th scope="col">Mahsulotlar</th>
                                      <th scope="col">Yaratilgan sana
                                      </th>
                                      <th scope="col">Harakat</th>
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
                                          <i class="mdi mdi-pencil  fs-18"></i>
                                        {{-- <a href="{{route('categories.destroy',$category->id)}}" class="btn btn-sm btn-danger"><i data-feather="trash"></i></a> --}}
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
                                                        <h5 class="modal-title" id="myLargeModalLabel">Kategoriyani o'zgartirish
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
                                                                  <input type="file" name="photo" id="logoInput" accept="image/*" class="form-control">
                                                                  
                                                                  <img id="preview2" src="{{asset('images/categories/'.$category->photo)}}" width="50px" alt="Logotip oldindan ko'rish">
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
                                                                  <label for="">Kategoriya nomi ({{$item['name']}})</label>
                                                                  <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting" value="{{$category->$name}}">
                                                              </div>
                                                              @endforeach
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                              <label for="">Asosiy Kategoriya</label>
                                                              <select name="main_category_id" class="form-select">
                                                                <option hidden value="none">Asosiy Kategoriyani tanlang</option>
                                                                @foreach ($categories as $c)
                                                                @if ($c->id == $category->main_category_id)
                                                                    <option selected value="{{$c->id}}">{{$c->name_uz}}</option>
                                                                @elseif($c->id != $category->id)
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
                      <h5 class="modal-title" id="myLargeModalLabel">Kategoriya qo‘shish
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
                                <input type="file"  name="photo" id="logoInput" accept="image/*" class="form-control">
                                <img id="preview" alt="Logotip oldindan ko'rish">
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
                                <label for="">Kategoriya nomi ({{$item['name']}})</label>
                                <input type="text" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
                            </div>
                            @endforeach
                          </div>
                          
                          <div class="mb-3">
                            <label for="">Asosiy Kategoriya</label>
                            <select name="main_category_id" class="form-select">
                              <option hidden value="none">Asosiy Kategoriyani tanlang</option>
                              @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name_uz}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="d-flex align-items-center justify-content-end">
                              {{-- <button type="button" class="btn btn-light" data-bs-dismiss="modal">Bekor qilish</button> --}}
                              {{-- <button type="button" class="btn btn-primary">Qo'shish</button> --}}
                              <input type="submit" value="Qo'shish" class="btn btn-primary">
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