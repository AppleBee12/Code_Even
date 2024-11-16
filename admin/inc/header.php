<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if (!isset($title)) {
  $title = '';
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='login/login.php';
  </script>";
}
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐 솔루션-관리자 페이지</title>

  <!-- 공통 Style CSS -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/reset.css">
  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    integrity="sha256-IKhQVXDfwbVELwiR0ke6dX+pJt0RSmWky3WB2pNx9Hg=" crossorigin="anonymous">

  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/summernote-bs5.css"
    rel="stylesheet">

  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/common.css">
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/css/main.css">

  <!-- 개인 Style CSS -->
  <?php
  $page = basename($_SERVER['PHP_SELF']); // 현재 실행 중인 페이지 이름을 가져옴
  switch ($page) {
    case 'teacher_list.php':
    case 'teacher_details.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/teacher.css">';
      break;
  }
  switch ($page) {
    case 'delivery_list.php':
    case 'orders_list.php':
    case 'orders_details.php':
    case 'refunds_list.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/orders.css">';
      break;
  }
  switch ($page) {
    case 'student_list.php':
    case 'student_details.php':
    case 'student_question.php':
    case 'student_question_details.php':
    case 'send_email.php':
    case 'course_reviews.php':
    case 'course_reviews_details.php':
    case 'notice.php':
    case 'notice_write.php':
    case 'notice_modify.php':
    case 'notice_search_result.php':
    case 'student_faq.php':
    case 'student_faq_write.php':
    case 'student_faq_modify.php':
    case 'teacher_faq.php':
    case 'teacher_faq_write.php':
    case 'teacher_faq_modify.php':
    case 'admin_qna.php':
    case 'admin_qna_datails.php':
    case 'admin_qna_write.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/student_inquiry.css">';
      break;
  }
  switch ($page) {
    case 'lecture_list.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/lecture.css">';
      break;
  }
  switch ($page) {
    case 'lecture_up.php':
      echo '<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/code_even/admin/css/lecture.css">';
      break;
  }
  ?>

  <!-- 개인 추가 js -->
  <?php
  if (isset($chart_js)) {
    echo $chart_js;
  }
  if (isset($main_js)) {
    echo $main_js;
  }

  ?>

</head>

