<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if(!isset($title)){
  $title = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐 솔루션-관리자 페이지</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <header class="header">
    <h1>codeeven</h1>
    <div class="login.php">안녕하세요 {name}관리자님</div>
    <div class="">안녕하세요 {name}강사님</div>
  </header>
  <nav class="nav navbar-expand-lg">
    <ul>
      <li><a href="">대시보드</a></li>
      <li><a href="카테고리 관리"></a></li>
      <li>강좌 관리
        <ul>
          <li><a href="">- 강좌 목록</a></li>
          <li><a href="">- 강좌 등록</a></li>
          <li><a href="">- 퀴즈 / 시험 목록</a></li>
          <li><a href="">- 퀴즈 / 시험 결과 관리</a></li>
        </ul>
      </li>
      <li>교재 관리
        <ul>
          <li><a href="">교재 목록</a></li>
          <li><a href="">교재 등록</a></li>
        </ul>
      </li>
      <li><a href="">전체 회원 관리</a></li>
      <li><a href="">강사 관리</a></li>
      <li>수강생 관리
        <ul>
          <li><a href="../students.php">- 수강생 목록</a></li>
          <li><a href="../students_qna.php">- 수강생 질문</a></li>
          <li><a href="../send_email.php">- 이메일 발송</a></li>
          <li><a href="../review.php">- /수강 후기</a></li>
        </ul>
      </li>
      <li>결제/배송 관리
        <ul>
          <li><a href="">- 주문/결제 목록</a></li>
          <li><a href="">- 교재 배송관리</a></li>
        </ul>
      </li>
      <li><a href="">쿠폰 관리</a></li>
      <li>매출통계 관리
        <ul>
          <li><a href="">- 강의 매출통계</a></li>
          <li><a href="">- 교재 매출통계</a></li>
          <li><a href="">- 월별 매출통계</a></li>
        </ul>
      </li>
      <li>문의 게시판 관리
        <ul>
          <li><a href="../notice.php">- 전체 공지사항</a></li>
          <li><a href="../faq.php">- 수강생 FAQ</a></li>
          <li><a href="../faq.php">- 교사 FAQ</a></li>
          <li><a href="../admin_qna.php">- 1:1 문의</a></li>
        </ul>
      </li>
      <li>커뮤니티 솔루션-관리자
        <ul>
          <li><a href="">- 고민상담</a></li>
          <li><a href="">- 팀 프로젝트</a></li>
          <li><a href="">- 블로그</a></li>
        </ul>
      </li>
      <li><a href="">강사 1:1</a></li>
      <li><a href="">강사 매뉴얼</a></li>
      <li><a href="">관리자 매뉴얼</a></li>
      <li><a href="">상점 관리</a></li>
      
    </ul>
  </nav>
