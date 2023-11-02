<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function obj_to_arry($o = '', $nested = false) {

    if (is_object($o)) {
        /* if nested is true use json encode/decode otherwise use type cast */
        if ($nested) {
            
        } else {
            return (array) $o;
        }
    }
}

function arry_to_obj(array $array) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = array_to_object($value);
        }
    }
    return (object) $array;
}

function parse_cookies($header) {

    $cookies = array();

    $cookie = new \App\Classes\Domain\Cookie();

    $parts = explode("=", $header);
    for ($i = 0; $i < count($parts); $i++) {
        $part = $parts[$i];
        if ($i == 0) {
            $key = $part;
            continue;
        } elseif ($i == count($parts) - 1) {
            $cookie->set_value($key, $part);
            $cookies[] = $cookie;
            continue;
        }
        $comps = explode(" ", $part);
        $new_key = $comps[count($comps) - 1];
        $value = substr($part, 0, strlen($part) - strlen($new_key) - 1);
        $terminator = substr($value, -1);
        $value = substr($value, 0, strlen($value) - 1);
        $cookie->set_value($key, $value);
        if ($terminator == ",") {
            $cookies[] = $cookie;
            $cookie = new cookie();
        }

        $key = $new_key;
    }
    return $cookies;
}


function get_fs_storage_path($disk = '', $path_type = 'rel') {

    if (empty($disk)) {
        $disk = config('filesystems.default');
    }
    switch ($disk) {
        case 'local':
            if ($path_type == 'full') {
                return config('filesystems.disks.local.root') . '/';
            } else {
                return 'storage/app/';
            }
            break;
        case 'public':
            //get root directory for case full
            if ($path_type == 'full') {
                return config('filesystems.disks.public.root') . '/';
            } else {
                return 'storage/app/public/';
            }
        default:
            return '';
    }
}

function get_ws_storage_path($disk = '') {

    if (empty($disk)) {
        $disk = config('filesystems.default');
    }
    switch ($disk) {
        case 'local':
            // return asset(Storage::disk($disk)->url('/')) . '/';
            return asset(config('private_file_route'));
        case 'public':
            return asset(Storage::disk($disk)->url('/')) . '/';
        case 's3':
            return asset(Storage::disk($disk)->url('/')) . '/';
        default:
            return '';
    }
}

function get_image_save_path_dir($dir = '', $disk = '') {

    // Storage::url($dir);
    switch ($disk) {
        case 'local':
        case '':
            //append root directory since storage url returns a relative path to storage dir
            return config('public') . $dir;
        default:
            return $dir;
    }
}

function get_file_rel_path($file, $disk = '') {

    switch ($disk) {
        case 'local':
        case '':
            //append root directory since storage url returns a relative path to storage dir
            return config('public') . $file;
        default:
            return $file;
    }
}

/* images functn */

function resize_images($id, $from_path, $imgs_info) {

    try {
        foreach ($imgs_info as $img_info) {
            resize_image($id, $from_path, $img_info['destination_dir'], $img_info['filename'], $img_info['pref_size']);
        }
    } catch (\Exception $e) {
        \Log::error($e);
    }
}

function resize_image($id, $from_path, $desination_dir, $filename, $preferred_size) {
    $pref_size = explode(',', $preferred_size);
    if (is_array($pref_size) && count($pref_size) > 1) {
        $img = \Intervention\Image\Facades\Image::make($from_path)->resize((int) $pref_size[0], (int) $pref_size[1]);
        $img->save($desination_dir . $filename);
    }
}


/**
 * Limit the File Name Length
 *
 * @param	string
 * @return	string
 */
function limit_filename_length($filename, $length) {
    if (strlen($filename) < $length) {
        return $filename;
    }
    $ext = '';
    if (strpos($filename, '.') !== FALSE) {
        $parts = explode('.', $filename);
        $ext = '.' . array_pop($parts);
        $filename = implode('.', $parts);
    }
    return substr($filename, 0, ($length - strlen($ext))) . $ext;
}

function go_back($url = '') {

    if (empty($url)) {
        // Log::info('back-'.\Session::get('history_back_url'));
        return \Session::get('history_back_url');
    }
    return $url;
}

function iteratable($data) {
    if (isset($data) && (($data instanceof \Illuminate\Support\Collection && !$data->isEmpty()) ||
            is_array($data) && !empty($data))) {
        return true;
    }
    return false;
}

function tep_empty($data) {
    if (isset($data) && (($data instanceof \Illuminate\Support\Collection && !$data->isEmpty()) ||
            is_array($data) && !empty($data)) || is_string($data) && $data != '') {
        return false;
    }
    return true;
}

function build_data(&$main, $append_from, $cols = '') {
    if (is_object($append_from)) {
        $table = $append_from->getTable();
        //if (tep_empty($cols)) {
        $attrs = $append_from->getAttributes();
        foreach ($attrs as $key => $val) {
            $main->{$table . '_' . $key} = $val;
        }
        //}
    }
}

/**
 * This function is used to generate a "clean" version of a string.
 * Clean means that it is a case insensitive form (case folding) and that it is normalized (NFC).
 * Additionally a homographs of one character are transformed into one specific character (preferably ASCII
 * if it is an ASCII character).
 *
 * Please be aware that if you change something within this function or within
 * functions used here you need to rebuild/update the username_clean column in the users table. And all other
 * columns that store a clean string otherwise you will break this functionality.
 *
 * @param	string	$text	An unclean string, mabye user input (has to be valid UTF-8!)
 * @return	string			Cleaned up version of the input string
 */
function utf8_clean_string($text) {
    // Other control characters
    $text = preg_replace('#(?:[\x00-\x1F\x7F]+|(?:\xC2[\x80-\x9F])+)#', '', $text);

    // we need to reduce multiple spaces to a single one
    $text = preg_replace('# {2,}#', ' ', $text);

    // we can use trim here as all the other space characters should have been turned
    // into normal ASCII spaces by now
    return trim($text);
}

function redirect_back($with = '', $input = '', $validator = '') {

    if (strpos(url()->previous(), 'login') !== false) {
        return redirect(action('DefaultController@indexAction'));
    }

    $redirector = redirect()->back();
    if (!empty($with) || is_array($with)) {
        $redirector->with($with);
    }
    if (!empty($validator) && is_object($validator)) {
        $redirector->withErrors($validator);
    }
    if ($input || is_array($input)) {
        if (is_array($input)) {
            $redirector->withInput($input);
        } else {
            $redirector->withInput();
        }
    }
    return $redirector;
}

