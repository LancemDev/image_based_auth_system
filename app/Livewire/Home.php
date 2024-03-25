<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Mary\Traits\Toast;
use Illuminate\Support\Str;


class Home extends Component
{
    use Toast;
    public $news;
    public $username;
    public $link;
    public $showModal = false;
    public bool $modal6 = false;


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
            $this->news = $responseData['articles'];
        } else {
            // Log the entire response data to debug the issue  yevhj
            dd($responseData);
            $this->news = [];
        }
    }
    

    public function render()
    {
        return view('livewire.home', ['news' => $this->news]);
    }
}