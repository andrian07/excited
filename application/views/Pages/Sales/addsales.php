<?php 
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . $this->config->item('header');
?>
</div>

<div class="container">
  <div class="page-inner">
    <div class="page-header">

    </div>
    <div class="row">
      <h3 class="fw-bold mb-3">Tambah Penjualan </h3>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <label for="noinvoice" class="col-sm-1 col-form-label text-right">No Invoice :</label>
              <div class="col-sm-3">
                <input id="sales_invoice" name="sales_invoice" type="text" class="form-control" value="AUTO" readonly="">
                <input id="sales_id" name="sales_id" type="hidden" class="form-control">
              </div>
              <div class="col-sm-4">
              </div>
              <label for="tanggal" class="col-sm-1 col-form-label text-right">Tanggal :</label>
              <div class="col-sm-3">
                <input id="sales_date" name="sales_date" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
              </div>
            </div>

            <div class="form-group row" style="margin-top: 2px;">
             <label for="noinvoice" class="col-sm-1 col-form-label text-right">Customer:</label>
             <div class="col-sm-2">
               <select class="form-control input-full js-example-basic-single" id="sales_customer" name="sales_customer">
                <option value="">-- Pilih Customer --</option>
                <?php foreach ($data['customer_list'] as $row) { ?>
                  <option value="<?php echo $row->customer_id; ?>"><?php echo $row->customer_name; ?></option>  
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1">
              <div class="form-group">
                <button id="btnadd_temp" class="btn btn-md btn-primary rounded-square float-right btn-add-temp" style="margin-top: 2px;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md"><i class="fas fa-plus"></i></button>
              </div>
            </div>

            <div class="col-sm-4"></div>
            <label for="tanggal" class="col-sm-1 col-form-label text-right">Ekspedisi :</label>
            <div class="col-sm-3">
              <select class="form-control input-full js-example-basic-single" id="sales_ekspedisi" name="sales_ekspedisi">
                <option value="">-- Pilih Ekspedisi --</option>
                <?php foreach ($data['ekspedisi_list'] as $row) { ?>
                  <option value="<?php echo $row->ms_ekspedisi_id; ?>"><?php echo $row->ms_ekspedisi_name; ?></option>  
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="noinvoice" class="col-sm-1 col-form-label text-right">No HP:</label>
            <div class="col-sm-3">
             <input id="sales_customer_phone" name="sales_customer_phone" type="text" class="form-control">
           </div>
           <div class="col-sm-4"></div>
           <label for="tanggal" class="col-sm-1 col-form-label text-right">User :</label>
           <div class="col-sm-3">
            <input id="po_user_id" name="po_user_id" type="text" class="form-control" value="<?php echo $_SESSION['user_name']; ?>" readonly="">
          </div>
        </div>

        <div class="form-group row">
          <label for="noinvoice" class="col-sm-1 col-form-label text-right">Alamat:</label>
          <div class="col-sm-3">
            <textarea class="form-control input-full" id="sales_customer_address" rows="4"></textarea>
          </div>

          <div class="col-sm-8"></div>

          <div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12 border-right border-bottom">
                      <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Kode Customer</label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control input-full" name="customer_code" id="member_code" value="Auto" readonly>
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control input-full" name="customer_name" id="customer_name" placeholder="Nama Pelanggan">
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control input-full" name="customer_phone" id="customer_phone" placeholder="No HP">
                        </div>
                      </div>

                      <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                        <div class="col-md-12 p-0">
                          <textarea class="form-control input-full" name="customer_address" id="customer_address"></textarea>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                  <button type="button" id="savecustomer" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form id="formaddtemp">
          <div class="row well well-sm input-temp">

            <div class="col-sm-4">
              <div class="form-group">
                <label>Produk</label>
                <input id="product_name" name="product_name" type="text" class="form-control ui-autocomplete-input" placeholder="ketikkan nama produk" value="" required="" autocomplete="off"  data-parsley-required data-parsley-required-message="*Masukan Nama Produk">
                <input id="product_id" type="hidden" name="product_id">
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label>Harga Jual Per Unit</label>
                <input id="temp_price" name="temp_price" class="form-control text-right" value="0"  required="">
              </div>
            </div>


            <div class="col-sm-1">
              <div class="form-group">
                <label>Qty</label>
                <input id="temp_qty" name="temp_qty" type="text" class="form-control text-right" value="0" required="">
              </div>
            </div>

            <div class="col-sm-4">

              <!-- text input -->

              <div class="form-group">

                <label>Total</label>

                <input id="temp_total" name="temp_total" type="text" class="form-control text-right" value="0" readonly="">

              </div>

            </div>

            <div class="col-sm-1" style="padding-right: 62px;">

              <!-- text input -->

              <label>&nbsp;</label>

              <div class="form-group">

                <button id="btnadd_temp" class="btn btn-md btn-primary rounded-circle float-right btn-add-temp"><i class="fas fa-plus"></i></button>

              </div>

            </div>

          </div>
        </form>

        <div class="table-responsive">
          <table id="temp-sales-list" class="display table table-striped table-hover" >
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <div class="row form-space">
          <div class="col-lg-6">
            <div class="form-group">
              <div class="col-sm-12">
                <textarea id="sales_remark" name="sales_remark" class="form-control" placeholder="Catatan" maxlength="500" rows="8"></textarea>
              </div>
            </div>
          </div>

          <div class="col-lg-6 text-right">
            <div class="form-group row">
              <label for="footer_sub_total" class="col-sm-7 col-form-label text-right:">Sub Total:</label>
              <div class="col-sm-5">
                <input id="footer_sub_total" name="footer_sub_total" type="text" class="form-control text-right" value="0" readonly="">
              </div>
            </div>
            <div class="form-group row">
              <label for="footer_total_discount" class="col-sm-7 col-form-label text-right:">Discount :</label>
              <div class="col-sm-5">
                <input id="footer_total_discount" name="footer_total_discount" data-bs-toggle="modal" data-bs-target="#footerdiscount" type="text" class="form-control text-right" value="0" readonly="">
              </div>
            </div>
            <div class="form-group row">
              <label for="footer_total_invoice" class="col-sm-7 col-form-label text-right:">Grand Total :</label>
              <div class="col-sm-5">
                <input id="footer_total_invoice" name="footer_total_invoice" type="text" class="form-control text-right" value="0" readonly="">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <button id="btncancel" class="btn btn-danger"><i class="fas fa-times-circle"></i> Batal</button>
                <button id="btnsave" class="btn btn-success button-header-custom-save"><i class="fas fa-save"></i> Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php 
require DOC_ROOT_PATH . $this->config->item('footer');
?>

<script>



  let temp_price = new AutoNumeric('#temp_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let temp_total = new AutoNumeric('#temp_total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });


  let footer_sub_total = new AutoNumeric('#footer_sub_total', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let footer_total_discount = new AutoNumeric('#footer_total_discount', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let footer_total_invoice = new AutoNumeric('#footer_total_invoice', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  function select_name()
  {
    var customer_id = $(this).val();
    console.log(customer_id)
  }

  $(document).ready(function() {
    tempsales_table();
  });

  function tempsales_table(){
    $('#temp-sales-list').DataTable( {
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      retrieve: true,
      ajax: {
        url: '<?php echo base_url(); ?>Sales/temp_sales_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
        {data: 0},
        {data: 1},
        {data: 2},
        {data: 3},
        {data: 4},
        {data: 5}
      ]
    });
  } 

  $('#sales_customer').on('change', function() {
    var customer_id = this.value;
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Sales/get_customer",
      dataType: "json",
      data: {customer_id:customer_id},
      success : function(data){
        if (data.code == "200"){
          let row = data.result[0];
          $('#sales_customer_phone').val(row.customer_phone);
          $('#sales_customer_address').val(row.customer_address);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  });


  $('#product_name').autocomplete({ 
    minLength: 2,
    source: function(req, add) {
      $.ajax({
        url: '<?php echo base_url(); ?>/Sales/search_product',
        dataType: 'json',
        type: 'GET',
        data: req,
        success: function(res) {
          if (res.success == true) {
            add(res.data);
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: res.message,
            })
          }
        },
      });
    },
    select: function(event, ui) {
      let id = ui.item.id;
      $("#product_id").val(id);
      temp_price.set(ui.item.product_price);
    },
  });

  $('#temp_qty').on('input', function() {
    let temp_qty = $('#temp_qty').val();
    let temp_price_val = temp_price.get();
    let total_temp_val = temp_qty * temp_price_val;
    temp_total.set(total_temp_val);
  });

  $('#btnadd_temp').on('click', function() {
    let product_id      = $('#product_id').val();
    let temp_price_val  = temp_price.get();
    let temp_qty        = $('#temp_qty').val();
    let temp_total_val  = temp_total.get();
    
    if(temp_total_val < 1){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahakan Isi Data Terlebih Dahulu',
      })
    }else{
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Sales/addtemp",
        dataType: "json",
        data: {product_id:product_id, temp_price_val:temp_price_val, temp_qty:temp_qty, temp_total_val:temp_total_val},
        success : function(data){
          if (data.code == "200"){
            let row = data.result[0];
            $('#sales_customer_phone').val(row.customer_phone);
            $('#sales_customer_address').val(row.customer_address);
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.result,
            })
          }
        }
      });
    }



  });

  $("#btncancel").click(function (e) {
    Swal.fire({
      title: 'Konfirmasi?',
      text: "Apakah Anda Yakin Membatalkan Inputan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Sales/clear_temp",
        dataType: "json",
        data: {},
        success : function(data){
          if (data.code == "200"){
           window.location.href = "<?php echo base_url(); ?>/Sales/salesorder";
         }else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
     }
   })
  });

  new bootstrap.Modal(document.getElementById('footerdiscount'), {backdrop: 'static', keyboard: false})  

</script>