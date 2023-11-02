<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//<select class="" name="acad_level_code" id="acad_level_code"  style="width:100%">


function acad_level_select($level_code, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "acad_level_code";
    }

    $select = '<select name="' . $name . '" ' . $params . '   style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="UG"' . selected($level_code, 'UG', false) . '>UG Undergraduate</option>
            <option value="PG"' . selected($level_code, 'PG', false) . '>PG Postgraduate</option>
            <option value="CE"' . selected($level_code, 'CE', false) . '>CE Continuing Education</option>
            <option value="CTF"' . selected($level_code, 'CTF', false) . '>CTF Certificate</option>
            <option value="PR"' . selected($level_code, 'PR', false) . '>PR Professional</option>
            <option value="NA"' . selected($level_code, 'N/A', false) . '>N/A Not Applicable</option>
            </select>';

    return $select;
}
function crse_level_select($level_code, $readonly = '') {

    $select = '<select name="course_level_code" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
                        <option value="">' . Lang::get('text.txt_select') . '</option>
                       <option value="100"' . selected($level_code, '100', false) . '>100 Course Level</option>
			<option value="200"' . selected($level_code, '200', false) . '>200 Course Level</option>
			<option value="300"' . selected($level_code, '300', false) . '>300 Course Level</option>
			<option value="400"' . selected($level_code, '400', false) . '>400 Course Level</option>
			<option value="500"' . selected($level_code, '500', false) . '>500 Course Level</option>
			<option value="600"' . selected($level_code, '600', false) . '>600 Course Level</option>
			<option value="700"' . selected($level_code, '700', false) . '>700 Course Level</option>
			<option value="800"' . selected($level_code, '800', false) . '>800 Course Level</option>
			<option value="900"' . selected($level_code, '900', false) . '>900 Course Level</option>
		    </select>';

    return $select;
}

function o_level_grd_select($grd, $name = '', $readonly = '') {

    $select = '<select name="' . $name . '" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
                        <option value="">' . Lang::get('text.txt_select') . '</option>
                       <option value="A1"' . selected($grd, 'A1', false) . '>A1</option>
			<option value="B2"' . selected($grd, 'B2', false) . '>B2</option>
			<option value="B3"' . selected($grd, 'B3', false) . '>B3</option>
			<option value="C4"' . selected($grd, 'C4', false) . '>C4</option>
			<option value="C5"' . selected($grd, 'C5', false) . '>C5</option>
			<option value="C6"' . selected($grd, 'C6', false) . '>C6</option>
			<option value="P7"' . selected($grd, 'P7', false) . '>P7</option>
			<option value="P8"' . selected($grd, 'P8', false) . '>P8</option>
			<option value="F9"' . selected($grd, 'F9', false) . '>F9</option>
		    </select>';

    return $select;
}

function prog_level_select($level_code, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "program_level";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '   data-live-search="true"' . $readonly . '>
                        <option value="">' . Lang::get('text.txt_select') . '</option>
                       <option value="100"' . selected($level_code, '100', false) . '>100 Level</option>
			<option value="200"' . selected($level_code, '200', false) . '>200 Level</option>
			<option value="300"' . selected($level_code, '300', false) . '>300 Level</option>
			<option value="400"' . selected($level_code, '400', false) . '>400 Level</option>
			<option value="500"' . selected($level_code, '500', false) . '>500 Level</option>
			<option value="600"' . selected($level_code, '600', false) . '>600 Level</option>
			<option value="700"' . selected($level_code, '700', false) . '>700 Level</option>
			<option value="800"' . selected($level_code, '800', false) . '>800 Level</option>
			<option value="900"' . selected($level_code, '900', false) . '>900 Level</option>
		    </select>';

    return $select;
}

function person_type_select($person_type, $readonly = '') {


    $select = '<select name="person_type" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="LEC"' . selected($person_type, 'LEC', false) . '>LEC Lecturer</option>
            <option value="ADJ"' . selected($person_type, 'ADJ', false) . '>ADJ Adjunct</option>
            <option value="STA"' . selected($person_type, 'STA', false) . '>STA Staff</option>
            <option value="APL"' . selected($person_type, 'APL', false) . '>APL Applicant</option>
            <option value="STU"' . selected($person_type, 'STU', false) . '>STU Student</option>
              </select>';

    return $select;
}

