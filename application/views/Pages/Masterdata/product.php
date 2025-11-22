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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-left">
              <div>
                <h3 class="fw-bold mb-3">Daftar Produk</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($check_auth[0]->add == 'N'){ ?>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
               <?php } ?>
               
               <div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 border-right border-bottom">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Kode Produk</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="product_code" id="product_code" value="Auto" readonly>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="product_name" id="product_name" placeholder="Nama Produk">
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Harga Jual</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="product_price" id="product_price" value="0">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                      <button id="save" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade bd-example-modal-md editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModaledit">Edit Produk</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 border-right border-bottom">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Kode Produk</label>
                            <div class="col-md-12 p-0">
                              <input type="hidden" class="form-control input-full" name="product_id_edit" id="product_id_edit" value="Auto" readonly>
                              <input type="text" class="form-control input-full" name="product_code_edit" id="product_code_edit" value="Auto" readonly>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="product_name_edit" id="product_name_edit" placeholder="Nama Produk">
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Harga Jual</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="product_price_edit" id="product_price_edit" value="0">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                      <button id="edit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="product-list" class="display table table-striped table-hover">
             <thead>
              <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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


  new bootstrap.Modal(document.getElementById('myModal'), {backdrop: 'static', keyboard: false})  
  new bootstrap.Modal(document.getElementById('exampleModaledit'), {backdrop: 'static', keyboard: false})  
  
  $(document ).ready(function() {
    table_product_list();
  });

  let product_price = new AutoNumeric('#product_price', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  let product_price_edit = new AutoNumeric('#product_price_edit', {
    currencySymbol : 'Rp. ',
    decimalCharacter : ',',
    decimalPlaces: 0,
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator : '.',
  });

  function table_product_list(){
    $('#product-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Masterdata/product_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
        {data: 0},
        {data: 1},
        {data: 2},
        {data: 3}
      ]
    });
  }

  $('#save').click(function(e){
    e.preventDefault();
    var product_name      = $("#product_name").val();
    var product_price_val = product_price.get();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/save_product",
      dataType: "json",
      data: {product_name:product_name, product_price_val:product_price_val},
      success : function(data){
        if (data.code == "200"){
          $('#product-list').DataTable().ajax.reload();
          let title = 'Save Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
          clear();
          notif_success(title, message, state);
          $('#myModal').modal('hide');
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

  $('#edit').click(function(e){
    e.preventDefault();
    var product_id        = $("#product_id_edit").val();
    var product_name      = $("#product_name_edit").val();
    var product_price_val = product_price_edit.get();
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/edit_product",
      dataType: "json",
      data: {product_id:product_id, product_name:product_name, product_price_val:product_price_val},
      success : function(data){
        if (data.code == "200"){
          $('#product-list').DataTable().ajax.reload();
          let title = 'Edit Data';
          let message = 'Data Berhasil Di Ubah';
          let state = 'info';
          notif_success(title, message, state);
          clear();
          $('#exampleModaledit').modal('hide');
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

  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var codes = button.data('codes')
    var name = button.data('name')
    var price = button.data('price')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Produk ' + name)
    modal.find('#product_id_edit').val(id)
    modal.find('#product_code_edit').val(codes)
    modal.find('#product_name_edit').val(name)
    product_price_edit.set(price);
  })

  function clear()
  {
    $("#product_name").val("");
    $("#product_name_edit").val("");
    product_price.set(0);
    product_price_edit.set(0);
    $("#product_id_edit").val("");
  }

  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });

</script>