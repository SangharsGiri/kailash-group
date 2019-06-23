<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_settings_model extends CI_Model{

    public function get_site_settings()
    {
        $result = $this->db->get('igc_site_settings')->row_array();
        return $result;
    }

public function get_service_settings()
    {
        
        $this->db->where('publish_status', '1');
         $this->db->where('content_type', 'Services');
        $result = $this->db->get('igc_content')->result_array();
        return $result;


    }


    public function get_team_settings()
    {

        $this->db->where('publish_status', '1');
        $this->db->where('content_type', 'Team');
        $result = $this->db->get('igc_content')->result_array();
        return $result;


    }

    public function get_product_settings()
    {

        $this->db->where('publish_status', '1');
        $this->db->where('content_type', 'Products');
        $result = $this->db->get('igc_content')->result_array();
        return $result;


    }




    //get all  menu

    public function get_main_menu()
    {

       $query = $this->db->query("select c.content_page_title, c.content_url from igc_content c join igc_mainmenu m on c.content_id= m.content_id
       where c.parent_id = '0' and c.delete_status = '0' and publish_status = '1' order by m.order_no");
        $result = $query->result_array();
        return $result;
    }

    //get footer menu

    public function get_footer_menu()
    {
        $query = $this->db->query("select c.content_page_title, c.content_url from igc_content c join igc_footermenu m on c.content_id= m.content_id
       where c.parent_id = '0' and c.delete_status = '0' and publish_status = '1' order by m.order_no");
        $result = $query->result_array();
        return $result;
    }

    //function mail server settings

    public function get_mail_info()
    {
        $this->db->where('delete_status', '0');
        $this->db->where('active_status', '1');
        $result = $this->db->get('igc_mail_server_setting')->row_array();
        return $result;


    }

    //function to get admin email

    public function get_admin_mails($type)
    {
        $query = $this->db->query("select am.full_name, am.email from igc_admin_email am join igc_admin_mail_setting ms on
        am.admin_id = ms.admin_id join  igc_mailing_type mt on ms.type_id = mt.type_id where am.active_status='1' and
        am.delete_status = '0' and mt.type_name = '$type'");
        $result = $query->result_array();
        return $result;
    }
}