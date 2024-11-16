-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-16 17:21
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
(1, 'code_even', '홍이븐', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 12345, '서울특별시 강남구', '101호', '2024-11-01', '2024-11-12 22:34:13', 100, 0);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
