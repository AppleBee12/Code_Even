<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
?>
<div class="container">
  <ul class="d-flex justify-content-center service_tab">
    <li class="nav_list">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/faq.php">FAQ</a>
    </li>
    <li class="nav_list_active">
      <a class="nav_item" href="http://<?= $_SERVER['HTTP_HOST'] ?>/code_even/front/service/notice.php">공지사항</a>
    </li>
  </ul>
  <div class="service_title">
    <h2 class="headt2">공지사항</h2>
    <div class="d-flex justify-content-center">
      <div class="content">
        <div class="title">
          <h3 class="headt3">코드이븐에서 알려드리는 소식입니다.</h3>
          <h4 class="headt6">이 곳에서 새로운 소식을 만나보세요!</h4>
        </div>
        <div class="search">
          <form action="#" class="d-flex align-items-center">
            <button type="submit"><i class="bi bi-search"></i></button type="submit">
            <label for="faqSearch" class="visually-hidden">FAQ 검색창</label>
            <input type="search" class="form-control" id="faqSearch" placeholder="검색어를 입력해주세요">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');?>