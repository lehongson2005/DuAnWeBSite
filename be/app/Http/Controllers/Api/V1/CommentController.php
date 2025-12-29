<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCommentRequest;
use App\Http\Requests\Api\V1\UpdateCommentRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Event $event)
    {
        // Get only top-level comments, replies can be loaded on demand
        $comments = $event->comments()
                          ->whereNull('parent_id')
                          ->with(['user', 'replies'])
                          ->paginate($request->input('per_page', 10));

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['event_id'] = $event->id;

        $comment = Comment::create($data);

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'replies', 'event']);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment); // Example of authorization
        
        $comment->update($request->validated());
        
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); // Example of authorization

        $comment->delete();
        
        return response()->noContent();
    }
}