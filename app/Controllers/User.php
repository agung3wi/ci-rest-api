<?php

namespace App\Controllers;

class User extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request =  \Config\Services::request();
    }

    public function index()
    {
        $data = $this->db->table('users')->get()->getResult();
        return $this->response->setJSON($data);
    }

    public function show($id)
    {
        $row = $this->db->table('users')->where("id", $id)->get()->getRow();
        return $this->response->setJSON($row);
    }

    public function update($id)
    {
        $input = $this->request->getJSON();
        $builder = $this->db->table('users');

        $data = [
            'username' => $input->username,
            'password'    => password_hash($input->password, PASSWORD_BCRYPT),
            'active' => 'Y'
        ];

        $builder->where("id", $id)->update($data);
        $row = $this->db->table('users')->where("id", $id)->get()->getRow();
        return $this->response->setJSON($row);
    }

    public function delete($id)
    {
        $row = $this->db->table('users')->where("id", $id)->get()->getRow();
        $builder = $this->db->table('users');
        $builder->where("id", $id)->delete();
        return $this->response->setJSON($row);
    }

    public function create()
    {
        $input = $this->request->getJSON();
        $builder = $this->db->table('users');

        $data = [
            'username' => $input->username,
            'password'    => password_hash($input->password, PASSWORD_BCRYPT),
            'active' => 'Y'
        ];

        $builder->insert($data);
        $id = $this->db->insertID();
        $row = $this->db->table('users')->where("id", $id)->get()->getRow();

        return $this->response->setJSON($row);
    }
}