<body>
  <header class="header d-flex justify-content-between">
    <h1 class="logo"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php">code even</a></h1>
    <div class="header_profile d-flex justify-content-between">
      <div class="alarm">
        <i class="bi bi-bell">
          <span class="position-absolute top-0 start-80 translate-middle badge rounded-pill bg-danger">
            1
            <span class="visually-hidden">unread messages</span>
          </span>
        </i>
      </div>
      <div>
        <p><?= $_SESSION['AUNAME'] ?> 님</p>
        <p>환영합니다.</p>
      </div>
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link" href="#"><img src="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/images/sb_logo.png"
              alt="" width="50"></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
            aria-expanded="false"></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">내 프로필 수정</a></li>
            <li><a class="dropdown-item" href="#">관리자 매뉴얼</a></li>
            <li><a class="dropdown-item" href="#">강사 매뉴얼</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item"
                href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/login/logout.php">로그아웃</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </header>
  <div class="nav_wrapper d-flex">
    <nav class="nav navbar-expand-lg d-flex flex-column justify-content-between">
      <div>
        <ul class="list-group line">
          <li class="list-group-item" data-link="admin"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/index.php">　<i
                class="bi bi-grid"></i> 　 대시보드</a></li>
        </ul>
        <ul class="list-group line">
          <li class="list-group-item" data-link="category">
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/category/category.php">
              　<i class="bi bi-tags"></i> 　 카테고리 관리
            </a>
          </li>
          <li class="pr list-group-item" data-link="lecture">
            　<i class="bi bi-collection-play"></i> 　 강좌 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#lecture_collapse" href="#"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="lecture_collapse">
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/lecture_list.php"> 　 - 강좌 목록</a></li>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/lecture_up.php"> 　 - 강좌 등록</a></li>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/quiz_test_list.php"> 　 - 퀴즈 / 시험
                  목록</a></li>
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/lecture/quiz_test_outcome.php"> 　 - 퀴즈 / 시험
                  결과 관리</a></li>
            </ul>
          </li>
          <li class="pr list-group-item" data-link="book">　<i class="bi bi-book"></i> 　 교재 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#book_collapse" href="#"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="book_collapse">
              <li class="list-group-item dropdown-item"><a href=""> 　 - 교재 목록</a></li>
              <li class="list-group-item dropdown-item"><a href=""> 　 - 교재 등록</a></li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <li class="list-group-item" data-link="user">　<a href=""><i class="bi bi-people"></i> 　 전체 회원 관리</a></li>
          <li class="list-group-item" data-link="teacher"><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/teacher/teacher_list.php">　<i
                class="bi bi-incognito"></i> 　 강사 관리</a>
          </li>
          <li class="pr list-group-item" data-link="student">　<i class="bi bi-mortarboard"></i> 　 수강생 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#student_collapse" href="#"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="student_collapse">
              <li class="list-group-item dropdown-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/student_list.php"> 　 - 수강생 목록</a>
              </li>
              <li class="list-group-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/student_question.php"> 　 - 수강생 질문</a>
              </li>
              <li class="list-group-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/send_email.php"> 　 - 이메일 발송</a></li>
              <li class="list-group-item"><a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/student/course_reviews.php"> 　 - 수강 후기</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <li class="pr list-group-item" data-link="pay">　<i class="bi bi-truck"></i> 　 결제/배송 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#payment_collapse"
              aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="payment_collapse">
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/orders_list.php"> 　 - 주문/결제 목록</a></li>
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/delivery_list.php"> 　 - 교재 배송관리</a></li>
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/orders/refunds_list.php"> 　 - 환불 관리</a></li>
            </ul>
          </li>
          <li class="list-group-item" data-link="coupons"><a
              href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/coupons/coupons.php">　<i class="bi bi-ticket"></i> 　 쿠폰 관리</a></li>
          <li class="pr list-group-item">　<i class="bi bi-graph-up-arrow"></i> 　 매출통계 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#statistics_collapse"
              href="#" aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="statistics_collapse">
              <li class="list-group-item dropdown-item"><a href=""> 　 - 강의 매출통계</a></li>
              <li class="list-group-item dropdown"><a href=""> 　 - 교재 매출통계</a></li>
              <li class="list-group-item dropdown"><a href=""> 　 - 월별 매출통계</a></li>
            </ul>
          </li>
        </ul>
        <ul class="list-group line">
          <li class="pr list-group-item" data-link="inquiry">　<i class="bi bi-patch-question"></i> 　 문의 게시판 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#bulletinboard_collapse"
              href="#" aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="bulletinboard_collapse">
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice.php"> 　 - 전체 공지사항</a></li>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/student_faq.php"> 　 - 수강생 FAQ</a></li>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/teacher_faq.php"> 　 - 교사 FAQ</a></li>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php"> 　 - 1:1 문의</a></li>
            </ul>
          </li>
          <li class="pr list-group-item" data-link="community">　<i class="bi bi-chat-dots"></i> 　 커뮤니티 관리
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#community_collapse"
              href="#" aria-expanded="false"><i class="bi bi-chevron-down"></i></button>
            <ul class="collapse btn-toggle-nav" id="community_collapse">
              <li class="list-group-item dropdown-item"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel.php"> 　 - 고민상담</a></li>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/team_project.php"> 　 - 팀 프로젝트</a></li>
              <li class="list-group-item dropdown"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/blog.php"> 　 - 블로그</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <ul class="no_line list-group">
        <li class="list-group-item" data-link=""><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/admin_qna.php">　<i class="bi bi-chat-dots"></i> 　 강사 1:1</a></li>
        <li class="list-group-item" data-link="manual"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_teacher.php">　<i class="bi bi-journal-bookmark-fill"></i> 　 강사 매뉴얼</a></li>
        <li class="list-group-item" data-link="manual"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/manual/for_admin.php">　<i class="bi bi-journal-bookmark-fill"></i> 　 관리자 매뉴얼</a></li>
        <li class="list-group-item" data-link="setting"><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/setting/store.php">　<i class="bi bi-gear-fill"></i> 　 상점 관리</a></li>
      </ul>
    </nav>
    <div class="nav_sibling">