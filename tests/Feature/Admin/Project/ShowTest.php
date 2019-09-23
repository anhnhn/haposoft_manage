<?php

namespace Tests\Feature\Admin\Project;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $response = $this->call('get', route('projects.show', $project->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.project.show');
        $response->assertViewHas('project');
    }

    public function testShowFail()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $response = $this->call('get', route('projects.show', $project->id+1));
        $this->assertEquals(404, $response->status());
    }
}
