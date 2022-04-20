<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="home" class="brand-link">
     <img src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Laravel</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{ asset('asset/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">{{ Auth::user()->name }}</a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
              <li class="nav-item menu-open" >
                <a href="{{ url('supplier') }}" class="{{ (request()->is('supplier')) ? 'nav-link active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>  
                    Data Supplier
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{ url('customer') }}" class="{{ (request()->is('customer')) ? 'nav-link active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                    Data Customer
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{ url('product') }}" class="{{ (request()->is('product')) ? 'nav-link active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>            
                    Data Product
                </a>
              </li>
              <li class="nav-item menu-open">
                <a href="{{ url('po') }}" class="{{ (request()->is('po')) ? 'nav-link active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                    Purchase Order                 
                </a>
              </li>
         <li class="nav-item menu-open">
           <a href="{{ url('so') }}" class="{{ (request()->is('so')) ? 'nav-link active' : '' }}">
             <i class="far fa-circle nav-icon"></i>             
               Sales Order             
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>