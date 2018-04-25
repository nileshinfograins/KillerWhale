<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Killer Whale - Admin Login</title>
  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #1f497c;
      font-family: sans-serif;
    }

    .loginContainer {
      width: 1180px;
      margin: 0 auto;
    }

    .loginBox {
      width: 30%;
      margin: 0 auto;
      border: 1px solid #999;
      border-radius: 4px;
      margin-top: 80px;
      padding: 30px;
      background: #fff;
      box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.49);
    }

    .loginBox img {
      display: block;
      margin: 0 auto;
      margin-bottom: 15px;
    }

    .loginBox input {
      display: block;
      width: 100%;
      height: 40px;
      border-radius: 4px;
      border: 1px solid #aaa;
      padding: 4px 8px;
      font-size: 16px;
      margin-bottom: 12px;
      outline: none;
    }

    .loginBox input[type="submit"] {
      margin: 0;
      background: #1f497c;
      border: 0;
      color: #fff;
      text-transform: uppercase;
      outline: none;
      cursor: pointer;
    }

    .errors {
      background: #ffafaf;
        border: 1px solid #bd4747;
        color: #802727;
      font-size: 13px;
      margin-bottom: 12px;
      padding: 4px 8px;
    }

    .errors p:not(:last-child) {
      margin-bottom: 4px;
    }

    .error{
      color: #ff0000;
    }

  </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
</head>
<body>
  <div class="loginContainer">
  <div class="loginBox">
    <form id="data_form" name="data_form" action="<?php echo base_url(); ?>admin/login" autocomplete="off" method="post" accept-charset="utf-8">

      <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="" width="150" />
      <?php
      if($this->session->flashdata('error_session'))
      {
      ?>
      <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('error_session'); ?>
      </div>
      <?php
      }
      ?>
      <input type="hidden" name="redirect_url" value="<?php if($this->input->get('next')) echo $this->input->get('next'); ?>" />
      <input type="text" name="username" value="" placeholder="Username" autofocus="autofocus"  class="required" />
      <?php echo form_error('username', '<div class="error">', '</div>'); ?>

      <input type="password" name="password" value="" placeholder="Password"  class="required" />
      <?php echo form_error('password', '<div class="error">', '</div>'); ?>

      <input type="submit" value="Login"  />
    </form>   
  </div>
  </div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
  $("#data_form").validate();
});

</script>