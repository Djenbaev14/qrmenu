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
              <?php 
              // Hozirgi URLni olish
                  $url = url()->current();  // yoki request()->url()

                  // URLni bo'lib olish
                  $segments = explode('/', parse_url($url, PHP_URL_PATH));

                  // Slashedan keyingi birinchi so'zni olish
                  $firstWordAfterSlash = $segments[3] ?? null; // Agar mavjud bo'lsa
              ?>
                <ul class="nav nav-tabs w-100" id="orderTabs" role="tablist">
                  <li class="col p-0 nav-item">
                    <a class="nav-link <?=(empty($firstWordAfterSlash)) ? 'active' : '';?>" href="{{route('orders.index')}}">Все</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link <?=($firstWordAfterSlash=='news') ? 'active' : '';?>" href="{{route('orders.news')}}">Новый</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link <?=($firstWordAfterSlash=='process') ? 'active' : '';?>" href="{{route('orders.process')}}">В процессе</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link <?=($firstWordAfterSlash=='expired') ? 'active' : '';?>" href="{{route('orders.expired')}}">Просроченный</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link <?=($firstWordAfterSlash=='ready') ? 'active' : '';?>" href="{{route('orders.ready')}}" >Готово</a>
                  </li>
                  <li class="col p-0 nav-item">
                      <a class="nav-link <?=($firstWordAfterSlash=='history') ? 'active' : '';?>" href="{{route('orders.history')}}">История заказов</a>
                  </li>
                </ul>
                <div class="tab-content" id="orderTabsContent">
                  <div class="tab-pane fade <?=(empty($firstWordAfterSlash)) ? 'show active' : '';?>" >
                      <div class="card pt-4">
                        <div class="car-body">
                          <table class="table">
                            <thead class="thead-primary">
                              <tr>
                                <th>Заказ номер</th>
                                <th>Имя клиента</th>
                                <th>Дата и время</th>
                                <th>Цена</th>
                                <th>Способ оплаты</th>
                                <th>Тип доставки</th>
                                <th>Состояние</th>
                                <th>Движение</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($orders as $order)
                                  <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->client->id }}</td>
                                    <td>{{ $order->created_at->format('Y.m.d H:i:s') }}</td>
                                    <td></td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                  </tr>
                              @empty
                                  <tr>
                                    <td colspan="8" class="text-center"><h3 class="fw-bold text-danger">Нет заказов</h3></td>
                                  </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade  <?=($firstWordAfterSlash=='news') ? 'show active' : '';?>" >
                      <div class="pt-4">
                        <div class="card">
                          <div class="card-header">
                            
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="tab-pane fade <?=($firstWordAfterSlash=='process') ? 'show active' : '';?>">
                      <div class="pt-4">
                        {{-- @foreach($orders as $order)
                          <div>{{ $order->name }} - {{ $order->status }}</div>
                        @endforeach --}}
                      </div>
                  </div>
                  <div class="tab-pane fade <?=($firstWordAfterSlash=='expired') ? 'show active' : '';?>">
                      <div class="pt-4">
                        {{-- @foreach($orders as $order)
                          <div>{{ $order->name }} - {{ $order->status }}</div>
                        @endforeach --}}
                      </div>
                  </div>
                  <div class="tab-pane fade <?=($firstWordAfterSlash=='ready') ? 'show active' : '';?>">
                      <div class="pt-4">
                        {{-- @foreach($orders as $order)
                          <div>{{ $order->name }} - {{ $order->status }}</div>
                        @endforeach --}}
                      </div>
                  </div>
                  <div class="tab-pane fade " id="history" role="tabpanel" aria-labelledby="history-tab">
                      <div class="pt-4">
                        {{-- @foreach($orders as $order)
                          <div>{{ $order->name }} - {{ $order->status }}</div>
                        @endforeach --}}
                      </div>
                  </div>
                </div>
            </div>
        </div>
          {{-- <div class="card-body">
            <div class="table-responsive">
              <table class="table table-responsive-sm display mb-4" id="example5"  style="min-width: 845px;">
                <thead>
                  <tr>
                    <th scope="col">Название продукта </th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Состояние</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection