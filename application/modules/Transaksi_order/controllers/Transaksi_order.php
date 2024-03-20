<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_order extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->_isLogged();
	}

	function _isLogged()
	{
		if ($this->session->userdata('status_sesi') != TRUE) {
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$data['title'] = "Transaksi Produk :: CSS XII Kota Cilegon";
		$data['judul'] = 'Transaksi Produk';
		$data['linkpage'] = '';
		$this->template->load('home', 'Transaksi_order', $data);
	}

	function load_transaksi_order()
	{
		$res = $this->Modular->Transaksi_order()->result();
		$output = array();
		
		foreach ($res as $key => $value) {
			$iddata = $value->kd_order.'=produk_order=kd_order=Transaksi_order=';
			//ststransksi//
			if($value->sts_transaksi =="0"){
			    $sts_transaksi='<span class="badge badge-warning">Baru</span>';
			}else if($value->sts_transaksi =="1"){
			    $sts_transaksi='<span class="badge badge-info">Proses Packing</span>';
			}else if($value->sts_transaksi =="2"){
			    $sts_transaksi='<span class="badge badge-primary">Kirim</span>';
			}else if($value->sts_transaksi =="3"){
			    $sts_transaksi='<span class="badge badge-success">Selesai</span>';
			}
			//sts bayar//
			if($value->status_bayar =="0"){
			    $sts_bayar='<span class="badge badge-warning">Belum Bayar</span>';
			}else{
			    $sts_bayar='<span class="badge badge-success">Lunas</span>';
			}
			//item//
			$itemnya=$this->db->query("SELECT * FROM produk_order_detail WHERE order_kd='".$value->kd_order."'")->num_rows();

			$data = [
				'id' => $value->kd_order,
				'ids' => $iddata,
				'kd_order'				 => $value->kd_order,
				'tgl_order'				 => $value->tgl_order,
				'nama_peserta'	 		 => $value->nama_peserta,
				'tlp_peserta'	 		 => $value->tlp_peserta,
				'nama_produk'	 		 => $value->nama_produk,
				'qty_order'		 		 => $itemnya,
				//'harga_order'		 	 => $value->harga_order,
				'jumlah_bayar'	 	 	 => number_format($value->jumlah_bayar),
				'status_kirim'	 	 	 => "<h6>".$sts_transaksi."</h6>",
				'status_bayar'	 	 	 =>  "<h6>".$sts_bayar."</h6>",
				'catatan'		 	    => $value->catatan,
			];
			array_push($output, $data);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	function form_tambah_transaksi_order()
	{
		$data['title'] 					= "Transaksi Order :: CSS XII Kota Cilegon";
		$data['judul'] 					= 'Form Transaksi Order';
		$data['url'] 					= base_url('Transaksi_order/Insert_transaksi_order');
		$data['id'] 					= rand(0, 99) . date('mdh');
		
		$data['Peserta']			    = $this->Modular->Pendaftaran()->result();
		$data['Produk']				 	= $this->Modular->Produk()->result();
		$data['qty_order']				= '';
		$data['harga_order']			= '';
		$data['alamat_kirim']			= '';
		
		$this->template->load('home', 'form_transaksi_order', $data);
	}

	function Insert_transaksi_order()
	{
		///// ID UNDANGAN /////
		$table1       = 'produk_order';
		$field1       = 'kd_order';

		$lastKode1    = $this->Modular->getMax($table1, $field1);

		$noUrut1      = (int) substr($lastKode1, -4, 4);
		$noUrut1++;

		$str1         = 'ODR';
		$kd_order  = $str1 . sprintf('%04s', $noUrut1);

		date_default_timezone_set('Asia/Jakarta');

		$req = [
			'method' => 'insert',
			'table' => 'produk_order',
			'value' => [
				'kd_order'		 		=> $kd_order,
				'pendaftar_kd'			=> $this->input->post('peserta'),
				'tgl_order'				=> date("Y-m-d H:i:s"),
				'alamat_kirim'			=> $this->input->post('alamat_kirim'),
			]
		];
		$req2 = [
			'method' => 'insert',
			'table' => 'produk_order_detail',
			'value' => [
				'order_kd'		 	=> $kd_order,
				'produk_id'			=> $this->input->post('produk'),
				'qty_order'			=> $this->input->post('qty_order'),
				'harga_order'		=> $this->input->post('harga_order'),
			]
		];
		
		$this->Modular->queryBuild($req);
		$this->Modular->queryBuild($req2);
		
		redirect(site_url('Transaksi_order'));
	}

	function edit_transaksi_order($id)
	{
		$row = $this->Modular->Transaksi_order_detail($id)->row();
		
		$data['title'] = "Detail Order :: CSS XII Kota Cilegon";
		$data['judul'] = 'Detail Order';
		$data['url'] 					= base_url('Transaksi_order/update_transaksi_order');
		$data['id'] = $id;

		$data['Peserta']			    = $this->Modular->Pendaftaran()->result();
		$data['Produk']				 	= $this->Modular->Produk()->result();
		$data['qty_order'] 				= $row->qty_order;
		$data['harga_order'] 			= $row->harga_order;
		$data['alamat_kirim'] 			= $row->alamat_kirim;
		
		$this->template->load('home', 'form_transaksi_order', $data);
		
	}

	function detail_order($id)
	{
		$row = $this->Modular->Transaksi_order_detail($id)->row();
		$itemnya=$this->db->query("SELECT * FROM produk_order_detail WHERE order_kd='".$row->kd_order."'");
		$itemnya1=$itemnya->num_rows();
		$data['title'] = "Detail Order :: CSS XII Kota Cilegon";
		$data['judul'] = 'Detail Order Nomor '.$id;
		$data['id'] = $id;
		
		
		if($row->sts_transaksi =="0"){
		    $sts_transaksi='<span class="badge badge-warning">Baru</span>';
		}else if($row->sts_transaksi =="1"){
		    $sts_transaksi='<span class="badge badge-info">Proses Packing</span>';
		}else if($row->sts_transaksi =="2"){
		    $sts_transaksi='<span class="badge badge-primary">Kirim</span>';
		}else if($row->sts_transaksi =="3"){
		    $sts_transaksi='<span class="badge badge-success">Selesai</span>';
		}
		//sts bayar//
		if($row->status_bayar =="0"){
		    $sts_bayar='<span class="badge badge-warning">Belum Bayar</span>';
		}else{
		    $sts_bayar='<span class="badge badge-success">Lunas</span>';
		}
		
		$data['kd_order'] 				= $row->kd_order;
		$data['tgl_order'] 				= $row->tgl_order;
		$data['nama_peserta'] 			= $row->nama_peserta;
		$data['tlp_peserta'] 			= $row->tlp_peserta;
		$data['totitem'] 				= $itemnya1;
		$data['jumlah_bayar'] 			= number_format($row->jumlah_bayar);
		$data['catatan'] 			    = $row->catatan;
		$data['status_kirim'] 			= $row->status_kirim;
		$data['status_bayar'] 			= $row->status_bayar;
		$data['nama_produk'] 			= $row->nama_produk;
		$data['harga'] 					= $row->harga;
		$data['satuan_produk'] 			= $row->satuan_produk;
		$data['email_peserta'] 			= $row->email_peserta;
		$data['stsbayar'] 			    = $sts_bayar;
		$data['ststrans'] 			    = $sts_transaksi;
		$data['kd_daftar']               = $row->kd_daftar;
		$data['namaprov']               = $row->nama_provinsi;
		$data['namakab']               = $row->nama_kab;
		//detail produk//
		$data['ordernya']              =$itemnya->result();

		$this->template->load('home', 'detail_order', $data);
		
	}

	function update_transaksi_order()
	{
		$req = [
			'method' => 'update',
			'table' => 'produk_order',
			'value' => [
				'pendaftar_kd'			=> $this->input->post('peserta'),
				'alamat_kirim'			=> $this->input->post('alamat_kirim'),
			],
			'where' => ['kd_order' => $this->input->post('id')]
		];
		$req2 = [
			'method' => 'update',
			'table' => 'produk_order_detail',
			'value' => [
				'produk_id'			=> $this->input->post('produk'),
				'qty_order'			=> $this->input->post('qty_order'),
				'harga_order'		=> $this->input->post('harga_order'),
			],
			'where' => ['order_kd' => $this->input->post('id')]
		];
		
		$this->Modular->queryBuild($req);
		$this->Modular->queryBuild($req2);
	}

	public function update_status($id, $status) {
        $req = [
            'method' => 'update',
            'table' => 'produk_order',
            'value' => [
                'status_kirim' => $status,
            ],
            'where' => ['kd_order' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Transaksi_order');
    }

	public function update_statuss($id, $status) {
        $req = [
            'method' => 'update',
            'table' => 'produk_order',
            'value' => [
                'status_bayar' => $status,
            ],
            'where' => ['kd_order' => $id]
        ];

        // Panggil fungsi untuk menjalankan query pembaruan status
        $this->Modular->queryBuild($req);

		redirect('Transaksi_order');
    }
}