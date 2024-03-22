<?php class Modular extends CI_Model {
	public function __construct() {
		parent::__construct();	
	}

  public function queryBuild($req) {
    foreach ($req as $key => $value) {
      if ($req['method'] == 'get') {
        $this->db->select($req['select']);
        $this->db->from($req['table']);
        if (isset($req['join'])) {
          foreach ($req['join'] as $table => $bound) {
            $this->db->join($table, $bound);
          }
        }
        if (isset($req['order'])) { $this->db->order_by($req['order']); }
        if (isset($req['where'])) { $this->db->where($req['where']); }
        if (isset($req['wherein'])) {
          foreach($req['wherein'] as $keyVal => $arrayVal) {
            $this->db->where_in($keyVal, $arrayVal);
          } 
        }
        if (isset($req['like'])) { $this->db->like($req['like']); }
        if (isset($req['not_like'])) { $this->db->not_like($req['not_like']); }
        if (isset($req['group'])) { $this->db->group_by($req['group']); }
        if (isset($req['limit'])) { $this->db->limit($req['limit']); }
        return $this->db->get();
      } elseif ($req['method'] == 'insert') {
        return $this->db->insert($req['table'], $req['value']);
      } elseif ($req['method'] == 'update') {
        if (isset($req['where'])) { $this->db->where($req['where']); }
        return $this->db->update($req['table'], $req['value']);
      } elseif($req['method'] == 'delete') {
        if (isset($req['where'])) { $this->db->where($req['where']); }
        return $this->db->delete($req['table']);
      }
    }
  }

  function UpdateData($table, $data, $where)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }

  function Peserta($table,$where){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->join('t_peserta_level', 't_peserta_level.kd_level_peserta = t_pendaftaran.level_peserta');
    $this->db->join('t_provinsi', 't_provinsi.kd_provinsi = t_pendaftaran.prov_kd');
    $this->db->join('t_prov_kab', 't_prov_kab.kd_kab = t_pendaftaran.kab_kd');
    $this->db->where($where);
    $data = $this->db->get();
    return $data;
  }

  function get_provinsi()
  {
    $query = "SELECT * FROM t_provinsi";
    return $this->db->query($query);
  }

  function produk_kat()
  {
    $query = "SELECT * FROM t_produk_kat";
    return $this->db->query($query);
  }

  function Produk_get($kd_produk)
  {
    $query = "SELECT * FROM t_produk where kd_produk='$kd_produk'";
    return $this->db->query($query);
  }

  function Agenda()
  {
    $query = "SELECT * FROM t_agenda";
    return $this->db->query($query);
  }

  function All_agenda()
  {
    $query = "SELECT * FROM t_agenda ta LEFT JOIN t_lokasi_venue tlv ON ta.kd_venue= tlv.kd_venue";
    return $this->db->query($query);
  }

  function Venue()
  {
    $query = "SELECT * FROM t_lokasi_venue";
    return $this->db->query($query);
  }

  function Seleksi_foto_hotel()
  {
    $query = "SELECT *, 
    CONCAT( 
      COALESCE(
        NULLIF(foto_1, 'NULL'), 
        NULLIF(foto_2, 'NULL'), 
        NULLIF(foto_3, 'NULL'), 
        NULLIF(foto_4, 'NULL'), 
        NULLIF(foto_5, 'NULL') 
      ) 
    ) AS foto_ke 
    FROM t_hotel WHERE foto_1 IS NOT NULL OR foto_2 IS NOT NULL OR foto_3 IS NOT NULL OR foto_4 IS NOT NULL OR foto_5 IS NOT NULL";
    return $this->db->query($query);
  }

  function Seleksi_foto_wisata()
  {
    $query = "SELECT *, 
    CONCAT( 
      COALESCE(
        NULLIF(foto_1, 'NULL'), 
        NULLIF(foto_2, 'NULL'), 
        NULLIF(foto_3, 'NULL'), 
        NULLIF(foto_4, 'NULL'), 
        NULLIF(foto_5, 'NULL') 
      ) 
    ) AS foto_ke 
    FROM t_wisata WHERE foto_1 IS NOT NULL OR foto_2 IS NOT NULL OR foto_3 IS NOT NULL OR foto_4 IS NOT NULL OR foto_5 IS NOT NULL";
    return $this->db->query($query);
  }

  function Seleksi_foto_galleri()
  {
    $query = "SELECT *, 
    CONCAT( 
      COALESCE(
        NULLIF(foto_1, 'NULL'), 
        NULLIF(foto_2, 'NULL'), 
        NULLIF(foto_3, 'NULL'), 
        NULLIF(foto_4, 'NULL'), 
        NULLIF(foto_5, 'NULL') 
      ) 
    ) AS foto_ke 
    FROM t_galleri WHERE foto_1 IS NOT NULL OR foto_2 IS NOT NULL OR foto_3 IS NOT NULL OR foto_4 IS NOT NULL OR foto_5 IS NOT NULL";
    return $this->db->query($query);
  }

  function level_peserta()
  {
    $query = "SELECT * FROM t_peserta_level";
    return $this->db->query($query);
  }

  function Jumlahdownload($id)
  {
    $query = "SELECT jumlah_download FROM t_materi where kd_materi='$id'";
    return $this->db->query($query);
  }

  function get_kabupaten($id)
  {
    $query = "SELECT * FROM t_kabupaten where prov_kd='$id'";
    return $this->db->query($query);
  }
  
  function Kabupaten()
  {
    $query = "SELECT * FROM t_kabupaten INNER JOIN t_provinsi ON t_provinsi.kd_provinsi= t_kabupaten.prov_kd";
    return $this->db->query($query);
  }

  function Produk()
  {
    $query = "SELECT * FROM t_produk INNER JOIN t_produk_kat ON t_produk.katagori_produk= t_produk_kat.kd_kat";
    return $this->db->query($query);
  }

  function Transaksi_order()
  {
    $query = "SELECT * FROM produk_order po 
    INNER JOIN produk_order_detail pod ON pod.order_kd = po.kd_order 
    INNER JOIN t_produk tp ON tp.kd_produk= pod.produk_id
    INNER JOIN t_pendaftaran tpen ON tpen.kd_daftar=po.pendaftar_kd";
    return $this->db->query($query);
  }

  function Transaksi_order_detail($id)
  {
    $query = "SELECT * FROM produk_order po 
    INNER JOIN produk_order_detail pod ON pod.order_kd = po.kd_order 
    INNER JOIN t_produk tp ON tp.kd_produk= pod.produk_id
    INNER JOIN t_pendaftaran tpen ON tpen.kd_daftar=po.pendaftar_kd
    LEFT JOIN t_provinsi tprov ON tprov.kd_provinsi=tpen.prov_kd
    LEFT JOIN t_prov_kab tprovkab ON tprovkab.kd_kab=tpen.kab_kd
    where po.kd_order='$id'";
    return $this->db->query($query);
  }

  function Undangan()
  {
    $query = "SELECT * FROM t_undangan 
    INNER JOIN t_provinsi ON t_provinsi.kd_provinsi= t_undangan.prov_kd 
    INNER JOIN t_kabupaten ON t_kabupaten.kd_kabupaten=t_undangan.kab_kd";
    return $this->db->query($query);
  }

  function Pendaftaran()
  {
    $query = "SELECT * FROM t_pendaftaran 
    INNER JOIN t_provinsi ON t_provinsi.kd_provinsi= t_pendaftaran.prov_kd 
    INNER JOIN t_prov_kab ON t_prov_kab.kd_kab= t_pendaftaran.kab_kd 
    INNER JOIN t_peserta_level ON t_peserta_level.kd_level_peserta=t_pendaftaran.level_peserta";
    return $this->db->query($query);
  }

  function Absen_Kehadiran()
  {
    $query = "SELECT * FROM t_absen_kehadiran 
    INNER JOIN t_agenda ON t_agenda.kd_agenda= t_absen_kehadiran.agenda_kd 
    INNER JOIN t_provinsi ON t_provinsi.kd_provinsi= t_absen_kehadiran.prov_kd 
    INNER JOIN t_kabupaten ON t_kabupaten.kd_kabupaten= t_absen_kehadiran.kab_kd 
    INNER JOIN t_peserta_level ON t_peserta_level.kd_level_peserta=t_absen_kehadiran.peserta_kd";
    return $this->db->query($query);
  }

  function Absen_KehadiranPeserta()
  {
    $query = "SELECT * FROM t_pendaftaran 
    INNER JOIN t_provinsi ON t_provinsi.kd_provinsi= t_pendaftaran.prov_kd 
    INNER JOIN t_prov_kab ON t_prov_kab.kd_kab= t_pendaftaran.kab_kd 
    INNER JOIN t_peserta_level ON t_peserta_level.kd_level_peserta=t_pendaftaran.level_peserta WHERE status_peserta='3' ORDER BY jam_verifikasi DESC";
    return $this->db->query($query);
  }

  public function getMax($table = null, $field = null)
	{
		$this->db->select_max($field);
		return $this->db->get($table)->row_array()[$field];
	}

  function Grafik_list()
  {
    $query = "SELECT tpl.nama_level_peserta, tpl.warna_level, SUM(CASE WHEN tpn.status_peserta = 1 THEN 1 ELSE 0 END) AS Tidak_Siap, SUM(CASE WHEN tpn.status_peserta = 2 THEN 1 ELSE 0 END) AS Siap 
    FROM t_peserta_level tpl 
    LEFT JOIN t_pendaftaran tpn ON tpl.kd_level_peserta = tpn.level_peserta 
    GROUP BY tpl.nama_level_peserta, tpl.warna_level";
    return $this->db->query($query);
  }

  function Grafik_list2()
  {
    $query = "SELECT tpk.nama_kab, COUNT(tpn.kd_daftar) Jumlah_Daftar, SUM(CASE WHEN tpn.status_peserta = 1 THEN 1 ELSE 0 END) AS Tidak_Siap, SUM(CASE WHEN tpn.status_peserta = 2 THEN 1 ELSE 0 END) AS Siap 
    FROM t_prov_kab tpk 
    INNER JOIN t_pendaftaran tpn ON tpn.kab_kd = tpk.kd_kab 
    GROUP BY tpk.nama_kab";
    return $this->db->query($query);
  }
} 
?>