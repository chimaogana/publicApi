<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use App\Classes\PasswordHash;

/**
 * Renders any unwarranted special characters to HTML entities.
 * 
 * @since 1.0.0
 * @param string $str
 * @return mixed
 */
function _h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * A wrapper for htmLawed which is a set of functions
 * for html purifier
 *
 * @since 5.0
 * @param string $str            
 * @return mixed
 */
function _escape($t, $C = 1, $S = []) {
    return htmLawed($t, $C, $S);
}

/**
 * Added htmLawed functions
 *
 * @since 5.0.1
 */
function htmLawed($t, $C = 1, $S = array()) {
    $C = is_array($C) ? $C : array();
    if (!empty($C['valid_xhtml'])) {
        $C['elements'] = empty($C['elements']) ? '*-center-dir-font-isindex-menu-s-strike-u' : $C['elements'];
        $C['make_tag_strict'] = isset($C['make_tag_strict']) ? $C['make_tag_strict'] : 2;
        $C['xml:lang'] = isset($C['xml:lang']) ? $C['xml:lang'] : 2;
    }
    // config eles
    $e = array(
        'a' => 1,
        'abbr' => 1,
        'acronym' => 1,
        'address' => 1,
        'applet' => 1,
        'area' => 1,
        'b' => 1,
        'bdo' => 1,
        'big' => 1,
        'blockquote' => 1,
        'br' => 1,
        'button' => 1,
        'caption' => 1,
        'center' => 1,
        'cite' => 1,
        'code' => 1,
        'col' => 1,
        'colgroup' => 1,
        'dd' => 1,
        'del' => 1,
        'dfn' => 1,
        'dir' => 1,
        'div' => 1,
        'dl' => 1,
        'dt' => 1,
        'em' => 1,
        'embed' => 1,
        'fieldset' => 1,
        'font' => 1,
        'form' => 1,
        'h1' => 1,
        'h2' => 1,
        'h3' => 1,
        'h4' => 1,
        'h5' => 1,
        'h6' => 1,
        'hr' => 1,
        'i' => 1,
        'iframe' => 1,
        'img' => 1,
        'input' => 1,
        'ins' => 1,
        'isindex' => 1,
        'kbd' => 1,
        'label' => 1,
        'legend' => 1,
        'li' => 1,
        'map' => 1,
        'menu' => 1,
        'noscript' => 1,
        'object' => 1,
        'ol' => 1,
        'optgroup' => 1,
        'option' => 1,
        'p' => 1,
        'param' => 1,
        'pre' => 1,
        'q' => 1,
        'rb' => 1,
        'rbc' => 1,
        'rp' => 1,
        'rt' => 1,
        'rtc' => 1,
        'ruby' => 1,
        's' => 1,
        'samp' => 1,
        'script' => 1,
        'select' => 1,
        'small' => 1,
        'span' => 1,
        'strike' => 1,
        'strong' => 1,
        'sub' => 1,
        'sup' => 1,
        'table' => 1,
        'tbody' => 1,
        'td' => 1,
        'textarea' => 1,
        'tfoot' => 1,
        'th' => 1,
        'thead' => 1,
        'tr' => 1,
        'tt' => 1,
        'u' => 1,
        'ul' => 1,
        'var' => 1
    ); // 86/deprecated+embed+ruby
    if (!empty($C['safe'])) {
        unset($e['applet'], $e['embed'], $e['iframe'], $e['object'], $e['script']);
    }
    $x = !empty($C['elements']) ? str_replace(array(
                "\n",
                "\r",
                "\t",
                ' '
                    ), '', $C['elements']) : '*';
    if ($x == '-*') {
        $e = array();
    } elseif (strpos($x, '*') === false) {
        $e = array_flip(explode(',', $x));
    } else {
        if (isset($x[1])) {
            preg_match_all('`(?:^|-|\+)[^\-+]+?(?=-|\+|$)`', $x, $m, PREG_SET_ORDER);
            for ($i = count($m); --$i >= 0;) {
                $m[$i] = $m[$i][0];
            }
            foreach ($m as $v) {
                if ($v[0] == '+') {
                    $e[substr($v, 1)] = 1;
                }
                if ($v[0] == '-' && isset($e[($v = substr($v, 1))]) && !in_array('+' . $v, $m)) {
                    unset($e[$v]);
                }
            }
        }
    }
    $C['elements'] = & $e;
    // config attrs
    $x = !empty($C['deny_attribute']) ? str_replace(array(
                "\n",
                "\r",
                "\t",
                ' '
                    ), '', $C['deny_attribute']) : '';
    $x = array_flip((isset($x[0]) && $x[0] == '*') ? explode('-', $x) : explode(',', $x . (!empty($C['safe']) ? ',on*' : '')));
    if (isset($x['on*'])) {
        unset($x['on*']);
        $x += array(
            'onblur' => 1,
            'onchange' => 1,
            'onclick' => 1,
            'ondblclick' => 1,
            'onfocus' => 1,
            'onkeydown' => 1,
            'onkeypress' => 1,
            'onkeyup' => 1,
            'onmousedown' => 1,
            'onmousemove' => 1,
            'onmouseout' => 1,
            'onmouseover' => 1,
            'onmouseup' => 1,
            'onreset' => 1,
            'onselect' => 1,
            'onsubmit' => 1
        );
    }
    $C['deny_attribute'] = $x;
    // config URL
    $x = (isset($C['schemes'][2]) && strpos($C['schemes'], ':')) ? strtolower($C['schemes']) : 'href: aim, feed, file, ftp, gopher, http, https, irc, mailto, news, nntp, sftp, ssh, telnet; *:file, http, https';
    $C['schemes'] = array();
    foreach (explode(';', str_replace(array(
        ' ',
        "\t",
        "\r",
        "\n"
                    ), '', $x)) as $v) {
        $x = $x2 = null;
        list ($x, $x2) = explode(':', $v, 2);
        if ($x2) {
            $C['schemes'][$x] = array_flip(explode(',', $x2));
        }
    }
    if (!isset($C['schemes']['*'])) {
        $C['schemes']['*'] = array(
            'file' => 1,
            'http' => 1,
            'https' => 1
        );
    }
    if (!empty($C['safe']) && empty($C['schemes']['style'])) {
        $C['schemes']['style'] = array(
            '!' => 1
        );
    }
    $C['abs_url'] = isset($C['abs_url']) ? $C['abs_url'] : 0;
    if (!isset($C['base_url']) or ! preg_match('`^[a-zA-Z\d.+\-]+://[^/]+/(.+?/)?$`', $C['base_url'])) {
        $C['base_url'] = $C['abs_url'] = 0;
    }
    // config rest
    $C['and_mark'] = empty($C['and_mark']) ? 0 : 1;
    $C['anti_link_spam'] = (isset($C['anti_link_spam']) && is_array($C['anti_link_spam']) && count($C['anti_link_spam']) == 2 && (empty($C['anti_link_spam'][0]) or hl_regex($C['anti_link_spam'][0])) && (empty($C['anti_link_spam'][1]) or hl_regex($C['anti_link_spam'][1]))) ? $C['anti_link_spam'] : 0;
    $C['anti_mail_spam'] = isset($C['anti_mail_spam']) ? $C['anti_mail_spam'] : 0;
    $C['balance'] = isset($C['balance']) ? (bool) $C['balance'] : 1;
    $C['cdata'] = isset($C['cdata']) ? $C['cdata'] : (empty($C['safe']) ? 3 : 0);
    $C['clean_ms_char'] = empty($C['clean_ms_char']) ? 0 : $C['clean_ms_char'];
    $C['comment'] = isset($C['comment']) ? $C['comment'] : (empty($C['safe']) ? 3 : 0);
    $C['css_expression'] = empty($C['css_expression']) ? 0 : 1;
    $C['direct_list_nest'] = empty($C['direct_list_nest']) ? 0 : 1;
    $C['hexdec_entity'] = isset($C['hexdec_entity']) ? $C['hexdec_entity'] : 1;
    $C['hook'] = (!empty($C['hook']) && function_exists($C['hook'])) ? $C['hook'] : 0;
    $C['hook_tag'] = (!empty($C['hook_tag']) && function_exists($C['hook_tag'])) ? $C['hook_tag'] : 0;
    $C['keep_bad'] = isset($C['keep_bad']) ? $C['keep_bad'] : 6;
    $C['lc_std_val'] = isset($C['lc_std_val']) ? (bool) $C['lc_std_val'] : 1;
    $C['make_tag_strict'] = isset($C['make_tag_strict']) ? $C['make_tag_strict'] : 1;
    $C['named_entity'] = isset($C['named_entity']) ? (bool) $C['named_entity'] : 1;
    $C['no_deprecated_attr'] = isset($C['no_deprecated_attr']) ? $C['no_deprecated_attr'] : 1;
    $C['parent'] = isset($C['parent'][0]) ? strtolower($C['parent']) : 'body';
    $C['show_setting'] = !empty($C['show_setting']) ? $C['show_setting'] : 0;
    $C['style_pass'] = empty($C['style_pass']) ? 0 : 1;
    $C['tidy'] = empty($C['tidy']) ? 0 : $C['tidy'];
    $C['unique_ids'] = isset($C['unique_ids']) ? $C['unique_ids'] : 1;
    $C['xml:lang'] = isset($C['xml:lang']) ? $C['xml:lang'] : 0;

    if (isset($GLOBALS['C'])) {
        $reC = $GLOBALS['C'];
    }
    $GLOBALS['C'] = $C;
    $S = is_array($S) ? $S : hl_spec($S);
    if (isset($GLOBALS['S'])) {
        $reS = $GLOBALS['S'];
    }
    $GLOBALS['S'] = $S;

    $t = preg_replace('`[\x00-\x08\x0b-\x0c\x0e-\x1f]`', '', $t);
    if ($C['clean_ms_char']) {
        $x = array(
            "\x7f" => '',
            "\x80" => '&#8364;',
            "\x81" => '',
            "\x83" => '&#402;',
            "\x85" => '&#8230;',
            "\x86" => '&#8224;',
            "\x87" => '&#8225;',
            "\x88" => '&#710;',
            "\x89" => '&#8240;',
            "\x8a" => '&#352;',
            "\x8b" => '&#8249;',
            "\x8c" => '&#338;',
            "\x8d" => '',
            "\x8e" => '&#381;',
            "\x8f" => '',
            "\x90" => '',
            "\x95" => '&#8226;',
            "\x96" => '&#8211;',
            "\x97" => '&#8212;',
            "\x98" => '&#732;',
            "\x99" => '&#8482;',
            "\x9a" => '&#353;',
            "\x9b" => '&#8250;',
            "\x9c" => '&#339;',
            "\x9d" => '',
            "\x9e" => '&#382;',
            "\x9f" => '&#376;'
        );
        $x = $x + ($C['clean_ms_char'] == 1 ? array(
                    "\x82" => '&#8218;',
                    "\x84" => '&#8222;',
                    "\x91" => '&#8216;',
                    "\x92" => '&#8217;',
                    "\x93" => '&#8220;',
                    "\x94" => '&#8221;'
                        ) : array(
                    "\x82" => '\'',
                    "\x84" => '"',
                    "\x91" => '\'',
                    "\x92" => '\'',
                    "\x93" => '"',
                    "\x94" => '"'
        ));
        $t = strtr($t, $x);
    }
    if ($C['cdata'] or $C['comment']) {
        $t = preg_replace_callback('`<!(?:(?:--.*?--)|(?:\[CDATA\[.*?\]\]))>`sm', 'hl_cmtcd', $t);
    }
    $t = preg_replace_callback('`&amp;([A-Za-z][A-Za-z0-9]{1,30}|#(?:[0-9]{1,8}|[Xx][0-9A-Fa-f]{1,7}));`', 'hl_ent', str_replace('&', '&amp;', $t));
    if ($C['unique_ids'] && !isset($GLOBALS['hl_Ids'])) {
        $GLOBALS['hl_Ids'] = array();
    }
    if ($C['hook']) {
        $t = $C['hook']($t, $C, $S);
    }
    if ($C['show_setting'] && preg_match('`^[a-z][a-z0-9_]*$`i', $C['show_setting'])) {
        $GLOBALS[$C['show_setting']] = array(
            'config' => $C,
            'spec' => $S,
            'time' => microtime()
        );
    }
    // main
    $t = preg_replace_callback('`<(?:(?:\s|$)|(?:[^>]*(?:>|$)))|>`m', 'hl_tag', $t);
    $t = $C['balance'] ? hl_bal($t, $C['keep_bad'], $C['parent']) : $t;
    $t = (($C['cdata'] or $C['comment']) && strpos($t, "\x01") !== false) ? str_replace(array(
                "\x01",
                "\x02",
                "\x03",
                "\x04",
                "\x05"
                    ), array(
                '',
                '',
                '&',
                '<',
                '>'
                    ), $t) : $t;
    $t = $C['tidy'] ? hl_tidy($t, $C['tidy'], $C['parent']) : $t;
    unset($C, $e);
    if (isset($reC)) {
        $GLOBALS['C'] = $reC;
    }
    if (isset($reS)) {
        $GLOBALS['S'] = $reS;
    }
    return $t;
    // eof
}

