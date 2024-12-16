<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1"  role="tab" aria-controls="nav-myLecTab1" aria-selected="true">탭 메뉴1</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2"  role="tab" aria-controls="nav-myLecTab2" aria-selected="false">탭 메뉴2</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">탭 메뉴1 제목이에요</p>
    </div>
    <div>
      <!--나중에 이 div를 삭제하고 사용하세요-->
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

    <!--제목 끝-->
  </div>
  <div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴2//탭이 없으면 삭제하세용-->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">탭메뉴2의 제목이에요</p>
    </div>
    <!--제목 끝-->  
    <div>탭 메뉴 2의 내용이 들어갈 자리입니다~~</div>
  </div><!-- 탭메뉴2 끝-->
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>