<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Carbon\Carbon;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Comments extends Component
{
    // public $comments;

    use WithPagination;

    public $newComment;

    public $image;

    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected',
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

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

        $image = $this->storeImage();

        if($this->newComment == ''){
            return;
        }
        $createdComment = Comment::create([
            'body' => $this->newComment, 'user_id' => 1,
            'image' => $image,
            'support_ticket_id' => $this->ticketId
        ]);

        // $this->comments->prepend($createdComment);
        $this->newComment = "";
        $this->image = "";

        session()->flash('message', 'Comment successfully created.');
    }
    
    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();
        // $this->comments = $this->comments->except($commentId);

        session()->flash('message', 'Comment deleted successfully.');
        // dd($comment);
    }

    public function storeImage()
    {
        if(!$this->image)
        {
            return null;
        }
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function render()
    {
        return view('livewire.comments', [
           'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }
}
