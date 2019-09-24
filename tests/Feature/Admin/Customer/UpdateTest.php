<?php

namespace Tests\Feature\Admin\Customer;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $data = [
            'name' => str_repeat('a', 49),
            'email' => $customer->email,
            'password' => '123456',
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 12),
            'customer_id' => $customer->id,
            'role_name' => 'customer',
        ];
        $response = $this->call('put', route('customers.update', $customer->id), $data);
        $this->assertDatabaseHas('customers', [
            'name' => str_repeat('a', 49),
            'email' => $customer->email,
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 12),
            'role_name' => 'customer',
        ]);
        $response->assertRedirect(route('customers.index'));
    }

    public function testUpdateFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $data = [
            'name' => str_repeat('a', 51),
            'email' => '',
            'address' => '',
            'phone' => str_repeat('1', 9),
        ];
        $response = $this->call('put', route('customers.update', $customer->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 50 characters.',
            'email' => 'The email field is required.',
            'address' => 'The address field is required.',
            'phone' => 'The phone must be between 10 and 15 digits.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
