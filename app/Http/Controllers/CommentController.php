<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest\StoreCommentRequest;
use App\Http\Requests\CommentRequest\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

   
    public function create(): View
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        Comment::create($request->validated());
        return redirect()->route('comments.index')->with('flash.success', 'Opération effectuée');
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function show(Comment $comment): View
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function edit(Comment $comment): View
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommentRequest $request
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function update(UpdateCommentRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());
        return redirect()->route('comments.show', ['comment' => $comment])->with('flash.success', 'Opération effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect()->route('comments.index')->with('flash.success', 'Opération effectuée');
    }
}