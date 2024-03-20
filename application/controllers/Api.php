<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH. 'libraries/format.php';
require APPPATH. 'libraries/RestController.php';
require APPPATH. 'libraries/JWT.php';
require APPPATH. 'libraries/Key.php';

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Api extends RestController {

    function __construct() {
        parent::__construct();

        /* if($this->verifyToken() == false) {
            return $this->response([
                'status' => false,
                'messages' => 'Token tidak sesuai'
            ], 401);
            die();
        } */
    }

    function verifyToken() {
        $header = $this->input->request_headers()['Authorization'];
        $x = explode(" ", $header);
        $token = $x[1];
        if($token) {
            try{
                $decode = JWT::decode($token, new Key('2212336221', 'HS256'));
                if($decode) {
                    return true;
                }
            } catch(\Exception $e) {
                return false;
            }
        }
    }

    ## START AGENDA ##
    public function agenda_get($id = null) {
        if($id === null) {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_agenda',
                'order' => 'tgl_agenda DESC'
            ];
        } else {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_agenda',
                'where' => [
                    'kd_agenda' => $id
                ]
            ];
        }

        $res = $this->Modular->queryBuild($req)->result();
        $output = [];
        foreach($res as $key => $val) {
            $data = [
                'id' => $val->kd_agenda,
                'nama' => $val->nama_agenda,
                'tamu' => $val->tamu_utama,
                'tgl' => $val->tgl_agenda,
                'jam_mulai' => $val->jam_agenda,
                'jam_akhir' => $val->jam_akhir,
                'alamat' => $val->alamat,
                'naskah' => $val->naskah_pidato
            ];
            array_push($output, $data);
        }
        $this->response($output, 200);
    }

    public function agendaToday_get() {
        $req = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_agenda',
            'where' => [
                'tgl_agenda' => date('Y-m-d')
            ]
        ];
        $res = $this->Modular->queryBuild($req);

        $output = [];
        foreach($res->result() as $key => $val) {
            $data = [
                'id' => $val->kd_agenda,
                'nama' => $val->nama_agenda,
                'tamu' => $val->tamu_utama,
                'jam_mulai' => $val->jam_agenda,
                'jam_akhir' => $val->jam_akhir,
                'alamat' => $val->alamat,
                'naskah' => $val->naskah_pidato
            ];
            array_push($output, $data);
        }
        $this->response($output, 200);
    }

    public function stsAgenda_put($id) {
        $req = [
            'method' => 'update',
            'table' => 't_agenda',
            'where' => [
                'kd_agenda' => $id
            ],
            'value' => [
                'sts_agenda' => 2
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        $this->response([
            'status' => true,
            'messages' => 'Berhasil memperbarui status agenda'
        ], 200);
    }

    public function agendaTomorrow_get() {
        $req = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_agenda',
            'where' => [
                'tgl_agenda' => date('Y-m-d', strtotime("tomorrow"))
            ]
        ];
        $res = $this->Modular->queryBuild($req)->result(); 
        
        $output = [];
        foreach($res as $key => $val) {
            $data = [
                'id' => $val->kd_agenda,
                'nama' => $val->nama_agenda,
                'tamu' => $val->tamu_utama,
                'jam_mulai' => $val->jam_agenda,
                'jam_akhir' => $val->jam_akhir,
                'alamat' => $val->alamat,
                'naskah' => $val->naskah_pidato
            ];
            array_push($output, $data);
        }

        $this->response($output, 200);
    }

    public function agendaRiwayat_get() {
        $req = [
            'method' => 'get',
            'select' => [
                '*'
            ],
            'table' => 't_agenda',
            'where' => [
                'sts_agenda' => 2
            ]
        ];
        $res = $this->Modular->queryBuild($req)->result();
        $output = [];
        foreach($res as $key => $val) {
            $data = [
                'id' => $val->kd_agenda,
                'nama' => $val->nama_agenda,
                'tamu' => $val->tamu_utama,
                'tgl' => $val->tgl_agenda,
                'jam_mulai' => $val->jam_agenda,
                'jam_akhir' => $val->jam_akhir,
                'alamat' => $val->alamat,
                'naskah' => $val->naskah_pidato
            ];
            array_push($output, $data);
        }
        $this->response($output, 200);
    }

    public function agenda_post() {
        $req = [
            'method' => 'insert',
            'table' => 't_agenda',
            'value' => [
                'kd_agenda' => $this->post('id'),
                'nama_agenda' => $this->post('nama'),
                'tamu_utama' => $this->post('tamu'),
                'tgl_agenda' => $this->post('tgl'),
                'jam_agenda' => $this->post('jam_mulai'),
                'jam_akhir' => $this->post('jam_akhir'),
                'naskah_pidato' => $this->post('naskah'),
                'sts_agenda' => '1',
                'admin_ygbuat' => $this->post('admin'),
                'tgl_buat' => date('Y-m-d H:i:s'),
                'alamat' => $this->post('alamat')
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil membuat agenda baru'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }

    public function agenda_put($id) {
        $req = [
            'method' => 'update',
            'table' => 't_agenda',
            'where' => [
                'kd_agenda' => $id
            ],
            'value' => [
                'nama_agenda' => $this->put('nama'),
                'tamu_utama' => $this->put('tamu'),
                'tgl_agenda' => $this->put('tgl'),
                'jam_agenda' => $this->put('jam_mulai'),
                'jam_akhir' => $this->put('jam_akhir'),
                'naskah_pidato' => $this->put('naskah'),
                'alamat' => $this->put('alamat')
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil memperbarui agenda'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan',
                'error' => $res
            ], 409);
        }
        $this->response($req, 200);
    }

    public function agenda_delete($id) {
        $iddata = $id.'='.'t_agenda'.'='.'kd_agenda'.'='.'agenda'.'='.'0.jpg';
        $this->deleteData($iddata);
    }
    ## END AGENDA ##



    ## START ADMIN ##
    public function admin_get($id = null) {
        if($id === null) {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_admin',
                'join' => [
                    't_level_admin' => 't_level_admin.kd_level=t_admin.level_admin'
                ],
                'order' => 'kd_admin ASC'
            ];
        } else {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_admin',
                'join' => [
                    't_level_admin' => 't_level_admin.kd_level=t_admin.level_admin'
                ],
                'where' => [
                    'kd_admin' => $id
                ]
            ];
        }

        $res = $this->Modular->queryBuild($req)->result();
        $output = [];
        foreach($res as $key => $val) {
            $data = [
                'id' => $val->kd_admin,
                'username' => $val->username,
                'level' => $val->nama_level,
                'login' => $val->last_login
            ];
            array_push($output, $data);
        }
        $this->response($output, 200);
    }

    public function admin_post() {
        $req = [
            'method' => 'insert',
            'table' => 't_admin',
            'value' => [
                'kd_admin' => $this->post('id'),
                'level_admin' => $this->post('level'),
                'username' => $this->post('username'),
                'passwordnya' => password_hash($this->post('password'), PASSWORD_DEFAULT)
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil menambah admin baru'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }

    public function admin_put($id) {
        $request = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_admin',
            'where' => [
                'kd_admin' => $id
            ]
        ];
        $row = $this->Modular->queryBuild($request)->row();
        if($this->put('password') != '') {
            $password = password_hash($this->put('password'), PASSWORD_DEFAULT);
        } else {
            $password = $row->passwordnya;
        }

        $req = [
            'method' => 'update',
            'table' => 't_admin',
            'where' => [
                'kd_admin' => $id
            ],
            'value' => [
                'level_admin' => $this->put('level'),
                'username' => $this->put('username'),
                'passwordnya' => $password
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil memperbarui data admin'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan',
                'error' => $res
            ], 409);
        }
    }

    public function admin_delete($id) {
        $iddata = $id.'='.'t_admin'.'='.'kd_admin'.'='.'admin'.'='.'0.jpg';
        $this->deleteData($iddata);
    }
    ## END ADMIN ##



    ## START LEVEL ADMIN ##
    public function level_get($id = null) {
        if($id === null) {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_level_admin',
                'order' => 'kd_level ASC'
            ];
        } else {
            $req = [
                'method' => 'get',
                'select' => '*',
                'table' => 't_level_admin',
                'where' => [
                    'kd_level' => $id
                ]
            ];
        }

        $res = $this->Modular->queryBuild($req)->result();
        $output = [];
        foreach($res as $key => $val) {
            $data = [
                'id' => $val->kd_level,
                'nama' => $val->nama_level
            ];
            array_push($output, $data);
        }
        $this->response($output, 200);
    }

    public function level_post() {
        $req = [
            'method' => 'insert',
            'table' => 't_level_admin',
            'value' => [
                'kd_level' => $this->post('id'),
                'nama_level' => $this->post('nama')
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil menambah data'
            ], 200);
        } else {
            $this->response([
                'status' => true,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }

    public function level_put($id) {
        $req = [
            'method' => 'update',
            'table' => 't_level_admin',
            'where' => [
                'kd_level' => $id
            ],
            'value' => [
                'nama_level' => $this->put('nama')
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil memperbarui data level'
            ], 200);
        } else {
            $this->response([
                'status' => true,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }

    public function level_delete($id) {
        $iddata = $id.'='.'t_level_admin'.'='.'kd_level'.'='.'admin'.'='.'0.jpg';
        $this->deleteData($iddata);
    }
    ## END LEVEL ADMIN ##



    ## START PROFIL ##
    public function profil_get() {
        $request = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_profil',
            'where' => [
                'kd_profil' => '1'
            ]
        ];
        $row = $this->Modular->queryBuild($request)->row();

        $data = [
            'nama' => $row->nama_profil_sistem,
            'logo' => base_url('assets/img/profil/logo/'.$row->logo),
            'versi' => $row->versi
        ];
        $this->response($data, 200);
    }

    public function profil_put() {
        $request = [
            'method' => 'get',
            'select' => '*',
            'table' => 't_profil',
            'where' => [
                'kd_profil' => '1'
            ]
        ];
        $row = $this->Modular->queryBuild($request)->row();

        $config2['upload_path']  = './assets/img/profil/logo/';
        $config2['allowed_types']= 'png|jpg|jpeg|ico';
        $config2['file_name']    = $row->kd_profil;
        $config2['encrypt_name'] = TRUE;
        $config2['overwrite']    = TRUE;
        $this->load->library('upload', $config2);
        if ($this->upload->do_upload('logo')) {
            if(file_exists($img = 'assets/img/profil/logo/'.$row->logo)) {
                unlink($img);
            }
            $logo = $this->upload->data('file_name');
        } else {
            $logo = $row->logo;
        }

        $req = [
            'method' => 'update',
            'table' => 't_profil',
            'where' => [
                'kd_profil' => $row->kd_profil
            ],
            'value' => [
                'nama_profil_sistem' => $this->put('nama'),
                'logo' => $logo,
                'versi' => $this->put('versi')
            ]
        ];
        $res = $this->Modular->queryBuild($req);
        if($res) {
            $this->response([
                'status' => true,
                'messages' => 'Berhasil memperbarui profil sistem'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }
    ## END PROFIL ##



    ## DELETE FUNCTION FOR ALL ##
    function deleteData($params) {
        $x = explode('=', $params);
        $pk = $x['0'];
        $tabel = $x['1'];
        $field = $x['2'];
        $folder= $x['3'];
        $file = $x['4'];

        $req = [
            'method' => 'delete',
            'table' => $tabel,
            'where' => [$field => $pk]
        ];

        $res = $this->Modular->queryBuild($req);
        if($res) {
            if(file_exists($loc = 'assets/img/'.$folder.'/'.$file)) {
                unlink($loc);
            }
            $this->response([
                'status' => true,
                'messages' => 'Berhasil menghapus data'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Terjadi kesalahan'
            ], 409);
        }
    }
    ## END DELETE FUNCTION ##
}