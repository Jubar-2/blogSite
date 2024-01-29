<?php

namespace App\Filters;

use App\Models\Recovery;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;


class RecoverAllowd implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        $recoveryModel = new Recovery();
        $userName = $request->uri->getSegment(2);
        $recoveryData = $recoveryModel->getWhere(["user_Name" => $userName])->getRow();
        if ($recoveryData) {
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