function crse_sec_instructor_meth_select($meth, $readonly = '') {

    $select = '<select name="instructor_method" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="LAB"' . selected($meth, 'LAB', false) . '>LAB Lab</option>
            <option value="LEC"' . selected($meth, 'LEC', false) . '>LEC Lecture</option>
            <option value="SEM"' . selected($meth, 'SEM', false) . '>SEM Seminar</option>
            <option value="LL"' . selected($meth, 'LL', false) . '>LL Lecture + Lab</option>
            <option value="LS"' . selected($meth, 'LS', false) . '>LS Lecture + Seminar</option>
            <option value="SL"' . selected($meth, 'SL', false) . '>SL Seminar + Lab</option>
            <option value="LLS"' . selected($meth, 'LLS', false) . '>LLS Lecture + Lab + Seminar</option>
             </select>';

    return $select;
}

function crse_sec_type_select($sec_type, $readonly = '') {
    $select = '<select name="sec_type" id="sec-typ" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="ONL"' . selected($sec_type, 'ONL', false) . '>ONL Online</option>
            <option value="HB"' . selected($sec_type, 'HB', false) . '>HB Hybrid</option>
            <option value="ONC"' . selected($sec_type, 'ONC', false) . '>ONC On-Campus</option>
               </select>';

    return $select;
}

function stu_status_select($status, $readonly = '') {
    $select = '<select name="status" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="A"' . selected($status, 'A', false) . '>A Active</option>
            <option value="H"' . selected($status, 'H', false) . '>H Hiatus</option>
            <option value="L"' . selected($status, 'L', false) . '>L Leave of Absence</option>
            <option value="W"' . selected($status, 'W', false) . '>W Withdrawn</option>
               </select>';
    return $select;
}

function course_sec_status_select($status, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
                <option value="A"' . selected($status, 'A', false) . '>A Active</option>
                <option value="I"' . selected($status, 'I', false) . '>I Inactive</option>
                     <option value="P"' . selected($status, 'P', false) . '>P Pending</option>
                <option value="C"' . selected($status, 'C', false) . '>C Cancel</option>
                   </select>';

    return $select;
}

function stu_prog_status_select($status, $name = '', $params = '', $include_empty = true, $readonly = '') {

    if (empty($name)) {
        $name = "status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if ($include_empty) {
        $select .= '<option value="">' . Lang::get('text.txt_select') . '</option>';
    }
    $select .= '<option value="A"' . selected($status, 'A', false) . '>A Active</option>
            <option value="P"' . selected($status, 'P', false) . '>P Potential</option>
            <option value="W"' . selected($status, 'W', false) . '>W Withdrawn</option>
            <option value="C"' . selected($status, 'C', false) . '>C Changed Mind</option>
            <option value="G"' . selected($status, 'G', false) . '>G Graduated</option>
               </select>';
    return $select;
}

function appl_status_select($appl_status, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "appl_status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="Pending"' . selected($appl_status, 'Pending', false) . '>Pending</option>
            <option value="Under Review"' . selected($appl_status, 'Under Review', false) . '>Under Review</option>
            <option value="Accepted"' . selected($appl_status, 'Accepted', false) . '>Accepted</option>
            <option value="Not Accepted"' . selected($appl_status, 'Not Accepted', false) . '>Not Accepted</option>
               </select>';

    return $select;
}

function admit_status_select($status, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "admit_status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
                <option value="FF"' . selected($status, 'FF', false) . '>FF First Time Freshman</option>
                <option value="TR"' . selected($status, 'TR', false) . '>TR Transfer</option>
                <option value="DE"' . selected($status, 'DE', false) . '>DE Direct Entry</option>
                <option value="NA"' . selected($status, 'NA', false) . '>NA Non-Applicable</option>
                </select>';

    return $select;
}

