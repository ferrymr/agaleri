<aside id="left-panel">
  <div class="login-info">
    <span>
      <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
        <img src="{{ asset('template/img/avatars/male.png') }}" alt="me" class="online" />
        <span>
          Hi, {{ Auth::user()->name }}

          @php
          $r = Auth::user()->role
          @endphp
        </span>
      </a>
    </span>
  </div>
  <nav>
    <ul class="nav">
      <!-- <li class="active open"> -->
      <li>
        <a href="{{ url('/home') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
      </li>
      <!-- Master Data -->
      @if($r == '1')
      <li>
        <a href="#"><i class="fa fa-lg fa-fw fa-hdd-o"></i> <span class="menu-item-parent">Master</span></a>
        <ul>
          <li>
            <a href="{{ url('/e_kategori') }}">Brand</a>
          </li>
          <li>
            <a href="{{ url('/size') }}">Size</a>
          </li>
          <li>
            <a href="{{ url('/produk') }}">Produk </a>
          </li>
          <li>
            <a href="{{ url('/costumer') }}">Customer</a>
          </li>
          <!-- <li>
            <a href="{{ url('/bahan_baku') }}">Bahan Baku</a>
          </li>
          <li>
            <a href="{{ url('/warna') }}">Warna</a>
          </li>
          <li>
            <a href="{{ url('/brand') }}">Brand</a>
          </li>
          <li>
            <a href="{{ url('/barang_jadi') }}">Barang Jadi</a>
          </li>
          <li>
            <a href="{{ url('/supplier') }}">Supplier</a>
          </li>
          <li>
            <a href="{{ url('/costumer') }}">Customer</a>
          </li>
          <li>
            <a href="{{ url('/cmt') }}">CMT</a>
          </li>
          <li>
            <a href="{{ url('/acc') }}">Accessories</a>
          </li>
          <li>
            <a href="{{ url('/proses') }}">Proses</a>
          </li>
          <li>
            <a href="{{ url('/satuan') }}">Satuan</a>
          </li>
          <li>
            <a href="{{ url('/bank') }}">Bank</a>
          </li> -->
          <li>
            <a href="{{ url('/role') }}">Role</a>
          </li>
          <!-- <li>
            <a href="{{ url('/master_neraca_saldo') }}">Neraca Saldo</a>
          </li> -->
        </ul>
      </li>
      @endif

      <!-- Sales -->
      @if($r == '1' || $r == '2')
      <li>
        <a href="{{ url('order_list_ecommerce') }}"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">Order<span></a>
      </li>
      @endif
      <!-- Sales -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">CRM<span></a>
      </li>
      @endif

      <!-- Production -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Production<span></a>
      </li>
      @endif

      <!-- Warehouse -->
      @if($r == '1' || $r == '2' )
      <li>
        <a href="#"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Warehouse</span></a>
        <ul>
          <li>
            <a href="{{ url('/masuk_barang_index') }}">Warehouse</a>
          </li>
          <li>
            <a href="{{ url('/stok_produk') }}">Stock Produk</a>
          </li>
        </ul>
      </li>

      @endif


      <!-- SKB -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-child"></i> <span class="menu-item-parent">HR</span></a>
      </li>
      @endif

      <!-- History -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-barcode"></i> <span class="menu-item-parent">POS</span></a>
      </li>
      @endif

      <!-- Finance -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-money"></i> <span class="menu-item-parent">Finance</span></a>
      </li>
      @endif

      <!-- Accounting -->
      @if($r == '1')
      <li class="disabled">
        <a href="#"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Accounting</span></a>
      </li>
      @endif


      <!-- eCommerce -->
      @if($r == '1')
      <li>
        <a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Report</span></a>
        <ul>
          <li>
            <a href="{{ url('/report_transaksi') }}">Transaksi</a>
          </li>
          <!-- <li>
            <a href="{{ url('/report_stok') }}">Stock</a>
          </li> -->
        </ul>
      </li>
      <li>
        <a href="javascript:void(0)"><i class="fa fa-lg  fa-gear"></i> <span class="menu-item-parent">Settings</span></a>
        <ul>
          <li>
            <a href="{{ url('/general') }}">General</a>
          </li>
          <li>
            <a href="{{ url('/pages') }}">Pages</a>
          </li>
          <li>
            <a href="{{ url('/promo') }}">Promo</a>
          </li>
          <!-- <li>
            <a href="javascript:void(0)">Tools</a>
            <ul>
              <li>
                <a href="javascript:void(0)">Import</a>
                <ul>
                  <li>
                    <a href="{{ url('/import') }}">Master Data</a>
                  </li>
                  <li>
                    <a href="{{ url('/import_stock') }}">Master Stock</a>
                  </li>
                  <li>
                    <a href="{{ url('/import_akun') }}">Master Akun</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li> -->

          <!-- <li>
            <a href="{{ url('/clear_data') }}">Clear Data</a>
          </li> -->
          <!-- <li>
            <a href="#">Accounting</a>
            <ul>
              <li>
                <a href="{{ url('/payment') }}">Jenis Pembayaran</a>
              </li>
              <li>
                <a href="{{ url('/category') }}">Kategori</a>
              </li>
            </ul>
          </li> -->
          <li>
            <a href="{{ url('/user') }}">User Management</a>
          </li>
          <li>
            <a href="{{ url('/gallery') }}">Gallery Produk </a>
          </li>
        </ul>
      </li>
      @endif
      <li>
        <a href="#"><i class="fa fa-lg  fa-question-circle"></i> <span class="menu-item-parent">About</span></a>
        <ul>
          <li>
            <a href="{{ url('/about') }}">About</a>
          </li>
          <li>
            <a href="{{ url('/changelog') }}">Changelog</a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>


  <span class="minifyme" data-action="minifyMenu">
    <i class="fa fa-arrow-circle-left hit"></i>
  </span>

</aside>