<?php

namespace App\Http\Controllers;

use App\Events\WebhookEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $product = $request->all();
        event(new WebhookEvent($product));
    }
}
