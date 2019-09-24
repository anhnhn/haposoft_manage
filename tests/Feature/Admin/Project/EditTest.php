<?php

namespace Tests\Feature\Admin\Project;

use App\Models\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        parent::loginAdmin();
        $customer = factory(Customer::class, 5)->create();
        $project = parent::createProject();
        $response = $this->call('get', route('projects.edit', $project->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.project.update');
        $response->assertViewHas('project');
    }

    public function testEditFail()
    {
        parent::loginAdmin();
        $customer = factory(Customer::class, 5)->create();
        $project = parent::createProject();
        $response = $this->call('get', route('projects.edit', $project->id + 1));
        $this->assertEquals(404, $response->status());
    }
}
