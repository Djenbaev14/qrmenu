@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
  
  <div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
      <div class="mr-auto d-none d-lg-block">
        <h2 class="text-black font-w600 mb-0">Список заказов</h2>
      </div>
        <button type="button" class="btn btn-primary mb-2 btn btn-primary d-flex align-items-center " data-toggle="modal" data-target="#basicModal">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>Создание заказа</button>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <div class="card-body">
            <!-- Nav tabs -->
            <div class="custom-tab-1">
                <ul class="nav nav-tabs w-100" id="orderTabs" role="tablist">
                  <li class="col p-0 nav-item">
                      <a class="nav-link">Все</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link active" id="new-tab" data-toggle="tab" href="{{route('orders.news')}}" aria-controls="new" aria-selected="true">Новый</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link">В процессе</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link" >Просроченный</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link" >Готово</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link" >История заказов</a>
                  </li>
                </ul>
                  <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                      <div class="pt-4">
                        aaaa
                        {{-- @foreach($orders as $order)
                          <div>{{ $order->name }} - {{ $order->status }}</div>
                        @endforeach --}}
                      </div>
                  </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection