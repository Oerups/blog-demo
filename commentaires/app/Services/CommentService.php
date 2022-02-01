<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Http;
use Auth;
use Kreait\Firebase\Auth\UserRecord;

class CommentService
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient();
    }

    public function all(): array
    {
        $query = $this->firestore->collection('comments');
        $querySnapshot = $query->documents();

        $comments = [];
        foreach ($querySnapshot as $documentSnapshot) {
            $comments[] = $this->getData($documentSnapshot);
        }

        return $comments;
    }

    public function get(string $id): ?array
    {
        $documentSnapshot = $this->firestore->collection('comments')->document($id)->snapshot();

        return $documentSnapshot->exists() ? $this->getData($documentSnapshot): null;
    }

    public function create(array $data): ?array
    {
        $response = Http::withToken(Auth::user()->token)->get(env('ARTICLES_SERVICE_URL') . '/' . $data['article_id']);

        if ($response->status() !== 200) {
            throw new \Exception('Article not found');
        }

        $commentId = $this->firestore->collection('comments')->add($data)->id();

        return $this->get($commentId);
    }

    public function update(string $id, array $data): array
    {
        $this->firestore->collection('comments')->document($id)->set($data);

        return $this->get($id);
    }

    public function delete(string $id): void
    {
        $this->firestore->collection('comments')->document($id)->delete();
    }

    protected function getData($documentSnapshot): array
    {
        return array_merge(
            ['id' => $documentSnapshot->id()],
            $documentSnapshot->data()
        );
    }
}
