<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Illuminate\Support\Facades\Log;

class MyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $request->oke = "ac";
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if ($request->oke == "abc") {
            $response = Services::response();
            $response->setStatusCode(401);
            $response->setJSON(["error" => true]);

            return $response;
        }
    }
}
