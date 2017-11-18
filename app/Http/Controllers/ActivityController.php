<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Classes;
use App\Http\Requests\AddActivityRequest;
use App\Http\Requests\EditActivityRequest;
use App\Models\School_Year;
use App\Models\Student;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class ActivityController extends Controller {
    public function getActivityList() {
        $schoolYearList = School_Year::orderBy('name', 'desc')->get();


        $schoolYearId = $schoolYearList->first()->id;

        $currentYear = date('Y');
        $currentMonth = date('m');

        if ($currentMonth <= 7) {
            $currentYear -= 1;
        }

        foreach($schoolYearList as $choolyear) {
            if($currentYear == substr($choolyear->name, 0, 4)) {
                $schoolYearId = $choolyear->id;
            }
        }

        $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolYearId)->orderBy('start_date', 'desc')->get();
        $this->data['schoolYearList'] = $schoolYearList;
        $this->data['schoolYearId'] = $schoolYearId;

        return view('activity.activityList', $this->data);
    }

    public function getDetailActivity($id) {
        $activity = Activity::find($id);

        return view('activity.detailOneActivity', ['activity' => $activity]);
    }

    public function getAddActivity() {
        $this->data['schoolYearList'] = School_Year::orderBy('name', 'desc')->take(6)->get();
        return view('activity.addActivity', $this->data);
    }

    public function postAddActivity(AddActivityRequest $request) {
        $newActivity = new Activity;
        $newActivity->name = $request->name;
        $newActivity->leader = $request->leader_id;
        $newActivity->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $newActivity->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $newActivity->start_regis_date = Carbon::createFromFormat('d/m/Y', $request->start_regis_date)->format('Y-m-d');
        $newActivity->end_regis_date = Carbon::createFromFormat('d/m/Y', $request->end_regis_date)->format('Y-m-d');
        $newActivity->content = $request->content;
        $newActivity->school_year_id = $request->schoolyear_id;
        $newActivity->conduct_mark = $request->conduct_mark;
        $newActivity->social_mark = $request->social_mark;
        $newActivity->activity_level = $request->activity_level;
        if($request->activity_level == config('constants.CLASS_ACTIVITY_LEVEL_ID')) {
            $newActivity->class_id = $request->class_id;
        } else {
            $newActivity->class_id = null;
        }
        $newActivity->max_regis_number = $request->max_number;
        if($request->trailer != null) {
            $newActivity->trailer = $this->getIdYoutue($request->trailer);
        } else {
            $newActivity->trailer = null;
        }

        $newActivity->save();

        return redirect()->route('activity_index_route');
    }

    public function getEditActivity($id) {
        $this->data['activity'] = Activity::find($id);
        $this->data['schoolYearList'] = School_Year::orderBy('id', 'desc')->get();
        return view('activity.editActivity', $this->data);
    }

    public function postEditActivity(EditActivityRequest $request, $activityId) {
        $activity = Activity::find($activityId);

        $activity->name = $request->name;
        $activity->leader = $request->leader_id;
        $activity->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $activity->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $activity->start_regis_date = Carbon::createFromFormat('d/m/Y', $request->start_regis_date)->format('Y-m-d');
        $activity->end_regis_date = Carbon::createFromFormat('d/m/Y', $request->end_regis_date)->format('Y-m-d');
        $activity->content = $request->content;
        $activity->school_year_id = $request->schoolyear_id;
        $activity->conduct_mark = $request->conduct_mark;
        $activity->social_mark = $request->social_mark;
        $activity->activity_level = $request->activity_level;
        if($request->activity_level == config('constants.CLASS_ACTIVITY_LEVEL_ID')) {
            $activity->class_id = $request->class_id;
        } else {
            $activity->class_id = null;
        }
        $activity->max_regis_number = $request->max_number;
        if($request->trailer != null) {
            $activity->trailer = $this->getIdYoutue($request->trailer);
        } else {
            $activity->trailer = null;
        }

        $activity->save();

        return redirect()->route('activity_index_route');
    }

    public function ajaxGetLeader($searchKey) {
        $leaderList = Student::where('status', 1)->where('is_it_student', 1)->where(function($query) use($searchKey) {
            $query->where('id', 'LIKE', '%'.$searchKey.'%')->orwhere('name', 'LIKE', '%'.$searchKey.'%');
        })->get();

        $htmlContent = '';
        foreach($leaderList as $leader) {
            $htmlContent .= '<li><a href="#">'.$leader->id.' - '.$leader->name.' - '.$leader->ClassOb->name.'</a></li>';
        }

        $this->data['htmlContent'] = $htmlContent;
        return response()->json($this->data);
    }

    public function ajaxGetClass($student_id) {
        $this->data['classOb'] = Student::find($student_id)->ClassOb;

        return response()->json($this->data);
    }

    private function getIdYoutue($url) {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return $my_array_of_vars['v'];
    }
}
