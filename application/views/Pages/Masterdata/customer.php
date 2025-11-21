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
                <h3 class="fw-bold mb-3">Daftar Customer</h3>
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

              <div class="modal fade bd-example-modal-md editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModaledit">Edit Customer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12 border-right border-bottom">
                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Kode Customer</label>
                            <div class="col-md-12 p-0">
                              <input type="hidden" class="form-control input-full" name="customer_id_edit" id="customer_id_edit">
                              <input type="text" class="form-control input-full" name="customer_code_edit" id="customer_code_edit"  readonly>
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="customer_name_edit" id="customer_name_edit" placeholder="Nama Pelanggan">
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control input-full" name="customer_phone_edit" id="customer_phone_edit" placeholder="No HP">
                            </div>
                          </div>

                          <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-12 p-0">
                              <textarea class="form-control input-full" name="customer_address_edit" id="customer_address_edit"></textarea>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                      <button id="editcustomer" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="customer-list" class="display table table-striped table-hover">
             <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
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
    table_customer_list();
  });

  function table_customer_list(){
    $('#customer-list').DataTable({
      serverSide: true,
      search: true,
      processing: true,
      ordering: false,
      ajax: {
        url: '<?php echo base_url(); ?>Masterdata/customer_list',
        type: 'POST',
        data:  {},
      },
      columns: 
      [
        {data: 0},
        {data: 1},
        {data: 2},
        {data: 3},
        {data: 4}
      ]
    });
  }


  $('#savecustomer').click(function(e){
    e.preventDefault();
    var customer_name             = $("#customer_name").val();
    var customer_phone            = $("#customer_phone").val();
    var customer_address          = $("#customer_address").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/save_customer",
      dataType: "json",
      data: {customer_name:customer_name, customer_phone:customer_phone, customer_address:customer_address},
      success : function(data){
        if (data.code == "200"){
          $('#customer-list').DataTable().ajax.reload();
          let title = 'Save Data';
          let message = 'Data Berhasil Di Tambah';
          let state = 'info';
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

  $('#editcustomer').click(function(e){
    e.preventDefault();
    var customer_id               = $("#customer_id_edit").val();
    var customer_name             = $("#customer_name_edit").val();
    var customer_phone            = $("#customer_phone_edit").val();
    var customer_address          = $("#customer_address_edit").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/edit_customer",
      dataType: "json",
      data: {customer_id:customer_id, customer_name:customer_name, customer_phone:customer_phone, customer_address:customer_address},
      success : function(data){
        if (data.code == "200"){
          $('#customer-list').DataTable().ajax.reload();
          let title = 'Edit Data';
          let message = 'Data Berhasil Di Ubah';
          let state = 'info';
          notif_success(title, message, state);
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
    var phone = button.data('phone')
    var address = button.data('address')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Member ' + name)
    modal.find('#customer_id_edit').val(id)
    modal.find('#customer_code_edit').val(codes)
    modal.find('#customer_name_edit').val(name)
    modal.find('#customer_phone_edit').val(phone)
    modal.find('#customer_address_edit').val(address)
  })


  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });

</script>