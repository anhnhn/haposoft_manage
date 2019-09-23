<?php

namespace Tests\Feature\Admin\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSuccessFully()
    {
        parent::loginAdmin();
        $response = $this->call('get', route('customers.create'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.create');
    }
}
