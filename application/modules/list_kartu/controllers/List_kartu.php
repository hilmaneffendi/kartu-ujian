<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class List_kartu extends CI_Controller {
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
        $this->load->model('Model_list_kartu');
    }
    public function index(){
        $data['page'] = "list_kartu";
        $data['menu'] = "List Kartu Ujian";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "content_list_kartu";
        $data['list_kartu'] = $this->Model_list_kartu->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function hapus($id){
        $id = array('id' => $id);
        $this->Model_list_kartu->Delete('t_mahasiswa', $id);
        redirect('list_kartu','refresh');
    }
    public function form_add(){
        $data['page'] = "list_kartu";
        $data['menu'] = "Data Pengguna";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "form_add";
        $data['list_kartu'] = $this->Model_list_kartu->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function proses_add(){
        $data = array(
            'npm'               => $this->input->post('npm'),
            'nama_mahasiswa'    => $this->input->post('nama'),
            'kelas_id'          => $this->input->post('kelas'),
            'jurusan_id'        => $this->input->post('jurusan')
            );
        $data = $this->Model_list_kartu->Insert('t_mahasiswa',$data);
        redirect('list_kartu','refresh');
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
       $res = $this->Model_list_kartu->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('list_kartu','refresh');
       }
    }
    public function aktif($id){
        $query          = $this->db->get_where('t_mahasiswa',array('id'=>$id));
        $rowx           = $query->row();
        $pl             = $rowx->npm.'-'.time();

        $plaintext  = $pl;
        $key        = 'ckbds';
        $ciphertext = '';
          for($i=0; $i<strlen($plaintext); $i++) {
            $char       = substr($plaintext, $i, 1);
            $keychar    = substr($key, ($i % strlen($key))-1, 1);
            $char       = chr(ord($char)+ord($keychar));
            $ciphertext.=$char;
          }


        $data = array(
            'status'               => 1
        );
        $where = array(
            'id' =>$id,
        );
        $datax = array(
            'kunci'               => base64_encode($ciphertext),
            'mahasiswa_id'        => $id
            );
        $res = $this->Model_list_kartu->Insert('t_kartu',$datax);
        $res = $this->Model_list_kartu->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('list_kartu','refresh');
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
        $this->Model_list_kartu->Delete('t_kartu', $idy);
       $res = $this->Model_list_kartu->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('list_kartu','refresh');
       }  
    }
    public function edit($id){
        $data['page']           = "list_kartu";
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
}