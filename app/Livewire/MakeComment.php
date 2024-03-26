<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Article;

class MakeComment extends Component
{
    public function makeComment()
    {
        $article = Article::find($this->article->id);

        if ($article) {
            $article->comments = $this->comment;
            $article->save();

            $this->comment = '';
            $this->success('Comment added successfully!');
        }
    }
}
