<?php

namespace Tests\Feature\Admin\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $response = $this->call('get', route('customers.show', $customer->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.show');
        $response->assertViewHas('customer');
    }

    public function testShowFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $response = $this->call('get', route('customers.show', $customer->id + 1));
        $this->assertEquals(404, $response->status());
    }
}
