<?php

namespace Tests\Feature\Admin\Task;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        factory(Task::class, 15)->create();
        $response = $this->call('get', route('tasks.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.index');
        $response->assertViewHas('tasks');
    }
}
