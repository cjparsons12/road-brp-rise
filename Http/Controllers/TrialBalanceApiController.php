<?php

namespace Oem\BrpRise\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class TrialBalanceApiController extends Controller
{
    /**
     * Pass the request on to the legacy site for processing
     * @param Request $request
     */
    public function store(Request $request)
    {
        $response = Http::withBasicAuth($request->getUser(), $request->getPassword())
            ->withBody($request->getContent(), 'application/xml')
            // TODO move URL to env
            ->post('http://brp.cjparsons.dev.softwareforge.local/facade/star/services/FinancialMetrics/Process');

        return response($response->body(), $response->status());
    }
}
