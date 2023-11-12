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
                     <a href="{{ route('dashboard') }}" class="nav-link active">
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
                             <a href="{{ route('penghuni.index') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Warga
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('warga.index') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     User
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('pengurus.index') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Pengurus
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('asset') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-primary"></i>
                                 <p>
                                     Asset
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <!-- <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-cogs"></i>
                         <p>
                             Penggunaan Asset
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('penggunaanAsset') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     List Penggunaan Asset
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('peminjamanAsset') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-danger"></i>
                                 <p>
                                     Peminjaman Asset
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Pengembalian Asset
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li> -->
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
                             <a href="{{ route('kas') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Mutasi Kas
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('printMutasiKas') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-info"></i>
                                 <p>
                                     Cetak Mutasi
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('listKasMasuk') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Kas Masuk
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('printKasMasuk') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-success"></i>
                                 <p>
                                     Cetak Kas Masuk
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('listKasKeluar') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-danger"></i>
                                 <p>
                                     Kas Keluar
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('printKasKeluar') }}" class="nav-link">
                                 <i class="nav-icon far fa-circle text-danger"></i>
                                 <p>
                                     Cetak Kas Keluar
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('pengaduan') }}" class="nav-link">
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
