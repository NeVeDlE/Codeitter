<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $with = [];
    protected $guarded = [];


    public function unreadMessagesCount()
    {
        return Message::where('receiver', auth()->id())->where('viewed', 0)
            ->count();
    }

    public function scopeFilter($query, $user)
    {
        $messages = Message::where('receiver', auth()->id())->where('sender', $user->id)
            ->where('viewed', 0)->get();

        foreach ($messages as $message) {
            if ($message->receiver == auth()->id() && !$message->viewed)
                $message->update([
                    'viewed' => 1
                ]);
        }
        $query->where('receiver', auth()->id())->where('sender', $user->id)
            ->orWhere('sender', auth()->id())->where('receiver', $user->id);
    }

    public function send()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function receive()
    {
        return $this->belongsTo(User::class, 'receiver');
    }

}
