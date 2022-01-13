<?php
// session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	public function __construct()
	{
		parent :: __construct();
		$this->load->model('home');
	}
	public function index()
	{
		$this->load->view("login");
	}
	public function Valid()
	{
		$Email=$this->input->post("User");
		$Pass=$this->input->post("Pass");
		$this->session->set_userdata('login',$this->home->Check($Email,$Pass));
		if($this->session->userdata['login']==1){
			// 	$this->ShowUser();
			// base_url('');
			// base_url('users');
			redirect('users','refresh',301);

		} else {
			echo "<script>alert('Please enter valid Email ID or Password')</script>";
			$this->load->view("login");
			// base_url('users','refresh',301);
		}
	}
	public function logout()
	{
		// session_destroy();
		$this->load->view("login");
	}
	public function ShowUser()
	{
		if($this->session->userdata['login']==1)
		{
			$data['result']=$this->home->getUserList();
			$this->load->view("UserList",$data);
		}
		else
			$this->load->view("login");
	}
	public function DeleteUser()
	{
		if(!empty($this->input->post()){
			$this->home->DeleteUser($id);
			$this->session->set_flashdata('success','Recored deleted');
			$this->load->view('users');
			// redirect('users','refresh',301);
		} else {
			$this->session->set_flashdata('error','Unable Recored deleted');
		}
	}
	public function register()
	{
		if(!$this->session->set_userdata['login']==1)
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