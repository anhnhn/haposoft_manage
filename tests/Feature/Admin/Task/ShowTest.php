<?php

namespace Tests\Feature\Admin\Task;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $task = parent::createTask();
        $response = $this->call('get', route('tasks.show', $task->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.show');
        $response->assertViewHas('task');
    }

    public function testShowFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $task = parent::createTask();
        $response = $this->call('get', route('tasks.show', $task->id + 1));
        $this->assertEquals(404, $response->status());
    }
}
