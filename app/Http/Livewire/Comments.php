<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Carbon\Carbon;
use Livewire\WithPagination;


class Comments extends Component
{
    // public $comments;

    use WithPagination;

    public $newComment;

    // public function mount()
    // {
        // $initialComments = Comment::latest()->paginate(2);
        // $this->comments = $initialComments;
    // }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'newComment' => 'required|max:255',
        ]);
    }

    public function addComment() 
    {
        $this->validate(['newComment' => 'required|max:255']);
        if($this->newComment == ''){
            return;
        }
        $createdComment = Comment::create([
            'body' => $this->newComment, 'user_id' => 1
        ]);

        // $this->comments->prepend($createdComment);
        $this->newComment = "";

        session()->flash('message', 'Comment successfully created.');
    }
    
    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        // $this->comments = $this->comments->except($commentId);

        session()->flash('message', 'Comment deleted successfully.');
        // dd($comment);
    }

    public function render()
    {
        return view('livewire.comments', [
           'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
