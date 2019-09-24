<?php

namespace Tests\Feature\User\Project;

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
        $reports = factory(Report::class, 15)->create();
        $data = [
            'reportName' => $reports->first()->name,
            'date' => $reports->first()->created_at
        ];
        $response = $this->call('get', route('user-reports.search', $user->id), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.report.show-report');
        $response->assertViewHas('reports');
        $response->assertViewHas('user');
    }

    public function testSearchNullFully()
    {
        $department = parent::createDepartment();
        $user = parent::loginUser();
        $reports = factory(Report::class, 15)->create();
        $data = [
            'reportName' => '',
            'date' => '',
        ];
        $response = $this->call('get', route('user-reports.search', $user->id), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.report.show-report');
        $response->assertViewHas('reports');
        $response->assertViewHas('user');
    }
}
