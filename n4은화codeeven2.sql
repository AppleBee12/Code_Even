-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-23 06:32
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `code_even`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `book`
--

CREATE TABLE `book` (
  `boid` int(11) NOT NULL COMMENT '번호',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `image` varchar(100) NOT NULL COMMENT '이미지',
  `title` varchar(250) NOT NULL COMMENT '강좌명',
  `des` varchar(255) DEFAULT NULL COMMENT '교재 설명',
  `name` varchar(50) NOT NULL COMMENT '등록자',
  `price` decimal(10,0) NOT NULL COMMENT '가격',
  `pd` datetime NOT NULL COMMENT '출판일',
  `book` varchar(250) NOT NULL COMMENT '교재명',
  `writer` varchar(50) NOT NULL COMMENT '저자',
  `company` varchar(100) NOT NULL COMMENT 'company 출판사'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='교재';

--
-- 테이블의 덤프 데이터 `book`
--

INSERT INTO `book` (`boid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `des`, `name`, `price`, `pd`, `book`, `writer`, `company`) VALUES
(1, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '홍길동', 15000, '2024-11-17 10:08:39', 'html 도장 깨기', '홍길동', '길동사'),
(2, 'A0001', 'B0002', 'C0008', '', '실무자 JAVA 코스', NULL, '홍이븐', 20000, '2024-11-20 08:32:56', 'JAVA 마스터하기', '김길동', '길벗'),
(3, 'A0002', 'B0004', 'C0018', '/uploads/cat-5270323_1280.jpg', '데이터베이스, 나도 한다면 한다! MySQL 사용기', 'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이븐관리자', 20000, '2023-11-01 00:00:00', 'MySQL 지식 쌓기\', \'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이도령', '도령사'),
(4, 'A0002', 'B0004', 'C0018', '/uploads/cat-4123233_1280.jpg', '이제 당당히 말할 수 있다! 나도 MySLQ 중급 사용자', '이제 당당히 MySQL 좀 안다라고 말할 수 있는 당신을 위한 책', '이븐관리자', 30000, '2024-06-18 00:00:00', 'MySQL도 즐길 수 있다', '이도령', '도령사'),
(5, 'A0002', 'B0004', 'C0018', '/uploads/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '데이터베이스, 나도 한다면 한다! MySQL 사용기', 'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이븐선생', 20000, '2023-11-01 00:00:00', 'MySQL 지식 쌓기', '홍길동', '길동사');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture`
--

CREATE TABLE `lecture` (
  `leid` int(11) NOT NULL COMMENT '번호',
  `cgid` int(11) DEFAULT NULL COMMENT '카테고리id',
  `boid` int(11) DEFAULT NULL COMMENT 'book (외래키)',
  `lecid` int(11) NOT NULL COMMENT '강사고유id',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `image` varchar(250) NOT NULL COMMENT '이미지',
  `title` varchar(100) NOT NULL COMMENT '강좌명',
  `des` text DEFAULT NULL COMMENT '강좌 소개',
  `name` varchar(50) NOT NULL COMMENT '등록자',
  `video_url` varchar(250) NOT NULL COMMENT '강의',
  `file` varchar(100) DEFAULT NULL COMMENT '실습 파일',
  `period` int(11) NOT NULL COMMENT '학습 기간',
  `course_type` varchar(30) NOT NULL COMMENT '레시피/일반',
  `isbest` varchar(10) NOT NULL COMMENT '베스트',
  `isrecom` varchar(10) NOT NULL COMMENT '추천',
  `state` tinyint(4) NOT NULL COMMENT '상태',
  `approval` tinyint(4) NOT NULL COMMENT '승인',
  `price` int(11) NOT NULL COMMENT '수강료',
  `level` int(11) NOT NULL COMMENT '레벨',
  `date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `lecture`
--

INSERT INTO `lecture` (`leid`, `cgid`, `boid`, `lecid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `des`, `name`, `video_url`, `file`, `period`, `course_type`, `isbest`, `isrecom`, `state`, `approval`, `price`, `level`, `date`) VALUES
(0, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 2, 0, 30000, 0, '2024-11-20 10:22:33'),
(1, NULL, 0, 0, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '초보자를 위한 쉽고 재미있는 HTML, CSS 기초입니다. 천천히 보면서 이해하면서 따라해 보세요!', '김동주', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 'general', '', '', 1, 1, 95000, 50, '2024-11-18 14:40:26'),
(2, NULL, 0, 2, 'A0001', 'B0001', 'C0001', '', 'HTML/CSS : 기초부터 실전까지 올인원', 'HTML/CSS : 예제와 함께하는 기초부터 실전까지 html, css 올인원 과정', '이븐선생', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 'general', '', '', 1, 1, 90000, 50, '0000-00-00 00:00:00'),
(3, NULL, 0, 0, 'A0001', 'B0001', 'C0001', '', '[레시피] CSS Flex와 Grid 제대로 익히기', '', '이븐선생', '', NULL, 0, 'recipe', '', '', 1, 0, 15000, 0, '2024-11-19 02:12:51'),
(4, NULL, 0, 1, 'A0002', 'B0004', 'C0009', '/uploads/images/default.png', 'Ver. 2024 - 처음하는 SQL과 데이터베이스(MySQL)[입문부터 활용까지])', '네카라쿠배가 사내 강의로 선택한 그 강의!\r\n3차 대폭 리뉴얼 (2024) 과 함께 돌아왔어요!\r\n이 강의는 8년간 온오프라인 약 8만 분께 진행했던 강의 경험을 바탕으로 만든 특별한 강의입니다. 잘 정리된 자료와 상세한 설명, 그리고 기존 피드백을 대폭 반영하여, 3차례 리뉴얼하여 보다 좋은 강의로 만들었습니다. ', '조한결', '', NULL, 30, 'general', '', '', 0, 0, 80000, 0, '2024-11-20 02:57:33'),
(5, NULL, 0, 1, 'A0003', 'B0005', 'C0015', '/uploads/images/IMG_2450.jpeg', '이상민의 언리얼 프로그래밍 Part3 - 네트웍 멀티플레이 프레임웍의 이해', NULL, '이상민', '', NULL, 30, 'general', '', '', 1, 0, 200000, 0, '2024-11-20 03:01:12'),
(6, NULL, 0, 1, 'A0002', 'B0004', 'C0009', '/uploads/images/IMG_2450.jpeg', '[레시피] MySQL JOIN문 완전정복', NULL, '조한결', 'default_video_url', NULL, 30, 'recipe', '', '', 1, 0, 15000, 0, '2024-11-20 04:35:15'),
(7, NULL, 0, 1, 'A0003', 'B0006', 'C0015', '/uploads/images/IMG_2450.jpeg', '[레시피] 화이트해커 로드맵 A to Z', NULL, '이상민', 'default_video_url', NULL, 30, 'recipe', '', '', 1, 0, 20000, 0, '2024-11-20 04:36:00'),
(8, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이브관리자', 'https://youtu.be/oHTt2fEkmGA?si=fNAGtOcPEzpxwXDM', NULL, 30, '', '', '', 1, 0, 50000, 0, '2024-11-20 05:10:39'),
(9, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 50000, 0, '2024-11-20 05:35:37'),
(10, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 100000, 0, '2024-11-20 09:51:34'),
(11, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-4738796_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 2, 0, 100000, 0, '2024-11-20 09:57:07'),
(12, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-4738796_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 100000, 0, '2024-11-20 10:00:54'),
(13, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 100000, 0, '2024-11-20 10:01:35'),
(14, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 100000, 0, '2024-11-20 10:01:55'),
(15, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 50000, 0, '2024-11-20 10:10:10'),
(16, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 100000, 0, '2024-11-20 10:10:52'),
(17, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 2, 0, 100000, 0, '2024-11-20 10:14:24'),
(18, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', 1, 0, 30000, 0, '2024-11-20 10:20:11'),
(19, NULL, NULL, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/yerlin-matu-GtwiBmtJvaU-unsplash.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '0', '1', 1, 0, 30000, 0, '2024-11-20 10:20:11'),
(20, NULL, NULL, 1, 'A0001', 'B0001', 'C0006', '/uploads/images/IMG_2450.jpeg', 'Vue.js 어디까지 배워 봤니?', NULL, '이븐관리자', 'https://youtu.be/oHTt2fEkmGA?si=fNAGtOcPEzpxwXDM', NULL, 60, '', '0', '0', 1, 0, 50000, 0, '2024-11-21 16:20:55');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_detail`
--

CREATE TABLE `lecture_detail` (
  `id` int(11) NOT NULL COMMENT '강의 ID',
  `lecture_id` int(11) NOT NULL COMMENT '강좌 ID (외래키)',
  `title` varchar(255) NOT NULL COMMENT '강의명',
  `description` text DEFAULT NULL COMMENT '강의 설명',
  `quiz_id` int(11) DEFAULT NULL COMMENT '퀴즈 ID (외래키)',
  `test_id` int(11) DEFAULT NULL COMMENT '시험 ID (외래키)',
  `file_id` int(11) DEFAULT NULL COMMENT '실습 파일 ID (외래키)',
  `video_url` varchar(255) DEFAULT NULL COMMENT '동영상 URL',
  `video_order` int(11) DEFAULT NULL COMMENT '강의 순서',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '생성 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `lefile`
--

CREATE TABLE `lefile` (
  `fileid` int(11) NOT NULL COMMENT '파일 ID',
  `lecdid` int(11) NOT NULL COMMENT '해당 강의 ID (외래키)',
  `lepid` int(11) NOT NULL COMMENT '강사 고유 ID(외래키)',
  `fname` varchar(255) NOT NULL COMMENT '파일 이름',
  `fpath` varchar(255) NOT NULL COMMENT '서버에 저장된 파일 경로',
  `ftype` varchar(50) NOT NULL COMMENT '파일 타입',
  `uploaded` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '업로드 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='실습 파일';

--
-- 테이블의 덤프 데이터 `lefile`
--

INSERT INTO `lefile` (`fileid`, `lecdid`, `lepid`, `fname`, `fpath`, `ftype`, `uploaded`) VALUES
(1, 0, 0, 'lecture_detail.sql', '/uploads/files/lecture_detail.sql', 'application/octet-stream', '2024-11-19 16:10:10'),
(2, 0, 0, 'lecture_detail.sql', '/uploads/files/lecture_detail.sql', 'application/octet-stream', '2024-11-19 16:10:52'),
(3, 17, 1, 'lecture_detail.sql', '/uploads/files/lecture_detail.sql', '', '2024-11-19 16:14:24');

-- --------------------------------------------------------

--
-- 테이블 구조 `levideo`
--

CREATE TABLE `levideo` (
  `vdid` int(11) NOT NULL COMMENT '동영상 ID',
  `lecpid` int(11) NOT NULL COMMENT '강좌 ID (외래키)',
  `lepid` int(11) NOT NULL COMMENT '강사 고유 ID (외래키)',
  `videoname` varchar(250) NOT NULL COMMENT '강의명',
  `video_url` varchar(255) NOT NULL COMMENT '동영상 URL',
  `uploaded` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '등록 시간',
  `orders` int(11) NOT NULL COMMENT '강의 순서'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강의';

--
-- 테이블의 덤프 데이터 `levideo`
--

INSERT INTO `levideo` (`vdid`, `lecpid`, `lepid`, `videoname`, `video_url`, `uploaded`, `orders`) VALUES
(1, 1, 0, '', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', '2024-11-18 05:45:33', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `quiz`
--

CREATE TABLE `quiz` (
  `exid` int(11) NOT NULL COMMENT '번호',
  `tid` int(11) NOT NULL COMMENT '강사id',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `title` varchar(250) NOT NULL COMMENT '강좌명',
  `tt` varchar(250) NOT NULL COMMENT '시험지명',
  `answer` varchar(10) NOT NULL COMMENT '정답',
  `pn` varchar(250) NOT NULL COMMENT '문제명',
  `question` varchar(250) NOT NULL,
  `explan` text DEFAULT NULL COMMENT '해설',
  `pnlevel` tinyint(4) NOT NULL COMMENT '문제 수준'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='퀴즈';

--
-- 테이블의 덤프 데이터 `quiz`
--

INSERT INTO `quiz` (`exid`, `tid`, `cate1`, `cate2`, `cate3`, `title`, `tt`, `answer`, `pn`, `question`, `explan`, `pnlevel`) VALUES
(1, 3, 'A0001', 'B0001', 'C0001', 'HTML 정도는 껌이지', '', '', '', '', NULL, 0),
(2, 3, 'A0001', 'B0001', 'C0001', 'HTML 정도는 껌이지', 'HTML 문서의 기본 구조를 시작하는 올바른 DOCTYPE 선언은 무엇인가?', '3', '[\"&lt;!DOCTYPE html PUBLIC&gt;\",\"&lt;!DOCTYPE HTML PUBLIC \\\"-\\/\\/W3C\\/\\/DTD HTML 4.01 Transitional\\/\\/EN&\\\"gt;\",\"&lt;!DOCTYPE html&gt;\",\"&lt;!DOCTYPE&gt;\"]', '', '', 3),
(3, 3, 'A0001', 'B0001', 'C0001', 'HTML 정도는 껌이지', 'HTML 기초 퀴즈', '3', '[\"&lt;!DOCTYPE html PUBLIC&gt;\",\"&lt;!DOCTYPE HTML PUBLIC \\\"-\\/\\/W3C\\/\\/DTD HTML 4.01 Transitional\\/\\/EN&\\\"gt;\",\"&lt;!DOCTYPE html&gt;\",\"&lt;!DOCTYPE&gt;\"]', '', '', 3),
(4, 3, 'A0001', 'B0001', 'C0001', 'HTML 정도는 껌이지', 'HTML 기초 퀴즈', '3', 'HTML 문서의 기본 구조를 시작하는 올바른 DOCTYPE 선언은 무엇인가?', '[\"&lt;!DOCTYPE html PUBLIC&gt;\",\"&lt;!DOCTYPE HTML PUBLIC \\\"-\\/\\/W3C\\/\\/DTD HTML 4.01 Transitional\\/\\/EN&\\\"gt;\",\"&lt;!DOCTYPE html&gt;\",\"&lt;!DOCTYPE&gt;\"]', '', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `stuscores`
--

CREATE TABLE `stuscores` (
  `exid` int(11) NOT NULL COMMENT '번호',
  `stu_id` int(11) NOT NULL COMMENT '수강생id',
  `score` int(11) NOT NULL COMMENT '점수',
  `answer` varchar(100) NOT NULL COMMENT '제출한 정답',
  `pnlevel` tinyint(4) NOT NULL COMMENT '수준당 점수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 점수 관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `test`
--

CREATE TABLE `test` (
  `exid` int(11) NOT NULL COMMENT '번호',
  `tid` int(11) NOT NULL COMMENT '강사id',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `title` varchar(250) NOT NULL COMMENT '강좌명',
  `tt` varchar(250) NOT NULL COMMENT '시험지명',
  `answer` varchar(10) NOT NULL COMMENT '정답',
  `pn` varchar(250) NOT NULL COMMENT '문제명',
  `question` varchar(250) NOT NULL,
  `explan` text DEFAULT NULL COMMENT '해설',
  `pnlevel` tinyint(4) NOT NULL COMMENT '문제 수준'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='시험';

--
-- 테이블의 덤프 데이터 `test`
--

INSERT INTO `test` (`exid`, `tid`, `cate1`, `cate2`, `cate3`, `title`, `tt`, `answer`, `pn`, `question`, `explan`, `pnlevel`) VALUES
(1, 3, 'A0001', 'B0001', 'C0001', 'HTML 정도는 껌이지', 'HTML 기초 시험', '3', 'HTML 문서의 기본 구조를 시작하는 올바른 DOCTYPE 선언은 무엇인가?', '[\"&lt;!DOCTYPE html PUBLIC&gt;\",\"&lt;!DOCTYPE HTML PUBLIC \\\"-\\/\\/W3C\\/\\/DTD HTML 4.01 Transitional\\/\\/EN&\\\"gt;\",\"&lt;!DOCTYPE html&gt;\",\"&lt;!DOCTYPE&gt;\"]', '', 3);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`boid`);

--
-- 테이블의 인덱스 `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`leid`),
  ADD KEY `cgid` (`cgid`),
  ADD KEY `boid` (`boid`);

--
-- 테이블의 인덱스 `lecture_detail`
--
ALTER TABLE `lecture_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecture_id` (`lecture_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `file_id` (`file_id`);

--
-- 테이블의 인덱스 `lefile`
--
ALTER TABLE `lefile`
  ADD PRIMARY KEY (`fileid`);

--
-- 테이블의 인덱스 `levideo`
--
ALTER TABLE `levideo`
  ADD PRIMARY KEY (`vdid`);

--
-- 테이블의 인덱스 `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`exid`);

--
-- 테이블의 인덱스 `stuscores`
--
ALTER TABLE `stuscores`
  ADD PRIMARY KEY (`exid`);

--
-- 테이블의 인덱스 `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`exid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `lecture`
--
ALTER TABLE `lecture`
  MODIFY `leid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `lecture_detail`
--
ALTER TABLE `lecture_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '강의 ID';

--
-- 테이블의 AUTO_INCREMENT `lefile`
--
ALTER TABLE `lefile`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT COMMENT '파일 ID', AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `levideo`
--
ALTER TABLE `levideo`
  MODIFY `vdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '동영상 ID', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `stuscores`
--
ALTER TABLE `stuscores`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

--
-- 테이블의 AUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
