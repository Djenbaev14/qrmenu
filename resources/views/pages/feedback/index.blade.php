@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header"><h4>Список отзывов </h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;bfeedback-radius:10px;" >
                        <div class="col-lg-6 col-sm-12">
                          <form action="{{ url('/feedback') }}" class="row" method="GET">
                            <div class="col-sm-12  col-lg-7 mb-2">
                                <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Поиск по имени клиента"/>
                            </div>
                            <div class="col-sm-12 col-lg-5">
                                <button type="submit" class="btn btn-primary">Поиск</button>
                                <a href="{{route('feedback.index')}}" class="btn btn-success">Очистка</a>
                            </div>
                        </form>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Добавление отзыв</button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table table-hover mb-0 w-100"  id="feedbacks-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Имя Фамилия</th>
                                      <th scope="col">Текст</th>
                                      <th scope="col">Дата создания
                                      </th>
                                      <th scope="col">Действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($feedbacks as $feedback)
                                    <tr class="align-middle">
                                      <td >{{$feedback->name}}</td>
                                      <td>{{Str::words($feedback->text,'7')}}</td>
                                      <td>{{$feedback->created_at->format('Y.m.d , H:i')}}</td>
                                      <td>
                                        <button type="button" class="btn btn-sm btn-success" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$feedback->id}}">
                                          <i class="mdi mdi-pencil  fs-18"></i></button>
                                        <form class="d-inline-block " action="{{ route('feedback.destroy', $feedback->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete  fs-18"></i></button>
                                        </form>
                                        
                                        <!--  Large modal example -->
                                        <div class="modal fade bs-example-modal-{{$feedback->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                        <form action="{{route('feedback.update',$feedback->id)}}" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          @method('PATCH')
                                                          <div class="mb-3">
                                                            <label for="name" class="form-label">ФИО</label>
                                                            <input type="text" class="form-control" id="name" value="{{$feedback->name}}" name="name">
                                                          </div>
                                                          <div class="mb-3">
                                                            <label for="name" class="form-label">Текст</label>
                                                            <textarea name="text" cols="30" re rows="10" class="form-control">{{$feedback->text}}</textarea>
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
                      @if ($feedbacks->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($feedbacks->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $feedbacks->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif
  
                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($feedbacks->getUrlRange(1, $feedbacks->lastPage()) as $page => $url)
                                      @if ($page == $feedbacks->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach
  
                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($feedbacks->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $feedbacks->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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
  
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Добавление продукта
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <form action="{{route('feedback.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">ФИО</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                      <label for="name" class="form-label">Текст</label>
                      <textarea name="text" cols="30" re rows="10" class="form-control"></textarea>
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
@endsection
