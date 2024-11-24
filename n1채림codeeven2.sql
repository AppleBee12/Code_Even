-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-23 05:52
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
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `cgid` int(11) NOT NULL,
  `code` varchar(10) NOT NULL COMMENT '카테고리 코드명',
  `pcode` varchar(10) DEFAULT NULL COMMENT '부모 카테고리 고드명',
  `name` varchar(50) NOT NULL COMMENT '카테고리 명',
  `step` int(11) NOT NULL COMMENT '카테고리 단계 1,2,3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`cgid`, `code`, `pcode`, `name`, `step`) VALUES
(1, 'A0001', NULL, '웹 개발', 1),
(2, 'A0002', NULL, '클라우드·DB', 1),
(3, 'A0003', NULL, '보안·네트워크', 1),
(4, 'B0001', 'A0001', '프론트엔드', 2),
(5, 'B0002', 'A0001', '백엔드', 2),
(6, 'B0003', 'A0002', '클라우드 컴퓨팅', 2),
(7, 'B0004', 'A0002', '데이터베이스', 2),
(8, 'B0005', 'A0003', '네트워크 관리', 2),
(9, 'B0006', 'A0003', '보안', 2),
(10, 'C0001', 'B0001', 'HTML/CSS', 3),
(11, 'C0002', 'B0001', 'JavaScript', 3),
(12, 'C0003', 'B0001', 'jQuery', 3),
(13, 'C0004', 'B0001', 'React', 3),
(14, 'C0005', 'B0001', 'Angular', 3),
(15, 'C0006', 'B0001', 'Vue.js', 3),
(16, 'C0007', 'B0001', 'TypeScript', 3),
(17, 'C0008', 'B0002', 'Java', 3),
(18, 'C0009', 'B0002', 'PHP', 3),
(19, 'C0010', 'B0002', 'Next.js', 3),
(20, 'C0011', 'B0002', 'Node.js', 3),
(21, 'C0012', 'B0003', 'AWS', 3),
(22, 'C0013', 'B0003', 'Azure', 3),
(23, 'C0014', 'B0003', 'Google Cloud Platform', 3),
(24, 'C0015', 'B0003', 'DevOps', 3),
(25, 'C0016', 'B0003', 'Kubernetes', 3),
(26, 'C0017', 'B0004', 'SQL', 3),
(27, 'C0018', 'B0004', 'MySQL', 3),
(28, 'C0019', 'B0004', 'PostgreSQL', 3),
(29, 'C0020', 'B0004', 'Oracle', 3),
(30, 'C0021', 'B0004', 'NoSQL', 3),
(31, 'C0022', 'B0004', 'MongoDB', 3),
(32, 'C0023', 'B0004', 'Cassandra', 3),
(33, 'C0024', 'B0004', 'Couchbase', 3),
(34, 'C0025', 'B0005', 'TCP/IP', 3),
(35, 'C0026', 'B0005', 'C/C++', 3),
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
  `regdate` timestamp NULL DEFAULT current_timestamp() COMMENT '등록일',
  `userid` varchar(100) DEFAULT NULL COMMENT '등록한유저',
  `max_value` double DEFAULT NULL COMMENT '최대할인금액',
  `use_min_price` double DEFAULT NULL COMMENT '최소사용금액',
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한',
  `cp_desc` varchar(100) DEFAULT NULL COMMENT '쿠폰내용'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`cpid`, `couponid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `userid`, `max_value`, `use_min_price`, `use_max_date`, `cp_desc`) VALUES
(1, 1001, '리뷰쿠폰', '/code_even/admin/upload/coupons/20241120014236135047.png', 1, 5000, 0, 1, '2024-11-18 01:09:49', 'admin', 5000, 30000, '2024-12-31 00:00:00', NULL),
(2, 1002, '10% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042304161737.png', 2, 0, 0, 1, '2024-11-18 01:09:49', 'admin', 10000, 50000, '2024-12-31 00:00:00', '수강 10% 할인 쿠폰'),
(3, 1003, '수강 환승쿠폰', '/code_even/admin/upload/coupons/20241120042250105391.png', 1, 10000, 0, 1, '2024-11-18 01:09:49', 'user123', 10000, 25000, '2025-01-31 00:00:00', '수강 환승쿠폰'),
(4, 1004, '신규 회원 15% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042237197337.png', 2, 15, 0, 1, '2024-11-18 01:09:49', 'newuser', 15000, 20000, '2024-12-31 00:00:00', '신규 회원 15% 할인 쿠폰 바로증정!');

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
  `regdate` timestamp NULL DEFAULT current_timestamp() COMMENT '등록일',
  `reason` varchar(100) NOT NULL COMMENT '쿠폰취득사유'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user_coupons`
--

INSERT INTO `user_coupons` (`ucid`, `couponid`, `userid`, `status`, `use_max_date`, `regdate`, `reason`) VALUES
(1, 4, 'test2', 1, '2024-12-24 23:59:59', '2024-11-24 09:10:02', '신규 회원 15% 할인 쿠폰');

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
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
