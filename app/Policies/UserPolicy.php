<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Project;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    public function showReport(User $user, Report $report)
    {
        return $user->id == $report->user_id;
    }

    public function viewProjectUser(User $user, Project $project)
    {
        $data = [];
        foreach ($project->users as $item) {
            array_push($data, $item->id);
        }
        return in_array($user->id, $data);
    }

    public function create(User $user)
    {
        //
    }

    public function createReport(User $user, User $userCreate)
    {
        return $user->id == $userCreate->id;
    }

    public function update(User $user, User $userUpdate)
    {
        return $user->id == $userUpdate->id;
    }

    public function updateReport(User $user, Report $report)
    {
        return $user->id == $report->user_id;
    }

    public function delete(User $user, User $model)
    {
        //
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }


}
