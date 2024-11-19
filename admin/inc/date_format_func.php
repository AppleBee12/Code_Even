<?php

function formatDate($date, $includeTime = false) {
    if ($date) {
        $format = $includeTime ? 'Y/m/d H:i:s' : 'Y/m/d';
        return (new DateTime($date))->format($format);
    }
    //return ''; // 날짜가 없는 경우 빈 문자열 반환
}

?>