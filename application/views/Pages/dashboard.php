<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>

<div class="container">
  <div class="page-inner">
    <div
    class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
    <div>
      <h3 class="fw-bold mb-3">Dashboard</h3>
    </div>
    <div class="ms-md-auto py-2 py-md-0">
      <a href="#" class="btn btn-primary btn-round">Pionir <?php echo $_SESSION['user_branch']; ?></a>
    </div>
  </div>
  <div class="row row-card-no-pd">
    <div class="col-12 col-sm-6 col-md-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h6><b>Transaksi Hari Ini</b></h6>
            </div>
            <h4 class="text-info fw-bold" style="margin-top:-5px;">4.500.000</h4>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <p class="text-muted mb-0">Jumlah Transaksi</p>
            <p class="text-muted mb-0">50 kali</p>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <p class="text-muted mb-0">Jumlah Barang</p>
            <p class="text-muted mb-0">150 Item</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h6><b>Transaksi Bulan Ini</b></h6>
            </div>
            <h4 class="text-success fw-bold" style="margin-top:-5px;">65.500.000</h4>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <p class="text-muted mb-0">Jumlah Transaksi</p>
            <p class="text-muted mb-0">250 kali</p>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <p class="text-muted mb-0">Jumlah Barang</p>
            <p class="text-muted mb-0">350 Item</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h6><b>Total Daftar Hari Ini</b></h6>
            </div>
            <h4 class="text-danger fw-bold" style="margin-top:-5px;">5.000.000</h4>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <p class="text-muted mb-0">Jumlah Member Daftar Hari Ini</p>
            <p class="text-muted mb-0">15 Orang</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">Jadwal Hari Ini</div>
            <div class="card-tools"><h4 class="text-info fw-bold">Sep 12</h4> </div>
          </div>
        </div>
        <div class="card-body activity">
          <ol class="activity-feed">
            <li class="feed-item feed-item-danger">
              <time class="date">08:20 - 09:20</time>
              <span class="text"
              >Kelas Yoga
              <a href="#">"Coach Budi"</a></span
              >
            </li>
            <li class="feed-item feed-item-danger">
              <time class="date">09:20 - 10:20</time>
              <span class="text"
              >Kelas Zumba
              <a href="#">"Coach Hendri"</a></span
              >
            </li>
            <li class="feed-item feed-item-danger">
              <time class="date">11:30 - 12:30</time>
              <span class="text"
              >Kelas Poundfit
              <a href="#">"Coach Siska"</a></span
              >
            </li>
            <li class="feed-item feed-item-danger">
              <time class="date">15:30 - 16:00</time>
              <span class="text"
              >Kelas Pilates
              <a href="#">"Coach Yuni"</a></span
              >
            </li>
            <li class="feed-item feed-item-danger">
              <time class="date">17:30 - 20:00</time>
              <span class="text"
              >Kelas Senam Aerobik
              <a href="#">"Coach Beni"</a></span
              >
            </li>
          </ol>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">Jadwal Besok</div>
            <div class="card-tools"><h4 class="text-info fw-bold">Sep 13</h4> </div>
          </div>
        </div>
        <div class="card-body activity">
          <ol class="activity-feed">
            <li class="feed-item feed-item-primary">
              <time class="date">11:30 - 12:30</time>
              <span class="text"
              >Kelas Poundfit
              <a href="#">"Coach Siska"</a></span
              >
            </li>
            <li class="feed-item feed-item-primary">
              <time class="date">17:30 - 20:00</time>
              <span class="text"
              >Kelas Senam Aerobik
              <a href="#">"Coach Beni"</a></span
              >
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-head-row">
            <div class="card-title">Member Baru</div>
            <div class="card-tools">
              <ul
              class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm"
              id="pills-tab"
              role="tablist"
              >
              <li class="nav-item">
                <a
                class="nav-link active"
                id="pills-week"
                data-bs-toggle="pill"
                href="#pills-week"
                role="tab"
                aria-selected="false"
                >See More..</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body activity">
        <div class="d-flex">
          <div class="flex-1 ms-3 pt-1">
            <h6 class="text-uppercase fw-bold mb-1">Kelas Yoga</h6>
            <span class="text-muted">Asti</span>
          </div>
          <div class="float-end pt-1">
            <small class="text-muted">Sep 12, 8:40 PM <br /> <a href="#">By: Marketing 1</a></small>
          </div>
        </div>
        <div class="separator-dashed"></div>


        <div class="d-flex">
          <div class="flex-1 ms-3 pt-1">
            <h6 class="text-uppercase fw-bold mb-1">Kelas Pilates</h6>
            <span class="text-muted">Sisca</span>
          </div>
          <div class="float-end pt-1">
            <small class="text-muted">Sep 12, 12:40 PM <br /> <a href="#">By: Marketing 2</a></small>
          </div>
        </div>
        <div class="separator-dashed"></div>


        <div class="d-flex">
          <div class="flex-1 ms-3 pt-1">
            <h6 class="text-uppercase fw-bold mb-1">Kelas MMA</h6>
            <span class="text-muted">Rudi</span>
          </div>
          <div class="float-end pt-1">
            <small class="text-muted">Sep 12, 12:40 PM <br /> <a href="#">By: Marketing 3</a></small>
          </div>
        </div>
        <div class="separator-dashed"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Laba/Rugi Tahun ini</div>
      </div>
      <div class="card-body">
        <div class="chart-container">
          <canvas
          id="pieChart"
          style="width: 50%; height: 50%"
          ></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card" style="height: 400px;"> 
      <div class="card-header">
        <div class="card-title">Penjualan Top Products</div>
      </div>
      <div class="card-body pb-0">
        <div class="d-flex">
          <div class="avatar">
            <img
            src="<?php echo base_url(); ?>dist//img/logoproduct.svg"
            alt="..."
            class="avatar-img rounded-circle"
            />
          </div>
          <div class="flex-1 pt-1 ms-2">
            <h6 class="fw-bold mb-1">CSS</h6>
            <small class="text-muted">Cascading Style Sheets</small>
          </div>
          <div class="d-flex ms-auto align-items-center">
            <h4 class="text-info fw-bold">+$17</h4>
          </div>
        </div>
        <div class="separator-dashed"></div>
        <div class="d-flex">
          <div class="avatar">
            <img
            src="<?php echo base_url(); ?>dist//img/logoproduct.svg"
            alt="..."
            class="avatar-img rounded-circle"
            />
          </div>
          <div class="flex-1 pt-1 ms-2">
            <h6 class="fw-bold mb-1">J.CO Donuts</h6>
            <small class="text-muted">The Best Donuts</small>
          </div>
          <div class="d-flex ms-auto align-items-center">
            <h4 class="text-info fw-bold">+$300</h4>
          </div>
        </div>
        <div class="separator-dashed"></div>
        <div class="d-flex">
          <div class="avatar">
            <img
            src="<?php echo base_url(); ?>dist//img/logoproduct3.svg"
            alt="..."
            class="avatar-img rounded-circle"
            />
          </div>
          <div class="flex-1 pt-1 ms-2">
            <h6 class="fw-bold mb-1">Ready Pro</h6>
            <small class="text-muted"
            >Bootstrap 5 Admin Dashboard</small
            >
          </div>
          <div class="d-flex ms-auto align-items-center">
            <h4 class="text-info fw-bold">+$350</h4>
          </div>
        </div>
        <div class="separator-dashed"></div>
        <div class="pull-in">
          <canvas id="topProductsChart"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <div class="card-head-row">
          <div class="card-title">Faktur Terlewat</div>
          <div class="card-tools">
            <ul
            class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm"
            id="pills-tab"
            role="tablist"
            >
            <li class="nav-item">
              <a
              class="nav-link active"
              id="pills-week"
              data-bs-toggle="pill"
              href="#pills-week"
              role="tab"
              aria-selected="false"
              >See More..</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body activity">
      <div class="d-flex">
        <div class="flex-1 ms-3 pt-1">
          <h6 class="text-uppercase fw-bold mb-1">#PJ-0001</h6>
          <span class="text-muted">Total: Rp. 10.000.000</span>
        </div>
        <div class="float-end pt-1">
          <small class="text-muted">Feb 25, 8:40 PM <br /> <a href="#">Cek: TRF 00011</a></small>
        </div>
      </div>
      <div class="separator-dashed"></div>


        <div class="d-flex">
        <div class="flex-1 ms-3 pt-1">
          <h6 class="text-uppercase fw-bold mb-1">#PJ-0002</h6>
          <span class="text-muted">Total: Rp. 10.000.000</span>
        </div>
        <div class="float-end pt-1">
          <small class="text-muted">Feb 25, 8:40 PM <br /> <a href="#">Cek: TRF 00011</a></small>
        </div>
      </div>
      <div class="separator-dashed"></div>


        <div class="d-flex">
        <div class="flex-1 ms-3 pt-1">
          <h6 class="text-uppercase fw-bold mb-1">#PJ-0003</h6>
          <span class="text-muted">Total: Rp. 10.000.000</span>
        </div>
        <div class="float-end pt-1">
          <small class="text-muted">Feb 25, 8:40 PM <br /> <a href="#">Cek: TRF 00011</a></small>
        </div>
      </div>
      <div class="separator-dashed"></div>
    </div>
  </div>
</div>

</div>


</div>
</div>
<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>
