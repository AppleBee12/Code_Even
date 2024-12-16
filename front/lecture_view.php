<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

?>
<div class="container">
  <div class="row">
    <div class="col-9">
      <img src="" alt="">
    </div>
    <div class="col-3">
      <h4>제대로 파는 HTML CSS</h4>
      <p>44,000 원</p>
      <hr>
      <ul>
        <li>
          <div class=" d-flex gap-2">
            <i class="bi bi-play-circle"></i>
            <p>VOD / 총 5강 / 2시간 15분</p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2">
            <i class="bi bi-calendar"></i>
            <p>30일 수강 가능</p>
          </div>
        </li>
        <li>
          <div class=" d-flex gap-2">
            <i class="bi bi-archive"></i>
            <p>강의 자료 있음</p>
          </div>
        </li>
      </ul>
      <hr>
      <p class="mt-4 fw-semibold">[교재] 목요일 TOO MUCH 친절한 HTML+CSS+자바...</p>
      <div class="d-flex justify-content-between">
        <p class="text-danger fs-5 fw-bold mb-3">28,800 원</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            <p>교재 함께 구매</p>
          </label>
        </div>
      </div>
      <hr>
      <div class="d-flex gap-2">
        <button class="btn btn-dark me-2">
          <i class="bi bi-cart"></i>
        </button>
        <button class="btn btn-outline-secondary">바로 구매하기</button>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-dark me-2 d-flex gap-2">
        <i class="bi bi-heart heart-icon" id="heart-icon"></i>
        <i class="bi bi-heart-fill heart-icon-filled d-none" id="heart-icon-filled"></i>
          <p>찜하기</p>
        </button>
        <button class="btn btn-dark me-2 d-flex gap-2">
          <i class="bi bi-share"></i>
          <p>공유하기</p>
        </button>
      </div>
    </div>
  </div>
</div>
<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>
