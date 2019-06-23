<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{

    public function get_all($table)
    {
        $result = $this->db->get($table)->result_array();
        return $result;
    }


    public function get_site_settings() 
    {
        $result = $this->db->get('igc_site_settings')->row_array();
        return $result;
    }


    public function get_not_deleted($table)
    {
        $this->db->where('delete_status', "0");
        $result = $this->db->get($table)->result_array();
        return $result;
    }
    
     public function get_where($table,$array){
        if(count($array) > 0){
            foreach($array as $key => $value){
                $this->db->where("$key","$value");
            }
        }
        $result = $this->db->get($table)->result_array();
        return $result;
    }

    public function move_to_trash($id, $field_name, $update, $table)
    {
        $this->db->where($field_name, $id);
        $result = $this->db->update($table, $update);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

    //function to  get  detail

    public function get_detail($id, $field_name, $table)
    {
        $this->db->where($field_name, $id);
        $result = $this->db->get($table)->row_array();
        return $result;
    }


//    public function get_active_not_deleted($table)
//    {
//        $this->db->where('act')
//    }




//function to insert

    public function insert($insert, $table)
    {
        $result = $this->db->insert($table, $insert);
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }


    //function to insert and return id

    public function insert_return_id($insert, $table)
    {
        $this->db->insert($table, $insert);
        $result = $this->db->insert_id();
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }

    public function get_active_records($table)
    {
        $this->db->where('publish_status', "1");
        $result = $this->db->get($table)->result_array();
        return $result;
    }


    //function to update

    public function whole_update($update, $table)
    {
        $result = $this->db->update($table, $update);
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }


    //function to update

    public function update($id, $field_name, $update, $table)
    {
        $this->db->where($field_name, $id);
        $result = $this->db->update($table, $update);
        if ($result) {
            return $result;
        } else {
            return false;

        }
    }


    public function soft_delete($id, $field_name, $table)
    {
        $update['updated'] = date('Y-m-d:H:i:s');
        $update['delete_status'] = "1";
        $this->db->where($field_name, $id);
        $result = $this->db->update($table, $update);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

    public function delete($id, $field_name, $table)
    {

        $this->db->where($field_name, $id);
        $result = $this->db->delete($table);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

    public function get_mail_info(){
        $this->db->where('delete_status', '0');
        $this->db->where('active_status', '1');
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;


    }

    public function get_detail_rows($id, $field_name, $table)
    {
        $this->db->where($field_name, $id);
        $result = $this->db->get($table)->result_array();
        return $result;
    }


    public function get_detail_records($id, $field_name, $table)
    {
        $this->db->where($field_name, $id);
        $this->db->where('delete_status', '0');
        $result = $this->db->get($table)->result_array();
        return $result;
    }

    public function get_row_last_id($field_name, $table)
    {
        $query =  $this->db->query("select $field_name from $table where $field_name ="."("."select max($field_name) from $table".")
        ");

        $result= $query->row_array();
        return $result;

    }


    //function to check url exist or not

    public function check_url($id,$field_id, $url, $field_url, $table)
    {
        $sql= $this->db->query("select $field_url from $table where '$field_id' <> '$id'and $field_url ='$url'");
        $result = $sql->result_array();
        return $result;
    }


    public function check_multiple_condition($id1, $field_name1,$id2, $field_name2,$table)
    {
        $this->db->where($field_name1, $id1);
        $this->db->where($field_name2, $id2);
        $result = $this->db->get($table)->row_array();
        return $result;
    }



}