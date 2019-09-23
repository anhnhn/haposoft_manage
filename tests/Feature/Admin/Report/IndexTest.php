<?php

namespace Tests\Feature\Admin\Report;

use App\Models\Customer;
use App\Models\Report;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        factory(Report::class, 15)->create();
        $response = $this->call('get', route('reports.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.report.index');
        $response->assertViewHas('reports');
    }
}
