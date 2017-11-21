<?php

class Mpesan extends CI_Model {
    #Start function pengaturan profile siswa#

    public function tampil_pesan() {
        $this->db->select('*');
        $this->db->from('tb_pesan');
        $this->db->where('status',1);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    function hapus_pesan($idpesan) {
        $this->db->set('status', 0);
        $this->db->where('id_pesan', $idpesan);
        $this->db->update('tb_pesan');
    }

    // update status read ortu jadi 1
    public function update_read($UUID)
    {
        $this->db->set('read_status_ortu',1);
        $this->db->where('UUID', $UUID);
        $this->db->update('tb_laporan_ortu');
    }

    // update statu read siswa jadi 1
    public function update_read_siswa($UUID)
    {
        $this->db->set('read_status_siswa',1);
        $this->db->where('UUID', $UUID);
        $this->db->update('tb_laporan_ortu');
    }

    public function namasiswa($id) {
        $query = "SELECT * FROM `tb_orang_tua` ortu 
                JOIN tb_siswa sis ON ortu.siswaID = sis.id 
                JOIN `tb_pengguna` peng ON peng.id = sis.penggunaID 
                WHERE `peng`.`namaPengguna`= '$id'";
        $result = $this->db->query($query);
        
        // return $result->result_array();
        if ($result->result_array()==array()) {
            return false;
        } else {
            return $result->result_array()[0];
        }
    }

    public function get_daftar_pesan($pengguna='')
    {
        $this->db->select('*');
        $this->db->from('tb_laporan_ortu l');
        $this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
        $this->db->where('l.read_status_ortu',0);
        $this->db->where('o.penggunaID',$pengguna);
        $this->db->limit(3);
        $this->db->order_by('l.id', 'desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_count($pengguna='')
    {
        $this->db->select('count(*) as numrows');
        $this->db->from('tb_laporan_ortu l');
        $this->db->join('tb_orang_tua o', 'l.id_ortu=o.id');
        $this->db->where('l.read_status_ortu',0);
        $this->db->where('o.penggunaID',$pengguna);

        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }

    /*Mengambil semua report*/
    function get_report_all($data,$id){
        $this->db->select('o.namaOrangTua, l.jenis, l.isi,l.date_created as tgl');
        $this->db->from('tb_orang_tua o');
        $this->db->join('tb_siswa s ',' o.siswaID = s.id');
        $this->db->join('tb_laporan_ortu l', 'o.id=l.id_ortu');
        $this->db->join('tb_pengguna peng ',' peng.id = s.penggunaID');
        $this->db->where("peng.namaPengguna",$id );
        $this->db->order_by("l.id", 'desc');

        if ($data['jenis']!="all") {
            $jenis = $data['jenis'];
            $this->db->where("l.jenis LIKE '%$jenis%'");
        }

        $query = $this->db->get();
        return $query->result_array();
    }   


}

?>