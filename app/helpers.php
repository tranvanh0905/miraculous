<?php

//app/helpers.php
use Illuminate\Support\Facades\DB;

function getWebSetting()
{
    $websetting = \App\WebSettings::first();
    return $websetting;
}