<?php

namespace App\Controllers;


class Home extends BaseController
{
	public function index()
	{
		$data = $this->request->oke;
		return $this->response->setJSON($data);
	}
}
