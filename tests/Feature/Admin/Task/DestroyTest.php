<?php

namespace Tests\Feature\Admin\Task;

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
        $report = parent::createReport();
        $task = parent::createTask();
        $data = [
            'name' => $task->name,
            'content' => $task->content,
            'link' => $task->link,
            'user_id' => $task->user_id,
            'project_id' => $task->project_id,
        ];
        $response = $this->call('delete', route('tasks.destroy', $task->id));
        $this->assertSoftDeleted('tasks', $data);
        $this->assertDatabaseMissing('report_task', [
            'task_id' => $task->id,
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $user = parent::createUser();
        $task = parent::createTask();
        $task = factory(Task::class)->create();
        $response = $this->call('delete', route('tasks.destroy', $task->id+1));
        $response->assertStatus(404);
    }
}
