<?php

namespace Tests\Feature\Admin\Department;

use App\Models\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $departments = factory(Department::class, 5)->create();
        $data = [
            'userName' => $departments->first()->name,
        ];
        $response = $this->call('get', route('departments.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.department.index');
        $response->assertViewHas('departments');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $departments = factory(Department::class, 5)->create();
        $data = [
            'departmentName' => '',
        ];
        $response = $this->call('get', route('departments.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.department.index');
        $response->assertViewHas('departments');
    }
}
