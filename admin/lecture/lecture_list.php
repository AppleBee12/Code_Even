<?php
  $title = "강좌 목록";

  include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

?>

<div class="container">
  <h2>강좌 목록</h2>
  <form action="" class="d-flex justify-content-end">
    <div class="d-flex w-25 mb-3">
      <input type="text" name="search_keyword" class="form-control" id="search" placeholder="검색어를 입력하세요.">
      <button type="button" class="btn lesearch"><i class="bi bi-search"></i></button>
    </div>
  </form>
  <form action="lelist_update.php" method="GET">
    <table class="table list_table">
      <thead>
          <th scope="col">번호</th>
          <th scope="col">이미지</th>
          <th scope="col">강좌명</th>
          <th scope="col">등록자</th>
          <th scope="col">학습 기간</th>
          <th scope="col">강좌 유형</th>
          <th scope="col">강좌 전시 옵션</th>
          <th scope="col">상태</th>
          <th scope="col">승인</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <th scope="row">1</th>
          <td><img src="" alt=""></td>
          <td>HTML 도장 깨기</td>
          <td>admin</td>    
          <td>60일</td>
          <td>
            <div>
              <span class="badge text-bg-secondary d-none">일반</span>
              <span class="badge recipe">레시피</span>
            </div>
          </td>
          <td>
              <div class="form-check d-inline-block me-2">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"> 베스트 </label>
              </div>
              <div class="form-check d-inline-block">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault"> 추천 </label>
              </div>
            </td>
          <td>
            <div>
              <span class="badge text-bg-secondary">개설</span>
              <span class="badge waitopen d-none">개설 대기</span>
            </div>
          </td>
          <td>
            <div class="d-flex justify-content-center align-items-center">
              <div class="form-check form-switch">
                <input class="form-check-input tog" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <!-- <label class="form-check-label" for="flexSwitchCheckDefault"></label> -->
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex justify-content-center gap-4">
              <i class="bi bi-pencil-fill"></i>
              <i class="bi bi-trash"></i>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2 mt-20 mb-50">
      <button type="button" class="btn selecmodify">일괄 수정</button>
      <button type="button" class="btn nlecture">강좌 등록</button>
    </div>
  </form>
  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="">1</a></li>
      <li class="page-item"><a class="page-link" href="">2</a></li>
      <li class="page-item"><a class="page-link" href="">3</a></li>
      <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
</div>


<?php

include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');

?>