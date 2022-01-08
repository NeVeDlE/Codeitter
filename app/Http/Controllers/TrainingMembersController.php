<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TrainingMembersController extends Controller
{
    public function index(Training $training)
    {
        return view('dashboard.admin-trainings.users.index', [
            'members' => TrainingMember::where('training_id', $training->id)->with('member')->paginate(10),
            'training' => $training,
        ]);
    }

    public function show(Training $training)
    {

        return view('dashboard.admin-trainings.users.owners-instructors-index', [
            'members' => TrainingMember::Owner($training->id)->with('member')->paginate(10),
            'training' => $training,
        ]);

    }

    public function create(Training $training)
    {
        return view('dashboard.admin-trainings.users.create', [
            'training' => $training
        ]);
    }

    public function store(Training $training)
    {
        $atr = array_merge($this->validateMember(), [
            'user_id' => auth()->id(),
            'training_id' => $training->id,
            'role' => 'member'
        ]);
        TrainingMember::create($atr);
        return redirect('/trainings')->with('success', 'You have joined ' . $training->name . 'successfully');

    }

    public function edit(Training $training, TrainingMember $member)
    {


        return view('dashboard.admin-trainings.users.edit', [
            'member' => $member,
            'training' => $training
        ]);
    }

    public function update(Training $training, TrainingMember $member)
    {
        $atr = request()->validate([
            'role' => 'required'
        ]);

        if ($member->role == 'owner' && request()->role != 'owner') {
            if (!TrainingMember::oneOwner($member)) {
                throw ValidationException::withMessages(['owner' => 'There must be at least one owner for this training']);
            }
        }
        $member->update($atr);
        return back()->with('success', 'This member as been updated');

    }

    public function destroy(Training $training, TrainingMember $member)
    {

        if ($member->role == 'owner') {
            if (!TrainingMember::oneOwner($member)) {
                throw ValidationException::withMessages(['owner' => 'There must be at least one owner for this training']);
            }
        }
        $member->delete();
        return back()->with('success', 'Member Deleted!');
    }

    protected function validateMember(?TrainingMember $member = null)
    {
        $member ??= new TrainingMember();
        return request()->validate([
            'user_id' => ['required', Rule::unique('training_members', 'user_id')->ignore($member->id)],
        ]);
    }


}
