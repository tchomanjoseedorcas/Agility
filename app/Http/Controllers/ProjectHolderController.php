<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\ProjectHolderRequest\StoreProjectHolderRequest;
use App\Http\Requests\ProjectHolderRequest\UpdateProjectHolderRequest;
use App\Http\Resources\ProjectHolderResource;
use App\Models\ProjectHolder;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class ProjectHolderController extends Controller
{
    private User $user;
    private ProjectHolder $projectHolder;

    public function __construct(User $user, ProjectHolder $projectHolder, private readonly Role $role)
    {
        $this->user = $user;
        $this->projectHolder = $projectHolder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $projectHolders = ProjectHolderResource::collection($this->projectHolder::all());
        return view('projectHolders.index', compact('projectHolders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('projectHolders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectHolderRequest $request): RedirectResponse
    {
        $role = $this->role::query()->where('name', UserRole::ADMINISTRATOR->value)->first();

        $userAttributes = $request->userAttributes();
        $user = $this->user::create($userAttributes);
        $user->assignRole($role);

        $this->projectHolder::create($request->projectHolderAttributes($user->id));

        return redirect('projectHolders.index')->with('flash.success', 'opération éffectuée');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectHolder $projectHolder): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $projectHolder = new ProjectHolderResource($projectHolder);
        return view('projectHolders.show', compact('projectHolder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectHolder $projectHolder): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $projectHolder = new ProjectHolderResource($projectHolder);
        return view('projectHolders.edit', compact('projectHolder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectHolderRequest $request, ProjectHolder $projectHolder): RedirectResponse
    {
        $projectHolder->user()->update($request->userAttributes());
        return redirect()->route('projectHolders.show', [
            'id' => $projectHolder->id
        ])->with('flash.success', 'opération éffectuée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectHolder $projectHolder): RedirectResponse
    {
        $projectHolder->delete();
        $this->projectHolder->user()->delete();
        return redirect('projectHolders.index')->with('flash.success', 'opération éffectuée');
    }
}
