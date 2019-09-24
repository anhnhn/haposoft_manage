<?php

namespace Tests\Feature\Admin\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $response = $this->call('get', route('departments.edit', $department->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.department.update');
        $response->assertViewHas('department');
    }

    public function testEditFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $response = $this->call('get', route('departments.edit', $department->id+1));
        $this->assertEquals(404, $response->status());
    }
}
