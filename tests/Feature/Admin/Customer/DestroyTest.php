<?php

namespace Tests\Feature\Admin\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroySuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $data = [
            'name' => $customer->name,
            'email' => $customer->email,
            'address' => $customer->address,
            'phone' => $customer->phone,
            'role_name' => 'customer',
        ];
        $response = $this->call('delete', route('customers.destroy', $customer->id));
        $this->assertSoftDeleted('customers', $data);
        $response->assertRedirect(route('customers.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $response = $this->call('delete', route('customers.destroy', $customer->id+1));
        $response->assertStatus(404);
    }
}
