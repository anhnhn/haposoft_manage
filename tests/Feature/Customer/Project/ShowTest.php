<?php

namespace Tests\Feature\Customer\Project;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginCustomer();
        $department = parent::createDepartment();
        $users = factory(User::class, 10)->create();
        $project = parent::createProject();
        $response = $this->call('get', route('customer-projects.show', $project->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('customer.project.show');
        $response->assertViewHas('project');
        $response->assertViewHas('users');
    }

    public function testShowFail()
    {
        parent::loginCustomer();
        $department = parent::createDepartment();
        $users = factory(User::class, 10)->create();
        $project = parent::createProject();
        $response = $this->call('get', route('customer-projects.show', $project->id+1));
        $this->assertEquals(404, $response->status());
    }
}
