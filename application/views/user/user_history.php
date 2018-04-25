<?php $this->load->view('user/user_header'); ?>
            
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
                                            <th></th>
                                            <th>Tx Hash</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($transfer_data))
                                            {
                                                $i=1;
                                                foreach ($transfer_data as $row) 
                                                {
                                            ?>                                        
                                                <tr>
                                                    <td><?php echo $i; ?>.</td>
                                                    <td>

                                                    <?php
                                                    if($row->from_address == $row->to_address)
                                                    {
                                                    ?>
                                                    <button type="button" class="btn btn-info">
                                                        <?php 
                                                        if($row->currency_type == 'ETH')
                                                        {
                                                            echo 'ETH - KWT'; 
                                                        }
                                                        else
                                                        {
                                                            echo 'KWT - ETH';    
                                                        }
                                                        ?>
                                                        
                                                    </button>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <button type="button" class="btn btn-info"><?php echo $row->currency_type; ?></button>
                                                    <?php   
                                                    }
                                                    ?>

                                                    </td>

                                                    <td><a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $row->from_address; ?>" ><?php echo substr($row->from_address, 0, 10); ?>....</a></td>

                                                    <?php
                                                    if($row->from_address == $row->to_address)
                                                    {
                                                    ?>
                                                    <td><a href="javascript:void(0)" class="btn btn-success btn-xs">Exchanged</a></td>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    if($row->from_user == $this->session->userdata('user_id'))
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

                                                    }                                                 
                                                    ?>

                                                    <td><?php echo $row->amount; ?></td>
                                                    <td><a href="javascript:void(0);" data-toggle="tooltip" title="<?php echo $row->to_address; ?>" ><?php echo substr($row->to_address, 0, 10); ?>....</a></td>

                                                    <td></td>
                                                    <td><a href="https://ropsten.etherscan.io/tx/<?php echo $row->tx_hash; ?>" data-toggle="tooltip" title="<?php echo $row->tx_hash; ?>" target="_blank"><?php echo substr($row->tx_hash, 0, 10); ?>....</a></td>
                                                </tr>
                                            <?php
                                            $i++;
                                                }
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

<?php $this->load->view('user/user_footer'); ?>

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