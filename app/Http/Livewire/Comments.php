<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
class Comments extends Component
{
    public $comments = [
            [
                'body' => 'i would like to introduce myself as a good laravel developer that work really hard and honest with other members.',
                'created_at' => '3 min ago',
                'creator' => 'Umayantha'
            ]
        ];


    public $newComment;

    public function addComment() 
    {
        $this->comments[] = 
        [
            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'Umayantha'
        ];
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
