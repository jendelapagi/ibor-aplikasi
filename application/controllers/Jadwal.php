<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Jadwal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/jadwal/index/';
            $config['first_url'] = base_url() . 'index.php/jadwal/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Jadwal_model->total_rows($q);
        $jadwal = $this->Jadwal_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_data' => $jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','jadwal/tbl_jadwal_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penjadwalan' => $row->id_penjadwalan,
		'tanggal_rencana_kunjungan' => $row->tanggal_rencana_kunjungan,
		'id_mitra' => $row->id_mitra,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','jadwal/tbl_jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jadwal/create_action'),
	    'id_penjadwalan' => set_value('id_penjadwalan'),
	    'tanggal_rencana_kunjungan' => set_value('tanggal_rencana_kunjungan'),
	    'id_mitra' => set_value('id_mitra'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','jadwal/tbl_jadwal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal_rencana_kunjungan' => $this->input->post('tanggal_rencana_kunjungan',TRUE),
		'id_mitra' => $this->input->post('id_mitra',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('jadwal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jadwal/update_action'),
		'id_penjadwalan' => set_value('id_penjadwalan', $row->id_penjadwalan),
		'tanggal_rencana_kunjungan' => set_value('tanggal_rencana_kunjungan', $row->tanggal_rencana_kunjungan),
		'id_mitra' => set_value('id_mitra', $row->id_mitra),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','jadwal/tbl_jadwal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penjadwalan', TRUE));
        } else {
            $data = array(
		'tanggal_rencana_kunjungan' => $this->input->post('tanggal_rencana_kunjungan',TRUE),
		'id_mitra' => $this->input->post('id_mitra',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Jadwal_model->update($this->input->post('id_penjadwalan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jadwal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal_rencana_kunjungan', 'tanggal rencana kunjungan', 'trim|required');
	$this->form_validation->set_rules('id_mitra', 'id mitra', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_penjadwalan', 'id_penjadwalan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_jadwal.xls";
        $judul = "tbl_jadwal";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Rencana Kunjungan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mitra");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Jadwal_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_rencana_kunjungan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mitra);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_jadwal.doc");

        $data = array(
            'tbl_jadwal_data' => $this->Jadwal_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('jadwal/tbl_jadwal_doc',$data);
    }

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 15:08:06 */
/* http://harviacode.com */