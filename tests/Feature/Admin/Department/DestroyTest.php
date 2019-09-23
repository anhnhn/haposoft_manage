<?php

namespace Tests\Feature\Admin\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroySuccessFully()
    {
        parent::loginAdmin();
        $department = parent::CreateDepartment();
        $user = parent::createUser();
        $data = [
            'name' => $department->name,
        ];
        $dataUser = [
            'name' => $user->name,
            'email' => $user->email,
            'department_id' => null,
        ];
        $response = $this->call('delete', route('departments.destroy', $department->id));
        $this->assertSoftDeleted('departments', $data);
        $this->assertDatabaseHas('users', $dataUser);
        $response->assertRedirect(route('departments.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $response = $this->call('delete', route('departments.destroy', $department->id+1));
        $response->assertStatus(404);
    }
}
