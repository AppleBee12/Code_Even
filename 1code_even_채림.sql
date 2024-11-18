-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-18 07:36
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
-- 데이터베이스: `codeeven2`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `cgid` int(11) NOT NULL,
  `code` varchar(10) NOT NULL COMMENT '카테고리 코드명',
  `pcode` varchar(10) DEFAULT NULL COMMENT '부모 카테고리 고드명',
  `name` varchar(50) NOT NULL COMMENT '카테고리 명',
  `step` int(11) NOT NULL COMMENT '카테고리 단계 1,2,3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


  -- 대분류 (step 1)
INSERT INTO `category` (`cgid`, `code`, `pcode`, `name`, `step`) VALUES 
(1, 'A0001', NULL, '웹 개발', 1),
(2, 'A0002', NULL, '클라우드·DB', 1),
(3, 'A0003', NULL, '보안·네트워크', 1);

-- 중분류 (step 2)
INSERT INTO `category` (`cgid`, `code`, `pcode`, `name`, `step`) VALUES 
-- 웹 개발 하위 카테고리
(4, 'B0001', 'A0001', '프론트엔드', 2),
(5, 'B0002', 'A0001', '백엔드', 2),

-- 클라우드·DB 하위 카테고리
(6, 'B0003', 'A0002', '클라우드 컴퓨팅', 2),
(7, 'B0004', 'A0002', '데이터베이스', 2),

-- 보안·네트워크 하위 카테고리
(8, 'B0005', 'A0003', '네트워크 관리', 2),
(9, 'B0006', 'A0003', '보안', 2);

-- 소분류 (step 3)
INSERT INTO `category` (`cgid`, `code`, `pcode`, `name`, `step`) VALUES 
-- 프론트엔드 하위 카테고리
(10, 'C0001', 'B0001', 'HTML/CSS', 3),
(11, 'C0002', 'B0001', 'JavaScript', 3),
(12, 'C0003', 'B0001', 'jQuery', 3),
(13, 'C0004', 'B0001', 'React', 3),
(14, 'C0005', 'B0001', 'Angular', 3),
(15, 'C0006', 'B0001', 'Vue.js', 3),
(16, 'C0007', 'B0001', 'TypeScript', 3),

-- 백엔드 하위 카테고리
(17, 'C0008', 'B0002', 'Java', 3),
(18, 'C0009', 'B0002', 'PHP', 3),
(19, 'C0010', 'B0002', 'Next.js', 3),
(20, 'C0011', 'B0002', 'Node.js', 3),

-- 클라우드 컴퓨팅 하위 카테고리
(21, 'C0012', 'B0003', 'AWS', 3),
(22, 'C0013', 'B0003', 'Azure', 3),
(23, 'C0014', 'B0003', 'Google Cloud Platform', 3),
(24, 'C0015', 'B0003', 'DevOps', 3),
(25, 'C0016', 'B0003', 'Kubernetes', 3),

-- 데이터베이스 하위 카테고리
(26, 'C0017', 'B0004', 'SQL', 3),
(27, 'C0018', 'B0004', 'MySQL', 3),
(28, 'C0019', 'B0004', 'PostgreSQL', 3),
(29, 'C0020', 'B0004', 'Oracle', 3),
(30, 'C0021', 'B0004', 'NoSQL', 3),
(31, 'C0022', 'B0004', 'MongoDB', 3),
(32, 'C0023', 'B0004', 'Cassandra', 3),
(33, 'C0024', 'B0004', 'Couchbase', 3),

-- 네트워크 관리 하위 카테고리
(34, 'C0025', 'B0005', 'TCP/IP', 3),
(35, 'C0026', 'B0005', 'C/C++', 3),

