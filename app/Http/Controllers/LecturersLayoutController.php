<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturers;
use App\Models\User;
use App\Models\Course;
use App\Models\ClassModel;
use App\Models\Majors;
use App\Models\Subject;
use App\Models\Scores;
use App\Models\CaseScore;
use App\Models\DetailScores;
use Illuminate\Support\Facades\Auth;

class LecturersLayoutController extends Controller
{
    public function scoreup(Request $request)
    {
        $listMajors = Majors::all();
        $listClass = ClassModel::all();
        $listCourse = Course::all();
        $listSubject = Subject::all();
        $user = Lecturers::find(Auth::user()->id)->first();


        return view('client.pages.scoreup', compact("user", 'listMajors', 'listClass', 'listCourse', 'listSubject'));
    }

    public function handleScoreup()
    {
        $listSubject = Subject::all();
        $idSubject = $_GET['id_subject'];
        $listScores = Scores::where('id_subject', $idSubject)->get();
        $listCaseScore = CaseScore::where('id_subject', $idSubject)->get();
        $user = Lecturers::find(Auth::user()->id)->first();
        return view('client.pages.handleScoreUp', compact("user", 'listScores', 'listSubject', 'listCaseScore', 'idSubject'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleCaseScore(Request $request)
    {
        // $title = $request->title;
        $countUD = 0;
        if ($request->titleUD) {
            $countUD = count($request->titleUD);
        }

        $countCR = 0;
        if ($request->titleCR) {
            $countCR = count($request->titleCR);
        }
        $idSubject = $request->id_subject;
        $listCaseScore = CaseScore::where('id_subject', $idSubject)->get();
        $listScores = Scores::where('id_subject', $idSubject)->get();
        $countListScore = count($listScores);


        $countCaseOld = count($listCaseScore);
        // if ($countCaseOld > 0) {
        for ($j = 0; $j < $countUD; $j++) {
            $caseItem = CaseScore::where('id', $request->id_case[$j])->first();

            $caseItem->update([
                'id_subject' => $idSubject,
                'title' => $request->titleUD[$j],
                'percent' => $request->percentUD[$j],
            ]);;
        }

        // }
        for ($i = 0; $i < $countCR; $i++) {
            $idCase = CaseScore::create([
                'id_subject' => $request->id_subject,
                'title' => $request->titleCR[$i],
                'percent' => $request->percentCR[$i],
            ]);

            //     // dd($idCase);
            if ($idCase) {
                for ($k = 0; $k < $countListScore; $k++) {
                    DetailScores::create([
                        'id_score' => $listScores[$k]->id,
                        'id_case_score' => $idCase->id,
                    ]);
                }

                // echo ($idCase->id);
            }
        }


        return redirect()->back();
    }

    public function postScoreUp(Request $request)
    {
        $count = count($request->id_score_details);
        for ($i = 0; $i < $count; $i++) {
            if ($request->score[$i] != '' || $request->note[$i] != '') {
                $detailsScore = DetailScores::find($request->id_score_details[$i]);
                $detailsScore->update([
                    'score' => $request->score[$i],
                    'note' => $request->note[$i],
                ]);
            }
        }

        $coundIdScore = count($request->scoreId);
        for ($k = 0; $k < $coundIdScore; $k++) {
            $score = Scores::find($request->scoreId[$k]);
            $score->update([
                'toltal' => $request->totalScore[$k]
            ]);
        }
        return redirect()->back();
    }
}
