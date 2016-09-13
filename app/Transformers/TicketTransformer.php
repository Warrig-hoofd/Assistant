<?php

namespace App\Transformers;

use App\Tickets;
use League\Fractal\TransformerAbstract;

/**
 * Class TicketTransformer
 * @package App\Transformers
 */
class TicketTransformer extends TransformerAbstract
{
    /**
     * [TRANSFORMER]: Transform the api output for the tickets.
     *
     * @param Tickets $tickets The tickets database model.
     */
    public function transform(Tickets $tickets)
    {

    }
}