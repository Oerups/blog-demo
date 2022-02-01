<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class MainController extends Controller
{
    public function __construct(CommentService $commentService) {

        $this->commentService = $commentService;
    }
    public function index(): JsonResponse
    {
        return response()->json($this->commentService->all());
    }

    public function show(string $id): JsonResponse
    {
        $comment = $this->commentService->get($id);
        if ($comment === null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        return response()->json($comment);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'content' => 'required|string',
            'article_id' => 'required|string',
        ]);
        $comment = $this->commentService->create(array_merge($validatedData, [
            'email' => Auth::user()->email,
            'created_at' => date('Y-m-d H:i:s'),
        ]));

        return response()->json($comment);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'content' => 'required|string'
        ]);

        $comment = $this->commentService->update($id, $validatedData);
        if ($comment === null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        return response()->json($comment);
    }

    public function destroy(string $id): JsonResponse
    {
        $comment = $this->commentService->get($id);
        if ($comment === null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        $this->commentService->delete($id);
        return response()->json(['success' => 'Comment deleted']);
    }
}
