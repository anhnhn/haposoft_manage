<?php

namespace Tests\Feature\Admin\Report;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $report = parent::createReport();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $tasks = factory(Task::class, 5)->create();
        $response = $this->call('get', route('reports.show', $report->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.report.show');
        $response->assertViewHas('report');
        $response->assertViewHas('tasks');
    }

    public function testShowFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $report = parent::createReport();
        $response = $this->call('get', route('reports.show', $report->id + 1));
        $this->assertEquals(404, $response->status());
    }
}
