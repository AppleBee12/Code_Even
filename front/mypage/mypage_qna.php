<?php
$title = '마이페이지-문의글보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');

?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab1"  role="tab" aria-controls="nav-myLecTab1" aria-selected="true">강의 문의</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2"  role="tab" aria-controls="nav-myLecTab2" aria-selected="false">서비스 문의</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
<div class="tab-content" id="nav-tabContent"><!--탭 메뉴 내용 시작-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab"><!-- 탭메뉴1 -->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 내역</p>
    </div>
    <div>
    <table class="table list_table">
    <thead>
      <tr>
        <th scope="col">
          <input class="form-check-input" type="checkbox" id="allCheck">
        </th>
        <th scope="col">번호</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th></th>
        <td></td>
      </tr>
    </tbody>
  </table>
    </div>  

    <!--제목 끝-->
  </div>
  <div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab"><!-- 탭메뉴2//탭이 없으면 삭제하세용-->
    <!--제목 시작-->
    <div class="mypage_title_wrapper">
      <p class="mypage_title headt5">나의 문의 내역</p>
    </div>
    <!--제목 끝-->  
    <div>
    </div>
  </div><!-- 탭메뉴2 끝-->
</div>


</div><!--여기부터는 마이페이지 헤더의 닫는 태그-->
</section>
</div>
</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>