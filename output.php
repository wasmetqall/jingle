<html>
<?php
require('func.php');
require('convertFuncs.php');
use Overtrue\Pinyin\Pinyin;

require_once "vendor/autoload.php";

$jingleInput = htmlspecialchars($_POST['jingleInput']);
$n_ng = $n_l = $h_f = false;
if (isset($_POST['n_ng']))
    $n_ng = true;
if (isset($_POST['n_l']))
    $n_l = true;
if (isset($_POST['h_f']))
    $h_f = true;
$wordPinyin = convertToPinyin($jingleInput);
$wordPinyinAfterPermutation = array();
permute($wordPinyin, 0, count($wordPinyin), $wordPinyinAfterPermutation);
$wordsPinyinArray = array();
foreach ($wordPinyinAfterPermutation as $wordPinyin) {
    convertForWord($wordPinyin, 0, count($wordPinyin), $n_ng, $n_l, $h_f, $wordsPinyinArray);
}
foreach ($wordsPinyinArray as $wordPinyin) {
    $input = "";
    foreach ($wordPinyin as $singlePinyin)
        $input .= $singlePinyin . "'";
    getJson(5, $input);
}

?>
</html>
