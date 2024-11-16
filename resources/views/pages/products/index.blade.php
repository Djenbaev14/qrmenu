@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="fw-bold mb-3">Список продуктов</h4>
                    <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                      <div class="col-lg-6 col-sm-12">
                        <form action="{{ url('/products') }}" class="row " method="GET">
                          <div class="col-sm-12 col-lg-7 mb-2">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Maxsulot nomini qidirish"/>
                          </div>
                          <div class="col-sm-12 col-lg-5 mb-2">
                            <button type="submit" class="btn btn-primary">Поиск</button>
                            <a href="{{route('products.index')}}" class="btn btn-success">Очистка</a>
                          </div>
                        </form>
                      </div>
                      <div class="col-lg-3 col-sm-12">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                          Добавление продукта</button>
                      </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    {{-- <span wire:click="sortBy('name_uz')"  class="text-sm float-right" style="cursor: pointer"><i data-feather="arrow-up"></i><i data-feather="arrow-down" class="text-muted"></i></span> --}}
                                    <th scope="col">Название продукта </span>
                                    </th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Дата создания</th>
                                    <th scope="col">Состояние</th>
                                    <th scope="col">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($products as $product)
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
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($products->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Артка sahifa tugmasi --}}
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled"><a class="page-link">&laquo; Артка</a></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo; Артка</a>
                                    </li>
                                @endif

                                {{-- Sahifa raqamlari --}}
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="page-item active" aria-current="page"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Кейинги sahifa tugmasi --}}
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Кейинги &raquo;</a>
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
                      <h5 class="modal-title" id="myLargeModalLabel">Добавление продукта
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                              <label  for="image1" class="custom-label-1"  ><i data-feather="camera" class="fa"></i></label>
                            </div>
                            
                            <div class="wrap-custom-file col-lg-3 col-sm-6 mb-2">
                                <input type="file" name="photos[]" id="image2" accept=".gif, .jpg, .png" />
                                <label  for="image2" class="custom-label-2"><i data-feather="camera" class="fa"></i></label>
                            </div>
                            
                            <div class="wrap-custom-file col-lg-3 col-sm-6">
                                <input type="file" name="photos[]" id="image3" accept=".gif, .jpg, .png" />
                                <label  for="image3" class="custom-label-3"><i data-feather="camera" class="fa"></i></label>
                            </div>
                            
                            <div class="wrap-custom-file col-lg-3 col-sm-6">
                                <input type="file" name="photos[]" id="image4" accept=".gif, .jpg, .png" />
                                <label  for="image4" class="custom-label-4"><i data-feather="camera" class="fa"></i></label>
                            </div>
                          </div>
                            <ul class="nav nav-pills nav-justified bg-light mt-3" role="tablist">
                              @foreach (config('app.languages') as $i => $item)
                                  <li class="nav-item" role="presentation">
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
                              <div class="mb-3">
                                <label for="">Название продукта ({{$item['name']}})</label>
                                <input type="text" value="{{old('name_'.$item['code'])}}" name="name_{{$item['code']}}" class="form-control" placeholder="Mahsulotning nomini kiriting">
                              </div>
                              <div class="mb-3">
                                <label for="">Определение ({{$item['name']}})</label>
                                {{-- <div id="quill-editor-{{$item['code']}}" style="height: 100px;">
                                </div> --}}
                                <?php
                                    $desc='description_'.$item['code'];
                                ?>
                                <textarea class="form-control" id="description_{{$item['code']}}" name="description_{{$item['code']}}" rows="10" placeholder="Введите текст">{{old('description_'.$item['code'])}}</textarea>
                              </div>
                            </div>
                            @endforeach
                          </div>
                          
                          <div class="mb-3">
                            <label for="">Категории</label>
                            <select name="category_id" class="form-select">
                              <option hidden value="none">Выберите категорию</option>
                              @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name_uz}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class=" mb-3">
                              <div class="form-check">
                                  <input type="checkbox" id="checkbox" class="form-check-input" id="checkmeout0">
                                  <label class="form-check-label" for="checkmeout0">Установление цены</label>
                              </div>
                          </div>
                          <div class="justify-content-between mb-3" style="display: none" id="show_price">
                            <div class="col-5">
                              <label for="" style="cursor: pointer">Цена</label>
                              <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}" placeholder="Введите цену">
                            </div>
                            <div class="col-5">
                              <label for="">Единица Измерения</label>
                              <select name="unit_id" id="unit_id" class="form-control">
                                <option value="null">Введите единицу измерения</option>
                                @foreach ($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                              </select>
                            </div>
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
		</div> <!-- container-fluid -->
	</div> 
@endsection


@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
@endpush

@push('js')
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
      <script>
        // Checkboxni tanlash
        const checkbox = document.getElementById('checkbox');
        const content = document.getElementById('show_price');
        const price = document.getElementById('price');
        const unit_id = document.getElementById('unit_id');

        // Checkbox Состояниеni tekshirish va divni ko'rsatish
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                content.style.display = 'flex';
                price.setAttribute('required', true);
                unit_id.setAttribute('required', true);
            } else {
                content.style.display = 'none';
                price.removeAttribute('required');
                unit_id.removeAttribute('required');
            }
        });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.is-active-checkbox').on('change', function() {
                var isChecked = $(this).is(':checked');
                var productId = $(this).data('id');
    
                $.ajax({
                    url: '/products/is_active', // marshrut manzili
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF tokeni
                        id: productId,
                        is_active: isChecked ? 1 : 0
                    },
                    success: function(response) {
                      
                      const Toast = Swal.mixin({
                      toast: true,
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                      }
                    });
                    Toast.fire({
                      icon: "success",
                      title: "Действие успешно изменено"
                    });
                    },
                    error: function(xhr) {
                      alert('error','error');
                    }
                });
            });
        });
    </script>



@endpush