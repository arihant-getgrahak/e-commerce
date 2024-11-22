<?php

namespace App\Http\Controllers;

class ShipRocketController extends Controller
{
    protected $id;

    protected $token;

    public function __construct($id)
    {
        $this->id = $id;
        $this->token = env('SHIPROCKET_TOKEN');
    }
}
