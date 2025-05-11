<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Filterjwt implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // JWT logic — sementara ini boleh kosong untuk testing
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // After filter logic (optional)
        return;
    }
}
