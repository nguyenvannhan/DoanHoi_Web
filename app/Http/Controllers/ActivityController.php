<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Classes;
use App\Http\Requests\AddActivityRequest;
use App\School_Yeares;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class ActivityController extends Controller {
    public function getActivityList() {
        $activityList = Activity::with('Leader', 'ClassOb', 'SchoolYear')->orderBy('startDate', 'desc')->get();
        $choolYearList = School_Yeares::orderBy('id', 'desc')->get();

        return view('activity.activityList', ['activityList' => $activityList, 'schoolYearList' => $choolYearList]);
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
        $newActivity->trailer = $this->getIdYoutue($request->txtTrailerURL);

        $newActivity->save();

        return redirect('/activity')->with(['alert_success' => 'Thêm hoạt động mới thành công!']);
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
