
<div class="app-sidebar-menu">
  <div class="h-100" data-simplebar>

      <!--- Sidemenu -->
      <div id="sidebar-menu">

          <div class="logo-box">
              <a class='logo logo-light' href='index.html'>
                  <span class="logo-sm">
                      <img src="assets/images/logo-sm.png" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                      <img src="assets/images/logo-light.png" alt="" height="24">
                  </span>
              </a>
              <a class='logo logo-dark' href='index.html'>
                  <span class="logo-sm">
                      <img src="assets/images/logo-sm.png" alt="" height="22">
                  </span>
                  <span class="logo-lg">
                      <img src="assets/images/logo-dark.png" alt="" height="24">
                  </span>
              </a>
          </div>

          <ul class="side-menu">
            <li>
                <a class='tp-link' href="{{route('home')}}">
                    <i data-feather="home"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            @if (auth()->user()->role_id==2)<li>
                <a href="#sidebarProducts" data-bs-toggle="collapse">
                    <i data-feather="home"></i>
                    <span> Продукты </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav-second-level">
                        <li>
                            <a class='tp-link' href='{{route('categories.index')}}'>Категории</a>
                        </li>
                        <li>
                            <a class='tp-link' href='{{route('products.index')}}'>Продукты</a>
                        </li>
                    </ul>
                </div>
                </li>
                
                <li>
                    <a class='tp-link' href="{{route('clients.index')}}">
                        <i data-feather="users"></i>
                        <span> Клиенты <?=(is_answered()) ? "<span class='mx-2 badge text-bg-danger'>".is_answered()."</span>" : '';?> </span>
                        
                    </a>
                </li>
                
                <li>
                    <a class='tp-link' href="{{route('settings.index')}}">
                        <i data-feather="settings"></i>
                        <span> Настройки </span>
                    </a>
                </li>
            @elseif(auth()->user()->role_id)
                <li>
                    <a class='tp-link' href="{{route('companies.index')}}">
                        <i data-feather="home"></i>
                        <span> Компании </span>
                    </a>
                </li>
            @endif
            
          </ul>
            

      </div>
      <!-- End Sidebar -->

      <div class="clearfix"></div>

  </div>
</div>