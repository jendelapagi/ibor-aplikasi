<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/ts/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/ts/index/';
            $config['first_url'] = base_url() . 'index.php/ts/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Ts_model->total_rows($q);
        $ts = $this->Ts_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ts_data' => $ts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','ts/tbl_ts_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Ts_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ts' => $row->id_ts,
		'nama_ts' => $row->nama_ts,
		'tempat_lahir_ts' => $row->tempat_lahir_ts,
		'tanggal_lahir_ts' => $row->tanggal_lahir_ts,
		'alamat_ts' => $row->alamat_ts,
		'pendidikan_ts' => $row->pendidikan_ts,
		'no_hp_ts' => $row->no_hp_ts,
		'gol_darah_ts' => $row->gol_darah_ts,
		'id_penjadwalan' => $row->id_penjadwalan,
		'id_kunjungan' => $row->id_kunjungan,
		'id_user_level' => $row->id_user_level,
	    );
            $this->template->load('template','ts/tbl_ts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ts'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ts/create_action'),
	    'id_ts' => set_value('id_ts'),
	    'nama_ts' => set_value('nama_ts'),
	    'tempat_lahir_ts' => set_value('tempat_lahir_ts'),
	    'tanggal_lahir_ts' => set_value('tanggal_lahir_ts'),
	    'alamat_ts' => set_value('alamat_ts'),
	    'pendidikan_ts' => set_value('pendidikan_ts'),
	    'no_hp_ts' => set_value('no_hp_ts'),
	    'gol_darah_ts' => set_value('gol_darah_ts'),
	    'id_penjadwalan' => set_value('id_penjadwalan'),
	    'id_kunjungan' => set_value('id_kunjungan'),
	    'id_user_level' => set_value('id_user_level'),
	);
        $this->template->load('template','ts/tbl_ts_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_ts' => $this->input->post('nama_ts',TRUE),
		'tempat_lahir_ts' => $this->input->post('tempat_lahir_ts',TRUE),
		'tanggal_lahir_ts' => $this->input->post('tanggal_lahir_ts',TRUE),
		'alamat_ts' => $this->input->post('alamat_ts',TRUE),
		'pendidikan_ts' => $this->input->post('pendidikan_ts',TRUE),
		'no_hp_ts' => $this->input->post('no_hp_ts',TRUE),
		'gol_darah_ts' => $this->input->post('gol_darah_ts',TRUE),
		'id_penjadwalan' => $this->input->post('id_penjadwalan',TRUE),
		'id_kunjungan' => $this->input->post('id_kunjungan',TRUE),
		'id_user_level' => $this->input->post('id_user_level',TRUE),
	    );

            $this->Ts_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('ts'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ts/update_action'),
		'id_ts' => set_value('id_ts', $row->id_ts),
		'nama_ts' => set_value('nama_ts', $row->nama_ts),
		'tempat_lahir_ts' => set_value('tempat_lahir_ts', $row->tempat_lahir_ts),
		'tanggal_lahir_ts' => set_value('tanggal_lahir_ts', $row->tanggal_lahir_ts),
		'alamat_ts' => set_value('alamat_ts', $row->alamat_ts),
		'pendidikan_ts' => set_value('pendidikan_ts', $row->pendidikan_ts),
		'no_hp_ts' => set_value('no_hp_ts', $row->no_hp_ts),
		'gol_darah_ts' => set_value('gol_darah_ts', $row->gol_darah_ts),
		'id_penjadwalan' => set_value('id_penjadwalan', $row->id_penjadwalan),
		'id_kunjungan' => set_value('id_kunjungan', $row->id_kunjungan),
		'id_user_level' => set_value('id_user_level', $row->id_user_level),
	    );
            $this->template->load('template','ts/tbl_ts_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ts'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ts', TRUE));
        } else {
            $data = array(
		'nama_ts' => $this->input->post('nama_ts',TRUE),
		'tempat_lahir_ts' => $this->input->post('tempat_lahir_ts',TRUE),
		'tanggal_lahir_ts' => $this->input->post('tanggal_lahir_ts',TRUE),
		'alamat_ts' => $this->input->post('alamat_ts',TRUE),
		'pendidikan_ts' => $this->input->post('pendidikan_ts',TRUE),
		'no_hp_ts' => $this->input->post('no_hp_ts',TRUE),
		'gol_darah_ts' => $this->input->post('gol_darah_ts',TRUE),
		'id_penjadwalan' => $this->input->post('id_penjadwalan',TRUE),
		'id_kunjungan' => $this->input->post('id_kunjungan',TRUE),
		'id_user_level' => $this->input->post('id_user_level',TRUE),
	    );

            $this->Ts_model->update($this->input->post('id_ts', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ts'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ts_model->get_by_id($id);

        if ($row) {
            $this->Ts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ts'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ts'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_ts', 'nama ts', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir_ts', 'tempat lahir ts', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir_ts', 'tanggal lahir ts', 'trim|required');
	$this->form_validation->set_rules('alamat_ts', 'alamat ts', 'trim|required');
	$this->form_validation->set_rules('pendidikan_ts', 'pendidikan ts', 'trim|required');
	$this->form_validation->set_rules('no_hp_ts', 'no hp ts', 'trim|required');
	$this->form_validation->set_rules('gol_darah_ts', 'gol darah ts', 'trim|required');
	$this->form_validation->set_rules('id_penjadwalan', 'id penjadwalan', 'trim|required');
	$this->form_validation->set_rules('id_kunjungan', 'id kunjungan', 'trim|required');
	$this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');

	$this->form_validation->set_rules('id_ts', 'id_ts', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_ts.xls";
        $judul = "tbl_ts";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Gol Darah Ts");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Penjadwalan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kunjungan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");

	foreach ($this->Ts_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ts);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir_ts);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir_ts);
	    xlsWriteNumber($tablebody, $kolombody++, $data->alamat_ts);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pendidikan_ts);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_ts);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gol_darah_ts);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_penjadwalan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kunjungan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_ts.doc");

        $data = array(
            'tbl_ts_data' => $this->Ts_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('ts/tbl_ts_doc',$data);
    }

}

/* End of file Ts.php */
/* Location: ./application/controllers/Ts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 15:19:35 */
/* http://harviacode.com */