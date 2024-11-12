<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/dbcon.php');

if (!isset($title)) {
  $title = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>코드이븐 솔루션-관리자 페이지</title>

  <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUIT@2/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="admin/css/reset.css">
  <link rel="stylesheet" href="admin/css/common.css">
  <link rel="stylesheet" href="admin/css/main.css">
</head>

<body>
  <header class="header">
    <h1 class="logo"><a href="#">code even</a></h1>
  </header>
  <nav class="nav navbar-expand-lg">
    <ul class="list-group">
      <li class="list-group-item"><a href=""><i class="bi bi-grid"></i> 　 대시보드</a></li>
      <li class="list-group-item"><a href=""><i class="bi bi-tags"></i> 　 카테고리 관리</a></li>
      <li class="list-group-item"><i class="bi bi-collection-play"></i> 　 강좌 관리
        <ul>
          <li class="list-group-item"><a href="">- 강좌 목록</a></li>
          <li class="list-group-item"><a href="">- 강좌 등록</a></li>
          <li class="list-group-item"><a href="">- 퀴즈 / 시험 목록</a></li>
          <li class="list-group-item"><a href="">- 퀴즈 / 시험 결과 관리</a></li>
        </ul>
      </li>
      <li class="list-group-item"><i class="bi bi-book"></i> 　 교재 관리
        <ul>
          <li class="list-group-item"><a href="">교재 목록</a></li>
          <li class="list-group-item"><a href="">교재 등록</a></li>
        </ul>
      </li>
      <li class="list-group-item"><a href=""><i class="bi bi-people"></i> 　 전체 회원 관리</a></li>
      <li class="list-group-item"><a href="admin/teacher/teacher_list.php"><i class="bi bi-incognito"></i> 　 강사 관리</a></li>
      <li class="list-group-item"><i class="bi bi-mortarboard"></i> 　 수강생 관리</li>
      <ul>
        <li class="list-group-item"><a href="">- 수강생 목록</a></li>
        <li class="list-group-item"><a href="">- 수강생 질문</a></li>
        <li class="list-group-item"><a href="">- 이메일 발송</a></li>
        <li class="list-group-item"><a href="">- 수강 후기</a></li>
      </ul>
      <li class="list-group-item"><i class="bi bi-truck"></i> 　 결제/배송 관리
        <ul>
          <li class="list-group-item"><a href="">- 주문/결제 목록</a></li>
          <li class="list-group-item"><a href="">- 교재 배송관리</a></li>
        </ul>
      </li>
      <li class="list-group-item"><a href=""><i class="bi bi-ticket"></i> 　 쿠폰 관리</a></li>
      <li class="list-group-item"><i class="bi bi-graph-up-arrow"></i> 　 매출통계 관리
        <ul>
          <li class="list-group-item"><a href="">- 강의 매출통계</a></li>
          <li class="list-group-item"><a href="">- 교재 매출통계</a></li>
          <li class="list-group-item"><a href="">- 월별 매출통계</a></li>
        </ul>
      </li>
      <li class="list-group-item"><i class="bi bi-patch-question"></i> 　 문의 게시판 관리
        <ul>
          <li class="list-group-item"><a href="">- 전체 공지사항</a></li>
          <li class="list-group-item"><a href="">- 수강생 FAQ</a></li>
          <li class="list-group-item"><a href="">- 교사 FAQ</a></li>
          <li class="list-group-item"><a href="">- 1:1 문의</a></li>
        </ul>
      </li>
      <li class="list-group-item"><i class="bi bi-chat-dots"></i> 　 커뮤니티 관리
        <ul>
          <li class="list-group-item"><a href="">- 고민상담</a></li>
          <li class="list-group-item"><a href="">- 팀 프로젝트</a></li>
          <li class="list-group-item"><a href="">- 블로그</a></li>
        </ul>
      </li>
      <li class="list-group-item"><a href=""><i class="bi bi-chat-dots"></i> 　 강사 1:1</a></li>
      <li class="list-group-item"><a href=""><i class="bi bi-journal-bookmark-fill"></i> 　 강사 매뉴얼</a></li>
      <li class="list-group-item"><a href=""><i class="bi bi-journal-bookmark-fill"></i> 　 관리자 매뉴얼</a></li>
      <li class="list-group-item"><a href=""><i class="bi bi-gear-fill"></i> 　 상점 관리</a></li>

    </ul>
  </nav>