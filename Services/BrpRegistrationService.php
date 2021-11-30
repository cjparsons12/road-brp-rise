<?php

namespace Oem\BrpRise\Services;

use App\Models\User;
use App\Models\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\RegistrationService;
use Exception;
use Oem\BrpRise\Services\BrpDealerStoreApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class BrpRegistrationService extends RegistrationService
{
    public function register(array $args)
    {
        $brpStore = BrpDealerStoreApiService::getDealerStore($args['registration_code']);

        parent::register(collect($args)->union([
            'store_name' => $brpStore['dealer_store_name'],
            'address' => $brpStore['address']['street'],
            'city' => $brpStore['address']['city'],
            'state' => $brpStore['address']['state'],
            'country' => $brpStore['address']['country'],
        ])->all());
    }
}
