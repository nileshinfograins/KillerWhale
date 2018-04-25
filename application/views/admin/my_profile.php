<?php $this->load->view('admin/admin_header'); ?>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-5">


<div class="card">
<div class="card-header" data-background-color="purple">
<h4 class="title">Change Password</h4>

</div>
<div class="card-content">

<form id="password_form" name="password_form" action="#" method="POST">
<div class="error_password"></div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Current Password</label>
            <input type="password" class="form-control required" id="current_password" name="current_password">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">New Password</label>
            <input type="password" class="form-control required" id="new_password" name="new_password">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Confirm Password</label>
            <input type="password" class="form-control required" id="confirm_password" name="confirm_password" equalTo="#new_password">
        </div>
    </div>
</div>

<button type="button" class="btn btn-theme pull-right" onclick="update_password();">Update Password</button>
<div class="clearfix"></div>
</form>


</div>
</div>

</div>
<div class="col-md-7">
<div class="card">
<div class="card-header" data-background-color="purple">
<h4 class="title">Edit Profile</h4>
<p class="category">Complete your profile</p>
</div>
<div class="card-content">
<form id="" name="" action="<?php echo base_url(); ?>admin/profile" method="POST">

<?php
if($this->session->flashdata('error_message'))
{
?>
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $this->session->flashdata('error_message'); ?>
  </div>
  <script type="text/javascript">
      setTimeout(function(){ $('.alert-success').hide();}, 4000);
  </script>
<?php } ?>


<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Username</label>
            <input type="text" class="form-control required" id="username" name="username" value="<?php if(!empty($admin_data->username)) echo $admin_data->username; ?>">
            <?php echo form_error('username', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php if(!empty($admin_data->email)) echo $admin_data->email; ?>" >
             <?php echo form_error('email', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-theme pull-right">Update Profile</button>
<div class="clearfix"></div>
</form>
</div>
</div>
</div>

</div>
</div>
</div>

<?php $this->load->view('admin/admin_footer'); ?>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $("#account_id").addClass('active');
});


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$(document).ready(function(){
    $("#password_form").validate();
});

function update_password()
{
    var form = $("#password_form");

    if(form.valid() == false)
    {
        return false;
    }
    else
    {
        var current_password = $("#current_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();

        var dataString = 'current_password='+current_password+'&new_password='+new_password+'&confirm_password='+confirm_password;
        var url = '<?php echo base_url(); ?>admin/dashboard/change_password';

        $.ajax({
            'type': 'POST',
            'data': dataString,
            'url': url,
            'dataType': 'json',
            success: function(response)
            {
                if(response.error == false)
                {
                    var html = '<div class="alert alert-success alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a> '+response.message+' </div>';

                    $(".error_password").html(html);
                }
                else
                {
                    var html = '<div class="alert alert-warning alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>';

                    $(".error_password").html(html);
                }

                $(".error_password").fadeIn();
                $(".error_password").fadeOut(5000);
                
            }

        });

    }

}
</script>


<!--  Cropping Script  Start  -->

<script type="text/javascript">
function show_preview_poup()
{
  $("#popup_file_input_id").val('');
  $(".cropit-preview-image").attr('src','');

  $("#image_preview_popup").modal('show');
}
</script>

<script src="<?php echo base_url(); ?>assets/js/jquery.cropit.js"></script>
<script type="text/javascript">
$(function() {
  $('.image-editor').cropit({allowDragNDrop: false});

  $('.rotate-cw').click(function() {
    $('.image-editor').cropit('rotateCW');
  });
  $('.rotate-ccw').click(function() {
    $('.image-editor').cropit('rotateCCW');
  });

});

function cropt_save_image()
{
    // Move cropped image data to hidden input
    var imageData = $('.image-editor').cropit('export');
    $('.hidden-image-data').val(imageData);

    // Print HTTP request params
    var formValue = $(this).serialize();
    // $('#result-data').text(formValue);

    /*******Upload Image logic**Start******/
        upload_image();

        //$("#image_preview_popup").modal('hide');
    /*******Upload Image logic**End******/

    // Prevent the form from actually submitting
    return false;
}

function upload_image()
{
        var imageData = $('.hidden-image-data').val();
        if(imageData == '')
        {
            $("#image_preview_popup").modal('hide');
        }
        else
        {
        var dataString = 'imageData='+imageData;
        var url = '<?php echo base_url(); ?>user/change_profile_image';

        $.ajax({
            'type': 'POST',
            'data': dataString,
            'url': url,
            'dataType': 'json',
            success: function(response)
            {   
                $('#profile_image_id').attr('src', response);
                $("#image_preview_popup").modal('hide');
            }

        });   
    }
}
</script>

    <style>
      .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 250px;
        height: 250px;
        margin: 0 auto;
      }
      .ratio-img-wrapper{
        width: 700px;
      }
      .cropit-preview-image-container {
        cursor: move;
      }

      .image-size-label {
        margin-top: 10px;
      }
      .resize-btn-section{
        padding:0 15px;
      }
      #popup_file_input_id{
        margin: 15px;
      }
      .drag-drop{
        position: absolute;
        top: 40%;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 15px;
      }
      input, .export {
        display: block;
      }

      button {
        margin-top: 10px;
      }
    </style>

<!--  Cropping Script  End  -->

  <!-- Modal -->
  <div class="modal fade" id="image_preview_popup" role="dialog">
    <div class="modal-dialog ratio-img-wrapper">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Image</h4>
        </div>
        <div class="modal-body">
        <form id="image_upload_form" name="image_upload_form" action="#">
          <div class="image-editor">
            <input type="file" class="cropit-image-input" id="popup_file_input_id" >
            <div class="cropit-preview">
              <h1 class="drag-drop">Image Preview</h1>
            </div>
           <div class="resize-btn-section">
              <div class="image-size-label">
              Resize image
            </div>
            <input type="range" class="cropit-image-zoom-input">
            
          <button class="rotate-ccw"><img src="<?php echo base_url(); ?>assets/img/undo.png" width="21px"></button>
          <button class="rotate-cw"><img src="<?php echo base_url(); ?>assets/img/redo.png" width="21px"></button>

            <input type="hidden" name="image-data" class="hidden-image-data" />
            <button type="button" style="margin: 0;" class="btn btn-success" id="crop_submit_id" onclick="cropt_save_image();">Submit</button>
           </div>
          </div>
        </form>

        </div>
      </div>
      
    </div>
  </div>
