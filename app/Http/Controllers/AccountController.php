<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoValidator;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function index()
    {

    }

    /**
     * [FRONT-END]: update the account info.
     *
     * @url:platform  POST:
     * @see:phpunit
     * @see:phpunit
     *
     * @param  InfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(InfoValidator $input)
    {
        session()->flash('message', 'The account information has been updated');


        return redirect()->back();
    }

    /**
     * [FRONT-END]:
     */
    public  function updateSecurity()
    {

    }
}
