
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://64.media.tumblr.com/d6281926c7a3929d7d43388e92d0a2d1/3f31a6b37ae6f5b5-11/s1280x1920/ccade35c0cd40628acaca91ba489dc6120714992.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Shin Liang</a>
            <span class="status-online ml-2" style="color: #00ff00; font-size: 20px;">&#8226;</span>
            <span class="owner-label ml-2 text-white" style="font-size: 14px;">Owner</span>
        </div>
    </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            <li class="nav-item">
                <a href="{{ route('satuan.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-weight-scale"></i>
                    <p>
                        Satuan Unit
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('paket.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-jug-detergent"></i>
                    <p>
                        Paket Laundry
                    </p>
                </a>
            </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-undo"></i>
                <p>
                    Pengembalian
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Data Order
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>
                    Data Transaksi Paket
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                    Pengeluaran
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                    Kas Laundry
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Statistik
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    Pembayaran
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                    Inbox
                </p>
            </a>
        </li>
        </ul>
      </nav>
    </div>
  </aside>
