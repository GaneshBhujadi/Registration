<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Model 
{
	public function Check($Email,$Pass)
	{
		$q=$this->db->query("select Name from Users where Email LIKE BINARY '$Email' && Pass LIKE BINARY '$Pass' && Design='Admin'");
		$row=$q->result();
		if(sizeof($row)==1)
			return 1;
	}
	public function getUserList()
	{
		$query=$this->db->query("select SrNo,Name,Mob,City,Email,Img from Users");
		return $query->result();
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