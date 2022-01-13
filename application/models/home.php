<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Model 
{
	public function Check($email,$pass)
	{
		$this->db->select('srno,name');
		$this->db->from(USERS);
		$this->db->where('email',$email);
		$this->db->where('pass',$pass);
		return $this->db->get()->result_array();
	}
	public function getUserList()
	{
		$this->db->select('SrNo,Name,Mob,City,Email,Img');
		$this->db->from(USERS);
		return $this->db->get()->result_array();
	}
	public function DeleteUser($SrNo)
	{
		if($this->db->query("delete from Users where SrNo='$SrNo'"))
			echo "<script>alert('Record deleted');</script>";
	}
	public function InsertUser($user)
	{
		$s=$this->db->insert('Users',$user);
		if($s==1)
		{
			echo "<script>alert('Registration Successful!');</script>";
			return 1;
		}
		else
			echo "<script>alert('Registration Failed!');</script>";
		return 0;
	}
	public function UpdateUser($update)
	{
		$SrNo=$update['SrNo'];
		$this->db->where("SrNo",$SrNo);
		$up=$this->db->update("Users",$update);
		return 1;
	}
}
?>	