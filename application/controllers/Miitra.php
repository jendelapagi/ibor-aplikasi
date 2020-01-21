<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Miitra extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Mitra_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/miitra/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/miitra/index/';
            $config['first_url'] = base_url() . 'index.php/miitra/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Mitra_model->total_rows($q);
        $miitra = $this->Mitra_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'miitra_data' => $miitra,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','miitra/tbl_mitra_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mitra_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mitra' => $row->id_mitra,
		'nama_mitra' => $row->nama_mitra,
		'wilayah' => $row->wilayah,
        'alamat'=> $row->alamat,
		'no_hp_mitra' => $row->no_hp_mitra,
	    );
            $this->template->load('template','miitra/tbl_mitra_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('miitra'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('miitra/create_action'),
	    'id_mitra' => set_value('id_mitra'),
	    'nama_mitra' => set_value('nama_mitra'),
	    'wilayah' => set_value('wilayah'),
        'alamat' => set_value('alamat'),
	    'no_hp_mitra' => set_value('no_hp_mitra'),
	);
        $this->template->load('template','miitra/tbl_mitra_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_mitra' => $this->input->post('nama_mitra',TRUE),
		'wilayah' => $this->input->post('wilayah',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
		'no_hp_mitra' => $this->input->post('no_hp_mitra',TRUE),
	    );

            $this->Mitra_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('miitra'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mitra_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('miitra/update_action'),
		'id_mitra' => set_value('id_mitra', $row->id_mitra),
		'nama_mitra' => set_value('nama_mitra', $row->nama_mitra),
		'wilayah' => set_value('wilayah', $row->wilayah),
        'alamat' => set_value('alamat', $row->alamat),
		'no_hp_mitra' => set_value('no_hp_mitra', $row->no_hp_mitra),
	    );
            $this->template->load('template','miitra/tbl_mitra_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('miitra'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mitra', TRUE));
        } else {
            $data = array(
		'nama_mitra' => $this->input->post('nama_mitra',TRUE),
		'wilayah' => $this->input->post('wilayah',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
		'no_hp_mitra' => $this->input->post('no_hp_mitra',TRUE),
	    );

            $this->Mitra_model->update($this->input->post('id_mitra', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('miitra'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mitra_model->get_by_id($id);

        if ($row) {
            $this->Mitra_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('miitra'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('miitra'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_mitra', 'nama mitra', 'trim|required');
	$this->form_validation->set_rules('wilayah', 'wilayah', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_hp_mitra', 'no hp mitra', 'trim|required');

	$this->form_validation->set_rules('id_mitra', 'id_mitra', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_mitra.xls";
        $judul = "tbl_mitra";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Mitra");
	xlsWriteLabel($tablehead, $kolomhead++, "Wilayah");
    xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Mitra");

	foreach ($this->Mitra_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_mitra);
	    xlsWriteLabel($tablebody, $kolombody++, $data->wilayah);
        xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_mitra);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_mitra.doc");

        $data = array(
            'tbl_mitra_data' => $this->Mitra_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('miitra/tbl_mitra_doc',$data);
    }

}

/* End of file Miitra.php */
/* Location: ./application/controllers/Miitra.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 07:32:27 */
/* http://harviacode.com */