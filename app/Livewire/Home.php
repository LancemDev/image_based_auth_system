<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Home extends Component
{
    public $news;

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
            // Log the entire response data to debug the issue
            dd($responseData);
            $this->news = [];
        }
    }

    public function render()
    {
        return view('livewire.home', ['news' => $this->news]);
    }
}