function tep_db_input($value) {

    //Log::info($value . '/in');
    if (is_null($value)) {
        return '';
    }
    // Log::info($value . '/out');

    return $value;
}

function tep_not_null($value) {
    if (is_array($value)) {
        if (sizeof($value) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
            return true;
        } else {
            return false;
        }
    }
}

function get_file_path() {
    return public_path();
}

function tep_session_is_registered($variable) {
    if (PHP_VERSION < 4.3) {
        return session_is_registered($variable);
    } else {
        return isset($_SESSION) && array_key_exists($variable, $_SESSION);
    }
}

function tep_session_register($variable) {
    global $session_started;

    if ($session_started == true) {
        if (PHP_VERSION < 4.3) {
            return session_register($variable);
        } else {
            if (!isset($GLOBALS[$variable])) {
                $GLOBALS[$variable] = null;
            }

            $_SESSION[$variable] = & $GLOBALS[$variable];
        }
    }

    return false;
}

function tep_string_to_int($string) {
    return (int) $string;
}

function tep_set_time_limit($limit) {
    if (!get_cfg_var('safe_mode')) {
        set_time_limit($limit);
    }
}

function tep_get_languages() {
    $languages_array = [];
    $qry_resultset = DB::select('select languages_id, name, code, image, directory  from languages order by sort_order');
    if (is_array($qry_resultset) && count($qry_resultset) > 0) {
        foreach ($qry_resultset as $resultset) {
            $languages_array[] = array('id' => $resultset->languages_id,
                'name' => $resultset->name,
                'code' => $resultset->code,
                'image' => $resultset->image,
                'directory' => $resultset->directory);
        }
    }
    return $languages_array;
}

