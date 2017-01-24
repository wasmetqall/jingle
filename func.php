<?php
use Overtrue\Pinyin\Pinyin;

function permute($pinyinArray, $i, $n, &$array) {
    if ($n == $i) {
        array_push($array, $pinyinArray);
    }
    else {
        for ($j = $i; $j < $n; $j++) {
            swap($pinyinArray, $i, $j);
            permute($pinyinArray, $i + 1, $n, $array);
            swap($pinyinArray, $i, $j);
        }
    }
}

function swap(&$str, $i, $j) {
    $tmp = $str[$i];
    $str[$i] = $str[$j];
    $str[$j] = $tmp;
}

function convertToPinyin($hanzi) {
    $pinyinObj = new Pinyin();
    $pinyin = $pinyinObj->convert($hanzi);
    return $pinyin;
}

//function convertPronunciation($n_ng, $n_l, $h_f, &$array) {
//    $cnt1 = count($array);
//    $cnt2 = count($array[1]);
//    if (!($n_ng || $n_l || $h_f))
//        return;
//    for ($i = 0; $i < $cnt1; $i++) {
//        for ($j = 0; $j < $cnt2; $j++)
//            if ($n_ng) {
//                if ($n_l) {
//                    if ($h_f)
//                        ;
//                    //convert_n_ng_n_l_h_f($array[$i],$array);
//
//                    else; //!$h_f
//                    //convert_n_ng_n_l($array[$i],$array);
//                }
//                else {//!$h_f !$n_l
//                    if ($h_f)
//                        ;
//                    //convert_n_ng_h_f($array[$i],$array);
//                    else
//                        convert_n_ng($array[$i], $array);
//                }
//            }
//            else {
//                if ($n_l) {
//                    if ($h_f)
//                        ;
//                    //convert_n_l_h_f($array[$i],$array);
//
//                    else //!$h_f
//                        convert_n_l($array[$i], $array);
//                }
//                else {//!$h_f !$n_l
//                    if ($h_f)
//                        convert_h_f($array[$i], $array);
//                }
//            }
//
//    }
//}

//function convert_n_ng($pinyin, &$array) {
//    if ($pinyin[-1] == 'n')
//        array_push($array, $pinyin . 'g');
//    elseif (substr($pinyin, -2, 2) == 'ng')
//        array_push($array, substr($pinyin, 0, -1));
//}
//
//function convert_n_l($pinyin, &$array) {
//    if ($pinyin[0] == 'n')
//        array_push($array, 'l' . substr($pinyin, 1));
//    elseif ($pinyin[0] == 'l') {
//        array_push($array, 'n', substr($pinyin, 1));
//    }
//}
//
//function convert_h_f($pinyin, &$array) {
//    if ($pinyin[0] == 'h')
//        array_push($array, 'f' . substr($pinyin, 1));
//    elseif ($pinyin[0] == 'f') {
//        array_push($array, 'h', substr($pinyin, 1));
//    }
//}

function getJson($size, $pinyin) {
    $url = "http://olime.baidu.com/py?input=$pinyin&inputtype=py&bg=0&ed=20&result=hanzi&resultcoding=unicode&ch_en=0&clientinfo=web&version=1";
    $page_content = file_get_contents($url);
    $json = json_decode($page_content, true);
    
    if (count($json['result'][0]) >= $size) {
        for ($i = 0; $i < $size; ++$i)
            echo $json['result'][0][$i][0] . " ";
    }
    else {
        foreach ($json['result'][0] as $value)
            echo $value[0] . " ";
    }
    echo "<br>";
}

