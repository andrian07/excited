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
                <h3 class="fw-bold mb-3">Daftar Penjualan</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <button class="btn btn-info" id="reload"><span class="btn-label"><i class="fas fa-sync"></i></span> Reload</button>
                <?php if($check_auth[0]->add == 'N'){ ?>
                  <button class="btn btn-primary" disabled="disabled"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button>
                <?php }else{ ?>
                 <a href="<?php echo base_url(); ?>Sales/addsales"><button class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah</button></a>
               <?php } ?>

             </div>
           </div>
         </div>
         <div class="card-body">
          <div class="table-responsive">
            <table id="customer-list" class="display table table-striped table-hover">
             <thead>
              <tr>
                <th>No Invoice</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Subtotal</th>
                <th>Diskon</th>
                <th>Total</th>
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
        url: '<?php echo base_url(); ?>Sales/transaction_list',
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
        {data: 5},
        {data: 6}
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