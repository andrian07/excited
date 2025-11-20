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
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="save_member_form" id="save_member_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/save_member" method="post">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12 border-right border-bottom">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Customer</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_code" id="member_code" value="Auto" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_name" id="member_name" placeholder="Nama Member">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_phone" id="member_phone" placeholder="No HP">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control input-full" name="member_nik" id="member_nik"></textarea>
                              </div>
                            </div>

                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade bd-example-modal-xl editmodal" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModaledit">Edit Member</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form name="edit_member_form" id="edit_member_form" enctype="multipart/form-data" action="<?php echo base_url(); ?>Masterdata/edit_member" method="post">
                      <div class="modal-body">

                        <div class="row">
                          <div class="col-md-4 border-right">
                            <div class="form-group form-inline">
                              <div class="proof">
                                <div class="imgArea_edit" data-title="">
                                  <input type="file" name="screenshoot_edit" id="screenshoot_edit" hidden accept="image/*" />
                                  <i class="fa-solid fa-cloud-arrow-up"></i>
                                  <h4>upload screenshoot</h4>
                                  <p>image size must be less than <span>2MB</span></p>
                                  <div id="active-image"></div>
                                </div>
                                <button class="selectImage_edit" type="button">Select Image</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kode Member</label>
                              <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control input-full" name="member_id_edit" id="member_id_edit" value="Auto" readonly>
                                <input type="text" class="form-control input-full" name="member_code_edit" id="member_code_edit" value="Auto" readonly>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_name_edit" id="member_name_edit" placeholder="Nama Member">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">No HP</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_phone_edit" id="member_phone_edit" placeholder="No HP">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Nik</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_nik_edit" id="member_nik_edit" placeholder="NIK">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Tgl Lahir</label>
                              <div class="col-md-12 p-0">
                                <input type="date" class="form-control input-full" name="member_dob_edit" id="member_dob_edit">
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_email_edit" id="member_email_edit" placeholder="Email">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control" id="member_address_edit" name="member_address_edit" rows="5"></textarea>
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
                              <div class="col-md-12 p-0">
                                <select class="form-select form-control" id="member_gender_edit" name="member_gender_edit">
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Kontak Darurat Yang Dapat Dihubungi</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_urgent_phone_edit" id="member_urgent_phone_edit" placeholder="Kontak Darurat">
                              </div>
                            </div>

                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Hubungan</label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" name="member_urgent_sibiling_edit" id="member_urgent_sibiling_edit" placeholder="Hubungan">
                              </div>
                            </div>
                          </div>


                          <div class="col-md-4">
                            <div class="form-group form-inline">
                              <label for="inlineinput" class="col-md-3 col-form-label">Keterangan (alergi / penyakit bawaan /dll):</label>
                              <div class="col-md-12 p-0">
                                <textarea class="form-control" id="member_desc_edit" name="member_desc_edit" rows="5"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" ><i class="fas fa-save"></i> Simpan</button>
                      </div>
                    </form>
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


  

  $('#edit_member_form').on('submit',(function(e) {
    e.preventDefault();
    var formData            = new FormData(this);
    var member_name         = $("#member_name_edit").val();
    var member_phone        = $("#member_phone_edit").val();
    var member_nik          = $("#member_nik_edit").val();
    var member_dob          = $("#member_dob_edit").val();
    var member_email        = $("#member_email_edit").val();
    var member_address      = $("#member_address_edit").val();
    var member_gender       = $("#member_gender_edit").val();

    if(member_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Member',
      })
    }else if(member_phone == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No HP',
      })
    }else if(member_nik == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No KTP',
      })
    }else if(member_dob == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Tgl Lahir',
      })
    }else if(member_address == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Alamat',
      })
    }else{
      $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){          
          window.location.href = "<?php echo base_url(); ?>Masterdata/member";
          Swal.fire('Saved!', '', 'success');
        }
      });
    }
  }));

  $('#save_member_form').on('submit',(function(e) {
    e.preventDefault();
    var formData            = new FormData(this);
    var member_name         = $("#member_name").val();
    var member_phone        = $("#member_phone").val();
    var member_nik          = $("#member_nik").val();
    var member_dob          = $("#member_dob").val();
    var member_email        = $("#member_email").val();
    var member_address      = $("#member_address").val();
    var member_gender       = $("#member_gender").val();

    if(member_name == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Nama Member',
      })
    }else if(member_phone == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No HP',
      })
    }else if(member_nik == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi No KTP',
      })
    }else if(member_dob == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Tgl Lahir',
      })
    }else if(member_address == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan Isi Alamat',
      })
    }else{
      $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(data){     
          if(data.code == 0){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.result,
            })
          }else{
            window.location.href = "<?php echo base_url(); ?>Masterdata/member";
            Swal.fire('Saved!', '', 'success');
          } 
        }
      });
    }
  }));

  $('#exampleModaledit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id   = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('.modal-title').text('Edit Member ' + name)
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Masterdata/get_edit_member",
      dataType: "json",
      data: {id:id},
      success : function(data){
        if (data.code == "200"){
          document.getElementById("active-image").innerHTML = "";
          let row = data.result[0];
          modal.find('#member_id_edit').val(row.member_id)
          modal.find('#member_code_edit').val(row.member_code)
          modal.find('#member_name_edit').val(row.member_name)
          modal.find('#member_phone_edit').val(row.member_phone)
          modal.find('#member_nik_edit').val(row.member_nik)
          modal.find('#member_dob_edit').val(row.member_dob)
          modal.find('#member_email_edit').val(row.member_email)
          modal.find('#member_address_edit').val(row.member_address)
          modal.find('#member_gender_edit').val(row.member_gender)
          modal.find('#member_urgent_phone_edit').val(row.member_urgent_phone)
          modal.find('#member_urgent_sibiling_edit').val(row.member_urgent_sibiling)
          modal.find('#member_desc_edit').val(row.member_desc)

          var elem = document.createElement("img");
          document.getElementById("active-image").appendChild(elem);
          elem.src = '<?php echo base_url(); ?>assets/member/'+row.member_image;
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.result,
          })
        }
      }
    });
  })


  $('#reload').click(function(e){
    e.preventDefault();
    location.reload();
  });

</script>