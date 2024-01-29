<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Verify implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        $userMode = new UserModel();
        $userName = $request->uri->getSegment(2);
        $requireOtp = $userMode->getWhere(["userName" => $userName])->getRow();
        if ($session->has('user')) {
            if ($requireOtp) {
                if (!$requireOtp->position) {
                    return redirect()->to(base_url('verify/' . $userName));
                } else {
                    return true;
                }
            } else {
                return redirect()->to(base_url('login'));
            }
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
