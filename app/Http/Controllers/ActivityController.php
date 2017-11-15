<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Classes;
use App\Http\Requests\AddActivityRequest;
use App\Http\Requests\EditActivityRequest;
use App\Models\School_Year;
use Illuminate\Http\Request;

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
        $newActivityId = $this->getNewActivityId();
        $schoolYearList = School_Yeares::orderBy('id', 'desc')->get();

        return view('activity.addActivity', ['newActivityId' => $newActivityId, 'schoolYearList' => $schoolYearList]);
    }

    public function postAddActivity(AddActivityRequest $request) {
        $newActivityId = $this->getNewActivityId();

        $newActivity = new Activity;
        $newActivity->id = $newActivityId;
        $newActivity->activityName = $request->txtActivityName;
        $newActivity->leader = $request->txtHiddenActivityLeader;
        $newActivity->startDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpStartDate)));
        $newActivity->endDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpEndDate)));
        $newActivity->startRegistrationDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpStartRegisDate)));
        $newActivity->endRegistrationDate = date('Y/m/d', strtotime(str_replace('/', '-',$request->dtpEndRegisDate)));
        $newActivity->content = $request->txtContent;
        $newActivity->schoolYearId = $request->slSchoolYear;
        $newActivity->conductMark = $request->txtConductMark;
        $newActivity->socialMark = $request->txtSocialMark;
        $newActivity->activityLevel = $request->rdActivityLevel;
        if($request->rdActivityLevel == 0) {
            $newActivity->classId = $request->txtClassId;
        } else {
            $newActivity->classId = null;
        }
        $newActivity->maxRegisNumber = $request->txtMaxNumber;
        if($request->txtTrailerURL != null) {
            $newActivity->trailer = $this->getIdYoutue($request->txtTrailerURL);
        } else {
            $newActivity->trailer = null;
        }

        $newActivity->save();

        return redirect('/activity')->with(['success_alert' => 'Thêm hoạt động mới thành công!']);
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

    private function getNewActivityId() {
        $activityTop = Activity::orderBy('id', 'desc')->take(1)->first();
        $createNumberId = (string)(substr($activityTop->id,2) + 1);
        while(strlen($createNumberId) < 3) {
            $createNumberId = '0'.$createNumberId;
        }
        $newActivityId = 'HD'.$createNumberId;

        return $newActivityId;
    }

    private function getIdYoutue($url) {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return $my_array_of_vars['v'];
    }
}