function certs_select($cert_code, $name = '', $params = '', $readonly = '') {
    if (empty($name)) {
        $name = "cert";
    }
    $select = '<select name="' . $name . '" ' . $params . '  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="AD"' . selected($cert_code, 'AD', false) . '>AD Advanced Diploma</option>
            <option value="IJM"' . selected($cert_code, 'IJM', false) . '>IJM IJMB</option>
            <option value="NCE"' . selected($cert_code, 'NCE', false) . '>NCE National Certificate of Education</option>
            <option value="OLV"' . selected($cert_code, 'OLV', false) . '>OLV Ordinary Level Certificate</option>
            <option value="JMB"' . selected($cert_code, 'JMB', false) . '>JMB Jamb</option>
            <option value="ND"' . selected($cert_code, 'ND', false) . '>ND Ordinary National Diploma</option>
            <option value="HND"' . selected($cert_code, 'HND', false) . '>HND Higher National Diploma</option>
            <option value="FD"' . selected($cert_code, 'FD', false) . '>FD First Degree</option>
            <option value="SD"' . selected($cert_code, 'SD', false) . '>SD Second Degree</option>
            <option value="NYC"' . selected($cert_code, 'NYC', false) . '>NYC National Youth Service Certificate</option>
            <option value="TR"' . selected($cert_code, 'TR', false) . '>TR Transcript</option>
            <option value="NA"' . selected($cert_code, 'N/A', false) . '>N/A Not Applicable</option>
            </select>';

    return $select;
}

function nxt_of_kin_rel_select($rel, $readonly = '') {

    $select = '<select name="nxt_of_kin_rel" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="F"' . selected($rel, 'F', false) . '>Father</option>
            <option value="M"' . selected($rel, 'M', false) . '>Mother</option>
            <option value="B"' . selected($rel, 'B', false) . '>Brother</option>
            <option value="S"' . selected($rel, 'S', false) . '>Sister</option>
            <option value="A"' . selected($rel, 'A', false) . '>Aunty</option>
            <option value="U"' . selected($rel, 'U', false) . '>Uncle</option>
            <option value="G"' . selected($rel, 'G', false) . '>Guardian</option>
            <option value="O"' . selected($rel, 'O', false) . '>Other</option>
             </select>';
    return $select;
}

function crse_sec_moodle_categ_select($categ, $readonly = '') {
    $select = '<select name="moodle_categ" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
             </select>';

    return $select;
}

function stu_load_rule_select($sec_type, $readonly = '') {
    $select = '<select name="stu_load_rule" class="form-control required  select"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="F"' . selected($sec_type, 'F', false) . '>F Full Time</option>
            <option value="P"' . selected($sec_type, 'P', false) . '>P Part Time</option>
               </select>';

    return $select;
}

function stu_load_rule_status_select($type, $readonly = '') {
    $select = '<select name="status" class="form-control required  selec" id="outstading-typ-filter"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="0"' . selected($type, '0', false) . '>Active</option>
            <option value="1"' . selected($type, '1', false) . '>In Active</option>
               </select>';

    return $select;
}

function mrk_sht_apprv_status_select($type, $readonly = '') {
    $select = '<select name="mrk_sht_apprv_status" class="form-control required  selec" id="mrk-sht-apprv-status"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="A"' . selected($type, 'A', false) . '>Approved</option>
            <option value="D"' . selected($type, 'D', false) . '>Disapproved</option>
            <option value="P"' . selected($type, 'P', false) . '>Pending</option>
               </select>';

    return $select;
}

