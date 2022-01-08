<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class TrainingController extends Controller
{

    public function index()
    {
        return view('dashboard.trainings.index', [
            'trainings' => Training::TrainingsMember()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('dashboard.trainings.create');
    }

    public function store()
    {
        $atr = array_merge($this->validateTraining(), [
            'slug' => $this->generateSlug(request()->name),
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('trainingsThumbnails')
        ]);

        $training = Training::create($atr);
        TrainingMember::create([
            'user_id' => auth()->id(),
            'training_id' => $training->id,
            'role' => 'owner',
        ]);
        return redirect('/trainings')->with('success', 'Your trainings has been published');
    }

    public function edit(Training $training)
    {
        return view('dashboard.trainings.edit', [
            'training' => $training,
        ]);
    }


    public function update(Training $training)
    {
        $atr = $this->validateTraining($training);
        if (isset($atr['thumbnail'])) {
            $atr['thumbnail'] = request()->file('thumbnail')->store('trainingsThumbnails');
        }
        $training->update($atr);
        return redirect('/trainings')->with('success', 'Your trainings has been updated');
    }

    public function destroy(Training $training)
    {

        $training->delete();
        return redirect('/trainings')->with('success', 'Your trainings has been deleted');

    }


    protected function validateTraining(?Training $training = null): array
    {
        $training ??= new Training();
        return request()->validate([
            'name' => 'required',
            'thumbnail' => $training->exists ? ['image'] : ['required', 'image'],
            'tag' => 'required',
            'description' => 'required',
            'start' => 'date',
            'end' => 'date',
        ]);
    }

    protected function generateSlug($name): string
    {
        $name = Str::slug($name);
        $id = 1;
        $slug = $name;

        while (Validator::make(['slug' => $slug], [
            'slug' => [Rule::unique('trainings', 'slug')],
        ])->fails()) {
            $slug = $name . $id++;
        };
        return $slug;
    }

}
