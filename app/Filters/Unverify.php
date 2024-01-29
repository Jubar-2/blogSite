<?php

namespace App\Filters;

use App\Models\OtpModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Unverify implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $otpModel = new OtpModel();
        $userName = $request->uri->getSegment(2);
        $requireOtp = $otpModel->getWhere(["user_Name" => $userName])->getRow();

        if ($requireOtp) {
            return true;
        } else {
            return redirect()->to(base_url('home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
