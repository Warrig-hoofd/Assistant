<?php

namespace App\Http\Controllers;

use App\Tickets;
use App\Transformers\TicketTransformer;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

/**
 * Class ApiTicketsController
 * @package App\Http\Controllers\Api
 */
class ApiTicketsController extends Controller
{
    /** @var Response $response The response contract for the api.*/
    protected $response;

    /** @var TicketTransformer $transformer The ticket transformer. */
    protected $transformer;

    /** @var array $headers used for setting the HTTP Headers */
    protected $headers;

    /** @var Validator $validation the validation rules. */
    protected $validation;

    /**
     * TicketsController constructor.
     *
     * @param Response $response
     * @param TicketTransformer $transformer
     */
    public function __construct(Response $response, TicketTransformer $transformer)
    {
        $this->response    = $response;
        $this->transformer = $transformer;

        // HTTP Headers
        $this->headers['Content-Type'] = 'application/json';

        // Validation rules.
        $this->validation[''] = '';

    }

    /**
     * [API]: Get all the tickets in the database.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   ApiTicketsTest::TicketsIndexWithData()
     * @see:phpunit   ApiTicketsTest::TicketsIndexWithOutData()
     *
     * @return mixed
     */
    public function index()
    {
        $tickets   = Tickets::count();
        $paginator = Tickets::paginate(15);

        if ($tickets === 0) {
            $data['status_code'] = $this->response->getStatusCode();
            $data['message']     = 'No tickets found.';

            return $this->response->withArray($data, $this->headers);
        } else {
            $data = $paginator->getCollection();

            $resource = new Collection($data, $this->transformer);
            $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            return $resource;
        }
    }

    /**
     * [API]: get a specific ticket in the database.
     *
     * @url:platform+.
     * r
     * @see:phpunit   ApiTicketsTest::TicketsShowFindId()
     * @see:phpunit   ApiTicketsTest::TicketsShowCannotFindId()
     *
     * @param  int $tid The id for the ticket in the database.
     * @return mixed
     */
    public function show($tid)
    {
        $ticket = Tickets::find($tid);

        if ($ticket) {
           return $this->response->withItem($ticket, $this->transformer);
        }

        $data['status_code'] = $this->response->getStatusCode();
        $data['message']     = 'There is no ticket found under this ID';

        return $this->response->errorWrongArgs($data, $this->headers);
    }

    /**
     * [API]: Store a ticket in the database.
     *
     * @url:platform
     * @see:phpunit   ApiTicketsTest::TicketsInsertWithoutErrors()
     * @see:phpunit   ApiTicketsTest::TicketsInsertWithErrors()
     *
     * @param  Request $input get all the form inputs.
     * @return mixed
     */
    public function store(Request $input)
    {
        $validation = Validator::make($input->all(), $this->validation);

        if ($validation->fails()) {
            $data['status_code'] = $this->response->getStatusCode();
            $data['message']     = 'Data validation failed';
            $data['errors']      = $validation;

            return $this->response->errorUnwillingToProcess($data, $this->headers);
        }

        $data['status_code'] = $this->response->getStatusCode();
        $data['message']     = 'Your feedback has been created';
        $data['data']        = $input->all();

        // TODO: create database insert.
        // TODO: create notification.

        return $this->response->withArray($data, $this->headers);
    }

    /**
     * [API]: Update a ticket in the database.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit   ApiTicketsTest::TicketsUpdateWithoutErrors()
     * @see:phpunit   ApiTicketsTest::TicketsUpdateWithErrors()
     *
     * @param  Request $input Get the inputs.
     * @param  int $tid The ticket id in the database.
     * @return mixed
     */
    public function update(Request $input, $tid)
    {
        //
    }

    /**
     * [API]: Delete a ticket out off the database.
     *
     * @url:platform  DELETE:
     * @see:phpunit   ApiTicketsTest::TestDeleteWithoutSuccess()
     * @see:phpunit   ApiTicketsTest::TestDeleteWithSuccess()
     *
     * @param  int $tid The ticket id in the database.
     * @return mixed
     */
    public function delete($tid)
    {
        if (Tickets::destroy($tid)) {
            // TODO: create notification.

            $data['status_code'] = $this->response->getStatusCode();
            $data['message']     = 'The ticket has been deleted';

            return $this->response->withArray($data, $this->headers);
        } else {
            $data['status_code'] = $this->response->getStatusCode();
            $data['message']     = 'No ticket found under this id.';

            return $this->response->errorNotFound($data, $this->headers);
        }
    }
}
