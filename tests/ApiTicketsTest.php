<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ApiTicketsTest
 */
class ApiTicketsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsShowFindId()
    {
        //
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsShowCannotFindId()
    {
        //
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsIndexWithData()
    {
        //
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsIndexWithoutData()
    {
        $user = factory(App\User::class)->create();

        $json['status_code'] = 200;
        $json['message']     = 'No tickets found.';

        $this->get('/api/tickets?api_token='. $user->api_token);
        $this->seeJsonEquals($json);
        $this->seeStatusCode(200);
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsInsertWithoutErrors()
    {

    }

    /**
     * POST:
     * ROUTE:
     *
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsInsertWithErrors()
    {
        $user = factory(App\User::class)->create();

        $this->post('/api/tickets?api_token='. $user->api_token, []);
        $this->seeJsonEquals(['error' => [
            'code'      => 'GEN-WRONG-ARGS',
            'http_code' => 400,
            'message'   => [
                'errors' => [
                    'category_id'   => ['The category id field is required.'],
                    'creator_email' => ['The creator email field is required.'],
                    'creator_name'  => ['The creator name field is required.'],
                    "description"   => ['The description field is required.'],
                    "platform"      => ['The platform field is required.'],
                    "title"         => ['The title field is required.'],
                ],

                'message'       => 'Data validation failed',
                'status_code'   => 200
            ]
        ]]);
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TestDeleteWithSuccess()
    {
        $user = factory(App\User::class, 2)->create();gi
    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TestDeleteWithoutSuccess()
    {

    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsUpdateWithoutErrors()
    {

    }

    /**
     * @test
     * @group all
     * @group api
     * @group tickets
     */
    public function TicketsUpdateWithErrors()
    {

    }
}

