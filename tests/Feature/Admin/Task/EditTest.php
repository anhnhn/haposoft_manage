<?php

namespace Tests\Feature\Admin\Task;

use App\Models\Department;
use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $projects = factory(Project::class, 10)->create();
        $task = parent::createTask();
        $response = $this->call('get', route('tasks.edit', $task->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.update');
        $response->assertViewHas('task');
        $response->assertViewHas('projects');
    }

    public function testEditFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $projects = factory(Project::class, 10)->create();
        $task = parent::createTask();
        $response = $this->call('get', route('tasks.edit', $task->id+1));
        $this->assertEquals(404, $response->status());
    }
}
