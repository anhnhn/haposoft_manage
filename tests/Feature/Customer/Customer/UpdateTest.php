<?php

namespace Tests\Feature\Customer\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateSuccessFully()
    {
        $customer = parent::loginCustomer();
        $data = [
            'name' => str_repeat('a', 49),
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 12),
            'email' => $customer->email,
            'customer_id' => $customer->id
        ];
        $response = $this->call('put', route('customer-customers.update', $customer->id), $data);
        $this->assertDatabaseHas('customers', [
            'name' => str_repeat('a', 49),
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 12),
            'email' => $customer->email,
        ]);
        $response->assertRedirect(route('customer-projects.index'));
    }

    public function testUpdateFail()
    {
        $customer = parent::loginCustomer();
        $data = [
            'name' => str_repeat('a', 51),
            'address' => '',
            'phone' => str_repeat('1', 9),
            'email' => $customer->email,
            'id' => $customer->id
        ];
        $response = $this->call('put', route('customer-customers.update', $customer->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 50 characters.',
            'address' => 'The address field is required.',
            'phone' => 'The phone must be between 10 and 15 digits.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
