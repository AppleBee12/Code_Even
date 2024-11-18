-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-15 18:28
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
-- 테이블 구조 `admin_answer`
--

CREATE TABLE `admin_answer` (
  `aaid` int(11) NOT NULL COMMENT '답변고유번호',
  `aqid` int(11) DEFAULT NULL COMMENT '질문고유번호',
  `acontent` text NOT NULL COMMENT '답변내용',
  `status` enum('waiting','done') NOT NULL DEFAULT 'done' COMMENT '상태',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='1:1 문의 (관리자답변)';

--
-- 테이블의 덤프 데이터 `admin_answer`
--

INSERT INTO `admin_answer` (`aaid`, `aqid`, `acontent`, `status`, `file`) VALUES
(1, 1, '답변이 작성되었습니다.', 'done', NULL),
(2, 2, 'ㅁㄴㅇㄹ', 'done', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `admin_question`
--

CREATE TABLE `admin_question` (
  `aqid` int(11) NOT NULL COMMENT '질문고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `category` int(11) NOT NULL COMMENT '주제분류',
  `qtitle` varchar(255) NOT NULL COMMENT '질문제목',
  `qcontent` text NOT NULL COMMENT '질문내용',
  `regdate` date NOT NULL COMMENT '등록일',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='1:1 문의 (사용자질문)';

--
-- 테이블의 덤프 데이터 `admin_question`
--

INSERT INTO `admin_question` (`aqid`, `uid`, `category`, `qtitle`, `qcontent`, `regdate`, `file`) VALUES
(1, 2, 2, '질문이 있습니다.', '질문이 있습니다.', '2024-11-18', NULL),
(2, 3, 5, '사용 문의 드립니다.', '사용 문의 드립니다.', '2024-11-18', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `class_data`
--

CREATE TABLE `class_data` (
  `cdid` int(11) NOT NULL COMMENT '수강데이터ID',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `leid` int(11) DEFAULT NULL COMMENT '강좌고유번호',
  `exid` int(11) DEFAULT NULL COMMENT '점수관리ID',
  `course_cert` varchar(255) NOT NULL COMMENT '수강이수증',
  `progress_rate` decimal(10,0) NOT NULL COMMENT '진도율'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강데이터';

-- --------------------------------------------------------

--
-- 테이블 구조 `faq`
--

CREATE TABLE `faq` (
  `fqid` int(11) NOT NULL COMMENT 'FAQ고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `category` int(11) NOT NULL COMMENT '주제분류',
  `target` enum('student','teacher') NOT NULL COMMENT '대상',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `content` text NOT NULL COMMENT '내용',
  `view` int(11) NOT NULL COMMENT '조회수',
  `regdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT '작성일',
  `status` enum('on','off') NOT NULL DEFAULT 'off' COMMENT '상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='자주묻는질문';

--
-- 테이블의 덤프 데이터 `faq`
--

INSERT INTO `faq` (`fqid`, `uid`, `category`, `target`, `title`, `content`, `view`, `regdate`, `status`) VALUES
(1, 1, 2, 'student', '강의 수강은 어떻게 하나요?', '강의 수강은 어떻게 하나요?', 0, '2024-11-16 17:24:50', 'off'),
(2, 1, 4, 'student', '탈퇴는 어떻게 하나요?', '탈퇴는 어떻게 하나요?', 0, '2024-11-16 18:30:18', 'off'),
(3, 1, 1, 'student', '환불은 어떻게 진행이 되나요?', '환불은 어떻게 진행이 되나요?', 0, '2024-11-17 02:47:25', 'off'),
(4, 1, 7, 'teacher', '정산은 어떻게 진행이 되나요?', '정산은 어떻게 진행이 되나요?', 0, '2024-11-18 16:41:40', 'on');

-- --------------------------------------------------------

--
-- 테이블 구조 `notice`
--

CREATE TABLE `notice` (
  `ntid` int(11) NOT NULL COMMENT '공지사항고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `content` text NOT NULL COMMENT '내용',
  `view` int(11) NOT NULL COMMENT '조회수',
  `regdate` date NOT NULL DEFAULT current_timestamp() COMMENT '등록일',
  `status` enum('on','off') NOT NULL DEFAULT 'off' COMMENT '상태',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `notice`
--

INSERT INTO `notice` (`ntid`, `uid`, `title`, `content`, `view`, `regdate`, `status`, `file`) VALUES
(1, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(2, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(3, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(4, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(5, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(6, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(7, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(8, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(9, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(10, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(11, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(12, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(13, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(14, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(15, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(16, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(17, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(18, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(19, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(20, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(21, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(22, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(23, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(24, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(25, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(26, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(27, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(28, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(29, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(30, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(31, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(32, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(33, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(34, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(35, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(36, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(37, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(38, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(39, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(40, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(41, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(42, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(43, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(44, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(45, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(46, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(47, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(48, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(49, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(50, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(51, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(52, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(53, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(54, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(55, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(56, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(57, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(58, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(59, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL),
(60, 1, '[공지] 개인정보처리방침 변경 안내', '[공지] 개인정보처리방침 변경 안내', 0, '2024-11-16', 'off', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `rvid` int(11) NOT NULL COMMENT '수강후기ID',
  `cdid` int(11) DEFAULT NULL COMMENT '수강데이터ID',
  `rating` tinyint(4) NOT NULL COMMENT '평점',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `content` text NOT NULL COMMENT '내용',
  `regdate` datetime NOT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강 후기';

-- --------------------------------------------------------

--
-- 테이블 구조 `send_email`
--

CREATE TABLE `send_email` (
  `emid` int(11) NOT NULL COMMENT '이메일발송고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `content` text NOT NULL COMMENT '내용',
  `regdate` datetime NOT NULL COMMENT '발송일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='이메일발송';

-- --------------------------------------------------------

--
-- 테이블 구조 `student_qna`
--

CREATE TABLE `student_qna` (
  `sqid` int(11) NOT NULL COMMENT '질문고유번호',
  `cdid` int(11) DEFAULT NULL COMMENT '수강데이터ID',
  `qtitle` varchar(255) NOT NULL COMMENT '질문제목',
  `qcontent` text NOT NULL COMMENT '질문내용',
  `status` enum('waiting','done') NOT NULL DEFAULT 'waiting' COMMENT '상태',
  `regdate` datetime NOT NULL COMMENT '등록일',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 질문';

-- --------------------------------------------------------

--
-- 테이블 구조 `teacher_qna`
--

CREATE TABLE `teacher_qna` (
  `asid` int(11) NOT NULL COMMENT '답변고유ID',
  `sqid` int(11) DEFAULT NULL COMMENT '질문고유ID',
  `tcid` int(11) NOT NULL COMMENT '강사ID',
  `content` text NOT NULL COMMENT '답변내용',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강사 답변';

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admin_answer`
--
ALTER TABLE `admin_answer`
  ADD PRIMARY KEY (`aaid`),
  ADD KEY `aqid` (`aqid`);

--
-- 테이블의 인덱스 `admin_question`
--
ALTER TABLE `admin_question`
  ADD PRIMARY KEY (`aqid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `class_data`
--
ALTER TABLE `class_data`
  ADD PRIMARY KEY (`cdid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `leid` (`leid`),
  ADD KEY `exid` (`exid`);

--
-- 테이블의 인덱스 `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`fqid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`ntid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rvid`),
  ADD KEY `cdid` (`cdid`);

--
-- 테이블의 인덱스 `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`emid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `student_qna`
--
ALTER TABLE `student_qna`
  ADD PRIMARY KEY (`sqid`),
  ADD KEY `cdid` (`cdid`);

--
-- 테이블의 인덱스 `teacher_qna`
--
ALTER TABLE `teacher_qna`
  ADD PRIMARY KEY (`asid`),
  ADD UNIQUE KEY `sqid` (`sqid`),
  ADD KEY `tcid` (`tcid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admin_answer`
--
ALTER TABLE `admin_answer`
  MODIFY `aaid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유번호';

--
-- 테이블의 AUTO_INCREMENT `admin_question`
--
ALTER TABLE `admin_question`
  MODIFY `aqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호';

--
-- 테이블의 AUTO_INCREMENT `class_data`
--
ALTER TABLE `class_data`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID';

--
-- 테이블의 AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호';

--
-- 테이블의 AUTO_INCREMENT `notice`
--
ALTER TABLE `notice`
  MODIFY `ntid` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항고유번호';

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `rvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강후기ID';

--
-- 테이블의 AUTO_INCREMENT `send_email`
--
ALTER TABLE `send_email`
  MODIFY `emid` int(11) NOT NULL AUTO_INCREMENT COMMENT '이메일발송고유번호';

--
-- 테이블의 AUTO_INCREMENT `student_qna`
--
ALTER TABLE `student_qna`
  MODIFY `sqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호';

--
-- 테이블의 AUTO_INCREMENT `teacher_qna`
--
ALTER TABLE `teacher_qna`
  MODIFY `asid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유ID';

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `admin_answer`
--
ALTER TABLE `admin_answer`
  ADD CONSTRAINT `admin_answer_ibfk_1` FOREIGN KEY (`aqid`) REFERENCES `admin_question` (`aqid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `admin_question`
--
ALTER TABLE `admin_question`
  ADD CONSTRAINT `admin_question_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `class_data`
--
ALTER TABLE `class_data`
  ADD CONSTRAINT `class_data_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_data_ibfk_2` FOREIGN KEY (`leid`) REFERENCES `lecture` (`leid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_data_ibfk_3` FOREIGN KEY (`exid`) REFERENCES `stuscores` (`exid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 테이블의 제약사항 `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`cdid`) REFERENCES `class_data` (`cdid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `send_email`
--
ALTER TABLE `send_email`
  ADD CONSTRAINT `send_email_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 테이블의 제약사항 `student_qna`
--
ALTER TABLE `student_qna`
  ADD CONSTRAINT `student_qna_ibfk_1` FOREIGN KEY (`cdid`) REFERENCES `class_data` (`cdid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `teacher_qna`
--
ALTER TABLE `teacher_qna`
  ADD CONSTRAINT `teacher_qna_ibfk_1` FOREIGN KEY (`sqid`) REFERENCES `student_qna` (`sqid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_qna_ibfk_2` FOREIGN KEY (`tcid`) REFERENCES `teachers` (`tcid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
