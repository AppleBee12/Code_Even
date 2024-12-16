<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<!--탭 메뉴 시작-->
<div class="mypage_tap_wrapper d-flex">
  <div class="mypage_tap headt6 active"><a href="#">진행 강좌</a></div>
  <div class="mypage_tap headt6"><a href="">종료 강좌</a></div>
</div>
<!--탭 메뉴 끝-->
<!--제목 시작-->
<div class="mypage_title_wrapper">
  <p class="mypage_title headt5">사용 안내</p>
</div>
<!--제목 끝-->
<div class="">


  <!--나중에 이 div만 삭제하고 사용하세요-->
  <div class="for_explain_remove_plz">
    <hr>
    <p>할일1.</p>
    <p><b>이 php를 복사해서 새로운 php를 만들어주세요!</b></p>
    <br>
    <p>처음 php를 만들면 css연결이 되어있지 않습니다</p>
    <p>header.php로 가셔서,</p>
    <p>49번 라인 mypage_header.css에</p>
    <p>새로 만든 php이름을 추가해주세요</p>
    <br>
    <p>+추가 팁: 이왕 간 김에 새로 만든 php에 맞는 css파일을 만들고 그 경로도 추가해주세요</p>
    <hr>
    <p>할일2.</p>
    <p><b>바로 위쪽에 탭 메뉴와 제목은 필요에 따라 지우고 사용하세요</b></p>
    <br>
    <p>미리 탭메뉴와 제목을 만들고 설정을 잡아놨습니다</p>
    <p>탭 메뉴와 제목 모두 들어가시는 분도 있고</p>
    <p>탭 메뉴만 들어가시는 분도</p>
    <p>일반 제목만 들어가시는 분도 있어서</p>
    <p>기본 설정을 잡아놨습니다</p>
    <p>mypage_header.css에서 css확인이 가능합니다!</p>
    <p>화이팅~!</p>
  </div>
  <!--나중에 이 div만 삭제하고 사용하세요-->


</div>
</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>