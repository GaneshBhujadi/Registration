<html>
 <head>
  <title>Create User</title>
  <style>
   input[type="text"],input[type="number"],input[type="password"],textarea,select{ width:250; }
   td{padding:10px;}
   input[type="submit"]{width:100; height:30; border-radius:10px;}
   input[type="submit"]:hover{background-color:green; color:white;}
  </style>
  <script>
   function validateEmail()
   {
	   var x=document.Register.Email.value;
	   var atposition=x.indexOf("@");  
	   var dotposition=x.lastIndexOf(".");  
	   if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length)
	   {
		   alert("Please enter a valid Email address");
		   return false;
	   }
   } 
  </script>
 </head>
 <body>
  <h1>Register User</h1>
  <table>
  <form name="Register" onsubmit="return validateEmail()" action="InsertUser" method="post" enctype="multipart/form-data">
  <tr>
   <td><input type="text" placeholder="Name" name="Name" autocomplete="off" autofocus required></td>
   <td><input type="number" placeholder="Mobile No" name="Mob" autocomplete="off" required></td>
   <tr>
   <td rowspan="2"><textarea rows="5" name="Address" placeholder="Address" autocomplete="off" required></textarea></td>
   <td><input type="text" placeholder="City" name="City" autocomplete="off" required></td>
   <tr>
   <td><b>Designation:</b><br>
   	 <input type="text" name="Design" list="list">
	 <datalist id="list">
	  <option value="Admin">
	  <option value="User">
	 </datalist>
   </tr>
   <tr>
    <td><input type="text" placeholder="Email" name="Email" autocomplete="off" required></td>
    <td><input type="password" placeholder="Password" name="Pass" required></td>
   </tr>
   <tr>
    <td>Profile Photo :<br><img src="UserImg/Img.jpg" height="100px" width="100px"><br><input type="file" name="Img"></td>
   </tr>	
   <tr>
    <td><input type="submit" value="Register"></td>
   
  </form>
  <form action="InsertUser" method="post">
   <input type="hidden" name="Back" value="1">
   <td><input type="submit" value="Back"></td>
  </form>
  </tr>
  </table>
 </body>
</html>