function get_local_govt_name($lg) {
    //get local govt  name here   
    $qry_resultset = DB::select('select local_govt_area from local_governments_area where local_govt_code = ?', [$lg]);
    if (is_array($qry_resultset) && count($qry_resultset) > 0) {
        $result = $qry_resultset[0];
        return $result->local_govt_area;
    }
    return "";
}

function get_state_name($st) {
    //get state name here   
    $qry_resultset = DB::select('select state from states where state_code = ?', [$st]);
    if (is_array($qry_resultset) && count($qry_resultset) > 0) {
        $result = $qry_resultset[0];
        return $result->state;
    }
    return "";
}


function get_crse_by_dept($dept) {

    $disp = "<option value=''>" . Lang::get('text.txt_select') . "</option>";

    //$qry_resultset = DB::select('select lga_id,lga_name from lgas where state_id = ? order by lga_name', [$st]);

    $qry_resultset = CourseManager::get_crses($dept);
    // if (is_array($qry_resultset) && count($qry_resultset) > 0) {
    foreach ($qry_resultset as $resultset) {
        $txt = "<option value=" . $resultset->course_id . ">" . $resultset->course_code . "&nbsp;&nbsp;&nbsp;" . $resultset->course_short_title . "</option>";
        $disp .=$txt;
    }
    //}
    return $disp;
}

