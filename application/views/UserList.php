<html>
 <head>
  <title>UserInfo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <style>
   *{ padding:0; margin:0;box-sizing:border-box; }
   #container {  width:80%; height:100%; background-color:#F3F3F3; }
   #UserList { position:relative; top:50; width: 80%;
			border-collapse:collapse; font-size:20px;
			font-family:sans-serif; box-shadow:0 20 0px rgba(0,0,0,0.15);
		 }
   #UserList #tr1{ background-color:#009879; color:#ffffff; }
   #UserList #tr2{ border-bottom:1px solid #dddddd; text-align:left; }
   #UserList #tr2 td {text-align:center;}
   #UserList tr:nth-of-type(even){ background-color:#f3f3f3; }
   #UserList #tr2:last-of-type{ border-bottom:2px solid #009879; }
   #UserList #tr2:hover { color:#009879; }
   #UserList td{ padding:15px; }
   #del,#add,#update,#logout{ width:100; height:30; border-radius:10px;}
   #add{ position:absolute; right:30%; }
   #logout{ position:absolute; right:20%; }
   #add:hover{ color:white; background-color:green; }
   #update:hover{ background-color:green;color:white; }
   #del:hover{background-color:#dc143c; color:white; }
   #logout:hover{background-color:#dc143c; color:white; }
  </style>
 </head>
 <body>
  <center><div id="container">
   <h1>User List</h1>
    <a id="add" href="register-user"><i class="fas fa-plus-square"></i> Create</a>
    <a id="logout" href="<?php echo base_url('logout');?>">Logout <i class="fas fa-sign-out-alt"></i></a>
   <table id="UserList">
    <tr id="tr1">
     <th>Profile Img.</th>
     <th>Sr.No</th>
     <th>Name</th>
     <th>Mo.No.</th>
     <th>City</th>
     <th>Email</th>
	 <th colspan="2">Action</th>
    </tr>
    <?php
     foreach($result as $row){?>
    <tr id="tr2">
     <!-- <form action="Edit" method="post"> -->
      <td><img src="UserImg/<?php echo $row['Img'];?>" height="150px" width="150px"></td>
      <td><?php echo $row['SrNo'];?> </td>
      <td><?php echo $row['Name'];?> </td>
      <td><?php echo $row['Mob'];?>  </td>
      <td><?php echo $row['City'];?> </td>
      <td><?php echo $row['Email'];?></td>
	   <input type="hidden" name="SrNo" value="<?php echo $row['SrNo'];?>">
	   <input type="hidden" name="Name" value="<?php echo $row['Name'];?>">  
	   <input type="hidden" name="Mob" value="<?php echo $row['Mob'];?>">
	   <input type="hidden" name="City" value="<?php echo $row['City'];?>">
	   <input type="hidden" name="Email" value="<?php echo $row['Email'];?>">
	   <input type="hidden" name="edit" value="0">
	  <td><button id="update"><i class="far fa-edit"></i> Edit</button></td>
	 </form>
	 <form action="DeleteUser" method="post">
	  <input type="hidden" name="SrNo" value="<?php echo $row['SrNo'];?>">
	  <td><a href="<?php //echo base_url('edit/'.$row['SrNo']);?>"><i id="delete" data-id="<?php echo $row['SrNo'];?>" class="far fa-trash-alt"></i> </a></td>
	 <!-- </form> -->
     <?php echo form_close();?>
    </tr>
	 <?php } ?>
   </table>
  </div></center>
  <input type="hidden" name="base_url" value="<?php echo base_url();?>">
 </body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("#delete").click(function () { 
        var id = $(this).attr('data-id');
        var base_url = $('#base_url').val();
        if(confirm('Do you really want to delete this recored?')){
           $.ajax({
               type: "POST",
               url: base_url+"delete-reored",
               data: {
                   srno : id
               },
           });
        }
    });
</script>