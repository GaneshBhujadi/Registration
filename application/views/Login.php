<html>
 <head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <style>
  body{
	  font-size: 14px; background-color: #f1f3f6;
	  color: #212121; line-height: 1.4;
	 }
   #login{
	   width: 500px; height: 400px;
	   text-align: center; margin: 0 auto;
	   background-color:#d9d9d9; margin-top: 160px;
	}
	#login h2 { padding: 16px 20px; box-shadow: 0 -2px 10px 0 rgb(0 0 0 / 30%); }
	input[type="text"],input[type="password"]
	{
		margin-top: 30px; height: 45px;
		width: 300px; font-size: 18px;
		margin-bottom: 20px; background-color: #fff;
		padding-left: 20px;
	}
	.btn-login{
		padding:15px 25px; border:none;
		background-color:#27ae60; color:#fff;
		}
  </style>
 </head>
 <body>
   <div id="login">
    <form action="Valid" method="post">
	 <div class="form-input">
		<h2>Admin login</h2>
	  <input type="text" name="User" placeholder="User" autocomplete="off" autofocus required />
	  <i class="fas fa-envelope-square"></i>
	 </div>
     <div class="form-input">
   	  <input type="password" name="Pass" placeholder="Password" required />
	  <i class="fas fa-lock"></i>
	 </div>
	 <input class="btn-login" type="submit" value="Sign In"/>
    </form>
   </div>
 </body>
</html>