function get_person_type($person_type) {

    switch ($person_type) {
        case "LEC":
            return "LEC Lecturer";
        case "ADJ":
            return "ADJ Adjunct";
        case "STA":
            return "STA Staff";
        case "APL":
            return "APL Applicant";
        case "STU":
            return "STU Student";
        default :
            return "";
    }
}

function get_stud_status($status) {
    switch ($status) {
        case "A":
            return "A Active";
        case "H":
            return "H Hiatus";
        case "L":
            return "L Leave of Absence";
        case "W":
            return "W Withdrawn";
        default :
            return "";
    }
}

function get_stu_prog_status($status) {

    switch ($status) {
        case "A":
            return "A Active";
        case "C":
            return "C Changed Mind";
        case "G":
            return "G Graduated";
        case "W":
            return "W Withdrawn";
        case "P":
            return "P Potential";
        default :
            return "";
    }
}

function get_emp_type_name($emp_type) {

    switch ($emp_type) {
        case "FT":
            return "FT Full Time";
        case "CT":
            return "CT Contract";
        default :
            return "";
    }
}

function get_staff_type_name($emp_type) {

    switch ($emp_type) {
        case "ACA":
            return "ACA Academic";
        case "NAC":
            return "NAC Non Academic";
        default :
            return "";
    }
}

