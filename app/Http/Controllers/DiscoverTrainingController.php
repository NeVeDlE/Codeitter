<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class DiscoverTrainingController extends Controller
{
    public function __invoke()
    {
        return view('discover.trainings-index',[
            'trainings'=>Training::Discover()->paginate(10),
        ]);
    }
}
