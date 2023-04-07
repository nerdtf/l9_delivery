<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param Client $client
     * @param Order $order
     * @return Response|bool
     */
    public function view(Client $client, Order $order)
    {
        return $client->id === $order->client_id;
    }


}