function get_library_type_name($lib_type) {

    switch ($lib_type) {
        case "G":
            return "G General";
        case "D":
            return "D Departmental";
        default :
            return "";
    }
}

function get_acad_lvl_name($acad_lvl) {

    switch ($acad_lvl) {
        case "N/A":
            return "N/A Not Applicable";
        case "CE":
            return "CE Continuing Education";
        case "CTF":
            return "CTF Certificate";
        case "UG":
            return "UG Undergraduate";
        case "GR":
            return "GR Graduate";
        case "DIP":
            return "DIP Diploma";
        case "PR":
            return "PR Professional";
        case "PhD":
            return "PhD Doctorate";
        default :
            return "";
    }
}

function get_crse_lvl_name($crse_lvl) {
    switch ($crse_lvl) {
        case "100":
            return "100 Course Level";
        case "200":
            return "200 Course Level";
        case "300":
            return "300 Course Level";
        case "400":
            return "400 Course Level";
        case "500":
            return "500 Course Level";
        case "600":
            return "600 Course Level";
        case "700":
            return "700 Course Level";
        case "800":
            return "800 Course Level";
        case "900":
            return "900 Course Level";
        default :
            return "";
    }
}

function get_instructor_meth_name($meth) {

    switch ($meth) {
        case "LAB":
            return "LAB Lab";
        case "LEC":
            return "LEC Lecture";
        case "SEM":
            return "SEM Seminar";
        case "LL":
            return "LL Lecture + Lab";
        case "LS":
            return "LS Lecture + Seminar";
        case "SL":
            return "SL Seminar + Lab";
        case "LLS":
            return "LLS Lecture + Lab + Seminar";
        default :
            return "";
    }
}

function get_crse_sec_typ_name($sec_type) {

    switch ($sec_type) {
        case "ONL":
            return "ONL Online";
        case "HB":
            return "HB Hybrid";
        case "ONC":
            return "ONC On-Campus";
        default :
            return "";
    }
}

function get_location_name($sec_type) {

    switch ($sec_type) {
        case "ONL":
            return "ONL Online";
        case "HB":
            return "HB Hybrid";
        case "ONC":
            return "ONC On-Campus";
        default :
            return "";
    }
}

function get_prog_mode_name($mode_type) {

    switch ($mode_type) {
        case "FT":
            return "FT Full Time";
        case "PT":
            return "PT Part Time";
        default :
            return "";
    }
}

function get_stu_status_name($s) {

    switch ($s) {
        case "A":
            return "A Active";
        case "H":
            return "H Hiatus";
        case "L":
            return "L Leave of Absence";
        case "W":
            return "W Withdrawn";

        default :
            return "";
    }
}

function get_admit_status_title($s) {

    switch ($s) {
        case "FF":
            return "FF First Time Freshman";
        case "TR":
            return "TR Transfer";
        case "DE":
            return "DE Direct Entry";
        case "NA":
            return "NA Non-Applicable";

        default :
            return "";
    }
}

function get_dept_type_title($dt) {

    switch ($dt) {
        case "ADMN":
            return "ADMN Administrative";
        case "ACAD":
            return "ACAD Academic";

        default :
            return "";
    }
}

function mrk_sht_apprv_status_title($stat) {

    switch ($stat) {
        case "A":
            return "Approved";
        case "D":
            return "Disapproved";
        case "P":
            return "Pending";
        default :
            return "";
    }
}

function get_nxt_of_kin_rel_name($rel) {
    switch ($rel) {
        case "F":
            return "Father";
        case "M":
            return "Mother";
        case "B":
            return "Brother";
        case "S":
            return "Sister";
        case "A":
            return "Aunty";
        case "U":
            return "Uncle";
        case "G":
            return "Guardian";
        case "O":
            return "Other";
        default :
            return "";
    }
}

function get_status($st) {

    switch ($st) {
        case "A":
            return "Active";
        case "I":
            return "In Active";

        default :
            return "";
    }
}

