<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $with = [];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeMessagesUsers($query)
    {
        //getting user ids for every message sent
        $messages = Message::select('sender', 'receiver')->where('receiver', auth()->id())
            ->orWhere('sender', auth()->id())->latest()->get();

        //making a queue to pass ids to in the order messages were sent

        $ids = new \SplQueue();
        foreach ($messages as $message) {
            $vis[$message->sender] = 0;
            $vis[$message->receiver] = 0;
            $ids->enqueue($message->sender);
            $ids->enqueue($message->receiver);
        }

        //using array as Visited array
        //to save if I already have this id or nah
        $ids->rewind();
        while ($ids->valid()) {
            if (!$vis[$ids->current()]) {
                $values[] = $ids->current();
                $vis[$ids->current()] = 1;
            }
            $ids->next();
        }
        //I sorted the ids in the order the messages were sent and now
        //getting the users from the DB in the same order

        if (!empty($values)) $query->whereIn('id', $values)
            ->orderByRaw('FIELD(id,' . implode(", ", $values) . ')');

        else  $query->where('id', 0);
    }


    public function scopeDiscover($query)
    {
        $query->withCount('followers')->orderBy('followers_count', 'desc')->with('followers');
    }

    public function scopeFilter($query, $search)
    {
        $query->where('username', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed', 'followed_by');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_by', 'followed');
    }

    public function view()
    {
        return $this->hasMany(View::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }


}
