<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
  public function get_country(){
    return $this->db->get('tbl_country')->result();
  }
  public function get_state($country_id){
    return $this->db->where('country_id',$country_id)->get('tbl_state')->result();
  }
  public function get_city($state_id, $country_id){
    return $this->db->where(['state_id'=>$state_id,'country_id'=> $country_id])->get('tbl_city')->result();
  }
  public function check_useremail($email){
    return $this->db->where(['email_id'=>$email,'status'=>1])->get('tbl_users');
  }
  public function get_aboutus_data() 
  {
    $user_id=$this->session->userdata('user_id');
    $userdata=  $this->db->where(['user_id'=>$user_id,'status'=>1])->get('tbl_about')->row();
    return   $userdata;
  }
  public function save_user_image($data) 
  {
    return $this->db->insert('tbl_user_image',$data);
  }
  public function user_image_data($user_id)
  {
    return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_user_image')->row();
  }
 
}