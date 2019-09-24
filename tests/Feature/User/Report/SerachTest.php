<?php

namespace Tests\Feature\User\Report;

use App\Models\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerachTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $reports = factory(Report::class, 15)->create();
        $data = [
            'reportName' => $reports->first()->name,
        ];
        $response = $this->call('get', route('reports.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.report.index');
        $response->assertViewHas('reports');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $reports = factory(Report::class, 15)->create();
        $data = [
            'projectName' => '',
        ];
        $response = $this->call('get', route('reports.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.report.index');
        $response->assertViewHas('reports');
    }
}
