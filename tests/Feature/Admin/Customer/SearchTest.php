<?php

namespace Tests\Feature\Admin\Customer;

use App\Models\Customer;
use DemeterChain\C;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $customers = factory(Customer::class, 5)->create();
        $data = [
            'customerName' => $customers->first()->name,
        ];
        $response = $this->call('get', route('customers.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.index');
        $response->assertViewHas('customers');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $customers = factory(Customer::class, 5)->create();
        $data = [
            'customerName' => '',
        ];
        $response = $this->call('get', route('customers.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.index');
        $response->assertViewHas('customers');
    }
}
