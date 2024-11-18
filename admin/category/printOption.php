<!-- html형식으로 옵션을 출력해서 알려준다. -->
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/dbcon.php');

/* 
1. 세 개의 인수를 변수에 담는다.
2. sql -> 실행(result)
    2-1. sql = 넘어온 것을 db에서 step이 2인 코드에서 pcode A와 일치하는 것 조회하기
        조건 두개 1) 스텝이 일치하는 것 / pcode에 값이 사용자가 선택한 카테고리의 값과 같은 것
    2-2. 패치 오브젝트 -> 객체 출력 객체 있을 때 마다 옵션 출력 데이타에 할당
        카테1배열에 데이타를 할당한다. 

    출력할 형태 변수에 담는다. 옵션

    html에 html의 옵션코드를 더한다. 복합연산자.
*/
$cate = $_POST['cate'];
$step = $_POST['step'];
$category = $_POST['category'];
print_r($cate);
$sql = "SELECT * FROM category WHERE step = $step and pcode = '$cate' ";
$result = $mysqli->query($sql);

$html = "<option selected>{$category}</option>";

while($data = $result->fetch_object()){
  $html .=  "<option value=\"{$data->code}\">{$data->name}</option>";
}
var_dump($_POST); // POST 데이터 확인

echo $html;
$mysqli->close();
?>