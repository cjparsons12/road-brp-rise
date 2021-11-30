<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Oem\BrpRise\Exceptions\BrpDealerStoreApiException;
use Oem\BrpRise\Services\BrpDealerStoreApiService;
use Tests\TestCase;

class BrpDealerStoreApiTest extends TestCase
{
    /**
     * Test the BRP dealer store API with a valid dealer number
     */
    public function test_brp_dealer_store_api_success()
    {
        $store = BrpDealerStoreApiService::getDealerStore('692038');

        $this->assertEquals('0000692038', $store['dealer_number']);
        $this->assertEquals('FREEDOM CYCLE', $store['dealer_store_name']);
    }

    /**
     * Test the API with a bad dealer number
     */
    public function test_brp_dealer_store_api_exception()
    {
        $this->expectException(BrpDealerStoreApiException::class);

        BrpDealerStoreApiService::getDealerStore('000000');
    }
}
