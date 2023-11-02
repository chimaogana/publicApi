<?php

//use DB;
use App\Classes\Date;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_student($student) {

    return \StudentManager::get_student($student);
}

function get_student_data($key, $student) {

    // App\Classes\Manager\StudentManager::get_student($student);
}

function get_stu_dir($last_name = '', $first_name = '', $id = '') {
    $stu_dir = config('students_dir') . '/' . $last_name . '_' . $first_name . '_' . $id;
    if (!FileManager::is_exist_dir($stu_dir)) {
        FileManager::create_dir($stu_dir, 'local', $mode = 0777);
    }
    return $stu_dir;
}

function get_stu_dir_path($last_name = '', $first_name = '', $id = '') {
    $dir = get_stu_dir($last_name, $first_name, $id);
    return $dir . '\\';
}

function get_stu_web_dir($last_name = '', $first_name = '', $id = '', $disk = '') {
    /* $stu_dir = config('students_dir') . '/' . $last_name . '_' . $first_name . '_' . $id . '/';
      return $stu_dir; */
    return get_stu_dir_path2($last_name, $first_name, $id, $disk);
}

function get_stu_dir_path2($last_name = '', $first_name = '', $id = '', $disk = '') {
    $stu_dir = config('students_dir') . '/' . $last_name . '_' . $first_name . '_' . $id . '/';
    if (!FileManager::is_exist_dir($stu_dir, $disk)) {
        FileManager::create_dir($stu_dir, $disk);
    }
    return $stu_dir;
}

function get_stu_name($val, $by = 'stu_id') {

    $result = DB::select('select CONCAT(last_name, ", ", first_name) AS fullname from persons '
                    . 'p join students s on s.person_id=p.person_id where s.' . $by . '=?', [$val]);
    if (!empty($result)) {
        return $result[0]->fullname;
    }
    return '';
}

function get_stu_grade($mark, $grade_scales) {

    foreach ($grade_scales as $grd_scale) {
        if ($mark <= $grd_scale['max_percent'] && $mark >= $grd_scale['min_percent']) {
            return $grd_scale;
        }
    }
    return null;
}

function get_grade_point($grd, $grade_scales) {

    foreach ($grade_scales as $grd_scale) {
        if ($mark <= $grd_scale['max_percent'] && $mark >= $grd_scale['min_percent']) {
            return $grd_scale;
        }
    }
    return null;
}

function acad_cred_grade_points($grade, $credits) {
    $point = DB::table('grade_scales')
            ->where(['grade' => $grade])
            ->value('points');
    return $point * $credits;
}

function create_update_sttr_record($sacd) {

    if (DB::table('stu_semesters as s')
                    ->where(['s.stu_id' => $sacd['stu_id'], 's.semester_code' => $sacd['semester_code']])
                    ->exists()) {
        /* DB::table('stu_semesters')
          ->where(['stu_id' => $sacd['stu_id'], 'semester_code' => $sacd['semester_code'],
          'acad_prog_id' => $sacd['acad_prog_id']])
          ->update(['att_cred' => 'att_cred' + $sacd['att_cred']]); */
        DB::update('update stu_semesters set att_cred = att_cred + ? where stu_id = ? and '
                . 'semester_code=?', [$sacd['att_cred'], $sacd['stu_id'], $sacd['semester_code']]);
    } else {
        DB::table('stu_semesters')->insert(['stu_id' => $sacd['stu_id'], 'semester_code' => $sacd['semester_code'],
            'att_cred' => $sacd['att_cred'],
            'created_at' => Date::today('', true)]);
    }
}

/**
 * Creates a new student sttr record is none exists or
 * updates the attCreds if the student registers for a
 * new course in the same term.
 * 
 * @since 6.3.0
 * @param object $sacd Object holding the last insert into stac.
 */
