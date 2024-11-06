@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">


        <div class="row mt-4">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <div class="d-flex align-items-end gap-2 mb-3">
                        <h4 class="fw-bold m-0">{{$category->name_uz}}</h4>
                        <span>{{$products->count()}} Mahsulot</span>
                      </div>
                      <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
                        <div class="col-5">
                          <form action="{{ route('categories.show',$category->id) }}" class="d-flex" method="GET">
                            <input type="search" class="form-control"  name="search" value="{{ request('search') }}" placeholder="Mahsulot nomini qidirish"/>
                            <button type="submit" class="btn btn-primary mx-2">Izlash</button>
                            <a href="{{route('categories.show',$category->id)}}" class="btn btn-success mx-2">Tozalash</a>
                        </form>
                        </div>
                        <div class="col-3 ">
                          <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                            Maxsulot qo'shish</button>
                        </div>
                      </div>
                  </div><!-- end card header -->
                  
                  <div class="card-body">
                      <div class="table-responsive mb-3">
                          <table class="table mb-0">
                              <thead>
                                  <tr>
                                      <th scope="col">Mahsulot nomi</th>
                                      <th scope="col">Narx</th>
                                      <th scope="col">Yaratilgan sana</th>
                                      <th scope="col">Holat</th>
                                      <th scope="col">Harakat</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($products as $product)
                                    <tr class="align-middle">
                                      <td><img src="{{asset('images/products/'.$product->photos[0])}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$product->name_uz}}</td>
                                      <td>{{$product->price}}</td>
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
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target=".bs-example-modal-{{$product->id}}">
                                          <i data-feather="edit"></i></button>
                                        {{-- <a href="{{route('categories.destroy',$category->id)}}" class="btn btn-sm btn-danger"><i data-feather="trash"></i></a> --}}
                                        <form class="d-inline-block" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                          @csrf
                                          @method("DELETE")
                                          <button class="btn btn-sm btn-danger"><i data-feather="trash"></i></button>
                                        </form>
                                        {{-- <div class="modal fade bs-example-modal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                                                  <input type="file"  name="photo" id="logoInput" accept="image/*" class="form-control">
                                                                  <img id="preview" src="{{asset('images/categories/'.$category->photo)}}" width="50px" alt="Logotip oldindan ko'rish">
                                                              </div>
                                                              
                                                              <ul class="nav nav-pills nav-justified bg-light" role="tablist">
                                                                @foreach (config('app.languages') as $i => $item)
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link <?=($i==0) ? 'active' : '';?>" data-bs-toggle="tab" href="#update_{{$item['code']}}_{{$category->id}}" role="tab">
                                                                            <span class="d-flex justify-content-center align-items-center">
                                                                                <img src="{{asset('images/flags/'.$item['code'].'.svg')}}" width="20px"> 
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
                                                                <input type="submit" value="Tahrirlash" class="btn btn-primary">
                                                            </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                  
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
                    <h5 class="modal-title" id="myLargeModalLabel">Mahsulot qo‘shish
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                      <div class="wrap-custom-file" >
                          <input type="file" name="photos[]" id="image1" accept=".gif, .jpg, .png" />
                          <label  for="image1"><i data-feather="camera" class="fa"></i></label>
                      </div>
                      
                      <div class="wrap-custom-file">
                          <input type="file" name="photos[]" id="image2" accept=".gif, .jpg, .png" />
                          <label  for="image2"><i data-feather="camera" class="fa"></i></label>
                      </div>
                      
                      <div class="wrap-custom-file">
                          <input type="file" name="photos[]" id="image3" accept=".gif, .jpg, .png" />
                          <label  for="image3"><i data-feather="camera" class="fa"></i></label>
                      </div>
                      
                      <div class="wrap-custom-file">
                          <input type="file" name="photos[]" id="image4" accept=".gif, .jpg, .png" />
                          <label  for="image4"><i data-feather="camera" class="fa"></i></label>
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
                              <label for="">Mahsulot nomi ({{$item['name']}})</label>
                              <input type="text" value="{{old('name_'.$item['code'])}}" name="name_{{$item['code']}}" class="form-control" placeholder="Kategoriyaning nomini kiriting">
                            </div>
                            <div class="mb-3">
                              <label for="">Ta'rif ({{$item['name']}})</label>
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
                          <label for="">Kategoriya</label>
                          <select name="category_id" class="form-select">
                            <option hidden value="none">Kategoriyani tanlang</option>
                            @foreach ($categories as $cat)
                                <option <?=($cat->id==$category->id) ? 'selected' : '';?> value="{{$cat->id}}">{{$cat->name_uz}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class=" mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="checkbox" class="form-check-input" id="checkmeout0">
                                <label class="form-check-label" for="checkmeout0">Narx belgilash</label>
                            </div>
                        </div>
                        <div class="justify-content-between mb-3" style="display: none" id="show_price">
                          <div class="col-5">
                            <label for="" style="cursor: pointer">Narx</label>
                            <input type="number" id="price" name="price" class="form-control" value="{{old('price')}}" placeholder="Narxni kiriting">
                          </div>
                          <div class="col-5">
                            <label for="">O'lchov Birligi</label>
                            <select name="unit_id" id="unit_id" class="form-control">
                              <option value="null">O'lchov birligi kiriting</option>
                              @foreach ($units as $unit)
                                  <option value="{{$unit->id}}">{{$unit->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
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


@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
    /*** GENERAL STYLES ***/
    * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    }


    /*** CUSTOM FILE INPUT STYE ***/
    .wrap-custom-file {
    position: relative;
    display: inline-block;
    width: 150px;
    height: 150px;
    margin: 0 1rem 0 0;
    text-align: center;
    }
    .wrap-custom-file input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 2px;
    height: 2px;
    overflow: hidden;
    opacity: 0;
    }
    .wrap-custom-file label {
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    overflow: hidden;
    padding: 0 0.5rem;
    cursor: pointer;
    background-color: #eee;
    border-radius: 4px;
    -webkit-transition: -webkit-transform 0.4s;
    transition: -webkit-transform 0.4s;
    transition: transform 0.4s;
    transition: transform 0.4s, -webkit-transform 0.4s;
    }
    /* .wrap-custom-file label span {
    display: block;
    margin-top: 2rem;
    font-size: 1.4rem;
    color: #777;
    -webkit-transition: color 0.4s;
    transition: color 0.4s;
    } */
    .wrap-custom-file label .fa {
    position: absolute;
    top: 40%;
    left: 50%;
    -webkit-transform: translatex(-50%);
    transform: translatex(-50%);
    font-size: 2rem;
    color: #777;
    -webkit-transition: color 0.4s;
    transition: color 0.4s;
    }
    .wrap-custom-file label:hover {
    -webkit-transform: translateY(-1rem);
    transform: translateY(-1rem);
    }
    .wrap-custom-file label:hover span, .wrap-custom-file label:hover .fa {
    color: #333;
    }
    .wrap-custom-file label.file-ok {
    background-size: cover;
    background-position: center;
    }
    .wrap-custom-file label.file-ok span {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 0.3rem;
    font-size: 1.1rem;
    color: #000;
    background-color: rgba(255, 255, 255, 0.7);
    }
    .wrap-custom-file label.file-ok .fa {
    display: none;
    }
    canvas.drawing,
    canvas.drawingBuffer {
      position: absolute;
      left: 0;
      top: 0;
    }

    </style>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-ui/4.11.0/index.js"></script>
    <script>
      var _scannerIsRunning = false;

      function startScanner() {
        Quagga.init(
          {
            inputStream: {
              name: "Live",
              type: "LiveStream",
              target: document.querySelector("#scanner-container"),
              constraints: {
                width: { min: 480 },
                height: 320,
                facingMode: "environment"
              }
            },
            decoder: {
              readers: ["ean_reader"]
            }
          },
          function (err) {
            if (err) {
              console.log(err);
              return;
            }
      
            console.log("Initialization finished. Ready to start");
            Quagga.start();
      
            // Set flag to is running
            _scannerIsRunning = true;
          }
        );
      
        Quagga.onProcessed(function (result) {
          var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;
      
          if (result) {
            if (result.boxes) {
              drawingCtx.clearRect(
                0,
                0,
                parseInt(drawingCanvas.getAttribute("width")),
                parseInt(drawingCanvas.getAttribute("height"))
              );
              result.boxes
                .filter(function (box) {
                  return box !== result.box;
                })
                .forEach(function (box) {
                  Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, {
                    color: "green",
                    lineWidth: 2
                  });
                });
            }
      
            if (result.box) {
              Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, {
                color: "#00F",
                lineWidth: 2
              });
            }
      
            if (result.codeResult && result.codeResult.code) {
              Quagga.ImageDebug.drawPath(
                result.line,
                { x: "x", y: "y" },
                drawingCtx,
                { color: "red", lineWidth: 5 }
              );
            }
          }
        });
      
        var scannedBarcode = "";
      
        Quagga.onDetected(function (result) {
          if (result.codeResult.code) {
            scannedBarcode = result.codeResult.code;
            document.getElementById("barcode").value = scannedBarcode;
            Quagga.stop();
            _scannerIsRunning = false;
            console.log("Barcode detected and processed : [" + scannedBarcode + "]");
          }
        });
      }
      
      // Start/stop scanner
      document.getElementById("scanButton").addEventListener(
        "click",
        function () {
          if (_scannerIsRunning) {
            Quagga.stop();
          } else {
            startScanner();
          }
        },
        false
      );
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