<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\NotificationCate;
use  App\Models\Notify;
use  App\Models\Scores;
use  App\Models\Students;

class StudentLayoutController extends Controller
{
    public function index()
    {
        $listCateNotifi = NotificationCate::orderBy('id', 'desc')->get();
        $user = students::find(Auth::user()->id)->first();
        return view('client.pages.homeStudent', compact("listCateNotifi", 'user'));
    }

    public function historyStudent()
    {
        $listScores = Scores::where('id_student', Auth::user()->id)->get();
        $user = students::find(Auth::user()->id)->first();
        return view('client.pages.historyStudent', compact('listScores', 'user'));
    }
}
