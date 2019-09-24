<?php

namespace Tests\Feature\Customer\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        $customer  = parent::loginCustomer();
        $response = $this->call('get', route('customer-customers.edit', $customer->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('customer.update');
        $response->assertViewHas('customer');
    }

    public function testEditFail()
    {
        parent::loginCustomer();
        $customer = parent::createCustomer();
        $response = $this->call('get', route('customer-customers.edit', $customer->id+1));
        $this->assertEquals(404, $response->status());
    }
}
