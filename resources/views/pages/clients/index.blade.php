@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4 class="fw-bold mb-3">Klientlar ro'yxati</h4>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-5">
                          <form action="{{ url('/clients') }}" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Kategoriya nomini qidirish"/>
                            <button type="submit" class="btn btn-primary mx-2">Izlash</button>
                            <a href="{{route('clients.index')}}" class="btn btn-success mx-2">Tozalash</a>
                        </form>
                        </div>
                        {{-- <div class="col-3 ">
                          <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Klient qo'shish</button>
                        </div> --}}
                      </div>
                  </div><!-- end card header -->
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0" id="clients-table">
                              <thead>
                                  <tr>
                                      <th scope="col">Ism Familyasi</th>
                                      <th scope="col">Telefon nomeri</th>
                                      <th scope="col">Address</th>
                                      <th scope="col">Product nomi</th>
                                      <th scope="col">Javob qaytarish
                                      </th>
                                      <th scope="col">Yaratilgan sana
                                      </th>
                                      <th scope="col">Harakat</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($clients as $client)
                                    <tr class="align-middle">
                                      <td >{{$client->name}}</td>
                                      <td>{{$client->phone}}</td>
                                      <td >{{$client->address}}</td>
                                      <td><?=($client->order[0]) ? $client->order[0]->product->name_uz : '';?></td>
                                      <td><?=($client->is_answered) ?  "<span class='text-success'>Javob qaytarilgan</span>" : "<span class='text-danger'>Javob qaytarilmagan</span>";?></td>
                                      
                                      <td>{{$client->created_at->format('Y.m.d , H:i')}}</td>
                                      <td>
                                        <a href="{{route('clients.show',$client->id)}}" class="btn btn-sm btn-primary" style="margin-right: 10px" ><i data-feather="eye"></i></a>
                                        <form class="d-inline-block " action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <button class="btn btn-sm btn-danger"><i class="mdi mdi-delete  fs-18"></i></button>
                                        </form>
                                  
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                      @if ($clients->hasPages())
                          <nav>
                              <ul class="pagination">
                                  {{-- Артка sahifa tugmasi --}}
                                  @if ($clients->onFirstPage())
                                      <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                  @else
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $clients->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                      </li>
                                  @endif
  
                                  {{-- Sahifa raqamlari --}}
                                  @foreach ($clients->getUrlRange(1, $clients->lastPage()) as $page => $url)
                                      @if ($page == $clients->currentPage())
                                          <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                      @else
                                          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                      @endif
                                  @endforeach
  
                                  {{-- Кейинги sahifa tugmasi --}}
                                  @if ($clients->hasMorePages())
                                      <li class="page-item">
                                          <a class="page-link" href="{{ $clients->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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