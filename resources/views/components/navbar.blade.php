
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
            
            <li>
                <a href="#sidebarProducts" data-bs-toggle="collapse">
                    <i data-feather="home"></i>
                    <span> Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav-second-level">
                        <li>
                            <a class='tp-link' href='{{route('categories.index')}}'>Categories</a>
                        </li>
                        <li>
                            <a class='tp-link' href='{{route('products.index')}}'>Products</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li>
                <a class='tp-link' href="{{route('settings.index')}}">
                    <i data-feather="settings"></i>
                    <span> Settings </span>
                </a>
            </li>
          </ul>

      </div>
      <!-- End Sidebar -->

      <div class="clearfix"></div>

  </div>
</div>