<?php $this->load->view('admin/admin_header'); ?>

            <div class="content dashboard-content">
                <div class="container-fluid">
                     <div class="row">

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="fab fa-ethereum"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Ethereum</p>
                                    <h3 class="title "><?php if(!empty($wallet_data->eth)) echo $wallet_data->eth; else echo '0.0'; ?> <small class="unit-bit">ETH</small> </h3>

                                    <?php
                                    if(!empty($admin_wallet_data->eth) && ($admin_wallet_data->eth != '0.0'))
                                    {
                                    ?>
                                    <!-- <a class="btn btn-primary btn-xs" onclick="exchange_token('1', '<?= $user_address; ?>');">Exchange<div class="ripple-container"></div></a>  -->
                                    <a class="btn btn-primary btn-xs" onclick="send_token('1', '<?= $user_address; ?>');">Send<div class="ripple-container"></div></a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <!-- <a class="btn btn-primary btn-xs" href="javascript:void(0);" disabled="">Exchange<div class="ripple-container"></div></a>  -->
                                    <a class="btn btn-primary btn-xs" href="javascript:void(0);" disabled="">Send<div class="ripple-container"></div></a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-primary btn-xs" onclick="show_QR('<?= $user_address; ?>');">Address<div class="ripple-container"></div></a>                                    
                                     
                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                     
                                    <!-- <img src="<?php echo base_url(); ?>assets/img/mula-icon.png"> -->
                                    <img src="<?php echo base_url(); ?>assets/img/mula-icon.png">
                                </div>
                                <div class="card-content">
                                    <p class="category">Killer Whale Token</p>
                                    <h3 class="title"><?php  if(!empty($wallet_data->token)) echo $wallet_data->token; else echo '0.0'; ?> <small class="unit-bit">KWT</small> </h3>

                                    <?php
                                    if(!empty($admin_wallet_data->token) && ($admin_wallet_data->token != '0.0'))
                                    {
                                    ?>
                                    <!-- <a class="btn btn-primary btn-xs" onclick="exchange_token('2', '<?= $user_address; ?>');">Exchange<div class="ripple-container"></div></a> -->
                                    <a class="btn btn-primary btn-xs" onclick="send_token('2', '<?= $user_address; ?>');">Send<div class="ripple-container"></div></a>
                                    <?php
                                    }
                                    else
                                    {
                                     ?>
                                    <!-- <a class="btn btn-primary btn-xs" href="javascript:void(0);" disabled="">Exchange<div class="ripple-container"></div></a> -->
                                    <a class="btn btn-primary btn-xs" href="javascript:void(0);" disabled="">Send<div class="ripple-container"></div></a> 
                                     <?php   
                                    }
                                    ?>
                                    <a class="btn btn-primary btn-xs" onclick="show_QR('<?= $user_address; ?>');">Address<div class="ripple-container"></div></a>

                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i> Tracked from Github
                                    </div>
                                </div> -->
                            </div>
                        </div>   
                    </div>
                    <div class="bouns-reffrl-link">
                     <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8">
                            <div class="card-panel card-alert">
                                <div   class="card-content sponsor-alert">
                                    <div class="input-group">
                                     <span  class="input-group-addon">Your referral link:</span>
                                        <input   class="form-control" id="btcAddressCopy" readonly value="<?php echo base_url(); ?>register?ref=<?php echo $user_data->referral_code; ?>" type="text">
                                        <span   class="input-group-btn"> <a  class="btn btn-xs btn-copy btn-copy-address button-copy" data-value-id="btcAddressCopy" id="copy_button">Copy</a> </span> 
                                    </div>
                                </div>
                            </div>  
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="card card-stats bounse">
                                    <div class="card-content clearfix">
                                        <p class="category pull-left">Bonuses</p>
                                        <p class=" lat-bonse pull-right">0 LAT
                                        </p>
                                    </div>
                                </div>
                        </div>
                     </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="green">
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Bitcoin Price Graph</h4>
                                    <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated 4 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="green">
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Daily Sales</h4>
                                    <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated 4 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="orange">
                                    <div class="ct-chart" id="emailsSubscriptionChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Email Subscriptions</h4>
                                    <p class="category">Last Campaign Performance</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="red">
                                    <div class="ct-chart" id="completedTasksChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Completed Tasks</h4>
                                    <p class="category">Last Campaign Performance</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-nav-tabs">
                                <div class="card-header" data-background-color="purple">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">Tasks:</span>
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active">
                                                    <a href="#profile" data-toggle="tab">
                                                        <i class="material-icons">bug_report</i> Bugs
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#messages" data-toggle="tab">
                                                        <i class="material-icons">code</i> Website
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#settings" data-toggle="tab">
                                                        <i class="material-icons">cloud</i> Server
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="profile">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="messages">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="settings">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                                        </td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                        <td class="td-actions text-right">
                                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Employees Stats</h4>
                                    <p class="category">New employees on 15th September, 2016</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Salary</th>
                                            <th>Country</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dakota Rice</td>
                                                <td>$36,738</td>
                                                <td>Niger</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Minerva Hooper</td>
                                                <td>$23,789</td>
                                                <td>Curaçao</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sage Rodriguez</td>
                                                <td>$56,142</td>
                                                <td>Netherlands</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Philip Chaney</td>
                                                <td>$38,735</td>
                                                <td>Korea, South</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

<?php $this->load->view('admin/admin_footer'); ?>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>

<div id="ethAddress" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>ETH and KWT Address</h3>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control text-center" id="AddrVal" value="" data-copy="AddrVal" readonly>
                <p>
                    <img src="" id="image_url">
                </p>
                <p class="modal-title">Copy this address or scan QR code.</p>
            </div>
        </div>
    </div>
</div>

<div id="send_token_popup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 id="title_send_token"></h3>
            </div>
            <div class="modal-body">
                <form id="sendETHForm" action="#" method="post">
                <div id="error_message1"></div>

                    <input type="hidden" name="send_token_type" id="send_token_type">
                    <input type="hidden" name="send_token_address" id="send_token_address">

                    <div class="form-group label-floating">
                        <label class="control-label">Address</label>
                        <input type="text" id="ethaddr" name="ethaddr" class="form-control required" onkeydown="javascript: if(event.keyCode == 13) return send_token_request();">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Amount</label>
                        <input type="text" id="ethval" name="ethval" class="form-control required" onkeypress="return isFloatNumber(this,event)" onkeydown="javascript: if(event.keyCode == 13) return send_token_request();">
                        <label><small class="text-left">Transaction fee 0.002 will be apply.</small></label>
                    </div>
                    <button type="button" id="ethSendSubmit" class="btn btn-block btn-primary" onclick="send_token_request();">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="exchange_token_popup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 id="title_exchange"></h3>
            </div>
            <div class="modal-body">
                <form id="exchangeETHtoMUTForm" action="#" method="post">

                <div id="error_message2"></div>

                    <input type="hidden" name="exchange_token_type" id="exchange_token_type">

                    <div class="form-group label-floating">
                        <label class="control-label">Amount</label>
                        <input type="text" id="ethvalexch" name="ethvalexch" class="form-control required" onkeypress="return isFloatNumber(this,event)">
                        <label><small class="text-left">Transaction fee 0.002 will be apply.</small></label>
                    </div>
                    <button type="button" id="exchangeETHtoMUTSubmit" class="btn btn-block btn-primary" onclick="exchange_token_request();">Exchange</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

$(document).ready(function(){
    $("#wallet_id").addClass('active');
});


/************Copy Link *****Start******/
$('#copy_button').click(function(){
  var txt = $('#btcAddressCopy').val();
  if(!txt || txt == ''){
    return;
  }
  
  copyTextToClipboard(txt);
  //$('textarea').val('').focus();
});

function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");

  textArea.style.position = 'fixed';
  textArea.style.top = 0;
  textArea.style.left = 0;
  textArea.style.width = '2em';
  textArea.style.height = '2em';
  textArea.style.padding = 0;
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.boxShadow = 'none';
  textArea.style.background = 'transparent';
  textArea.value = text;
  document.body.appendChild(textArea);
  textArea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    $("#copy_button").html('copied');

    setTimeout(function(){$("#copy_button").html('Copy'); }, 3000);

  } catch (err) {
    console.log('Oops, unable to copy');
  }
  document.body.removeChild(textArea);
}
/************Copy Link *****End******/

