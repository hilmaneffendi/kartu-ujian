<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Verifikasi extends CI_Controller {
     public function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        parent::__construct();
        if ($this->session->userdata('logged_in')!="Sudah Loggin") {
            redirect('login');
        }else{
            if($this->session->userdata('level')!="1"){
                redirect("dashboard","refresh");
            }
        }
        $this->load->helper('text');
        $this->load->model('Model_verifikasi');
    }
    public function index(){
        $data['page'] = "verifikasi";
        $data['menu'] = "Daftar Hadir";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "content_verifikasi";
        $data['verifikasi'] = $this->Model_verifikasi->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function hapus($id){
        $id = array('id' => $id);
        $this->Model_verifikasi->Delete('t_mahasiswa', $id);
        redirect('verifikasi','refresh');
    }
    public function form_add(){
        $data['page'] = "verifikasi";
        $data['menu'] = "Data Pengguna";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "form_add";
        $data['verifikasi'] = $this->Model_verifikasi->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function proses_add(){
        $data = array(
            'npm'               => $this->input->post('npm'),
            'nama_mahasiswa'    => $this->input->post('nama'),
            'kelas_id'          => $this->input->post('kelas'),
            'jurusan_id'        => $this->input->post('jurusan')
            );
        $data = $this->Model_verifikasi->Insert('t_mahasiswa',$data);
        redirect('verifikasi','refresh');
    }
    public function update_data(){
        $data = array(
            'npm'               => $this->input->post('npm'),
            'nama_mahasiswa'    => $this->input->post('nama'),
            'kelas_id'          => $this->input->post('kelas'),
            'jurusan_id'        => $this->input->post('jurusan')
        );
       $where = array(
            'id' =>$this->input->post('id'),
        );
       $res = $this->Model_verifikasi->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('verifikasi','refresh');
       }
    }
    public function aktif($id){
        $data = array(
            'status'               => 1
        );
       $where = array(
            'id' =>$id,
        );
        $kunci                = time();
        $datax = array(
            'kunci'               => base64_encode($kunci),
            'mahasiswa_id'        => $id
            );
        $res = $this->Model_verifikasi->Insert('t_kartu',$datax);
       $res = $this->Model_verifikasi->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('verifikasi','refresh');
       }  
    }
    public function nonaktif($id){
        $data = array(
            'status'               => 0
        );
       $where = array(
            'id' =>$id,
        );
        $idy = array('mahasiswa_id' => $id);
        $this->Model_verifikasi->Delete('t_kartu', $idy);
       $res = $this->Model_verifikasi->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('verifikasi','refresh');
       }  
    }
    public function edit($id){
        $data['page']           = "verifikasi";
        $data['menu']           = "Edit Mahasiswa";
        $data['icon']           = "glyphicon glyphicon-book";
        $data['content']        = "form_edit";
        $query                  = $this->db->get_where('t_mahasiswa',array('id'=>$id));
        $rowx                   = $query->row();
        $data['id']             = $rowx->id;      
        $data['npm']            = $rowx->npm;      
        $data['nama_mahasiswa'] = $rowx->nama_mahasiswa;
        $data['kelas_id']       = $rowx->kelas_id;
        $data['jurusan_id']     = $rowx->jurusan_id;
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function cek_cipher(){
         $data['page'] = "verifikasi";
        $data['menu'] = "Verifikasi Kartu";
        $data['icon'] = "glyphicon glyphicon-book";
        $d      =  $this->input->post('cip');
        $key    = 'ckbds';
        $plaintext = '';
        $ciphertext = base64_decode($d);
     
          for($i=0; $i<strlen($ciphertext); $i++) {
            $char = substr($ciphertext, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $plaintext.=$char;
          }
      $a  = explode('-', $plaintext);
      $hasil = $a[0];
      $cek =  $this->db->get_where('view_kartu',array('npm'=>$hasil))->num_rows();
        if ($cek > 0) {
            $query =  $this->db->get_where('view_kartu',array('npm'=>$hasil));
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