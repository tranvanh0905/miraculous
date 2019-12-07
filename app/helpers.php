<?php

//app/helpers.php
use Illuminate\Support\Facades\DB;

function getWebSetting()
{
    $websetting = \App\WebSettings::first();
    return $websetting;
}

function get3songBottom()
{
    $song = \App\Song::inRandomOrder()->limit(3)->get();
    return $song;
}

//Get time ago

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}

function getToken($length = 12)
{
    $token = '';
    $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codeAlphabet .= time();
    $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
    $codeAlphabet .= '0123456789';
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; ++$i) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }

    return $token;
}

function getSlider()
{
    $allSlider = \App\Slider::where('status', '=', 1)->orderBy('sort', 'asc')->get();
    return $allSlider;
}

function convertDate($date)
{
    $orgDate = $date;
    return $newDate = date("d-m-Y", strtotime($orgDate));
}
