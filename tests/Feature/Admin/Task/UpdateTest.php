<?php

namespace Tests\Feature\Admin\Task;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $task = parent::createTask();
        $data = [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('abc', 500),
            'user_id' => $user->id,
            'project_id' => $project->id,
            'hours' => '11',
        ];
        $response = $this->call('put', route('tasks.update', $task->id), $data);
        $this->assertDatabaseHas('tasks', [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('abc', 500),
            'user_id' => $user->id,
            'project_id' => $project->id,
            'hours' => '11',
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testUpdateFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $task = parent::createTask();
        $data = [
            'name' => str_repeat('a', 256),
            'content' => str_repeat('abc', 500),
            'user_id' => '',
            'project_id' => 'abc',
            'hours' => 'abc',
        ];
        $response = $this->call('put', route('tasks.update', $task->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 255 characters.',
            'hours' => 'The hours must be a number.',
            'project_id' => 'The project\'s name must be a number.',
            'user_id' => 'The user\'s name must be a number.'
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
