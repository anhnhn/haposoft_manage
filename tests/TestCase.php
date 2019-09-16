<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAdmin() {
        $admin = factory(Admin::class)->create();
        $this->actingAs($admin, 'admin');
    }

    public function createDepartment() {
        $department = factory(Department::class)->create();
        return $department;
    }

    public function createUser() {
        $user = factory(User::class)->create();
        return $user;
    }
}
