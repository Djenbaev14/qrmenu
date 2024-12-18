<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{route('home')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('orders.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-list"></i>
                    <span class="nav-text">Заказы</span>
                </a>
            </li>
            @can('category-list')
                <li>
                    <a href="{{route('categories.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Категории</span>
                    </a>
                </li>
            @endif
            @can('product-list') 
                <li>
                    <a href="{{route('products.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Продукты</span>
                    </a>
                </li>
            @endif
            {{-- @can('feedback-list')
                <li>
                    <a href="{{route('feedback.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Отзывы</span>
                    </a>
                </li>
            @endif --}}
            <li>
                <a href="{{route('qr-code.index')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-menu-1"></i>
                    <span class="nav-text">Qr Меню</span>
                </a>
            </li>
            @can('setting-list')
                <li>
                    <a href="{{route('settings.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Настройки</span>
                    </a>
                </li>
            @endif
            @can('company-list')
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-settings-7"></i>
                        <span class="nav-text">Компании</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                           <a href='{{route('companies.index')}}'>Список компаний</a>
                       </li>
                       <li>
                           <a href='{{route('companies.create')}}'>Добавить компанию</a>
                       </li>
                    </ul>
                </li>
            @endcan
            {{-- <li>
                    <a  href="{{route('clients.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span> Клиенты <?=(auth()->user()->can('only-thier-clients-list')) ? "<span class='mx-2 badge text-bg-danger'>".is_answered()."</span>" : '';?> </span>
                    </a>
            </li> --}}
            @can('all-categories-list')
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Категории</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                           <a href='{{route('all-categories.index')}}'>Список категорий</a>
                       </li>
                       <li>
                           <a href='{{route('all-categories.create')}}'>Добавить категорию</a>
                       </li>
                    </ul>
                </li>
            @endcan
        </ul>
    
    </div>
</div>