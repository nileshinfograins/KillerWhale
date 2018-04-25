<?php $this->load->view('admin/admin_header'); ?>

            <div class="content dashboard-content">
                <div class="container-fluid">
                     <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                   <!--  <i class="material-icons"></i> -->
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Users</p>
                                    <h3 class="title"><?php echo $user_count; ?></h3>

                                    <a class="btn btn-primary btn-xs" href="<?php echo base_url(); ?>admin/user_management">View<div class="ripple-container"></div></a>

                                </div>
                                <!-- <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-danger">warning</i>
                                        <a href="#pablo">Get More Space...</a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="fab fa-ethereum"></i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Ethereum</p>
                                    <h3 class="title "><?php if(!empty($wallet_data->eth)) echo $wallet_data->eth; else echo '0.0'; ?> <small class="unit-bit">ETH</small> </h3>

                                    <?php
                                    if(!empty($wallet_data->eth) && ($wallet_data->eth != '0.0'))
                                    {
                                    ?>
                                   <!--  <a class="btn btn-primary btn-xs" onclick="exchange_token('1', '<?= $user_address; ?>');">Exchange<div class="ripple-container"></div></a> --> 
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
                                    if(!empty($wallet_data->token) && ($wallet_data->token != '0.0'))
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
        var token_address = $("#ethaddr").val();

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
