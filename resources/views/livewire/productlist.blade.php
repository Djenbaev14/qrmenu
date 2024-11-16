<div>
    <div class="card">
        <div class="card-header">
            <h4 class="fw-bold mb-3">Maxsulotlar ro'yxati</h4>
            <div class="row  justify-content-between p-2" style="background-color: #F9F9FC;border-radius:10px;" >
              <div class="col-4">
                <input wire:model='search' type="search" class="form-control"  placeholder="Maxsulot nomini qidirish">
              </div>
              <div class="col-3 ">
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6V18M18 12L6 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 6V18M18 12L6 12" stroke="url(#paint0_linear_1494_22742)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><defs><linearGradient id="paint0_linear_1494_22742" x1="11.8537" y1="4.97561" x2="12.1463" y2="20.0488" gradientUnits="userSpaceOnUse"><stop stop-color="#fff"></stop><stop offset="1" stop-color="#fff"></stop></linearGradient></defs></svg>
                  Добавление продукта</button>
              </div>
            </div>
        </div><!-- end card header -->
        <div class="card-body">
            <div class="table-responsive">
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
                            <td><img src="{{asset('images/products/'.json_decode($product->photos)[0])}}" class="rounded" width="70px" height="40px" alt="">&nbsp;&nbsp;{{$product->name_uz}}</td>
                            <td><?=($product->price) ? number_format($product->price)." сум" : ''?></td>
                            <td>{{$product->created_at->format('Y.m.d , H:i')}}</td>
                            <td>{{$product->is_active}}</td>
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
        </div>
    </div>
</div>
