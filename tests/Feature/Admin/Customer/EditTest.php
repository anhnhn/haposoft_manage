<?php

namespace Tests\Feature\Admin\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $response = $this->call('get', route('customers.edit', $customer->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.update');
        $response->assertViewHas('customer');
    }

    public function testEditFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $response = $this->call('get', route('customers.edit', $customer->id+1));
        $this->assertEquals(404, $response->status());
    }
}
