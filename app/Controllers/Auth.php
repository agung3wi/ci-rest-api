<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request =  \Config\Services::request();;
    }


    public function login()
    {
        $input = $this->request->getJSON();
        $user  = $this->db->table('users')->get()->getRow();
        $data = [];

        if (is_null($user)) {
            $data["message"] = "Tidak ditemukan User";
        } else {
            $data["message"] = "Berhasil Login";
            $payload = [
                "user_id" => $user->id
            ];
            $data["token"] = JWT::encode($payload, env("APP_KEY", "XYZ"));
        }

        return $this->response->setJSON($data);
    }

    public function logout()
    {
        $data["message"] = "Berhasil Logout";
        return $this->response->setJSON($data);
    }
}
