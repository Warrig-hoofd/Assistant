<?php

namespace App\Http\Controllers;

use App\Notifications\DestroyUser;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class UserManagementController
 * @package App\Http\Controllers
 */
class UserManagementController extends Controller
{
    /**
     * UserManagementController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [FRONT-END]: Get the index overview for the user management.
     *
     * @url:platform  GET|HEAD: /users
     * @see:phpunit   UserManagementTest::userManagementIndex()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['users']       = User::paginate(15);
        $data['roles']       = Role::paginate(15);
        $data['permissions'] = Permission::paginate(15);

        return view('users.index', $data);
    }

    /**
     * [FRONT-END]: delete a user out off the system.
     *
     * @url:platform  GET|HEAD: /users/delete/{id}
     * @see:phpunit   UserManagementTest::destroyUser()
     *
     * @param  int $id the user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (User::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The account is deleted');

            Notification::send(auth()->user(), new DestroyUser());
        }

        return redirect()->back(302);
    }

    /**
     * [FRONT-END]: regenerate or re-generate the api token for the user.
     *
     * @url:platform  GET|HEAD: /users/token
     * @see:phpunit   UserManagementTest::TokenGenerate()
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateToken()
    {
        $userId = auth()->user()->id;
        $user   = User::find($userId);

        if ($user->update(['api_token' => str_random(40)])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The token is generated');
        }

        return redirect()->back();
    }
}
