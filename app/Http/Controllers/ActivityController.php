<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Classes;
use App\Http\Requests\AddActivityRequest;
use App\Http\Requests\EditActivityRequest;
use App\Models\School_Year;
use App\Models\Student;
use App\Models\Log;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Auth;

class ActivityController extends Controller {
    private $user;
    protected $userInfo;
    
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = $user;
            $this->userInfo = is_null($user->Student) ? NULL : $user->Student;
            
            return $next($request);
        });
    }
    
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
        if($this->user->level != 3) {
            $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolYearId)->orderBy('start_date', 'desc')->get();
        } else {
            $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolYearId)->where('class_id', $this->userInfo->class_id)->orderBy('start_date', 'desc')->get();
        }
        $this->data['schoolYearList'] = $schoolYearList;
        $this->data['schoolYearId'] = $schoolYearId;
        
        return view('activity.activityList', $this->data);
    }
    
    public function getActivityListBySchoolYear($schoolyear_id) {
        if($this->user->level == 3) {
            $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolyear_id)->orderBy('start_date', 'desc')->where('activity_level', 0)->where('class_id', $this->userInfo->class_id)->get();
        } else {
            $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolyear_id)->orderBy('start_date', 'desc')->get();
        }
        
        return response()->view('activity.activity-list-table', $this->data);
    }
    
    public function getDetailActivity($id) {
        $this->data['activity'] = Activity::find($id);
        
        return response()->view('activity.detail-activity-modal', $this->data);
    }
    
    public function getAddActivity() {
        $this->data['schoolYearList'] = School_Year::orderBy('name', 'desc')->take(6)->get();
        if($this->user->level == 3) {
            $this->data['classOb'] = Classes::find($this->userInfo->class_id);
        }
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
        
        $new_data = $newActivity->id.' - '.$newActivity->name.' - '.$newActivity->start_date.' - '.$newActivity->end_date;
        Log::addToLog('Thêm hoạt động', '', $new_data);
        
        
        return redirect()->route('activity_index_route');
    }
    
    public function getEditActivity($id) {
        $this->data['activity'] = Activity::find($id);
        $this->data['schoolYearList'] = School_Year::orderBy('id', 'desc')->get();
        if($this->user->level == 3) {
            $this->data['classOb'] = Classes::find($this->userInfo->class_id);
        }
        return view('activity.editActivity', $this->data);
    }
    
    public function postEditActivity(EditActivityRequest $request, $activityId) {
        $activity = Activity::find($activityId);
        
        $old_data = $activity->id.' - '.$activity->name.'<br/>';
        $new_data = $activity->id.' - '.$request->name.'<br/>';
        
        $activity->name = $request->name;
        if($activity->leader != $request->leader_id) {
            $old_data .= 'Đứng chinh: '.$activity->leader.'<br/>';
            $new_data .= 'Đứng chinh: '.$request->leader_id.'<br/>';
            
            $activity->leader = $request->leader_id;
        }
        $new = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        if($activity->start_date != $new) {
            $new_data .= 'NBD: '.$new.'<br/>';
            $old_data .= 'NBD: '.$activity->start_date.'<br/>';
            
            $activity->start_date = $new;
        }
        $new = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        if($activity->end_date != $new) {
            $new_data .= 'NKT: '.$new.'<br/>';
            $old_data .= 'NKT: '.$activity->end_date.'<br/>';
            
            $activity->end_date = $new;
        }
        $new = Carbon::createFromFormat('d/m/Y', $request->start_regis_date)->format('Y-m-d');
        if($activity->start_regis_date != $new) {
            $new_data .= 'NBDDK: '.$new.'<br/>';
            $old_data .= 'NBDDK: '.$activity->start_regis_date.'<br/>';
            
            $activity->start_regis_date = $new;
        }
        $new = Carbon::createFromFormat('d/m/Y', $request->end_regis_date)->format('Y-m-d');
        if($activity->end_regis_date != $new) {
            $new_data .= 'NKTDK: '.$new.'<br/>';
            $old_data .= 'NKTDK: '.$activity->end_regis_date.'<br/>';
            
            $activity->end_regis_date = $new;
        }
        if($activity->content != $request->content) {
            $new_data .= 'Nội dung: '.$request->content.'<br/>';
            $old_data .= 'Nội dung: '.$activity->content.'<br/>';
            
            $activity->content = $request->content;
        }
        if($activity->school_year_id != $request->schoolyear_id) {
            $new_data .= 'Năm học: '.$request->schoolyear_id.'<br/>';
            $old_data .= 'Năm học: '.$activity->school_year_id.'<br/>';
            
            $activity->school_year_id = $request->schoolyear_id;
        }
        if($activity->conduct_mark != $request->conduct_mark) {
            $new_data .= 'ĐRL: '.$request->conduct_mark.'<br/>';
            $old_data .= 'ĐRL: '.$activity->conduct_mark.'<br/>';
            
            $activity->conduct_mark = $request->conduct_mark;
        }
        if($activity->social_mark != $request->social_mark) {
            $new_data .= 'CTXH: '.$request->social_mark.'<br/>';
            $old_data .= 'CTXH: '.$activity->social_mark.'<br/>';
            
            $activity->social_mark = $request->social_mark;
        }
        if($activity->activity_level != $request->activity_level) {
            $new_data .= 'Cấp HD: '.$request->activity_level.'<br/>';
            $old_data .= 'Cấp HD: '.$activity->activity_level.'<br/>';
            
            $activity->activity_level = $request->activity_level;
        }
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
        
        Log::addToLog('Cập nhật hoạt động', $old_data, $new_data);
        
        return redirect()->route('activity_index_route');
    }
    
    public function postDeleteActivity(Request $request) {
        $id = $request->id;
        $schoolYearId = $request->schoolYearId;
        
        $activity = Activity::find($id);
        $old_data = $activity->id.' - '.$activity->name;
        $activity->delete();
        
        Log::addToLog('Xóa hoạt động', $old_data, '');

        $this->data['activityList'] = Activity::with('Leader', 'ClassOb', 'SchoolYear')->where('school_year_id', $schoolYearId)->orderBy('start_date', 'desc')->get();
        
        return response()->view('activity.activity-list-table', $this->data);
    }
    
    public function ajaxGetLeader($searchKey) {
        $leaderList = Student::where('status', 1)->where('is_it_student', 1)->where(function($query) use($searchKey) {
            $query->where('id', 'LIKE', '%'.$searchKey.'%')->orwhere('name', 'LIKE', '%'.$searchKey.'%');
        });
        
        if($this->user->level == 3) {
            $leaderList = $leaderList->where('class_id', $this->userInfo->class_id);
        }
        
        $leaderList = $leaderList->get();
        
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
