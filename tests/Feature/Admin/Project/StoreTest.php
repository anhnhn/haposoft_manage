<?php

namespace Tests\Feature\Admin\Project;

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
        $customer = parent::createCustomer();
        $response = $this->call('post', route('projects.store'), [
            'name' => str_repeat('a', 99),
            'start_date' => '2016-05-24',
            'end_date' => '2016-06-24',
            'customer_id' => $customer->id,
        ]);
        $this->assertDatabaseHas('projects', [
            'name' => str_repeat('a', 99),
            'start_date' => '2016-05-24',
            'end_date' => '2016-06-24',
            'customer_id' => $customer->id,
        ]);
        $response->assertRedirect(route('projects.index'));
    }

    public function testStoreFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $data = [
            'name' => str_repeat('a', 101),
            'start_date' => '2019-09-25',
            'end_date' => '2019-09-10',
            'department_id' => $customer->id,
        ];
        $response = $this->call('post', route('projects.store'), $data);
        $errors = [
            'name' => 'The name may not be greater than 100 characters.',
            'end_date' => 'The end date must be a date after start date.'
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
