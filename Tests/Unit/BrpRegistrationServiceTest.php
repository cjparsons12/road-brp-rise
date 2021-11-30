<?php

namespace Tests\Feature;

use Oem\BrpRise\Services\BrpDealerStoreApiService;
use Oem\BrpRise\Exceptions\BrpDealerStoreApiException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Oem\BrpRise\Services\BrpRegistrationService;
use Tests\TestCase;

class BrpRegistrationServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the BRP dealer store API with a valid dealer number
     */
    public function test_register(BrpRegistrationService $brpRegistrationService)
    {
        $brpRegistrationService->register([
            'registration_code' => 692038,
            'name' => 'Test',
            'email' => 'register_test@mailinator.com',
            'password' => 12345678
        ]);

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
