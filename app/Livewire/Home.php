<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use App\Models\Article;


class Home extends Component
{
    use Toast;
    public $news;
    public $username;
    public $link;
    public $url;
    public $showModal = false;
    public bool $commentModal = false;
    public bool $modal6 = false;
    public bool $modal11 = false;
    public $newComment;
    public $commentInput;
    public $articleUrl;
    public $liked = [];

    public function like($url)
    {
        $article = Article::where('url', $url)->first();

        if ($article) {
            $article->liked = !$article->liked;
            $article->save();

            $this->liked[$url] = $article->liked;
            $this->success($article->liked ? 'Liked!' : 'Unliked!');
        }
    }
    public function showCommentModal($url)
    {
        $this->commentModal = true;
        // $this->success('OPening the modal');
        $this->articleUrl = $url;
        // $this->success('OPening the modal');
    }

    public function comment()
    {
        $article = Article::where('url', $this->articleUrl)->first();

        if ($article) {
            $article->comments = $this->commentInput;
            $article->save();

            $this->success('Comment added successfully!');
            $this->commentModal = false;
            $this->commentInput = '';
        }
    }

    public function share($url)
    {
        $this->link = $url;
        $this->modal6 = true;
    }
    public function copyToClipboard()
    {
        $this->dispatch('copyToClipboard', $this->link);
        $this->success('Link copied to clipboard!');
    }

    public function mount()
    {
        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => 'Kenya',
            'apiKey' => env('NEWS_API_KEY'),
        ]);
    
        $responseData = $response->json();
    
        if (isset($responseData['articles'])) {
            foreach (array_slice($responseData['articles'], 0, 15) as $article) {
                Article::updateOrCreate(
                    ['url' => $article['url']],
                    [
                        'title' => $article['title'],
                        'url' => $article['url'], // corrected 'urlToImage' to 'url
                        'description' => $article['description'],
                        'urlToImage' => $article['urlToImage'],
                        'publishedAt' => $article['publishedAt'],

                    ]
                );
            }
    
            $this->news = Article::all();
        } else {
            // Log the entire response data to debug the issue
            dd($responseData);
            $this->news = [];
        }
    }

    public function delete($url)
    {
        // Find the article in the database
        $article = Article::where('url', $url)->first();

        // Check if the article exists
        if ($article) {
            // Delete the article
            $article->delete();

            // Show a success message
            $this->success('Article deleted successfully!');

            // Refresh the component to show the updated list of articles
            $this->mount();
        } else {
            // Show an error message
            $this->error('Article not found!');
        }
    }
    

    public function render()
    {
        return view('livewire.home', ['news' => $this->news]);
    }
}