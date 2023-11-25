<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdministratorResource;
use App\Models\Administrator;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdministratorController extends Controller
{
    private User $user;
    private Administrator $administrator;

    public function __construct(User $user, Administrator $administrator)
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
        return view('administrator',[
            'administrators' => $administrators,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministratorRequest $request): AdministratorResource
    {
        $userAttributes = $request->userAttributes();
        $user = $this->user::create($userAttributes);
        $administrator = $this->administrator::create($request->administratorAttributes($user->id));
        return new AdministratorResource($administrator);
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrator $administrator): AnonymousResourceCollection
    {
        return AdministratorResource::collection($administrator);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministratorRequest $request, Administrator $administrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator)
    {
        //
    }
}
