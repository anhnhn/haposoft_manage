<?php

namespace Tests\Feature\Admin\Customer;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreSuccessFully()
    {
        parent::loginAdmin();
        $response = $this->call('post', route('customers.store'), [
            'name' => str_repeat('a', 49),
            'email' => 'namanh@gmail.com',
            'password' => '123456',
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 11),
            'role_name' => 'customer',
        ]);
        $this->assertDatabaseHas('customers', [
            'name' => str_repeat('a', 49),
            'email' => 'namanh@gmail.com',
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 11),
            'role_name' => 'customer',
        ]);
        $response->assertRedirect(route('customers.index'));
    }

    public function testStoreFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $data = [
            'name' => str_repeat('a', 51),
            'email' => $customer->email,
            'password' => '12345',
            'address' => '',
            'phone' => str_repeat('1', 9),
            'role_name' => 'customer',
        ];
        $response = $this->call('post', route('customers.store'), $data);
        $errors = [
            'email' => 'The email has already been taken.',
            'password' => 'The password must be at least 6 characters.',
            'name' => 'The name may not be greater than 50 characters.',
            'address' => 'The address field is required.',
            'phone' => 'The phone must be between 10 and 15 digits.',

        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
