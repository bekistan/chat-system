<?php

namespace App\Http\Livewire;
use App\Models\Conversation;
use Livewire\Component;
use App\Models\Messages;

class ListCoversationAndMessage extends Component
{ 
    public $body;
    public $selectedConversation;
    public function mount(){
        $this->selectedConversation=Conversation::query()
        ->where('sender_id',auth()->id())
        ->orwhere('receiver_id',auth()->id())
        ->first();
    }
    public function sendMessage()
    {
        Messages::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->body
        ]);

        $this->reset('body');

        $this->viewMessage($this->selectedConversation->id);
    }

    public function viewMessage($conversationId)
    {
        $this->selectedConversation=Conversation::findOrFail($conversationId);
        
    }
    public function render()
    {
        $conversations=Conversation::query()
        ->where('sender_id',auth()->id())
        ->orwhere('receiver_id',auth()->id())
        ->get();
        return view('livewire.list-coversation-and-message',['conversations'=>$conversations])->extends('layouts.app');
    }
   
}
