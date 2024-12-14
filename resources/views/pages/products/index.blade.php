@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
  
  <div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
      <div class="mr-auto d-none d-lg-block">
        <h2 class="text-black font-w600 mb-0">Список продуктов</h2>
      </div>
        <button type="button" class="btn btn-primary mb-2 btn btn-primary d-flex align-items-center " data-toggle="modal" data-target="#basicModal">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>Добавить продукта</button>
    </div>
    
    <div class="modal right fade " id="basicModal">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary" >
                  <h5 class="modal-title text-white">Добавить продукта</h5>
                  <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="wrap-custom-file col-lg-3 col-sm-6 mb-2" >
                          <input type="file" name="photos[]" id="image1" accept=".gif, .jpg, .png" />
                          <label  for="image1" class="custom-label-1"  ><i class="flaticon-381-photo-camera-1"></i></label>
                        </div>
                        
                        <div class="wrap-custom-file col-lg-3 col-sm-6 mb-2">
                            <input type="file" name="photos[]" id="image2" accept=".gif, .jpg, .png" />
                            <label  for="image2" class="custom-label-2"><i class="flaticon-381-photo-camera-1"></i></label>
                        </div>
                        
                        <div class="wrap-custom-file col-lg-3 col-sm-6">
                            <input type="file" name="photos[]" id="image3" accept=".gif, .jpg, .png" />
                            <label  for="image3" class="custom-label-3"><i class="flaticon-381-photo-camera-1"></i></label>
                        </div>
                        
                        <div class="wrap-custom-file col-lg-3 col-sm-6">
                            <input type="file" name="photos[]" id="image4" accept=".gif, .jpg, .png" />
                            <label  for="image4" class="custom-label-4"><i class="flaticon-381-photo-camera-1"></i></label>
                        </div>
                      </div>
                        <ul class="nav nav-tabs mt-3" role="tablist">
                          @foreach (config('app.languages') as $i => $item)
                              <li class="nav-item" role="presentation">
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
                          <div class="mb-3">
                            <label for="">Название продукта ({{$item['name']}})</label>
                            <input type="text" value="{{old('name_'.$item['code'])}}" name="name_{{$item['code']}}" class="form-control" placeholder="Mahsulotning nomini kiriting">
                          </div>
                          <div class="mb-3">
                            <label for="">Определение ({{$item['name']}})</label>
                            <?php
                                $desc='description_'.$item['code'];
                            ?>
                            <textarea class="form-control" id="description_{{$item['code']}}" name="description_{{$item['code']}}" rows="3" placeholder="">{{old('description_'.$item['code'])}}</textarea>
                          </div>
                        </div>
                        @endforeach
                      </div>
                      
                      <div class="mb-3">
                        <label for="">Категории</label>
                        <select name="category_id" id="single-select" class="form-select">
                          @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name_uz}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class=" mb-3">
                        <label for="" style="cursor: pointer">Цена</label>
                        <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}" placeholder="Введите цену">
                        <div class="mb-3">
                          <label for="">Порядковый номер</label>
                          <input type="number" value="99" name="sequence_number" class="form-control">
                        </div>
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
                    <th scope="col">Название продукта </th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Состояние</th>
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                  <tr class="align-middle">
                    <td><img src="{{asset('images/products/'.$product->photos[0])}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$product->name_uz}}</td>
                    <td><?=($product->price) ? number_format($product->price)." сум" : ''?></td>
                    <td>{{$product->created_at->format('Y.m.d , H:i')}}</td>
                    <td>
                      <div class="form-check form-switch ">
                        <input class="form-check-input is-active-checkbox" 
                              type="checkbox" 
                              role="switch" 
                              style="transform: scale(1.8);cursor: pointer;" data-id="{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }}>
                      </div>
                    </td>
                    <td>
                      {{-- <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$product->id}}">
                        <i data-feather="edit"></i></button> --}}
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-success" ><i data-feather="edit"></i></button></a>
                      <form class="d-inline-block" action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-sm btn-danger"><i data-feather="trash"></i></button>
                      </form>
                      <!-- /.modal -->
                
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
<link rel="stylesheet" href="{{asset('css/multiphoto.css')}}">
@endpush
@push('js')

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
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

      <script>
        $('input[type="file"]').each(function(){
        // Refs
        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();
  
        // When a new file is selected
        $file.on('change', function(event){
          
            var fileName = $file.val().split( '\\' ).pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if( fileName ){
            $label
                .addClass('file-ok')
                .css('background-image', 'url(' + tmppath + ')');
            $labelText.text(fileName);
            }else{
            $label.removeClass('file-ok');
            $labelText.text(labelDefault);
            }
        });
  
        // End loop of file input elements
        });
        </script>
        <script type="text/javascript">
  
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);
  
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
  
        </script>
@endpush