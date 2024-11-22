<?php
$dataFile = $_SERVER['DOCUMENT_ROOT'] . '/code_even/inc/visit_data.json';
$today = date("Y-m-d");

if (!isset($_COOKIE["visited"])) {
    // 방문 데이터 로드
    $data = [];
    if (file_exists($dataFile)) {
        $data = json_decode(file_get_contents($dataFile), true);
    }

    // 오늘 방문 기록 추가
    if (!isset($data[$today])) {
        $data[$today] = 0;
    }
    $data[$today]++;

    // 방문 데이터 저장
    file_put_contents($dataFile, json_encode($data));

    // 쿠키 설정 (1일 유지)
    setcookie("visited", "yes", time() + 86400);
}



/*
매일의 방문자 수를 'visit_data.json'파일에 24시간 간격으로 저장해주는 쿠키 로직입니다.

//방문 데이터를 로드를 하고 싶으실 때는 아래 json decode로 불러오세요!
$dataFile = "visit_data.json";
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

//YYYY-MM까지만 추출 = 7
$monthlyData = [];
foreach ($data as $date => $count) {
    $month = substr($date, 0, 7);
    if (!isset($monthlyData[$month])) {
        $monthlyData[$month] = 0;
    }
    $monthlyData[$month] += $count;
}

echo "<pre>";
print_r($monthlyData);
echo "</pre>";
*/
?>