function stu_course_sec_status_title($stat) {

    switch ($stat) {
        case "A":
            return "A Add";
        case "N":
            return "N New";
        case "D":
            return "D Drop";
        case "W":
            return "W Withdrawn";
        case "C":
            return "C Cancelled";
        default :
            return "";
    }
}

function get_crse_sec_status_title($stat) {

    switch ($stat) {
        case "A":
            return "A Active";
        case "I":
            return "I Inactive";
        case "P":
            return "P Pending";
        case "C":
            return "C Cancel";
        default :
            return "";
    }
}

function get_job_title_name($job_id) {
    
}

function get_semester_title($val, $by = '') {
    return \App\Classes\Facades\SemesterManager::get_semester_title($val, $by);
}

function get_acad_yr_title_by($val, $by = '') {
    return \App\Classes\Facades\AcadYrManager::get_acad_yr_title($val, $by);
}

function get_faculty_title_by($val, $by = '') {
    return \App\Classes\Facades\CollegeManager::get_faculty_title_by($val, $by);
}

function _trim($str) {
    return preg_replace('/\s/', '', $str);
}

function tep_create_random_value($length, $type = 'mixed') {
    if (($type != 'mixed') && ($type != 'chars') && ($type != 'digits'))
        $type = 'mixed';

    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#()^?!';
    $digits = '0123456789';

    $base = '';

    if (($type == 'mixed') || ($type == 'chars')) {
        $base .= $chars;
    }

    if (($type == 'mixed') || ($type == 'digits')) {
        $base .= $digits;
    }

    $value = '';


    $hasher = new \App\Classes\PasswordHash(10, true);

    do {
        $random = base64_encode($hasher->get_random_bytes($length));

        for ($i = 0, $n = strlen($random); $i < $n; $i++) {
            $char = substr($random, $i, 1);

            if (strpos($base, $char) !== false) {
                $value .= $char;
            }
        }
    } while (strlen($value) < $length);

    if (strlen($value) > $length) {
        $value = substr($value, 0, $length);
    }

    return $value;
}

function get_app_url($request = '') {

    $server = Request::server();
    $port = $server['SERVER_PORT']; //$request->getPort();
    if ($port < 0) {
        $port = 80; // Work around java.net.URL bug
    }
    $scheme = $server['REQUEST_SCHEME']; //$request->getScheme();
    $url = $scheme;
    $url .="://";

    $url .=$server['HTTP_HOST']; //$server['SERVER_NAME']

    if (("http" === $scheme && ($port != 80)) || ("https" === $scheme && ($port != 443))) {
        $url .=':';
        $url .=$port;
    }
//$req->getBaseUrl();
    $base_path = Request::getBasePath(); // str_replace_first('/', '', $request->getBasePath());
    if (!empty($base_path)) {
        $url .=$base_path;
    }
//  String contextPath = request.getContextPath();
    /*   if (contextPath != null && !contextPath . isEmpty()) {
      url . append(contextPath);
      }
      url . append(request . getServletPath());
      return url . toString(); */
    return $url;
}

/* CORE FUNCTION */



function remove_array_item($item, $arr) {
    if (($key = array_search($item, $arr)) !== false) {
        unset($arr[$key]);
    }
}

function get_states_by_country($cntry) {

    $disp = "<option value=''>" . Lang::get('text.txt_select') . "</option>";

    $qry_resultset = DB::select('select id,state_name from states where country_id = ? order by state_name', [$cntry]);
    if (is_array($qry_resultset) && count($qry_resultset) > 0) {
        foreach ($qry_resultset as $resultset) {
            $txt = "<option value=" . $resultset->id . ">" . $resultset->state_name . "</option>";
            $disp .=$txt;
        }
    }
    return $disp;
}

function get_local_governments_by_state($st) {

    $disp = "<option value=''>" . Lang::get('text.txt_select') . "</option>";

    $qry_resultset = DB::select('select lga_id,lga_name from lgas where state_id = ? order by lga_name', [$st]);
    if (is_array($qry_resultset) && count($qry_resultset) > 0) {
        foreach ($qry_resultset as $resultset) {
            $txt = "<option value=" . $resultset->lga_id . ">" . $resultset->lga_name . "</option>";
            $disp .=$txt;
        }
    }
    return $disp;
}