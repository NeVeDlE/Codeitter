<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMember extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function oneOwner(TrainingMember $currentMember): bool
    {
        $members = TrainingMember::get();
        $bool = false;
        foreach ($members as $member) {
            if ($member->role == 'owner' && $currentMember->id != $member->id) {
                $bool = true;
                break;
            }
        }
        return $bool;
    }

    public function scopeOwner($query, $training)
    {
        $query->where('training_id', $training)->whereIn('role', ['owner', 'instructor']);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
