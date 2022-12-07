<?php

function minify_html($buffer)
{
    $search = array(
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s',
        '/<!--(.|\s)*?-->/'
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
    if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
        $buffer = preg_replace($search, $replace, $buffer);
    }
    return $buffer;
}

function minify_css($buffer)
{
    $search = array(
        '/\/\*((?!\*\/).)*\*\//',
        '/\s{2,}/',
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s',
        '/\s*([{};,:])\s*/'
    );
    $replace = array(
        '',
        ' ',
        '>',
        '<',
        '\\1',
        '\\1'
    );
    if (preg_match("/\<style/i", $buffer) == 1 && preg_match("/\<\/style\>/i", $buffer) == 1) {
        $buffer = preg_replace($search, $replace, $buffer);
    }
    return $buffer;
}

function minify_js($buffer)
{
    $search = array(
        '/\/\*((?!\*\/).)*\*\//',
        '/\s{2,}/',
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s'
    );
    $replace = array(
        '',
        ' ',
        '>',
        '<',
        '\\1'
    );
    if (preg_match("/\<script/i", $buffer) == 1 && preg_match("/\<\/script\>/i", $buffer) == 1) {
        $buffer = preg_replace($search, $replace, $buffer);
    }
    return $buffer;
}

// nén html, css, js - valedrat
function minify_output($buffer = null)
{
    $buffer = minify_html($buffer);
    $buffer = minify_css($buffer);
    $buffer = minify_js($buffer);
    return $buffer;
}
ob_start("minify_output");
