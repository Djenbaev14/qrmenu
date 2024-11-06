@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

				<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
						<div class="flex-grow-1">
								<h4 class="fs-18 fw-semibold m-0">{{$product->name_uz}} o'zgartirish</h4>
						</div>
				</div>
        <!-- General Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                              <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                {{-- <div class="wrap-custom-file" >
                                    <input type="file" name="photos[]" id="image1" accept=".gif, .jpg, .png" />
                                    <label  for="image1" style='background-image: url("{{asset('images/products/'.$arrayData['photos'][0]['photo'])}}")' class="custom-label-1"><i data-feather="camera" class="fa"></i></label>
                                </div> --}}
                                
                                <div class="wrap-custom-file">
                                    <input type="file" name="photos[]" id="image2" accept=".gif, .jpg, .png" />
                                    <label  for="image2" class="custom-label-1"><i data-feather="camera" class="fa"></i></label>
                                </div>
                                
                                <div class="wrap-custom-file">
                                    <input type="file" name="photos[]" id="image3" accept=".gif, .jpg, .png" />
                                    <label  for="image3" class="custom-label-1"><i data-feather="camera" class="fa"></i></label>
                                </div>
                                
                                <div class="wrap-custom-file">
                                    <input type="file" name="photos[]" id="image4" accept=".gif, .jpg, .png" />
                                    <label  for="image4" class="custom-label-1"><i data-feather="camera" class="fa"></i></label>
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
                                      <?php
                                        $name='name_'.$item['code'] ;
                                        $description='description_'.$item['code'] ;
                                      ?>
                                      <div class="mb-3">
                                        <label for="">Mahsulot nomi ({{$item['name']}})</label>
                                        <input type="text" value="{{$product->$name}}" name="name_{{$item['code']}}" class="form-control" placeholder="Mahsulotning nomini kiriting">
                                      </div>
                                      <div class="mb-3">
                                        <label for="">Ta'rif ({{$item['name']}})</label>
                                        <?php
                                            $desc='description_'.$item['code'];
                                        ?>
                                        <textarea class="form-control" type="text" id="description_{{$item['code']}}" name="description_{{$item['code']}}" rows="10" placeholder="Введите текст">{!! $product->$description !!}</textarea>
                                      </div>
                                    </div>
                                    @endforeach
                                  </div>
                                  
                                  <div class="mb-3">
                                    <label for="">Kategoriya</label>
                                    <select name="category_id" class="form-select">
                                      <option hidden value="none">Kategoriyani tanlang</option>
                                      @foreach ($categories as $cat)
                                          <option <?=($product->category_id==$cat->id) ? 'selected' : '';?> value="{{$cat->id}}">{{$cat->name_uz}}</option>
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

                </div>
            </div>
        </div>


		</div> <!-- container-fluid -->
	</div> 
@endsection

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

    // Checkbox holatini tekshirish va divni ko'rsatish
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
@endpush