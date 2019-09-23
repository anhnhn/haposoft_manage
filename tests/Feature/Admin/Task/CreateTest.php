<?php

namespace Tests\Feature\Admin\Task;

use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $projects = factory(Project::class, 15)->create();
        $response = $this->call('get', route('tasks.create'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.task.create');
        $response->assertViewHas('projects');
    }
}
