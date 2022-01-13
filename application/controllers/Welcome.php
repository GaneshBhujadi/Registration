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
		$data = $this->home->Check($Email,$Pass);
		$this->session->set_userdata('UADMINID',$data[0]['srno']);
		$this->session->set_userdata('UNAME',$data[0]['name']);
		if(!empty($this->session->userdata('UADMINID'))){
			redirect('users','refresh',301);
		} else {
			echo "<script>alert('Please enter valid Email ID or Password')</script>";
			$this->load->view("login");
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('UADMINID');
		$this->session->unset_userdata('UNAME');
		$this->load->view("login");
	}
	public function ShowUser()
	{
		if(!empty($this->session->userdata('UADMINID'))){
			$data['result']=$this->home->getUserList();
			$this->load->view("UserList",$data);
		} else{
			$this->load->view("login");
		}
	}
	public function DeleteUser()
	{
		if(!empty($this->input->post())){
			$this->home->DeleteUser($id);
			$this->session->set_flashdata('success','Recored deleted');
			$this->load->view('users');
		} else {
			$this->session->set_flashdata('error','Unable Recored deleted');
			redirect('default_controller','refresh',301);
		}
	}
	public function register()
	{
		if(!empty($this->session->userdata('UADMINID'))){
			$this->load->view("Register");
		} else {
			$this->load->view("login");
		}
	}
	public function InsertUser()
	{
		$back=$this->input->post("Back");
		if($back==1){
			redirect('users','refresh',301);
		} else {
			$img=$_FILES["Img"];
			if(file_exists("./UserImg/".$img['name'])){
				echo "<script>alert('Image allready exists!');</script>";
				redirect('register-user','refresh',301);
			} else if($img['type']=="image/jpeg" or $img['type']=="image/jpg" or $img['type']=="image/png"){
				$config["allowed_types"]="jpeg|jpg|png";
				$config["upload_path"]="./UserImg/";
				$this->load->library("upload",$config);
				if($this->upload->do_upload("Img")) {
					$user["Img"]=$img["name"];
		  			$user["Name"]=$this->input->post("Name");
		  			$user["Mob"]=$this->input->post("Mob");
		  			$user["Address"]=$this->input->post("Address");
		  			$user["City"]=$this->input->post("City");
		  			$user["Design"]=$this->input->post("Design");
		  			$user["Email"]=$this->input->post("Email");
		  			$user["Pass"]=$this->input->post("Pass");
		  			$inserted=$this->home->InsertUser($user);
		  			if($inserted==1){
						  redirect('users','refresh',301);
					  } else{
						  $this->load->view("Register.php");
					  }
		  	} else{
		  		print_r($this->upload->data());
			  } 
		  } else {
		  	echo "<script>alert('Image is not valid');</script>";
		  	redirect('register-user','refresh',301);
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
				redirect('users','refresh',301);
			}			
			else
				echo "<script>alert('updation failed');</script>";
		}
		elseif($edit==2)
			redirect('users','refresh',301);
		else
			$this->load->view("EditUser",$update);
	}
}
?>