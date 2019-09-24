<?php

namespace Tests\Feature\Admin\Project;

use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $projects = factory(Project::class, 20)->create();
        $data = [
            'projectName' => $projects->first()->name,
        ];
        $response = $this->call('get', route('projects.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.project.index');
        $response->assertViewHas('projects');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $customer = parent::createCustomer();
        $projects = factory(Project::class, 20)->create();
        $data = [
            'projectName' => '',
        ];
        $response = $this->call('get', route('projects.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.project.index');
        $response->assertViewHas('projects');
    }
}
