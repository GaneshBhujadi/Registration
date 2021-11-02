<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function index()
	{
		$this->load->view("login");
	}
	public function Valid()
	{
		$Email=$this->input->post("User");
		$Pass=$this->input->post("Pass");
		$this->load->model("home");
		$_SESSION['login']=$this->home->Check($Email,$Pass);
		if($_SESSION['login']==1)
			$this->ShowUser();
		else
		{
			echo "<script>alert('Please enter valid Email ID or Password')</script>";
			$this->load->view("login");
		}
	}
	public function logout()
	{
		session_destroy();
		$this->load->view("login");
	}
	public function ShowUser()
	{
		if($_SESSION['login']==1)
		{
			$this->load->model("home");
			$rs['result']=$this->home->getUserList();
			$this->load->view("UserList",$rs);
		}
		else
			$this->load->view("login");
	}
	public function DeleteUser()
	{
		if(!$_SESSION['login']==1)
			$this->load->view("login");
		$SrNo=$this->input->post("SrNo");
		$this->load->model("home");
		$this->home->DeleteUser($SrNo);
		$this->ShowUser();
	}
	public function register()
	{
		if(!$_SESSION['login']==1)
			$this->load->view("login");
		$this->load->view("Register");
	}
	public function InsertUser()
	{
		$back=$this->input->post("Back");
		if($back==1)
		{
			$this->ShowUser();
		}
		else
		{
		  $img=$_FILES["Img"];
		  if(file_exists("./UserImg/".$img['name']))
		  {
			  echo "<script>alert('Image allready exists!');</script>";
			  $this->register();
		  }
		  elseif($img['type']=="image/jpeg" or $img['type']=="image/jpg" or $img['type']=="image/png")
		  {
		  	$config["allowed_types"]="jpeg|jpg|png";
		  	$config["upload_path"]="./UserImg/";
		  	$this->load->library("upload",$config);
		  	if($this->upload->do_upload("Img"))
		  	{
		  		$user["Img"]=$img["name"];
		  		$user["Name"]=$this->input->post("Name");
		  		$user["Mob"]=$this->input->post("Mob");
		  		$user["Address"]=$this->input->post("Address");
		  		$user["City"]=$this->input->post("City");
		  		$user["Design"]=$this->input->post("Design");
		  		$user["Email"]=$this->input->post("Email");
		  		$user["Pass"]=$this->input->post("Pass");
		  		$this->load->model("home");
		  		$inserted=$this->home->InsertUser($user);
		  		if($inserted==1)
		  			$this->ShowUser();
		  		else
		  			$this->load->view("Register.php");
		  	}
		  	else
		  		print_r($this->upload->data());
		  }
		  else
		  {
		  	echo "<script>alert('Image is not valid');</script>";
		  	$this->register();
		  }
		}
	}
	public function Edit()
	{
		$update["SrNo"]=$this->input->post("SrNo");
		$update["Name"]=$this->input->post("Name");
		$update["Mob"]=$this->input->post("Mob");
		$update["City"]=$this->input->post("City");
		$update["Email"]=$this->input->post("Email");
		$edit=$this->input->post("update");
		if($edit==1)
		{
			$this->load->model("home");
			$updated=$this->home->UpdateUser($update);
			if($updated==1)
			{
				echo "<script>alert('Updation Sucdessful!');</script>";
				$this->ShowUser();
			}			
			else
				echo "<script>alert('updation failed');</script>";
		}
		elseif($edit==2)
			$this->ShowUser();
		else
			$this->load->view("EditUser",$update);
	}
}
?>