function show_QR(address)
{
    var image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&choe=UTF-8&chl='+address;

    $("#image_url").attr('src', image_url);

    $("#AddrVal").val(address);
    $("#ethAddress").modal('show');
}

function exchange_token(type, address)
{
    if(type == 1)
    {
        $("#title_exchange"). html('Exchange ETH to KWT');
    }
    else if(type == 2)
    {
        $("#title_exchange"). html('Exchange KWT to ETH');
    }

    $("#exchange_token_type").val(type);
    $("#exchange_token_address").val(address);
    $("#exchange_token_popup").modal('show');
}


function exchange_token_request()
{
    var form = $("#exchangeETHtoMUTForm");

    if(form.valid() == false)
    {
        return false;
    }
    else
    {
        $("#exchangeETHtoMUTSubmit").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        var type = $("#exchange_token_type").val();
        var amount = $("#ethvalexch").val();

        var url = '<?php echo base_url(); ?>user/profile/exchange_token_request';
        var dataString = 'type='+type+'&amount='+amount;

        $.ajax({
            type: "post",
            data: dataString,
            url: url,
            dataType: "json",
            success: function(response)
            {
                if(response.error == false)
                {
                    var html = '<div class="alert alert-success alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">×</a>'+response.message+'</div>';
                    $("#error_message2").html(html);
                }
                else
                {
                    var html = '<div class="alert alert-warning alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">×</a>'+response.message+'</div>';
                    $("#error_message2").html(html);
                }

                setTimeout(function(){ $("#error_message2").hide(); }, 4000);

                $("#ethvalexch").val('');

                $("#exchangeETHtoMUTSubmit").prop('disabled', false).html('Send');
            }
        });
    }
}

