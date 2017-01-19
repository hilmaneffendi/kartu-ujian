# kartu-ujian
implementation encrypt / decrypt base64 with key for qr code

# Script encode data
membuat qr code dengan mengenkrip data npm + waktu.
agar tidak bisa di dekrip menggunakan aplikasi lain kita menambahkan kunci
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
          
 # Script decode data
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
