<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any customers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    public function viewProject(Customer $customer, Project $project)
    {
        return $customer->id == $project->customer_id;
    }

    public function create(User $user)
    {
        //
    }

    public function update(Customer $customer, Customer $customerUpdate)
    {
        return $customer->id == $customerUpdate->id;
    }

    public function delete(User $user, Customer $customer)
    {
        //
    }

    public function restore(User $user, Customer $customer)
    {
        //
    }

    public function forceDelete(User $user, Customer $customer)
    {

    }
}
