<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\Response;
use Config\Services;
use Exception;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        $request = \Config\Services::request();

        $token = $request->getHeaderLine("Authorization");

        if (!is_null($token)) {
            $request->token = $token;
        }

        try {
            $decoded = JWT::decode($token, env("APP_KEY", "XYZ"), ['HS256']);
            $request->authId = $decoded->user_id;
        } catch (BeforeValidException $ex) {
        } catch (SignatureInvalidException $ex) {
        } catch (Exception $ex) {
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $authId = $request->authId ?? null;
        // if (is_null($authId)) {
        //     $response = Services::response();

        //     $response->setStatusCode(401);
        //     $response->setJSON(["message" => "Unauthorized"]);

        //     return $response;
        // }
    }
}
