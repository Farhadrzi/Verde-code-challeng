<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class AppBaseController extends Controller
{
    public ResponseHelper $response;
    public function __construct()
    {
        $this->response =  new ResponseHelper();
    }
}
