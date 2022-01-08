<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TopicController extends Controller
{
    public function index(Training $training)
    {
        return view('dashboard.admin-trainings.topics.index', [
            'topics' => $training->topics,
            'training' => $training
        ]);
    }


    public function create(Training $training)
    {
        return view('dashboard.admin-trainings.topics.create', [
            'topics' => $training->topics,
            'training' => $training,
        ]);

    }

    public function store(Training $training)
    {
        $atr = array_merge($this->validateTopic(),
            [
                'training_id' => $training->id,
            ]);

        Topic::create($atr);
        return redirect('/trainings/' . $training->slug . '/topics')->with('success', 'Your Topic has been created');

    }

    public function edit(Training $training, Topic $topic)
    {

        return view('dashboard.admin-trainings.topics.edit', [
            'topic' => $topic,
            'training' => $training
        ]);

    }

    public function update(Training $training, Topic $topic)
    {
        $atr = $this->validateTopic($topic);
        $topic->update($atr);
        return redirect('/trainings/' . $training->slug . '/topics')->with('success', 'Your Topic has been updated');
    }

    public function destroy(Training $training, Topic $topic)
    {
        $topic->delete();
        return back()->with('success', 'Topic Deleted!');
    }

    protected function validateTopic(?Topic $topic = null): array
    {
        $topic ??= new Topic();
        return request()->validate([
            'name' => ['required', Rule::unique('topics', 'name')->ignore($topic)],
        ]);
    }

}