function send_token(type, address)
{
    $("#ethaddr").val('');
    $("#ethval").val('');

    if(type == 1)
    {
        $("#title_send_token"). html('Send ETH to address');
    }
    else if(type == 2)
    {
        $("#title_send_token"). html('Send KWT to address');
    }

    $("#ethaddr").attr('disabled', 'true').val(address);
    $("#ethaddr").parents('div.label-floating').addClass('is-focused');

    $("#send_token_type").val(type);
    $("#send_token_address").val(address);
    $("#send_token_popup").modal('show');
}

function send_token_request()
{

    var form = $("#sendETHForm");

    if(form.valid() == false)
    {
        return false;
    }
    else
    {
        $("#ethSendSubmit").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        var type = $("#send_token_type").val();
        var token_address = $("#send_token_address").val();

        var amount = $("#ethval").val();

        var url = '<?php echo base_url(); ?>admin/dashboard/send_token_request';
        var dataString = 'type='+type+'&token_address='+token_address+'&amount='+amount;

        $.ajax({
            type: "post",
            data: dataString,
            url: url,
            dataType: "json",
            success: function(response)
            {
                if(response.error == false)
                {
                    var html = '<div class="alert alert-success alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">×</a>'+response.message+'</div>';
                    $("#error_message1").html(html);
                }
                else
                {
                    var html = '<div class="alert alert-warning alert-dismissible"><a href="#" class="close close_class_boot" data-dismiss="alert" aria-label="close">×</a>'+response.message+'</div>';
                    $("#error_message1").html(html);
                }

                setTimeout(function(){ $("#error_message1").hide(); }, 4000);

                $("#ethaddr").val('');
                $("#ethval").val('');

                $("#ethSendSubmit").prop('disabled', false).html('Send');
            }
        });
    }
}

 $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

function isFloatNumber(item,evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


</script>
