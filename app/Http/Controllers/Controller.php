<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\AdministratorResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ProjectHolderResource;
use App\Models\Administrator;
use App\Models\Employee;
use App\Models\ProjectHolder;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private function getProfile(User $user, string $model)
    {
        $userQuery = call_user_func($model. "::select", '*');
        return $userQuery->Where('user_id', '=', $user->id)->first();
    }

    public function getUser(User $user): AdministratorResource|EmployeeResource|ProjectHolderResource|null
    {
        return match ($user->getRoleAttribute()->name) {
            UserRole::ADMINISTRATOR->value => new AdministratorResource($this->getProfile($user, 'App\Models\Administrator')),
            UserRole::EMPLOYEE->value => new EmployeeResource($this->getProfile($user, 'App\Models\Employee')),
            UserRole::PROJECT_HOLDER->value => new ProjectHolderResource($this->getProfile($user, 'App\Models\ProjectHolder')),
            default => null
        };
    }

    public function dashboard(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $administrator = Administrator::all()->count();
        $employee = Employee::all()->count();
        $projectHolder = ProjectHolder::all()->count();
        return view('pages.pages.dashboard', compact('administrator', 'employee', 'projectHolder'));
    }
}
