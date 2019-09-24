<?php

namespace Tests\Feature\User\User;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateReportTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateRePortSuccessFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        $tasks = factory(Task::class, 10)->create();
        $response = $this->call('get', route('users.createReport', $user->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.report.create');
        $response->assertViewHas('user');
        $response->assertViewHas('tasks');
    }

    public function testCreateReportFail()
    {
        parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 10)->create();
        $response = $this->call('get', route('users.createReport', $user->id+1));
        $this->assertEquals(404, $response->status());
    }
}
