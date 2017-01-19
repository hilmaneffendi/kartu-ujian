<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_mahasiswa extends CI_Controller {
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
        $this->load->model('Model_data_mahasiswa');
    }
    public function index(){
        $data['page'] = "data_mahasiswa";
        $data['menu'] = "Data Mahasiswa";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "content_data_mahasiswa";
        $data['data_mahasiswa'] = $this->Model_data_mahasiswa->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function hapus($id){
        $id = array('id' => $id);
        $this->Model_data_mahasiswa->Delete('t_mahasiswa', $id);
        redirect('data_mahasiswa','refresh');
    }
    public function form_add(){
        $data['page'] = "data_mahasiswa";
        $data['menu'] = "Data Pengguna";
        $data['icon'] = "glyphicon glyphicon-book";
        $data['content'] = "form_add";
        $data['data_mahasiswa'] = $this->Model_data_mahasiswa->getData('view_mahasiswa');
        $this->load->view('dashboard/view_dashboard',$data);
    }
    public function proses_add(){
        $user_id = time();
        $data = array(
            'npm'               => $this->input->post('npm'),
            'nama_mahasiswa'    => $this->input->post('nama'),
            'kelas_id'          => $this->input->post('kelas'),
            'jurusan_id'        => $this->input->post('jurusan'),
            'user_id'           => $user_id
            );
        $data2 = array(
            'nama'               => $this->input->post('nama'),
            'username'           => $this->input->post('npm'),
            'password'           => md5($this->input->post('npm')),
            'level'              => 2,
            'foto'               => 'avatar.jpg',
            'user_id'           => $user_id,
            'status'             => 1

            );
        $data = $this->Model_data_mahasiswa->Insert('t_mahasiswa',$data);
        $data = $this->Model_data_mahasiswa->Insert('t_member',$data2);
        redirect('data_mahasiswa','refresh');
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
       $res = $this->Model_data_mahasiswa->Update('t_mahasiswa',$data,$where);
       if ($res > 0) {
            redirect('data_mahasiswa','refresh');
       }
    }
    public function edit($id){
        $data['page']           = "data_mahasiswa";
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
