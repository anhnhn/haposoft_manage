<?php

namespace Tests\Feature\User\Report;

use App\Models\Report;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 10)->create();
        $report = factory(Report::class)->create();
        $response = $this->call('get', route('user-reports.edit', $report->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.report.update');
        $response->assertViewHas('tasks');
        $response->assertViewHas('report');
        $response->assertViewHas('listTaskUser');
    }

    public function testShowReportFail()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 10)->create();
        $report = factory(Report::class)->create();
        $response = $this->call('get', route('user-reports.edit', $report->id+1));
        $this->assertEquals(404, $response->status());
    }
}
