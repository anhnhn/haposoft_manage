<?php

namespace Tests\Feature\Admin\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $data = [
            'name' => str_repeat('a', 49),
        ];
        $response = $this->call('put', route('departments.update', $department->id), $data);
        $this->assertDatabaseHas('departments', [
            'name' => str_repeat('a', 49),
        ]);
        $response->assertRedirect(route('departments.index'));
    }

    public function testUpdateFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $data = [
            'name' => str_repeat('a', 51),
        ];
        $response = $this->call('put', route('departments.update', $department->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 50 characters.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
