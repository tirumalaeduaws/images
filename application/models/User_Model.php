<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function addNew($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($data, $table, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    public function get_field($field, $table, $where){
        $query = $this->db->get_where($table, $where);
        $result = $query->row_array()[$field];
        return $result;
      }




      function get_row($table, $where)
      {
        $query = $this->db->get_where($table, $where);
        return $query->row_array();
      }

    public function count_rows($table, $where, $var){
        $query = $this->db->get_where($table, array($where => $var));
        return $query->num_rows();
    }

    public function count($table, $where){
        return $this->db->get_where($table, $where)->num_rows();
    }





    public function get_banners($banner_id = FALSE){
        if($banner_id === FALSE){

            $query = $this->db->get('banners');
            return $query->result_array();

        }else{

        $query = $this->db->get_where('banners', array('banner_id' => $banner_id));
        return $query->row_array();
      }
    }

    public function get_gallery($gallery_id = FALSE){
      if($gallery_id === FALSE){

          $query = $this->db->get('gallery');
          return $query->result_array();

      }else{

      $query = $this->db->get_where('gallery', array('gallery_id' => $gallery_id));
      return $query->row_array();
    }
  }

  public function get_activities($activities_id = FALSE){
    if($activities_id === FALSE){

        $query = $this->db->get('activities');
        return $query->result_array();

    }else{

    $query = $this->db->get_where('activities', array('activities_id' => $activities_id));
    return $query->row_array();
  }
}

public function get_sliders($slider_id = FALSE){
  if($slider_id === FALSE){
      $query = $this->db->get('sliders');
      return $query->result_array();

  }else{

  $query = $this->db->get_where('sliders', array('sliders_id' => $slider_id));
  return $query->row_array();
}
}


    public function get_results($results_id = FALSE){
      if($results_id === FALSE){
          $query = $this->db->get('results');
          return $query->result_array();

      }else{

      $query = $this->db->get_where('results', array('results_id' => $results_id));
      return $query->row_array();
       }
    }


    public function get_2020($results_year = FALSE){
      if($results_year === FALSE){
          $query = $this->db->get('results');
          return $query->result_array();

      }else{

      $query = $this->db->get_where('results', array('results_year' => $results_year));
      return $query->row_array();
       }
    }

    
    public function get_admission($id = FALSE){
        if($id === FALSE){
            $this->db->select("id, t_unique, t_sname, t_mname, t_lname, t_mobile, t_type, t_status");
            $this->db->order_by("id", "desc");
            $query=$this->db->get('admission');
            return $query->result_array();
        }else{
            $query = $this->db->get_where('admission', array('id' => $id));
            return $query->row_array();
        }
    }


    public function get_expadmission($frm, $to,$tfrm,$tto){

      $this->db->where('t_date >=', $frm);
      $this->db->where('t_date <=', $to);
      $this->db->where('t_time <=', $tfrm);
      $this->db->where('t_time <=', $tto);
          $this->db->order_by("id", "asc");
          $query=$this->db->get('admission');
          return $query->result_array();     
    }



}

?>