<?php

namespace Tests\Feature\Admin\Task;

use App\Models\Report;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $tasks = factory(Task::class, 15)->create();
        $data = [
            'taskName' => $tasks->first()->name,
        ];
        $response = $this->call('get', route('tasks.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.index');
        $response->assertViewHas('tasks');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $tasks = factory(Task::class, 15)->create();
        $data = [
            'taskName' => '',
        ];
        $response = $this->call('get', route('tasks.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.index');
        $response->assertViewHas('tasks');
    }
}
