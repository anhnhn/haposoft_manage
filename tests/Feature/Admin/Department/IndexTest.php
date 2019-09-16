<?php

namespace Tests\Feature\Admin\Department;

use App\Models\Department;
use DemeterChain\C;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        $data[] = factory(Department::class, 5)->create();
        $response = $this->call('get', route('departments.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.department.index');
        $response->assertViewHas('departments');
    }
}
