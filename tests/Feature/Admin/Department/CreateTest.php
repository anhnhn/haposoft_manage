<?php

namespace Tests\Feature\Admin\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSuccessFully()
    {
        parent::loginAdmin();
        $response = $this->call('post', route('departments.store'), [
            'name' => str_repeat('a', 50),
        ]);
        $this->assertDatabaseHas('departments', [
            'name' => str_repeat('a', 50),
        ]);
        $response->assertRedirect(route('departments.index'));
    }

    public function testCreateFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $data = [
            'name' => $department->name,
        ];
        $response = $this->call('post', route('departments.store'), $data);
        $errors = [
            'name' => 'The name has already been taken.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
