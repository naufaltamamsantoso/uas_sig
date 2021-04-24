<?php

class Mainmenu_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMapdata()
    {
        $this->db->select('*');
        $this->db->from('markers');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('markers');
        $this->session->set_flashdata('message', 'Berhasil Dihapus');
    }

    public function addData()
    {
        $data = [
            'id' => $this->input->post('id'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'longitude' => $this->input->post('lng'),
            'latitude' => $this->input->post('lat'),
            'tipe' => $this->input->post('tipe'),
        ];
        $this->db->insert('markers', $data);
        $this->session->set_flashdata('flash', 'Berhasil Ditambahkan');
    }
}
