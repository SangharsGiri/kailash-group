<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Category_sorting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('adjacency_category_list');
    }

    /**
     * Show all navigation groups
     *
     * @return void
     */
    public function index()
    {
        $groups  = $this->adjacency_category_list->get_all_groups();
        $data['groups'] = array();

        foreach ($groups as $group)
        {
            $items                                 = $this->adjacency_category_list->get_all($group['id']);
            $data['groups'][$group['id']]          = $group;
            $data['groups'][$group['id']]['items'] = parse_children($items);
        }

        $data['title'] = 'Navigation';
        $data['styles'] =  array('static/css/bootstrap','static/css/style');
        $data['scripts'] = array('static/js/jquery.cookie','static/js/jquery.mjs.nestedSortable','static/js/cat.script');
        $this->load->view('header',$data);
        $this->load->view('menu_list');
        $this->load->view('footer');
    }

    /**
     * Add new item to navigation group
     *
     * @param string $id Item id
     *
     * @return void
     */

    
    public function add($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
        $this->form_validation->set_rules('content_page_title', 'Name', 'required|trim');
        $this->form_validation->set_rules('content_url', 'URL', 'required|trim');
        $this->form_validation->set_rules('parent_id', 'Parent', 'required|integer');

        if ($this->form_validation->run() === FALSE)
        {

            $data['navigation'] = $this->adjacency_list->get_group($id);
            $data['dropdown']   = $this->adjacency_list->get_all_for_dropdown($id);
            $data['title']      = 'Add item';

            //$this->load->view('adjacency/list/add', $data);

            $this->load->view('header',$data);
            $this->load->view('add_list');
            $this->load->view('footer');
        }
        else
        {
            $data = $this->input->post();
            $data['content_title'] =$this->input->post('content_page_title');
            $data['group_id'] = $id;
            $data['delete_status']="0";
            $data['publish_status']="0";
            $data['content_type']="Page";
            $this->adjacency_list->add_item($data);

            redirect('primary_menu');
        }
    }

    /**
     * Edit item from navigation group
     *
     * @param string $id Item id
     *
     * @return void
     */
    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('parent_id', 'Parent', 'required|integer');

        if ($this->form_validation->run() === FALSE)
        {
            if ($data = $this->adjacency_list->get_item($id))
            {
                $data['navigation'] = $this->adjacency_list->get_group($data['group_id']);
                $data['dropdown']   = $this->adjacency_list->get_all_for_dropdown($data['group_id'], (int) $id);
                $data['title']      = 'Edit item';
                $this->load->view('adjacency/list/edit', $data);
            }
            else
            {
                show_404();
            }
        }
        else
        {
            $this->adjacency_list->update_item($id, $this->input->post());

            redirect('al');
        }
    }

    /**
     * Delete item from navigation group
     *
     * @param string $id Item id
     *
     * @return void
     */
    public function delete($id)
    {
        if ( ! $this->adjacency_list->has_children($id))
        {
            $this->adjacency_list->delete_item($id);
        }

        redirect('al');
    }

    /**
     * Reorder items in navigation group
     *
     * @return void
     */
    public function reorder()
    {
        if ($this->input->is_ajax_request())
        {
            $arr   = array();
            $order = $this->input->post('order');

            parse_str($order, $arr);

            $this->adjacency_category_list->reorder($arr['list']);
        }
        else
        {
            show_404();
        }
    }

    /**
     * Add new navigation group
     *
     * @return void
     */
    public function add_group()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $data['title'] = 'Add navigation group';
            $this->load->view('adjacency/group/add', $data);
        }
        else
        {
            $this->adjacency_list->add_group($this->input->post());

            redirect('al');
        }
    }

    /**
     * Edit navigation group
     *
     * @param string $id Item id
     *
     * @return void
     */
    public function edit_group($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            if ($data = $this->adjacency_list->get_group($id))
            {
                $data['title'] = 'Edit navigation group';
                $this->load->view('adjacency/group/edit', $data);
            }
            else
            {
                show_404();
            }
        }
        else
        {
            $this->adjacency_list->update_group($id, $this->input->post());

            redirect('al');
        }
    }

    /**
     * Delete navigation group
     *
     * @param string $id Item id
     *
     * @return void
     */
    public function delete_group($id)
    {
        $this->adjacency_list->delete_group($id);

        redirect('al');
    }

    /**
     * Samples - library usage
     *
     * @return void
     */
    public function samples()
    {
        $data['title'] = 'Samples';
        $this->load->view('adjacency/sample/index', $data);
    }
}
/* End of file al.php */
/* Location: ./controllers/al.php */
