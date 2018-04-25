<?php $this->load->view('admin/admin_header'); ?>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header" data-background-color="purple">
    <h4 class="title"><?php echo $title; ?></h4>
    <!-- <p class="category">Here is a subtitle for this table</p> -->
</div>
<div class="card-content table-responsive">

<div class="">
  <form id="data_form" name="data_form" action="<?php echo base_url(); ?>admin/referral_setting" method="POST">

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

    <div class="form-group">
      <label for="">Level 1 (in %):</label>
      <input type="text" class="form-control required" id="level_one_percentage" name="level_one_percentage" placeholder="First Level Percentage" onkeypress="return isNumberKey(this, event)" value="<?php echo $referral_data->first_level; ?>">
    </div>
    <div class="form-group">
      <label for="">Level 2 (in %):</label>
      <input type="text" class="form-control required" id="level_second_percentage" name="level_second_percentage" placeholder="Second Level Percentage" onkeypress="return isNumberKey(this, event)" value="<?php echo $referral_data->second_level; ?>">
    </div>
    <div class="form-group">
      <label for="">Level 3 (in %):</label>
      <input type="text" class="form-control required" id="level_third_percentage" name="level_third_percentage" placeholder="Third Level Percentage" onkeypress="return isNumberKey(this, event)" value="<?php echo $referral_data->third_level; ?>">
    </div>    
    <button type="submit" class="btn btn-theme">Save</button>
  </form>
</div>
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

$( "#data_form" ).validate({
  rules: {
    level_one_percentage: {
      required: true,
      max: 100
    },
    level_second_percentage: {
      required: true,
      max: 100
    },
    level_third_percentage: {
      required: true,
      max: 100
    },        
  }
});

});

$(document).ready(function(){
$("#referral_id").addClass('active');
});

</script>
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
function isNumberOLD(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function isNumberKey(txt, evt) {

    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
            return true;
        } else {
            return false;
        }
    } else {
        if (charCode > 31
             && (charCode < 48 || charCode > 57))
            return false;
    }
    return true;
}
</script>

