<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH. 'libraries/format.php';
require APPPATH. 'libraries/RestController.php';
require APPPATH. 'libraries/JWT.php';
require APPPATH. 'libraries/ExpiredException.php';
require APPPATH. 'libraries/BeforeValidException.php';
require APPPATH. 'libraries/SignatureInvalidException.php';
require APPPATH. 'libraries/JWK.php';

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class Middleware extends RestController {
    function __construct() {
        parent::__construct();
    }

    function confToken() {
        $config['exp'] = 3600;
        $config['secretkey'] = '2212336221';
        return $config;
    }

    public function login_post() {
        $req = [
            'method' => 'get',
            'select' => [
                '*'
            ],
            'table' => 't_admin',
            'where' => [
                'username' => $this->post('username')
            ]
        ];
        $res = $this->Modular->queryBuild($req);

        if($res->num_rows() > 0) {
            $row = $res->row();

            if(password_verify($this->post('password'), $row->passwordnya)) {
                $exp = time() + 3600;
                $token = [
                    'iss' => 'apprestservice',
                    'aud' => 'user',
                    'iat' => time(),
                    'nbf' => time() + 10,
                    'exp' => $exp,
                    'data' => [
                        'username' => $this->post('username'),
                        'password' => $this->post('password')
                    ]
                ];
                $jwt = JWT::encode($token, $this->confToken()['secretkey'], 'HS256');
                $this->response([
                    'status' => true,
                    'messages' => 'Berhasil mengautentikasi pengguna',
                    'data' => [
                        'token' => $jwt,
                        'expired' => $exp
                    ]
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'messages' => 'Password tidak sesuai'
                ], 401);
            }
        } else {
            $this->response([
                'status' => false,
                'messages' => 'Pengguna tidak ditemukan'
            ], 404);
        }
    }    
}