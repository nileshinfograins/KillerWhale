<?php $this->load->view('user/user_header'); ?>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-5">
<div class="card card-profile">
<div class="card-avatar">
<a href="#pablo" onclick="show_preview_poup();">

<?php 
if(!empty($user_data->profile_image))
{
?>
<img class="img" src="<?php echo base_url(); ?>uploads/user_images/<?php echo $user_data->profile_image; ?>" id="profile_image_id"/>
<?php
}
else
{
?>
<img class="img" src="<?php echo base_url(); ?>assets/img/user.png" id="profile_image_id"/>
<?php    
}
?>


</a>
</div>
<div class="content">
<h4 class="card-title"><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h4>
</div>
</div>

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
<form id="" name="" action="<?php echo base_url(); ?>user/profile" method="POST">

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
            <label class="control-label">First Name</label>
            <input type="text" class="form-control required" id="first_name" name="first_name" value="<?php if(!empty($user_data->first_name)) echo $user_data->first_name; ?>">
            <?php echo form_error('first_name', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Last Name</label>
            <input type="text" class="form-control required" id="last_name" name="last_name" value="<?php if(!empty($user_data->last_name)) echo $user_data->last_name; ?>">
            <?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Email</label>
            <input type="text" class="form-control required" id="email" name="email" value="<?php if(!empty($user_data->email)) echo $user_data->email; ?>" disabled="">
             <?php echo form_error('email', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Contact Number</label>
            <input type="text" class="form-control required" id="contact_number" name="contact_number" value="<?php if(!empty($user_data->contact_number)) echo $user_data->contact_number; ?>" onkeypress="return isNumber(event);">
             <?php echo form_error('contact_number', '<div class="error">', '</div>'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <select class="form-control required" id="country" name="country">
                <option value="">Select Country</option>
             <?php
             $country_result = getCountryList();

             if(!empty($country_result))
             {
                foreach ($country_result as $row) 
                {
             ?>
             <option value="<?php echo $row->id; ?>" <?php if($user_data->country == $row->id) echo 'selected'; ?>><?php echo $row->name; ?></option>
             <?php
                }
             }
             ?>
            </select>
            <?php echo form_error('country', '<div class="error">', '</div>'); ?>

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

<?php $this->load->view('user/user_footer'); ?>

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
        var url = '<?php echo base_url(); ?>user/change_password';

        $.ajax({
            'type': 'POST',
            'data': dataString,
            'url': url,
            'dataType': 'json',
            success: function(response)
            {

                if(response == 1)
                {
                    var html = '<div class="alert alert-success alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a> Password changed successfully. </div>';

                    $(".error_password").html(html);
                }
                else if(response == 2)
                {
                    var html = '<div class="alert alert-warning alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a>Please enter correct old password.</div>';

                    $(".error_password").html(html);
                }
                else if(response == 3)
                {
                    var html = '<div class="alert alert-warning alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">&times;</a>New password and confirm password doesn\'t match</div>';

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
  $("#upload").val('');
  $(".cr-image").attr('src','');

  $("#image_preview_popup").modal('show');
}
</script>

<script type="text/javascript">
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
  .ratio-img-wrapper{
    width: 700px;
  }
</style>

<!--  Cropping Script  End  -->
  <script src="<?php echo base_url(); ?>crop/croppie.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>crop/croppie.css">

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
          <div class="row">
            <div class="col-md-6 text-center">
            <div id="upload-demo" style="width:350px" class="croppie-container">
              
            </div>
            </div>

            <input type="hidden" name="hidden-image-data" id="hidden-image-data" class="hidden-image-data">

            <div class="col-md-6" style="padding-top:30px;">
            <strong>Select Image:</strong>
            <br>
            <input id="upload" type="file">
            <br>
            <button class="btn btn-theme upload-result">Upload Image</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>


<script type="text/javascript">


$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () { 

var file = $("#upload").val();
var fileType = file.replace(/^.*\./, '');

var ValidImageTypes = ["gif", "jpg", "png", "jpg", "jpeg", "GIF", "JPG", "PNG", "JPG", "JPEG"];
if ($.inArray(fileType, ValidImageTypes) < 0) {
     
     alert('Please select valid Image format');
     $("#upload").val('');
     return false;
}

  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {

var file = $("#upload").val();
      
if(file)
{
  $(".upload-result").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
}

  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {
  
        if(file)
        {
          setTimeout(function(){ 
          $(".hidden-image-data").val(resp);
          upload_image();
           $(".upload-result").prop('disabled', false).html('Upload Image'); }, 2000);
        }
        else
        {
          $("#image_preview_popup").modal('hide');
        }
  
  });
});


</script>