function create_update_sttr_recordXX($sacd) {

    if (DB::table('stu_semesters as s')
                    ->where(['s.stu_id' => $sacd['stu_id'], 's.semester_code' => $sacd['semester_code'],
                        's.acad_prog_id' => $sacd['acad_prog_id']])
                    ->exists()) {
        /* DB::table('stu_semesters')
          ->where(['stu_id' => $sacd['stu_id'], 'semester_code' => $sacd['semester_code'],
          'acad_prog_id' => $sacd['acad_prog_id']])
          ->update(['att_cred' => 'att_cred' + $sacd['att_cred']]); */
        DB::update('update stu_semesters set att_cred = att_cred + ? where stu_id = ? and '
                . 'semester_code=? and acad_prog_id=?', [$sacd['att_cred'], $sacd['stu_id'], $sacd['semester_code'], $sacd['acad_prog_id']]);
    } else {
        DB::table('stu_semesters')->insert(['stu_id' => $sacd['stu_id'], 'matric_no' => $sacd['matric_no'], 'semester_code' => $sacd['semester_code'],
            'acad_prog_id' => $sacd['acad_prog_id'], 'att_cred' => $sacd['att_cred'],
            'created_at' => Date::convertDate()]);
    }
}

/* function create_update_sttr_record($sacd) {

  if (DB::table('stu_semesters as s')->
  where(['s.stu_id' => $sacd->stu_id, 's.semester_code' => $sacd->semester_code,
  's.acad_prog_id' => $sacd->acad_prog_id])
  ->exists()) {

  DB::table('stu_semesters')->insert(['stu_id' => $sacd->stu_id, 'semester_code' => $sacd->semester_code,
  'acad_prog_id' => $sacd->acad_prog_id, 'att_cred' => $sacd->att_cred,
  'created_at' => Date::convertDate()]);
  } else {

  DB::table('stu_semesters')
  ->where(['stu_id' => $sacd->stu_id, 'semester_code' => $sacd->semester_code,
  'acad_prog_id' => $sacd->acad_prog_id])
  ->update(['att_cred' => 'att_cred' + $sacd->att_cred]);
  }
  } */

function get_stu_header($stu_id, $url = '') {


    $path = (config('person_image_path_md'));
    $stu = DB::table('students as s')
            ->join('persons as p', 's.person_id', '=', 'p.person_id')
            ->where(['s.stu_id' => $stu_id])
            ->select('s.matric_no', 's.status', 's.stu_id', 'p.person_id', 'p.first_name', 'p.last_name', 'p.middle_name', 'p.sex', 'p.alternate_id', 'p.person_type'
                    , 'p.email', 'p.pic', 'p.prefix')
            ->first();

    if (is_object($stu)) {
        $name = $stu->prefix . '.' . $stu->last_name . ',' . $stu->first_name;
        if (hp("view_stu_record")) {
            if (empty($url)) {
                $url = action('WissenAdmin\StudentController@viewAction', ['stu_id' => $stu_id]);
            }
            $name = '<a  class="" style="color:navy" href="' . $url . '">' . $name . '</a>';
        }
        $header = '<div class="row intro" id="stu-hdr-cont" style="margin:auto  -1px;margin-bottom:3px">
            <div class="col-md-8 col-xs-6 border-righ"> <strong></strong>
               <img src="' . $path . '/' . $stu->pic . '" alt="user" width="60" class="img img-responsive img-circle" />
                   <span class="name">' . $name . '<br></span>
                    </div>
                    <div class="col-md-4" style="padding-top:10px">' . manage_std_lnk_select($stu, '', '', '', '', false) . '</div>'
                . '</div>';
    } else {
        $header = Lang::get('msg.txt_resource_nt_fnd');
    }
    //<small>'.$stu->matric_no.'</small>
    return $header;
}

/*
 *  $header = '<div class="col-md-12">
            <div class="col-md-8 col-xs-6 border-righ"> <strong></strong>
                <img src="' . $path . '/' . $stu->pic . '" alt="user" width="60" class="img img-responsive img-circle" />
                <span class="name">' . $name . '<br></span>
                    </div>
                    <div class="col-md-4">bbbb</div>
                    
        </div>'
 */