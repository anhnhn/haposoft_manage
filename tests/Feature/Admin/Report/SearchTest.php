<?php

namespace Tests\Feature\Admin\Report;

use App\Models\Project;
use App\Models\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        $projects = factory(Project::class, 15)->create();
        $data = [
            'projectName' => $projects->first()->name,
            'customerName' => $projects->first()->customer->name,
        ];
        $response = $this->call('get', route('user-projects.search', $user->id), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.home');
        $response->assertViewHas('projects');
    }

    public function testSearchNullFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        $projects = factory(Project::class, 15)->create();
        $data = [
            'projectName' => '',
            'customerName' => '',
        ];
        $response = $this->call('get', route('user-projects.search', $user->id), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.home');
        $response->assertViewHas('projects');
    }
}
