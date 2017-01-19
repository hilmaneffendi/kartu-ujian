<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak_kartu extends CI_Controller {
     public function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        parent::__construct();
        if ($this->session->userdata('logged_in')!="Sudah Loggin") {
            redirect('login');
        }
        $this->load->helper('text');
        $this->load->model('Model_cetak_kartu');
    }
    public function index(){
        $data['page']       = "cetak_kartu";
        $data['menu']       = "Cetak Kartu Ujian";
        $data['icon']       = "glyphicon glyphicon-book";
        $cek =  $this->db->get_where('view_kartu',array('user_id'=>$this->session->userdata('user_id')))->num_rows();
        if ($cek > 0) {
            $query =  $this->db->get_where('view_kartu',array('user_id'=>$this->session->userdata('user_id')));
            $rowx                       = $query->row();
            $data['id']                 = $rowx->id;      
            $data['npm']                = $rowx->npm;      
            $data['kunci']              = $rowx->kunci;      
            $data['nama_mahasiswa']     = $rowx->nama_mahasiswa;
            $data['kelas']              = $rowx->kelas;
            $data['jurusan']            = $rowx->jurusan;
            $data['content']    = "content_cetak_kartu";
        }else{
            $data['content']    = "content_cetak_kosong";
        }
        $this->load->view('dashboard/view_dashboard',$data);
    }
}