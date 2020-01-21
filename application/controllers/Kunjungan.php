<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kunjungan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Kunjungan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kunjungan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kunjungan/index/';
            $config['first_url'] = base_url() . 'index.php/kunjungan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Kunjungan_model->total_rows($q);
        $kunjungan = $this->Kunjungan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kunjungan_data' => $kunjungan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','kunjungan/tbl_kunjungan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kunjungan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kunjungan' => $row->id_kunjungan,
		'tanggal_kunjungan' => $row->tanggal_kunjungan,
		'id_mitra' => $row->id_mitra,
		'keterangan' => $row->keterangan,
		'foto_kunjungan' => $row->foto_kunjungan,
	    );
            $this->template->load('template','kunjungan/tbl_kunjungan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kunjungan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kunjungan/create_action'),
	    'id_kunjungan' => set_value('id_kunjungan'),
	    'tanggal_kunjungan' => set_value('tanggal_kunjungan'),
	    'id_mitra' => set_value('id_mitra'),
	    'keterangan' => set_value('keterangan'),
	    'foto_kunjungan' => set_value('foto_kunjungan'),
	);
        $this->template->load('template','kunjungan/tbl_kunjungan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan',TRUE),
		'id_mitra' => $this->input->post('id_mitra',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'foto_kunjungan'=> $foto['file_name'],
	    );

            $this->Kunjungan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success ');
            redirect(site_url('kunjungan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kunjungan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kunjungan/update_action'),
		'id_kunjungan' => set_value('id_kunjungan', $row->id_kunjungan),
		'tanggal_kunjungan' => set_value('tanggal_kunjungan', $row->tanggal_kunjungan),
		'id_mitra' => set_value('id_mitra', $row->id_mitra),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'foto_kunjungan' => set_value('foto_kunjungan', $row->foto_kunjungan),
	    );
            $this->template->load('template','kunjungan/tbl_kunjungan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kunjungan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kunjungan', TRUE));
        } else {
            $data = array(
		'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan',TRUE),
		'id_mitra' => $this->input->post('id_mitra',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'foto_kunjungan'=>$foto['file_name'],
	    );

            $this->Kunjungan_model->update($this->input->post('id_kunjungan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kunjungan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kunjungan_model->get_by_id($id);

        if ($row) {
            $this->Kunjungan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kunjungan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kunjungan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal_kunjungan', 'tanggal kunjungan', 'trim|required');
	$this->form_validation->set_rules('id_mitra', 'id mitra', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('foto_kunjungan', 'foto kunjungan', 'trim|required');

	$this->form_validation->set_rules('id_kunjungan', 'id_kunjungan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_kunjungan.xls";
        $judul = "tbl_kunjungan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Kunjungan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Mitra");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto Kunjungan");

	foreach ($this->Kunjungan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_kunjungan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_mitra);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_kunjungan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_kunjungan.doc");

        $data = array(
            'tbl_kunjungan_data' => $this->Kunjungan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kunjungan/tbl_kunjungan_doc',$data);
    }

    function upload_foto(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto_kunjungan');
        return $this->upload->data();
    }
}

/* End of file Kunjungan.php */
/* Location: ./application/controllers/Kunjungan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 07:35:27 */
/* http://harviacode.com */