<?php

namespace Tests\Feature\Admin\Project;

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
        $project = parent::createProject();
        $data = [
            'name' => str_repeat('a', 49),
            'start_date' => '2016-05-24',
            'end_date' => '2016-08-24',
            'customer_id' => $customer->id,
        ];
        $response = $this->call('put', route('projects.update', $project->id), $data);
        $this->assertDatabaseHas('projects', [
            'name' => str_repeat('a', 49),
            'start_date' => '2016-05-24',
            'end_date' => '2016-08-24',
            'customer_id' => $customer->id,
        ]);
        $response->assertRedirect(route('projects.index'));
    }

    public function testUpdateFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $data = [
            'name' => str_repeat('a', 101),
            'start_date' => '2016-11-26',
            'end_date' => '2016-10-26',
            'customer_id' => 'aaaa',
        ];
        $response = $this->call('put', route('projects.update', $project->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 100 characters.',
            'end_date' => 'The end date must be a date after start date.',
            'customer_id' => 'The customer\'s name must be a number.'
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
