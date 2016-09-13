<?php

use App\Notifications\DestroyUser;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;

/**
 * Class UserManagementTest
 */
class UserManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /users
     * ROUTE:    users.index
     *
     * @test
     * @group all
     * @group users
     */
    public function UserManagementIndex()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user);
        $this->seeIsAuthenticatedAs($user);
        $this->visit(route('users.index'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD: /users/token
     * ROUTE:    users.token
     *
     * @test
     * @group all
     * @group users
     */
    public function TokenGenerate()
    {
        $user  = factory(App\User::class)->create();

        // Database checksum
        $oldDb = ['id' => $user->id, 'api_token' => $user->api_token];

        $this->actingAs($user);
        $this->seeIsAuthenticatedAs($user);
        $this->seeInDatabase('users', $oldDb);
        $this->visit(route('users.token'));
        $this->dontSeeInDatabase('users', $oldDb);
        $this->seeStatusCode(200);
        $this->session([
            'class'     => 'alert alert-success',
            'message'   => 'The token is generated',
        ]);
    }

    /**
     * GET|HEAD: /users/destroy/{id}
     * ROUTE:    users.destroy
     *
     * @test
     * @group all
     * @group users
     */
    public function destroyUser()
    {
        Notification::fake();
        $users = factory(App\User::class, 2)->create();

        $this->actingAs($users[0]);
        $this->seeIsAuthenticatedAs($users[0]);
        $this->visit(route('users.destroy', ['id' => $users[1]->id]));
        $this->dontSeeInDatabase('users', ['id' => $users[1]->id]);
        $this->seeStatusCode(200);
        $this->session([
            'class'   => 'alert alert-success',
            'message' => 'The account is deleted.',
        ]);

        Notification::assertSentTo($users[0], DestroyUser::class);
    }
}
