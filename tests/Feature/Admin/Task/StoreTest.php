<?php

namespace Tests\Feature\Admin\Task;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $response = $this->call('post', route('tasks.store'), [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('abc', 500),
            'user_id' => $user->id,
            'project_id' => $project->id,
            'hours' => '11',
        ]);
        $this->assertDatabaseHas('tasks', [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('abc', 500),
            'user_id' => $user->id,
            'project_id' => $project->id,
            'hours' => '11',
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testStoreFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $data = [
            'name' => str_repeat('a', 256),
            'content' => str_repeat('abc', 500),
            'user_id' => 'abc',
            'project_id' => '',
            'hours' => 'abc',
        ];
        $response = $this->call('post', route('tasks.store'), $data);
        $errors = [
            'name' => 'The name may not be greater than 255 characters.',
            'hours' => 'The hours must be a number.',
            'project_id' => 'The project\'s name field is required.',
            'user_id' => 'The user\'s name must be a number.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
