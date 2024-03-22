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
  public function show_user_data(){
    return $this->db->select('tbl_user_image.image,tbl_about.introduction,tbl_about.cv')->join('tbl_user_image','tbl_about.user_id=tbl_user_image.user_id','left')->where(['tbl_user_image.status'=>1,'tbl_about.status'=>1])->get('tbl_about')->row();
  }
  public function total_project($user_id) 
  {
    return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_project')->num_rows();
  }
  public function total_client($user_id) 
  {
    return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_client')->num_rows();
  }
  public function total_experience($user_id) 
  {
    return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_experience')->num_rows();
  }
 public function show_education($user_id){
  return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_qualification')->result();
 }
 public function show_experience($user_id){
  return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_experience')->result();
 }
 public function show_skills($user_id){
  return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_skills')->result();
 }
//  public function show_client($user_id){
//   return $this->db->where(['status'=>1,'user_id'=>$user_id])->get('tbl_qualification')->result();
//  }

public function get_user_data(){
  $user_id=$this->session->userdata('user_id');
   $response= $this->db->where(['id'=>$user_id,'status'=>1])->get('tbl_users')->row();
   return   $response;
}

public function getTotalProjectData(){
  $user_id=$this->session->userdata('user_id');
  $userdata=  $this->db->where(['user_id'=>$user_id,'status'=>1])->get('tbl_project')->result();
  return   $userdata;
}





}