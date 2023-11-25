<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Resources\AdministratorResource;
use App\Models\Administrator;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{
    private User $user;
    private Administrator $administrator;

    public function __construct(User $user, Administrator $administrator, private readonly Role $role)
    {
        $this->user = $user;
        $this->administrator = $administrator;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $administrators = AdministratorResource::collection($this->administrator::all());
        return view('administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministratorRequest $request): RedirectResponse
    {
        $role = $this->role::query()->where('name', UserRole::ADMINISTRATOR->value)->first();

        $userAttributes = $request->userAttributes();
        $user = $this->user::create($userAttributes);
        $user->assignRole($role);

        $this->administrator::create($request->administratorAttributes($user->id));

        return redirect('administrators.index')->with('flash.success', 'opération éffectuée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrator $administrator): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $administrator = new AdministratorResource($administrator);
        return view('administrators.show', compact('administrator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $administrator = new AdministratorResource($administrator);
        return view('administrators.edit', compact('administrator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministratorRequest $request, Administrator $administrator): RedirectResponse
    {
        $administrator->user()->update($request->userAttributes());
        return redirect()->route('administrators.show', [
            'id' => $administrator->id
        ])->with('flash.success', 'opération éffectuée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator): RedirectResponse
    {
        $administrator->delete();
        $this->administrator->user()->delete();
        return redirect('administrators.index')->with('flash.success', 'opération éffectuée');
    }
}
