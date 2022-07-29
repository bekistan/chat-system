<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;

class ListUser extends Component
{
    public $user;
     

    public function startConversation($userId)
    {
        $conversation = Conversation::firstOrCreate([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
        ]);

        return redirect('/messages')->with('selectedConversation', $conversation);
    }
    public function render()
    {
        $users = User::query()->where('id', 'not like', '%'.auth()->id().'%')->paginate(5);
        return view('livewire.list-user', ['users' => $users])->extends('layouts.app');
    }
}
