<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TicketsTest
 */
class TicketsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /tickets
     * ROUTE:    tickets.index
     *
     * @test
     * @group all
     * @group tickets
     */
    public function IndexOverview()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user);
        $this->seeIsAuthenticatedAs($user);
        $this->visit(route('tickets.index'));
        $this->seeStatusCode(200);
    }
}
