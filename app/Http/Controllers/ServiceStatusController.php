<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketValidator;
use App\Notifications\TicketCreation;
use App\PlatformUpdate;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class ServiceStatusController
 * @package App\Http\Controllers
 */
class ServiceStatusController extends Controller
{
    /**
     * ServiceStatusController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [FRONT-END]: Get a overview for all the platform updates.
     *
     * @url:platform  GET|HEAD: /updates
     * @see:phpunit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['tickets'] = PlatformUpdate::paginate(15);
        return view('update.index', $data);
    }

    /**
     * [FRONT-END]: get the index about the update statuses.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit
     *
     * @param  TicketValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(TicketValidator $input)
    {
        if (PlatformUpdate::create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The ticket has been created.');

            // Internal notification trigger.
            $users = User::all();
            $users->notify(new TicketCreation);
        }

        return redirect()->back();
    }

    /**
     * [FRONT-END]: Get the info about a specific ticket.
     *
     * @param  int $id The id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data['ticket'] = PlatformUpdate::find($id);
        return view('tickets.show', $data);
    }

    /**
     * [FRONT-END]: Update a ticket in the database.
     *
     * @url:platform  POST:
     * @see:phpunit
     *
     * @param  TicketValidator $input
     * @param  int $id the id in the database.
     * @return \Illuminate\Http\RedirectResponsparam
     */
    public function update(TicketValidator $input, $id)
    {
        $ticket = PlatformUpdate::find($id);
        $ticket->update($input->except('_token'));

        session()->flash('class', 'alert alert-success');
        session()->flash('message', 'Ticket has been updated');

        return redirect()->back();
    }

    /**
     * [FRONT-END]: Delete the ticket out off the database.
     *
     * @url:platform:  GET|HEAD
     * @see:phpunit
     *
     * @param int $id the database id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (PlatformUpdate::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The ticket has been deleted');

            // Notification system trigger.
            $users = User::all();

            // TODO: create notification class.
            // $users->notify();
        }

        return redirect()->back();
    }
}
