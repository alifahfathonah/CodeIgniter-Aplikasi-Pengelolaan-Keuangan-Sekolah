<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

    public function index()
    {
        $data["pesan"] = array();
        array_push($data["pesan"], array(
                                'nis' => '-',
                                'nama' => '-',
                                'pesan' => '-',
                                'status' => '-',

                            ));;
        $this->load->view("admin/hasil_import", $data);
    }

    public function upload()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            //redirect halaman
            redirect('import/');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $tes = array();

            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 4){
                    array_push($tes, array(
                        'tanggal' => $row['A'],
                        'nis' => $row['B'],
                        'nama' => $row['C'],
                        'kelas' => $row['D'],
                        'nominal' => $row['E'],
                        'spp' => $row['F'],
                        'cat' => $row['G'],
                        'robotik' => $row['H'],
                        'seragam' => $row['I'],
                        'sains' => $row['J'],
                        'pendaftaran' => $row['K'],
                        'taekwondo' => $row['L'],
                        'du' => $row['M'],
                        'retur' => $row['N'],
                        'kalender' => $row['O'],

                    ));
                }
                $numrow++;
            }

            //proses
            $data["pesan"] = array();

            //$this->db->insert_batch('tes', $tes);
            foreach($tes as $yoi){
                if ($yoi['spp'] != "")
                {
                    $ceknis = $this->cekNIS($yoi['nis']);
                    if ($ceknis > 0){
                        $bulan = date('m');
                        $tahun = date('Y');

                        $this->db->select("*");
                        $this->db->where("b.NIS", $yoi['nis'], FALSE);
                        $this->db->where("b.bulan_spp", $bulan, FALSE);
                        $this->db->where("b.tahun_spp", $tahun, FALSE);
                        $query = $this->db->get("bayar_spp as b"); 
                        $total = $query->num_rows();
                        
                        if($total == 0){
                            $this->addSPP($yoi['nis'],$yoi['tanggal'],$yoi['spp'],$bulan,$tahun);
                            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran SPP!",
                                'status' => 1,
                            ));  
                        }else{
                            if ($bulan == 12){
                                $bulan = 1;
                                $tahun = $tahun+1;
                            }else{
                                $bulan = $bulan+1;
                            }
                            $this->db->select("*");
                            $this->db->where("b.NIS", $yoi['nis'], FALSE);
                            $this->db->where("b.bulan_spp", $bulan, FALSE);
                            $this->db->where("b.tahun_spp", $tahun, FALSE);
                            $query = $this->db->get("bayar_spp as b"); 
                            $total = $query->num_rows();

                            if($total == 0){
                              $this->addSPP($yoi['nis'],$yoi['tanggal'],$yoi['spp'],$bulan,$tahun);
                              array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran SPP!",
                                'status' => 1,
                            ));

                          }else{
                            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Error! Tidak dapat input data pembayaran SPP! Silahkan input manual",
                                'status' => 0,
                            ));
                        }
                    }    
                }
                else{
                    array_push($data["pesan"], array(
                        'nis' => $yoi['nis'],
                        'nama' => $yoi['nama'],
                        'pesan' => "Error Input SPP! NIS Tidak Ditemukan! Silahkan input manual",
                        'status' => 0,

                    ));
                }
            }


            if ($yoi['cat'] != "")
            {
                $ceknis = $this->cekNIS($yoi['nis']);
                if ($ceknis > 0){
                    $bulan = date('m');
                    $tahun = date('Y');

                    $this->db->select("*");
                    $this->db->where("b.NIS", $yoi['nis'], FALSE);
                    $this->db->where("b.bulan_catering", $bulan, FALSE);
                    $this->db->where("b.tahun_catering", $tahun, FALSE);
                    $query = $this->db->get("bayar_catering as b"); 
                    $total = $query->num_rows();

                    if($total == 0){
                        $this->addCAT($yoi['nis'],$yoi['tanggal'],$yoi['cat'],$bulan,$tahun);
                        array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Catering!",
                                'status' => 1,
                            ));
                    }else{
                        if ($bulan == 12){
                            $bulan = 1;
                            $tahun = $tahun+1;
                        }else{
                            $bulan = $bulan+1;
                        }
                        $this->db->select("*");
                        $this->db->where("b.NIS", $yoi['nis'], FALSE);
                        $this->db->where("b.bulan_catering", $bulan, FALSE);
                        $this->db->where("b.tahun_catering", $tahun, FALSE);
                        $query = $this->db->get("bayar_catering as b"); 
                        $total = $query->num_rows();

                        if($total == 0){
                          $this->addCAT($yoi['nis'],$yoi['tanggal'],$yoi['cat'],$bulan,$tahun);
                          array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Catering!",
                                'status' => 1,
                            ));
                      }else{
                        array_push($data["pesan"], array(
                            'nis' => $yoi['nis'],
                            'nama' => $yoi['nama'],
                            'pesan' => "Error! Tidak dapat input data pembayaran Catering! Silahkan input manual",
                            'status' => 0,
                        ));
                    }
                }

            }else{
                array_push($data["pesan"], array(
                    'nis' => $yoi['nis'],
                    'nama' => $yoi['nama'],
                    'pesan' => "Error Input Catering! NIS Tidak Ditemukan! Silahkan input manual",
                    'status' => 0,
                ));
            }
        }


        if ($yoi['robotik'] != "")
        {
            $this->addROBOTIK($yoi['nis'],$yoi['nama'],$yoi['tanggal'],$yoi['robotik']);
            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Robotik!",
                                'status' => 1,
                            ));
        }
        if ($yoi['seragam'] != "")
        {
            $this->addSERAGAM($yoi['nis'],$yoi['nama'],$yoi['tanggal'],$yoi['seragam']);
            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Seragam!",
                                'status' => 1,
                            ));
        }
        if ($yoi['sains'] != "")
        {
            $this->addSAINS($yoi['nis'],$yoi['nama'],$yoi['tanggal'],$yoi['sains']);
            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Sains!",
                                'status' => 1,
                            ));
        }
        if ($yoi['pendaftaran'] != "")
        {
            $this->addPENDAFTARAN($yoi['nama'],$yoi['tanggal'],$yoi['pendaftaran']);
            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Pendaftaran!",
                                'status' => 1,
                            ));
        }
        if ($yoi['taekwondo'] != "")
        {
            $this->addTAEKWONDO($yoi['nis'],$yoi['nama'],$yoi['tanggal'],$yoi['taekwondo']);
            array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Taekwondo!",
                                'status' => 1,
                            ));
        }
        if ($yoi['du'] != "")
        {
            $ceknis = $this->cekNIS($yoi['nis']);
            if ($ceknis > 0){

                $no = $this->getNoDaftarUlangByNis($yoi['nis']);
                $no1 = $no;
                if($no1!=""){
                    $this->addDU($no1,$yoi['tanggal'],$yoi['du']);
                array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Daftar Ulang! No. DU ".$no1,
                                'status' => 1,
                            ));    
                }else{
                    array_push($data["pesan"], array(
                'nis' => $yoi['nis'],
                'nama' => $yoi['nama'],
                'pesan' => "Error Input Daftar Ulang! No Daftar Ulang Tidak ditemukan",
                'status' => 0,
                )); 
                }

                
            }else{
               array_push($data["pesan"], array(
                'nis' => $yoi['nis'],
                'nama' => $yoi['nama'],
                'pesan' => "Error Input Daftar Ulang! NIS Tidak Ditemukan! Silahkan input manual",
                'status' => 0,
            ));
           }
       }
       if ($yoi['kalender'] != "")
       {
        $this->addKALENDER($yoi['nama'],$yoi['tanggal'],$yoi['kalender']);
        array_push($data["pesan"], array(
                                'nis' => $yoi['nis'],
                                'nama' => $yoi['nama'],
                                'pesan' => "Sukses! Input data pembayaran Kalender!",
                                'status' => 1,
                            ));
    }

}

            //end proses

            //delete file from server
unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success

            //redirect halaman
$this->load->view("admin/hasil_import", $data);

}
}

public function cekNIS($nis){
    $this->db->select("*");
    $this->db->where("s.NIS", $nis, FALSE);
    $query = $this->db->get("data_siswa as s"); 
    return $total = $query->num_rows();
}
public function addSPP($nis, $tanggal, $jumlah,$bulan,$tahun)
{   
  $spp = array(
    'NIS' => $nis,
    'tanggal_bayar_spp' => $tanggal,
    'bulan_spp' => $bulan,
    'tahun_spp' => $tahun,
    'jumlah' => $jumlah
);

  $this->db->insert('bayar_spp', $spp);

}

public function addCAT($nis, $tanggal, $jumlah,$bulan,$tahun)
{
    $cat = array(
        'NIS' => $nis,
        'tanggal_bayar_catering' => $tanggal,
        'bulan_catering' => $bulan,
        'tahun_catering' => $tahun,
        'biaya_catering' => $jumlah
    );

    $this->db->insert('bayar_catering', $cat);
}

public function addROBOTIK($nis, $nama, $tanggal, $jumlah)
{
    $robotik = array(
        'id_kategori_pemasukkan_lain' => 5,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nis."-".$nama
    );

    $this->db->insert('pemasukkan_lain', $robotik);

}

public function addSERAGAM($nis, $nama, $tanggal, $jumlah)
{
    $seragam = array(
        'id_kategori_pemasukkan_lain' => 1,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nis."-".$nama
    );

    $this->db->insert('pemasukkan_lain', $seragam);

}

public function addSAINS($nis,$nama, $tanggal, $jumlah)
{
    $sains = array(
        'id_kategori_pemasukkan_lain' => 9,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nis."-".$nama
    );

    $this->db->insert('pemasukkan_lain', $sains);


}

public function addPENDAFTARAN($nama, $tanggal, $jumlah)
{
    $pendaftaran = array(
        'id_kategori_pemasukkan_lain' => 4,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nama
    );

    $this->db->insert('pemasukkan_lain', $pendaftaran);

}

public function addTAEKWONDO($nis,$nama, $tanggal, $jumlah)
{
    $taekwondo = array(
        'id_kategori_pemasukkan_lain' => 2,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nis."-".$nama
    );

    $this->db->insert('pemasukkan_lain', $taekwondo);

}

public function addDU($no, $tanggal, $jumlah)
{       
    $du = array(
        'no_bayar_daftar_ulang' => $no,
        'tanggal_bayar_daftarulang' => $tanggal,
        'nominal' => $jumlah
    );

    $this->db->insert("cicil_daftar_ulang", $du);

}

public function getNoDaftarUlangByNis($nis)
{
    $sql = "SELECT no_bayar_daftar_ulang as no FROM daftar_ulang WHERE NIS = $nis AND status = 0";

    return $this->db->query($sql)->row();
}

public function addKALENDER($nama, $tanggal, $jumlah)
{
    $kalender = array(
        'id_kategori_pemasukkan_lain' => 10,
        'tanggal_pemasukkan_lain' => $tanggal,
        'nominal_pemasukkan_lain' => $jumlah,
        'keterangan_pemasukkan_lain' => $nama
    );

    $this->db->insert('pemasukkan_lain', $kalender);

}

}