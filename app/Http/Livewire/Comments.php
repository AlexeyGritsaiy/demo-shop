<?php

namespace App\Http\Livewire;

use App\Comment;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Comments extends Component
{
    use WithPagination;

    public $newComment;
    public $ticketId ;

    protected $listeners = [
        'ticketSelected',
    ];

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

//    public function handleFileUpload($imageData)
//    {
//        $this->image = $imageData;
//    }

    public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);
        $createdComment = Comment::create([
            'body'              => $this->newComment,
            'user_id' =>1,
            'support_ticket_id' => 5,
        ]);
        $this->newComment = '';
        session()->flash('message', 'Comment added successfully 😁');
    }


    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully 😊');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket', $this->ticketId),
        ]);
    }
}