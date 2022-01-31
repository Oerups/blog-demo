<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;

    public function __construct(ArticleService $articleService) {

        $this->articleService = $articleService;
    }
    public function index(): JsonResponse
    {
        return response()->json($this->articleService->getAllArticles());
    }

    public function show(string $id): JsonResponse
    {
        $article = $this->articleService->getArticleById($id);
        if ($article === null) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json($article);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required|array',
        ]);
        $article = $this->articleService->createArticle($validatedData);

        return response()->json($article);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'required|array',
        ]);
        $article = $this->articleService->updateArticle($id, $validatedData);
        if ($article === null) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json($article);
    }

    public function patch(Request $request, string $id): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'title' => 'string',
            'content' => 'string',
            'categories' => 'array',
        ]);
        $article = $this->articleService->patchArticle($id, $validatedData);
        if ($article === null) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        return response()->json($article);
    }

    public function destroy(string $id): JsonResponse
    {
        $article = $this->articleService->getArticleById($id);
        if ($article === null) {
            return response()->json(['error' => 'Article not found'], 404);
        }
        $this->articleService->deleteArticle($id);
        return response()->json(['success' => 'Article deleted']);
    }
}
