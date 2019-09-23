<?php

namespace Tests\Feature\Admin\Customer;

use App\Models\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        $data[] = factory(Customer::class, 5)->create();
        $response = $this->call('get', route('customers.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.customer.index');
        $response->assertViewHas('customers');
    }
}
