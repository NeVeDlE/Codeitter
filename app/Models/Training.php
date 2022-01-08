<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, $search)
    {
        $query->where('name', 'like', '%' . $search . '%')->with('members');
    }

    public function scopeTrainingsMember($query){
        $trainingsMember=TrainingMember::where('user_id',auth()->id())->get();
        foreach ($trainingsMember as $training){
            $ids[]=$training->training_id;
        }
        $query->whereIn('id',$ids);
    }

    public function scopeDiscover($query)
    {
        $query->withCount('members')->orderBy('members_count', 'desc')->with('members');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function posts()
    {
        return $this->hasMany(TrainingPost::class, 'training_id');
    }

    public function members()
    {
        return $this->hasMany(TrainingMember::class, 'training_id');
    }


}
