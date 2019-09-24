<?php

namespace Tests\Feature\Admin\Project;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroySuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $user = parent::createUser();
        $task = factory(Task::class)->create();
        $dataTask = [
            'name' => $task->name,
            'hours' => $task->hours,
            'content' => $task->content,
            'user_id' => $task->user_id,
            'project_id' => $task->project_id,
        ];
        $data = [
            'id' => $project->id,
            'name' => $project->name,
            'customer_id' => $customer->id,
        ];
        $response = $this->call('delete', route('projects.destroy', $project->id));
        $this->assertSoftDeleted('tasks', $dataTask);
        $this->assertDatabaseMissing('project_user', [
            'project_id' => $project->id,
        ]);
        $this->assertSoftDeleted('projects', $data);
        $response->assertRedirect(route('projects.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $user = parent::createUser();
        $task = factory(Task::class)->create();
        $response = $this->call('delete', route('projects.destroy', $project->id+1));
        $response->assertStatus(404);
    }
}
