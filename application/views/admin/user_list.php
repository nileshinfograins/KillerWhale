<?php $this->load->view('admin/admin_header'); ?>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title"><?php echo $title; ?></h4>
                                    <!-- <p class="category">Here is a subtitle for this table</p> -->
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>S.No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($user_data))
                                            {
                                                $i=($this->uri->segment(3) == '') ? 1 : $this->uri->segment(3) + 1;
                                                foreach ($user_data as $row) 
                                                {
                                            ?>                                        
                                                <tr id="tr_id_<?php echo $row->id; ?>">
                                                    <td><?php echo $i; ?>.</td>
                                                <td>
                                                <?php
                                                    if(!empty($row->profile_image))
                                                    {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>uploads/user_images/<?php echo $row->profile_image; ?>" height="50" width="50">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>img/user.png" height="50" width="50">
                                                    <?php
                                                    }
                                                ?>
                                                </td>

                                                    <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                                                    <td><?php echo $row->email; ?></td>

                                                    <td><?php echo $row->contact_number; ?></td>
                                                    <td><?php echo getCountryName($row->country); ?></td>

                                                    <td>
                                                    <?php
                                                    if($row->status)
                                                    {
                                                    ?>
                                                    <a id="status_id_<?php echo $row->id; ?>" class="btn btn-primary btn-xs" href="javascript:void(0);" onclick="change_status('<?php echo $row->id; ?>');">Active</a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <a id="status_id_<?php echo $row->id; ?>" class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="change_status('<?php echo $row->id; ?>');">Inactive</a>
                                                    <?php
                                                    }
                                                    ?>
                                                    </td>

                                            <th>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-xs">Actions<div class="ripple-container"></div></button>
                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="caret"></span>
                                                <div class="ripple-container"></div></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="javascript:void(0);" id="deleteUser" onclick="delete_user('<?php echo $row->id; ?>')">Delete</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/user_history/<?php echo $row->id; ?>" target="_blank">History</a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/user_wallet/<?php echo $row->id; ?>">Wallet</a></li>
                                                </ul>
                                            </div>
                                            </th>

                                                </tr>
                                            <?php
                                            $i++;
                                                }
                                            }
                                            else
                                            {
                                            ?>
                                            <tr colspan="8"><td>No Data Found  !</td></tr>
                                            <?php
                                            }
                                            ?>                                            
                                        </tbody>
                                    </table>
                                </div>

                        <!-- Pagination Start -->
                            <?php echo $links; ?>
                        <!-- Pagination End -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>

<?php $this->load->view('admin/admin_footer'); ?>

<script type="text/javascript">

$(document).ready(function(){
    $("#users_id").addClass('active');
});

</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>



<script src="<?php echo base_url(); ?>js/bootstrap-dialog.js"></script>

<script type="text/javascript">
function delete_user(id)
{
  BootstrapDialog.show({
  title: "Confirm",
  message: "Do you really want to delete it ?",
  buttons: [
  {
  label: 'Yes',
  cssClass: 'btn-primary ',
  action: function(dialogItself){

  var url = '<?php echo base_url(); ?>admin/dashboard/delete_user';
  var dataString = 'id='+id;

  $.ajax({
    type:"POST",
    data:dataString,
    url:url,
    dataType:"json",
    success:function(response)
    {

      dialogItself.close();

      $("#tr_id_"+id).remove();

      BootstrapDialog.show({
        title: "Message",
        message: response.message,
        });    

    }

  });    

  }
  },
  {
      label: 'No',
      cssClass: 'btn-warning',
      action: function(dialogItself){
      dialogItself.close();
   }
  }]
  });

}


function change_status(id)
{
  BootstrapDialog.show({
  title: "Confirm",
  message: "Do you really want to change status ?",
  buttons: [
  {
  label: 'Yes',
  cssClass: 'btn-primary ',
  action: function(dialogItself){

  var url = '<?php echo base_url(); ?>admin/dashboard/change_user_status';
  var dataString = 'id='+id;

  $.ajax({
    type:"POST",
    data:dataString,
    url:url,
    dataType:"json",
    success:function(response)
    { 

      dialogItself.close();



      if(response.status == 0)
      {
        $("#status_id_"+id).addClass('btn-warning'); 
        $("#status_id_"+id).removeClass('btn-primary'); 

        $("#status_id_"+id).html('Inactive'); 
      }
      else
      {
        $("#status_id_"+id).removeClass('btn-warning'); 
        $("#status_id_"+id).addClass('btn-primary'); 

        $("#status_id_"+id).html('Active');
      }

      BootstrapDialog.show({
        title: "Message",
        message: response.message,
        });    
    }

  });    


  }
  },
  {
      label: 'No',
      cssClass: 'btn-warning',
      action: function(dialogItself){
      dialogItself.close();
   }
  }]
  });

}

</script>