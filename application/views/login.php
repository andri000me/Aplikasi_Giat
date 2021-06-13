<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/login.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
      <div class="login">

          <div class="avatar">
            <i class="fa fa-user"></i>
          </div>
		<form class="POST" action="<?php echo base_url();?>Dashboard/auth" enctype="multipart/form-data" method="post">
            
          <h2>Login Form</h2>

          <div class="box-login">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="username" name="username">
          </div>

          <div class="box-login">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password">
          </div>

          <button type="submit" name="login" class="btn-login">Login</button>
          
      </div>
  </head>
  </html>