function status_select($status, $name = '', $params = '', $include_empty = true, $readonly = '') {

    if (empty($name)) {
        $name = "status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }

    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if ($include_empty) {
        $select .= '<option value="">' . Lang::get('text.txt_select') . '</option>';
    }
    $select .= '<option value="A"' . selected($status, 'A', false) . '>Active</option>
            <option value="I"' . selected($status, 'I', false) . '>In-Active</option>
            </select>';
    return $select;
}

function library_type_select($type, $readonly = '') {
    $select = '<select name="type" class="form-control required  selec" id="lib-typ"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="G"' . selected($type, 'G', false) . '>General</option>
            <option value="D"' . selected($type, 'D', false) . '>Departmental</option>
               </select>';

    return $select;
}

function location_select($selected, $name = '', $params = '', $include_empty = true, $blank_title = '', $readonly = '') {

    if (empty($name)) {
        $name = "location_code";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if (empty($blank_title)) {
        $blank_title = Lang::get('text.txt_select');
    }
    if ($include_empty) {
        $select .= '<option value="">' . $blank_title . '</option>';
    }
    $select .= '<option value="ONL"' . selected($selected, 'ONL', false) . '>Online</option>
            <option value="ONC"' . selected($selected, 'ONC', false) . '>On Campus</option>
               </select>';
    return $select;
}

function prog_mode_select($prog_mode, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = 'program_mode_code';
    }
   
    $select = '<select name="' . $name . '" ' . $params . '    data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="FT"' . selected($prog_mode, 'FT', false) . '>Full Time</option>
            <option value="PT"' . selected($prog_mode, 'PT', false) . '>Part Time</option>
               </select>';
    

    return $select;
}

function program_mode_select($prog_mode, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = 'program_mode_code';
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"';
    }

    $select = '<select name="' . $name . '" ' . $params . '  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="ONLFT"' . selected($prog_mode, 'FT', false) . '>Online-Full Time</option>
            <option value="ONLPT"' . selected($prog_mode, 'PT', false) . '>Online-Part Time</option>
            <option value="ONSFT"' . selected($prog_mode, 'FT', false) . '>On-Campus-Full Time</option>
            <option value="ONSPT"' . selected($prog_mode, 'PT', false) . '>On-Campus-Part Time</option>
            <option value="HBFT"' . selected($prog_mode, 'FT', false) . '>Hybrid-Full Time</option>
            <option value="HBPT"' . selected($prog_mode, 'PT', false) . '>Hybrid-Part Time</option>
              </select>';

    return $select;
}

function stu_course_sec_status_select($type, $readonly = '') {
    $select = '<select name="status" class="form-control required  selec" id="status"  style="width:100%"  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
            <option value="A"' . selected($type, 'A', false) . '>A Add</option>
            <option value="N"' . selected($type, 'N', false) . '>N New</option>
            <option value="D"' . selected($type, 'D', false) . '>D Drop</option>
            <option value="W"' . selected($type, 'W', false) . '>W Withdrawn</option>
            <option value="C"' . selected($type, 'C', false) . '>C Cancelled</option>
             </select>';
    return $select;
}

