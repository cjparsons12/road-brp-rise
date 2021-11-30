<?php

namespace Oem\BrpRise\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Oem\BrpRise\Exceptions\BrpDealerStoreApiException;

class BrpDealerStoreApiService
{
    /**
     * @throws BrpDealerStoreApiException
     */
    public static function getDealerStore(int $dealerNumber)
    {
        $response = Http::withToken(env('BRP_DEALER_STORE_API_KEY'), 'Apikey')
            ->get(env('BRP_DEALER_STORE_URL').'dealer_stores', [
                // dealer number must have ten digits so pad the front with 0's if necessary
                'dealer_number' => str_pad($dealerNumber, 10, '0', STR_PAD_LEFT)
            ]);

        if ($response->ok()) {
            $json = $response->json();
            return $json['result']['dealer_store'][0];
        } else {
            throw new BrpDealerStoreApiException($response->body(), $response->status());
        }
    }
}
