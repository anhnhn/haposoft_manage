<?php

namespace Tests\Feature\User\Task;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::createDepartment();
        parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 10)->create();
        $response = $this->call('get', route('user-tasks.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.task.index');
        $response->assertViewHas('tasks');
        $response->assertViewHas('user');
    }
}