function library_location_select($loc, $name = '', $params = '', $readonly = '') {

    if (empty($name)) {
        $name = "location";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
                <option value="ONL"' . selected($loc, 'ONL', false) . '>ONL Online</option>
                <option value="ONS"' . selected($loc, 'ONS', false) . '>ONS Onsite</option>
                   </select>';

    return $select;
}

function book_physical_frm_select($frm, $name = '', $params = '', $include_empty = true, $blank_title = '', $readonly = '') {

    if (empty($name)) {
        $name = "physical_form";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    if (empty($blank_title)) {
        $blank_title = Lang::get('text.txt_select');
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if ($include_empty) {
        $select .= '<option value="">' . $blank_title . '</option>';
    }
    $select .= '<option value="Book"' . selected($frm, 'Book', false) . '>Book</option>
                <option value="Journal"' . selected($frm, 'Journal', false) . '>Journal</option>
                    <option value="CD/DVD"' . selected($frm, 'CD/DVD', false) . '>CD/DVD</option>
                <option value="Manuscript"' . selected($frm, 'Manuscript', false) . '>Manuscript</option>
                               <option value="Thesis"' . selected($frm, 'Thesis', false) . '>Thesis</option>

                   </select>';

    return $select;
}

function book_size_select($data, $name = '', $params = '', $readonly = '') {
    if (empty($name)) {
        $name = "size1";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
                <option value="Medium"' . selected($data, 'Medium', false) . '>Medium</option>
                <option value="Large"' . selected($data, 'Large', false) . '>Large</option>
                    <option value="Huge"' . selected($data, 'Huge', false) . '>Huge</option>
                <option value="Small"' . selected($data, 'Small', false) . '>Small</option>
                               <option value="Tiny"' . selected($data, 'Tiny', false) . '>Tiny</option>
                   </select>';

    return $select;
}

function book_source_select($data, $name = '', $params = '', $readonly = '') {
    if (empty($name)) {
        $name = "source_details";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }

    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>
            <option value="">' . Lang::get('text.txt_select') . '</option>
                <option value="Local Purchase"' . selected($data, 'Local Purchase', false) . '>Local Purchase</option>
                <option value="University"' . selected($data, 'University', false) . '>University</option>
                   </select>';

    return $select;
}

function lib_memb_user_typ_select($selected, $name = '', $params = '', $include_empty = true, $readonly = '') {

    if (empty($name)) {
        $name = "user_type";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if ($include_empty) {
        $select .= '<option value="">' . Lang::get('text.txt_select') . '</option>';
    }
    $select .= '<option value="Member"' . selected($selected, 'Member', false) . '>Member</option>
            <option value="Admin"' . selected($selected, 'Admin', false) . '>Admin</option>
            </select>';
    return $select;
}

function circulation_status_select($selected, $name = '', $params = '', $include_empty = true, $readonly = '') {

    if (empty($name)) {
        $name = "circ_status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if ($include_empty) {
        $select .= '<option value="">' . Lang::get('text.txt_select') . '</option>';
    }
    $select .= '<option value="issued"' . selected($selected, 'issued', false) . '>Issued</option>
            <option value="returned"' . selected($selected, 'returned', false) . '>Returned</option>
                <option value="expired_returned"' . selected($selected, 'expired_returned', false) . '>Expired and Returned</option>
                    <option value="expired_not_returned"' . selected($selected, 'expired_not_returned', false) . '>Expired and not Returned</option>
            </select>';
    return $select;
}

function notification_type_select($selected, $name = '', $params = '', $include_empty = true, $blank_title = '', $readonly = '') {

    if (empty($name)) {
        $name = "message_type";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }

    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if (empty($blank_title)) {
        $blank_title = Lang::get('text.txt_select');
    }
    if ($include_empty) {
        $select .= '<option value="">' . $blank_title . '</option>';
    }
    $select .= '<option value="Notification"' . selected($selected, 'Notification', false) . '>' . Lang::get('text.txt_only_notificatn') . '</option>
                <option value="Email"' . selected($selected, 'Email', false) . '>' . Lang::get('text.txt_email_notificatn') . '</option>
                <option value="SMS"' . selected($selected, 'SMS', false) . '>' . Lang::get('text.txt_sms_notificatn') . '</option>
            </select>';
    return $select;
}

function book_request_status_select($selected, $name = '', $params = '', $include_empty = true, $blank_title = '', $readonly = '') {

    if (empty($name)) {
        $name = "req_status";
    }
    if (empty($params)) {
        $params = 'class="form-control required  select"  style="width:100%"';
    }
    $select = '<select name="' . $name . '" ' . $params . '  data-live-search="true"' . $readonly . '>';
    if (empty($blank_title)) {
        $blank_title = Lang::get('text.txt_select');
    }
    if ($include_empty) {
        $select .= '<option value="">' . $blank_title . '</option>';
    }

    $select .= '<option value="0"' . selected($selected, '0', false) . '>' . Lang::get('text.txt_pending') . '</option>
                <option value="1"' . selected($selected, '1', false) . '>' . Lang::get('text.txt_approved') . '</option>
                <option value="-1"' . selected($selected, '-1', false) . '>' . Lang::get('text.txt_disapproved') . '</option>
            </select>';
    return $select;
}

function selected($curr_code, $code, $default) {

    if (is_array($curr_code)) {
        if (in_array($code, $curr_code)) {
            return ' selected';
        }
    } else {
        if ($curr_code == $code) {
            return ' selected';
        }
    }
    return $default;
}
