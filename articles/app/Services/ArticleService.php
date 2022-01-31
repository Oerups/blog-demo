<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class ArticleService
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient();
    }

    public function getAllArticles()
    {
        $query = $this->firestore->collection('articles');
        $querySnapshot = $query->documents();

        $articles = [];
        foreach ($querySnapshot as $documentSnapshot) {
            $articles[] = $this->getArticleData($documentSnapshot);
        }

        return $articles;
    }

    public function getArticleById(string $id): ?array
    {
        $documentSnapshot = $this->firestore->collection('articles')->document($id)->snapshot();

        return $documentSnapshot->exists() ? $this->getArticleData($documentSnapshot): null;
    }

    public function createArticle(array $data): array
    {
        $articleId = $this->firestore->collection('articles')->add($data)->id();

        return $this->getArticleById($articleId);
    }

    public function updateArticle(string $id, array $data): array
    {
        $this->firestore->collection('articles')->document($id)->set($data);

        return $this->getArticleById($id);
    }

    public function patchArticle(string $id, array $data): array
    {
        $this->firestore->collection('articles')->document($id)->update(['test'], ['test']);

        return $this->getArticleById($id);
    }

    public function deleteArticle(string $id): void
    {
        $this->firestore->collection('articles')->document($id)->delete();
    }

    protected function getArticleData($documentSnapshot): array
    {
        return array_merge(
            ['id' => $documentSnapshot->id()],
            $documentSnapshot->data(),
        );
    }
}
