<?php $this->load->view('admin/admin_header'); ?>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header" data-background-color="purple">
    <h4 class="title">Transfer History</h4>
    <!-- <p class="category">Here is a subtitle for this table</p> -->
</div>
<div class="card-content table-responsive">
    <table class="table">
        <thead class="text-primary">
            <th>S.No.</th>
            <th>Type</th>
            <th>From</th>
            <th>Tx</th>
            <th>Amount</th>
            <th>To</th>
            <th>Tx Hash</th>
        </thead>
        <tbody>
            <?php
            if(!empty($transfer_data))
            {
                $i=$this->uri->segment(3) == '' ? 1 : $this->uri->segment(3) + 1; 
                foreach ($transfer_data as $row) 
                {
            ?>                                        
                <tr>
                    <td><?php echo $i; ?>.</td>
                    <td>
                    <button type="button" class="btn btn-info"><?php echo $row->currency_type; ?></button>
                    </td>

                    <td><a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $row->from_address; ?>" ><?php echo substr($row->from_address, 0, 10); ?>....</a></td>

                    <?php
                    if($row->from_address == $this->config->item('admin_wallet_address'))
                    {
                    ?>
                    <td><a href="javascript:void(0)" class="btn btn-danger btn-xs">OUT</a></td>
                    <?php
                    }
                    else
                    {
                    ?>
                    <td><a href="javascript:void(0)" class="btn btn-success btn-xs">IN</a></td>
                    <?php
                    }
                    ?>

                    <td><?php echo $row->amount; ?></td>
                    <td><a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $row->to_address; ?>" ><?php echo substr($row->to_address, 0, 10); ?>....</a></td>

                    <td><a href="https://ropsten.etherscan.io/tx/<?php echo $row->tx_hash; ?>" data-toggle="tooltip" title="<?php echo $row->tx_hash; ?>" target="_blank"><?php echo substr($row->tx_hash, 0, 10); ?>....</a></td>
                </tr>
            <?php
            $i++;
                }
            }
            else
            {
             ?>
             <tr><td colspan="7" align="center">No Data Found !</td></tr>
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
$("#history_id").addClass('active');
});

</script>
<script>
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>