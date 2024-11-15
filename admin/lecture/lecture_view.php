<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>

<style>
  .mainimg{
    position: relative;
    left: 50%;
    transform: translateX(-50%);
  }

  tr{
    border-color: var(--bk0);
    margin-bottom: 8px;
  }

  .mainimg{
    width: 350px;
    padding: 40px;
  }

</style>

<div class="container">
  <h2>강좌 상세</h2>
  <form action="" method="">
    <table class="table details_table">
      <colgroup>
        <col style="width:160px">
        <col style="">
        <col style="width:160px">
        <col style="">
        <col style="width:160px">
        <col style="">
      </colgroup>
      <tbody>
        <tr>
          <div class="d-flex justify-content-between text-nowrap">
            <div>
              <th scope="row">강좌명</th>
              <td colspan="4">기초부터 확실하게! (페이지의 내용전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)</td>
            </div>
            <div>
              <th scope="row">수강료</th>
              <td>50,000원</td>
            </div>
          </div>
        </tr>
        <tr class="none">
          <th scope="row">분류</th>
          <td>웹 개발 / 프론트엔드 / HTML</td>
          <th scope="row">강사명</th>
          <td colspan="2">홍길동</td>
          <th scope="row">학습 기간</th>
          <td>2024 / 10 / 01 ~ 2024 / 11 /1</td>
        </tr>
        <tr>
          <td colspan="9"><img src="../../images/sb_logo.png" alt="" class="mainimg"></td>
        </tr>
        <tr>
          <th>강좌 소개</th>
          <td colspan="5">프론트엔드의 가장 기본인 HTML로 뼈대를 만들고  CSS를 활용하여 옷을 입혀 봅시다.</td>
        </tr>
      </tbody>
    </table>
  </form>
  <div class="content_bar">
    <h3">강의 상세</h3>
  </div>
  <form action="" method="" class="mt-3">
    <table class="table list_table">
      <colgroup>
        <col style="width:160px">
        <col style="width:516px">
        <col style="width:160px">
        <col style="width:516px">
      </colgroup>
      <tbody>
        <tr>
          <th scope="row" rowspan="3"><img src="../../images/sb_logo.png" alt="" style="width: 200px;"></th>
          <td>1강. 개발 시작하기 전 준비!</td>
          <td>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">실습 파일</span>
            <input type="text" class="form-control file-view" placeholder="index.html" aria-label="Recipient's username" aria-describedby="basic-addon2">
          </div>
          </td>
          <td>
            <button type="button" class="btn btn-sm nlecture">퀴즈 미리보기</button>
            <button type="button" class="btn btn-sm nlecture">시험 미리보기</button>
          </td>
        </tr>
        <tr>
          <td rowspan="2" colspan="3">
            <p>개발을 대하는 마음가짐과 검색 방법 및 공식 문서 활용하는 습관을 키우며 vs code 설치까지 한 번에! 완전 처음 접하시는 분이라면 무조건 집중
            해서 수강해 보세요</p>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>