-- 보안 하위 카테고리
(36, 'C0027', 'B0006', 'CPPG', 3),
(37, 'C0028', 'B0006', 'Security', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `coupons`
--

CREATE TABLE `coupons` (
  `cpid` int(11) NOT NULL,
  `couponid` int(11) NOT NULL COMMENT '쿠폰아이디',
  `coupon_name` varchar(100) DEFAULT NULL COMMENT '쿠폰명',
  `coupon_image` varchar(100) DEFAULT NULL COMMENT '쿠폰이미지',
  `coupon_type` tinyint(4) DEFAULT NULL COMMENT '쿠폰타입',
  `coupon_price` double DEFAULT NULL COMMENT '할인금액',
  `coupon_ratio` double DEFAULT NULL COMMENT '할인비율',
  `status` tinyint(4) DEFAULT 0 COMMENT '상태',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `userid` varchar(100) DEFAULT NULL COMMENT '등록한유저',
  `max_value` double DEFAULT NULL COMMENT '최대할인금액',
  `use_min_price` double DEFAULT NULL COMMENT '최소사용금액',
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `coupons` (`cpid`, `couponid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `userid`, `max_value`, `use_min_price`, `use_max_date`) VALUES
(1, 1001, '5,000원 할인 쿠폰', '/code_even/admin/coupons/coupon4.png', 1, 5000, NULL, 1, '2024-11-18 10:09:49', 'admin', NULL, 30000, '2024-12-31 00:00:00'),
(2, 1002, '10% 할인 쿠폰', 'coupons2.png', 2, NULL, 10, 1, '2024-11-18 10:09:49', 'admin', 10000, 50000, '2024-12-31 00:00:00'),
(3, 1003, '무료배송 쿠폰', 'coupons3.png', 3, NULL, NULL, 1, '2024-11-18 10:09:49', 'user123', NULL, 0, '2025-01-31 00:00:00'),
(4, 1004, '신규 회원 15% 할인 쿠폰', 'coupons4.png', 2, NULL, 15, 0, '2024-11-18 10:09:49', 'newuser', 15000, 20000, '2024-12-31 00:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `userid` varchar(50) NOT NULL COMMENT '아이디',
  `username` varchar(50) NOT NULL COMMENT '이름',
  `usernick` varchar(50) DEFAULT NULL COMMENT '닉네임',
  `userpw` varchar(200) NOT NULL COMMENT '비밀번호',
  `userphonenum` varchar(50) NOT NULL COMMENT '휴대전화',
  `useremail` varchar(100) DEFAULT NULL COMMENT '이메일',
  `email_ok` tinyint(4) DEFAULT NULL COMMENT '이메일수신여부',
  `post_code` int(11) DEFAULT NULL COMMENT '우편번호',
  `addr_line1` varchar(100) DEFAULT NULL COMMENT '주소',
  `addr_line2` varchar(100) DEFAULT NULL COMMENT '상세주소',
  `signup_date` date NOT NULL COMMENT '가입일',
  `last_date` datetime NOT NULL COMMENT '마지막접속일',
  `user_level` tinyint(4) DEFAULT NULL COMMENT '회원구분',
  `user_status` int(11) DEFAULT 0 COMMENT '회원상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`uid`, `userid`, `username`, `usernick`, `userpw`, `userphonenum`, `useremail`, `email_ok`, `post_code`, `addr_line1`, `addr_line2`, `signup_date`, `last_date`, `user_level`, `user_status`) VALUES
(1, 'code_even', '이븐관리자', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 12345, '서울특별시 강남구', '101호', '2024-11-01', '2024-11-12 22:34:13', 100, 0),
(2, 'even_teacher', '이븐선생', '이븐하게', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'eventeacher@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '0000-00-00', '2024-11-18 00:34:45', 10, 0),
(3, 'even_student', '이븐학생', '이도령', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5600', '2doryung@even.co.kr', 1, 11000, '서울시 영등포구', '여의도 한강공원', '0000-00-00', '2024-11-17 08:01:44', 1, 0),
(4, 'my_teacher', '김동주', '멋진선생님', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'rocks@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '0000-00-00', '0000-00-00 00:00:00', 10, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `user_coupons`
--

CREATE TABLE `user_coupons` (
  `ucid` int(11) NOT NULL,
  `couponid` int(11) NOT NULL COMMENT '쿠폰아이디',
  `userid` varchar(100) NOT NULL COMMENT '유저아이디',
  `status` int(11) DEFAULT 1 COMMENT '상태',
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `reason` varchar(100) NOT NULL COMMENT '쿠폰취득사유'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cgid`);

--
-- 테이블의 인덱스 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`cpid`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 테이블의 인덱스 `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`ucid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
