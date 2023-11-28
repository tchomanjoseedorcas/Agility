<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class StatusController extends Controller
{
    private Status $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $statuses = StatusResource::collection($this->status::all());
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Status $status)
    {

    }

     /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request,Status $status)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {

    }
}
