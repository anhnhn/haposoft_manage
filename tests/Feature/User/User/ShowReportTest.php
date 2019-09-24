<?php

namespace Tests\Feature\User\User;

use App\Models\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowReportTest extends TestCase
{
    use RefreshDatabase;

    public function testShowRePortSuccessFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        $reports = factory(Report::class, 10)->create();
        $response = $this->call('get', route('users.showReport', $user->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.report.show-report');
        $response->assertViewHas('user');
        $response->assertViewHas('reports');
    }

    public function testShowReportFail()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        $reports = factory(Report::class, 10)->create();
        $response = $this->call('get', route('users.showReport', $user->id+1));
        $this->assertEquals(404, $response->status());
    }
}
