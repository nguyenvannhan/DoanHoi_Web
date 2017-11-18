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
        $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->orderBy('start_date', 'desc')->get();
        $this->data['schoolYearList'] = School_Year::orderBy('id', 'desc')->get();

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
        if($request->activity_level == 0) {
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

    public function getEditActivity($activityId) {
        $activity = Activity::find($activityId);
        $schoolYearList = School_Yeares::orderBy('id', 'desc')->get();

        return view('activity.editActivity', ['activity' => $activity, 'schoolYearList' => $schoolYearList]);
    }

    public function postEditActivity(EditActivityRequest $request, $activityId) {
        $activity = Activity::find($activityId);

        $activity->activityName = $request->txtActivityName;
        $activity->leader = $request->txtHiddenActivityLeader;
        $activity->startDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpStartDate)));
        $activity->endDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpEndDate)));
        $activity->startRegistrationDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpStartRegisDate)));
        $activity->endRegistrationDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpEndRegisDate)));
        $activity->content = $request->txtContent;
        $activity->schoolYearId = $request->slSchoolYear;
        $activity->conductMark = $request->txtConductMark;
        $activity->socialMark = $request->txtSocialMark;
        $activity->activityLevel = $request->rdActivityLevel;
        if($request->rdActivityLevel == 0) {
            $activity->classId = $request->txtClassId;
        } else {
            $activity->classId = null;
        }
        $activity->maxRegisNumber = $request->txtMaxNumber;
        if($request->txtTrailerURL != null) {
            $activity->trailer = $this->getIdYoutue($request->txtTrailerURL);
        } else {
            $activity->trailer = null;
        }

        $activity->save();

        return redirect('/activity')->with(['success_alert' => 'Cập nhật hoạt động mã '.$activityId.' thành công!']);
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
