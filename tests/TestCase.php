<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Project;
use App\Models\Report;
use App\Models\Task;
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

    public function loginCustomer() {
        $customer = factory(Customer::class)->create();
        $this->actingAs($customer, 'customer');
        return $customer;
    }

    public function loginUser() {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'web');
        return $user;
    }

    public function createDepartment() {
        $department = factory(Department::class)->create();
        return $department;
    }

    public function createUser() {
        $user = factory(User::class)->create();
        return $user;
    }

    public function createCustomer() {
        $customer = factory(Customer::class)->create();
        return $customer;
    }

    public function createProject() {
        $project = factory(Project::class)->create();
        return $project;
    }

    public function createReport() {
        $report = factory(Report::class)->create();
        return $report;
    }

    public function createTask() {
        $task = factory(Task::class)->create();
        return $task;
    }
}
