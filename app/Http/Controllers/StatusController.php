<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest\StoreStatusRequest;
use App\Http\Requests\TaskRequest\StoreTaskRequest;
use App\Http\Requests\StatusRequest\UpdateStatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
{
    private Status $status;
    private Task  $task;

    public function __construct(Status $status, Task $task)
    {
        $this->status = $status;
        $this->task = $task;
    }

    /** 
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $statuse = StatusResource::collection($this->status::all());
        return view('statuses.index', compact('statuses'));
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('statuses.create');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Status $status): RedirectResponse
    {
        $this->status::create($status->resourceAttributes());

        return redirect()->route('statuses.index')->with('flash.success', 'Operation successfully completed');
    }

     /** 
     * Display the specified resource.
     */
    public function show(Status $status): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $status = new StatusResource ($status);
        return view('statuses.show', compact('status'));
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $status = new StatusResource ($status);
        return view('statuses.edit', compact('status'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request,Status $status): RedirectResponse
    {
        $status->update($request->statusAttributes());
        return redirect()->route('statuses.show', ['id' => $status->id])->with('flash.success', 'Operation successfully completed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status): RedirectResponse
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('flash.success', 'Operation successfully completed');
    }
}
