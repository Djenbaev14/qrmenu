<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @if (auth()->user()->hasRole('restaurant_owner'))
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
                <li>
                    <a href="{{route('categories.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Категории</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('products.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-archive"></i>
                        <span class="nav-text">Продукты</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('qr-code.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-menu-1"></i>
                        <span class="nav-text">Qr Меню</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('settings.index')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Настройки</span>
                    </a>
                </li>
            @elseif(auth()->user()->hasRole('super_admin'))
                <li>
                    <a href="{{route('home')}}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-home"></i>
                        <span class="nav-text">Главный</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-settings-7"></i>
                        <span class="nav-text">Рестораны</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                           <a href='{{route('companies.index')}}'>Список ресторанов</a>
                       </li>
                       <li>
                           <a href='{{route('companies.create')}}'>Добавить ресторан                    </a>
                       </li>
                    </ul>
                </li>
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
                {{-- <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Продукты</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                           <a href='{{route('all-products.index')}}'>Список продуктов</a>
                       </li>
                       <li>
                           <a href='{{route('all-products.create')}}'>Добавить продукта</a>
                       </li>
                    </ul>
                </li> --}}
            @endif
        </ul>
    
    </div>
</div>