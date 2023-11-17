 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard') }}" class="brand-link">
         <img src="{{ asset('lte/img/logo_paguyuban.png') }}" alt="tc3" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-bold">Tenjo City 3</span>
     </a><br>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <li class="nav-item">
                     <a href="{{ route('dashboardUser') }}" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-hdd"></i>
                         <p>
                             Master Data
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ url('/user/penghuni') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Warga
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('/user/asset') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-primary"></i>
                                 <p>
                                     Asset
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-university"></i>
                         <p>
                             Iuran/Kas Warga
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('iuranSaya',[Crypt::encrypt(auth()->user()->user_id)]) }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Iuran Saya
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('UserMutasi') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Mutasi Kas
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('filterMutasi') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Filter Mutasi
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('UserKasMasuk') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Kas Masuk
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('filterKasMasuk') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Filter Kas Masuk
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('UserKasKeluar') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-danger"></i>
                                 <p>
                                     Kas Keluar
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('filterKasKeluar') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-danger"></i>
                                 <p>
                                     Filter Kas Keluar
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="{{ url('/user/pengaduan/') }}" class="nav-link">
                         <i class="nav-icon fas fa-file-signature"></i>
                         <p>
                             Pengaduan
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
