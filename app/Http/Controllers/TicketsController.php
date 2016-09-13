<?php

namespace App\Http\Controllers;

use App\Tickets;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class TicketsController
 * @package App\Http\Controllers
 */
class TicketsController extends Controller
{
    /**
     * TicketsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [FRONT-END]: Ticket overview.
     *
     * @url:platform  GET|HEAD: /tickets
     * @see:phpunit   TicketsTest::IndexOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // TODO: Complete view.
        $data['tickets'] = Tickets::all();
        return view('tickets.index', $data);
    }

    /**
     * [FRONT-END]: Insert a new ticket through the web interface.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert()
    {
        return redirect()->back();
    }

    /**
     * [FRONT-END]: delete a ticket out off the system.
     *
     * @param  int $id the ticket id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Tickets::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The ticket has been deleted.');
        }

        return redirect()->back();
    }

}
