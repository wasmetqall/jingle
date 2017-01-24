<?php
function convertForWord($wordPinyin, $i, $n, $n_ng, $n_l, $h_f, &$wordsPinyinArray) {
    if ($i == $n) {
        array_push($wordsPinyinArray, $wordPinyin);
    }
    else {
        //push original singlePinyin
        //convert singlePinyin and push
        $singlePinyinsAfterConversion = array();
        convertForSinglePinyin($wordPinyin[$i], $n_ng, $n_l, $h_f, $singlePinyinsAfterConversion);
        foreach ($singlePinyinsAfterConversion as $value) {
            $wordPinyin[$i] = $value;
            convertForWord($wordPinyin, $i + 1, $n, $n_ng, $n_l, $h_f, $wordsPinyinArray);
        }
    }
}

function convertForSinglePinyin($singlePinyin, $n_ng, $n_l, $h_f, &$singlePinyinsAfterConversion) {
    array_push($singlePinyinsAfterConversion, $singlePinyin);
    if ($n_l && inspect_n_l($singlePinyin)) {
        if ($n_ng && inspect_n_ng($singlePinyin)) {
            convert_n_l($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
            convert_n_ng($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
            convert_n_l($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
        }
        else {
            convert_n_l($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
        }
    }
    elseif ($h_f && inspect_h_f($singlePinyin)) {
        if ($n_ng && inspect_n_ng($singlePinyin)) {
            convert_h_f($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
            convert_n_ng($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
            convert_h_f($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
            
        }
        else {
            convert_h_f($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
        }
    }
    else {
        if ($n_ng && inspect_n_ng($singlePinyin)) {
            convert_n_ng($singlePinyin);
            array_push($singlePinyinsAfterConversion, $singlePinyin);
        }
    }
}

function inspect_n_ng($singlePinyin) {
    if (substr($singlePinyin, -1) == 'n' || substr($singlePinyin, -2) == 'ng')
        return true;
    else
        return false;
}

function convert_n_ng(&$singlePinyin) {
    if (substr($singlePinyin, -1) == 'n')
        $singlePinyin .= 'g';
    elseif (substr($singlePinyin, -2) == 'ng')
        $singlePinyin = substr($singlePinyin, 0, -1);
}

function inspect_n_l($singlePinyin) {
    if ($singlePinyin[0] == 'n' || $singlePinyin[0] == 'l')
        return true;
    else
        return false;
}

function convert_n_l(&$singlePinyin) {
    if ($singlePinyin[0] == 'n')
        $singlePinyin[0] = 'l';
    elseif ($singlePinyin[0] == 'l')
        $singlePinyin[0] = 'n';
}

function inspect_h_f($singlePinyin) {
    if ($singlePinyin[0] == 'h' || $singlePinyin[0] == 'f')
        return true;
    else
        return false;
}

function convert_h_f(&$singlePinyin) {
    if ($singlePinyin[0] == 'h')
        $singlePinyin[0] = 'f';
    elseif ($singlePinyin[0] == 'f')
        $singlePinyin[0] = 'h';
}


