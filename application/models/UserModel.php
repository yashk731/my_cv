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
}