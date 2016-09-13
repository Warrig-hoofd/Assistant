<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class PlatformController
 * @package App\Http\Controllers
 */
class PlatformController extends Controller
{
    /**
     * PlatformController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert()
    {
        
    }
}
