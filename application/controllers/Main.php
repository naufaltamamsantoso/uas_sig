<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mainmenu_model');
    }

    public function index()
    {
        $data['map'] = $this->Mainmenu_model->getMapdata();
        $this->load->view('mainmenu/header');
        $this->load->view('mainmenu/map', $data);
        $this->load->view('mainmenu/footer');
    }

    public function deleteData($id)
    {
        if ($id) {
            $this->Mainmenu_model->delete($id);
            redirect('main');
        } else {
            redirect('main');
        }
    }

    public function addData()
    {
        $this->Mainmenu_model->addData();
        redirect('main');
    }
}
