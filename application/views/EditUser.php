<html>
 <head>
  <title>Update User</title>
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
   <center><table id="UserList"></center>
   <h1>Edit User</h1>
   <tr id="tr1">
    <th>Name</th>
    <th>Mobile Number</th>
    <th>City</th>
    <th>Email</th>
	<th>Update</th>
   </tr>
   <tr>
    <form name="Register" onsubmit="return validateEmail()" action="Edit" method="post">
     <input type="hidden" name="SrNo" value="<?php echo $SrNo;?>">
    <td> <input type="text" name="Name" value="<?php echo $Name;?>"> </td>
    <td> <input type="number" name="Mob" value="<?php echo $Mob;?>"> </td>
    <td> <input type="text" name="City" value="<?php echo $City;?>"> </td>
    <td> <input type="text" name="Email" value="<?php echo $Email;?>"> </td>
	<input type="hidden" name="update" value="1">
    <td><input type="submit" value="Update"></td>
	</form>
	<form action="Edit" method="post">
	 <input type="hidden" name="update" value="2">
	 <td><input type="submit" value="back"></td>
	</form>
   </table>
 </body>
</html>