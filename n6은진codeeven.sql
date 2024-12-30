-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-30 12:24
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
-- 테이블 구조 `book_sales`
--

CREATE TABLE `book_sales` (
  `boid` int(11) NOT NULL COMMENT '교재고유번호',
  `book_title` varchar(250) NOT NULL COMMENT '교재명',
  `publisher_name` varchar(100) NOT NULL COMMENT '출판사명',
  `order_count` int(11) NOT NULL DEFAULT 0 COMMENT '교재주문건수',
  `total_order_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '교재총주문금액',
  `total_refund_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '교재환불금액',
  `refund_count` int(11) NOT NULL DEFAULT 0 COMMENT '교재별환불건수',
  `total_sales` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '교재최종매출액(환불후)',
  `book_cate` tinyint(4) NOT NULL COMMENT '교재분류(웹개발=1)',
  `sale_date` date NOT NULL COMMENT '판매날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='교재매출통계';

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL COMMENT '장바구니고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `userid` varchar(50) DEFAULT NULL COMMENT '회원아이디',
  `ssid` varchar(100) DEFAULT NULL COMMENT '세션아이디',
  `leid` int(11) NOT NULL COMMENT '강좌고유번호',
  `boid` int(11) DEFAULT NULL COMMENT '교재고유번호',
  `total_price` decimal(10,2) NOT NULL COMMENT '총가격(교재+강좌)',
  `coupon_id` int(11) DEFAULT NULL COMMENT '적용쿠폰',
  `discount_price` decimal(10,2) DEFAULT NULL COMMENT '쿠폰할인금액',
  `regdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT '상품추가일자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='장바구니';

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_sales`
--

CREATE TABLE `lecture_sales` (
  `leid` int(11) NOT NULL COMMENT '강좌고유번호',
  `lec_title` varchar(100) NOT NULL COMMENT '강좌제목',
  `th_name` varchar(50) NOT NULL COMMENT '강사명',
  `lec_price` decimal(10,2) NOT NULL COMMENT '강좌가격',
  `order_count` int(11) NOT NULL DEFAULT 0 COMMENT '강좌주문건수',
  `total_order_amount` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT '강좌총주문금액(쿠폰전)',
  `total_discount_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌총할인금액',
  `net_order_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌실결제금액(쿠폰후)',
  `refund_count` int(11) NOT NULL DEFAULT 0 COMMENT '강좌환불건수',
  `total_refund_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌환불금액',
  `final_sales_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌최종매출액(환불후)',
  `lec_type` tinyint(4) NOT NULL COMMENT '강좌유형(일반1,2레시피)',
  `lec_cate` tinyint(4) NOT NULL COMMENT '강좌분류(웹개발=1)',
  `sale_date` date NOT NULL COMMENT '판매날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강좌별매출통계';

--
-- 테이블의 덤프 데이터 `lecture_sales`
--

INSERT INTO `lecture_sales` (`leid`, `lec_title`, `th_name`, `lec_price`, `order_count`, `total_order_amount`, `total_discount_amount`, `net_order_amount`, `refund_count`, `total_refund_amount`, `final_sales_amount`, `lec_type`, `lec_cate`, `sale_date`) VALUES
(1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '김동주', 95000.00, 5, 475000.00, 0.00, 475000.00, 0, 0.00, 475000.00, 1, 1, '2024-03-19'),
(1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '김동주', 95000.00, 5, 475000.00, 0.00, 475000.00, 0, 0.00, 475000.00, 1, 1, '2024-05-19'),
(1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '김동주', 95000.00, 5, 475000.00, 0.00, 475000.00, 0, 0.00, 475000.00, 1, 1, '2024-08-19'),
(1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '김동주', 95000.00, 5, 475000.00, 0.00, 475000.00, 0, 0.00, 475000.00, 1, 1, '2024-09-19'),
(2, 'HTML/CSS : 기초부터 실전까지 올인원', '이븐선생', 90000.00, 3, 270000.00, 0.00, 270000.00, 0, 0.00, 270000.00, 1, 1, '2024-04-19'),
(2, 'HTML/CSS : 기초부터 실전까지 올인원', '이븐선생', 90000.00, 3, 270000.00, 0.00, 270000.00, 0, 0.00, 270000.00, 1, 1, '2024-06-19'),
(2, 'HTML/CSS : 기초부터 실전까지 올인원', '이븐선생', 90000.00, 3, 270000.00, 0.00, 270000.00, 0, 0.00, 270000.00, 1, 1, '2024-09-19'),
(2, 'HTML/CSS : 기초부터 실전까지 올인원', '이븐선생', 90000.00, 3, 270000.00, 0.00, 270000.00, 0, 0.00, 270000.00, 1, 1, '2024-10-19'),
(3, '[레시피] CSS Flex와 Grid 제대로 익히기', '이븐선생', 15000.00, 10, 150000.00, 0.00, 150000.00, 0, 0.00, 150000.00, 2, 1, '2024-05-19'),
(3, '[레시피] CSS Flex와 Grid 제대로 익히기', '이븐선생', 15000.00, 4, 60000.00, 0.00, 60000.00, 0, 0.00, 60000.00, 2, 1, '2024-07-19'),
(3, '[레시피] CSS Flex와 Grid 제대로 익히기', '이븐선생', 15000.00, 4, 60000.00, 0.00, 60000.00, 0, 0.00, 60000.00, 2, 1, '2024-09-19'),
(4, 'Ver. 2024 - 처음하는 SQL과 데이터베이스(MySQL)[입문부터 활용까지]', '조한결', 80000.00, 4, 320000.00, 0.00, 320000.00, 0, 0.00, 320000.00, 1, 2, '2024-11-19'),
(5, '이상민의 언리얼 프로그래밍 Part3 - 네트웍 멀티플레이 프레임웍의 이해', '이상민', 200000.00, 5, 1000000.00, 0.00, 1000000.00, 0, 0.00, 1000000.00, 1, 3, '2024-09-19'),
(6, '[레시피] MySQL JOIN문 완전정복', '조한결', 15000.00, 8, 120000.00, 0.00, 120000.00, 0, 0.00, 120000.00, 2, 2, '2024-10-19'),
(7, '[레시피] 화이트해커 로드맵 A to Z', '이상민', 20000.00, 5, 100000.00, 0.00, 100000.00, 0, 0.00, 100000.00, 2, 3, '2024-11-19');

-- --------------------------------------------------------

--
-- 테이블 구조 `monthly_sales`
--

CREATE TABLE `monthly_sales` (
  `data_year_month` varchar(7) NOT NULL COMMENT '''YYYY-MM'' 형식',
  `order_count` int(11) NOT NULL DEFAULT 0 COMMENT '총주문건수',
  `total_order_amount` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT '총주문금액(쿠폰적용전)',
  `discount_count` int(11) NOT NULL DEFAULT 0 COMMENT '할인건수',
  `total_discount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '총할인금액',
  `refund_count` int(11) NOT NULL DEFAULT 0 COMMENT '환불건수',
  `total_refund_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '총환불금액',
  `net_order_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '실결제금액(쿠폰적용후)',
  `final_sales_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '총매출액(할인환불계산)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='월별매출통계';

-- --------------------------------------------------------

--
-- 테이블 구조 `orders`
--

CREATE TABLE `orders` (
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호(탈퇴시빈값)',
  `total_amount` decimal(10,2) NOT NULL COMMENT '전체결제금액(쿠폰적용 전)',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '할인 금액',
  `final_amount` decimal(10,2) NOT NULL COMMENT '할인 적용 후 결제 금액',
  `order_title` varchar(250) NOT NULL COMMENT '주문명(첫번째항목+외n건)',
  `order_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '주문일자',
  `pay_method` tinyint(4) NOT NULL COMMENT '결제수단',
  `pay_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문상태 (0=정상)',
  `receiver` varchar(50) DEFAULT NULL COMMENT '수령인',
  `zipcode` int(6) DEFAULT NULL COMMENT '우편번호',
  `addr_line1` varchar(100) DEFAULT NULL COMMENT '수령주소',
  `addr_line2` varchar(100) DEFAULT NULL COMMENT '상세주소',
  `addr_line3` varchar(100) DEFAULT NULL COMMENT '참고항목',
  `receiver_phone` varchar(11) DEFAULT NULL COMMENT '수령인전화번호',
  `request` varchar(100) DEFAULT NULL COMMENT '요청사항'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='주문';

--
-- 테이블의 덤프 데이터 `orders`
--

INSERT INTO `orders` (`odid`, `uid`, `total_amount`, `discount_amount`, `final_amount`, `order_title`, `order_date`, `pay_method`, `pay_status`, `receiver`, `zipcode`, `addr_line1`, `addr_line2`, `addr_line3`, `receiver_phone`, `request`) VALUES
(1, 3, 100000.00, 10000.00, 90000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2023-12-24 14:48:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 35, 150000.00, 10000.00, 140000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-01-15 10:45:23', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 42, 120000.00, 20000.00, 100000.00, 'HTML/CSS : 기초부터 실전까지 올인원', '2024-02-20 14:32:11', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 27, 130000.00, 15000.00, 115000.00, '실무자 JAVA 코스', '2024-03-12 08:20:05', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 53, 170000.00, 20000.00, 150000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-04-08 16:05:45', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 18, 90000.00, 10000.00, 80000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-05-30 11:15:33', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 61, 200000.00, 25000.00, 175000.00, 'HTML/CSS : 기초부터 실전까지 올인원', '2024-06-15 13:50:12', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 39, 110000.00, 10000.00, 100000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-07-22 17:00:00', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 12, 140000.00, 5000.00, 135000.00, 'HTML/CSS : 기초부터 실전까지 올인원', '2024-08-09 15:25:27', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 25, 175000.00, 15000.00, 160000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-09-11 09:35:12', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 44, 210000.00, 30000.00, 180000.00, '실무자 JAVA 코스', '2024-10-05 14:45:18', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 67, 115000.00, 20000.00, 95000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-11-14 13:10:45', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 30, 95000.00, 5000.00, 90000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-11-01 12:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 55, 185000.00, 25000.00, 160000.00, 'HTML/CSS : 기초부터 실전까지 올인원', '2024-01-29 16:30:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 8, 99000.00, 10000.00, 89000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-02-14 10:15:55', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 49, 125000.00, 20000.00, 105000.00, '실무자 JAVA 코스', '2024-03-21 11:45:40', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 14, 155000.00, 5000.00, 150000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-04-27 08:30:22', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 66, 195000.00, 10000.00, 185000.00, '실무자 JAVA 코스', '2024-05-13 14:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 28, 130000.00, 15000.00, 115000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-06-25 17:40:45', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 34, 160000.00, 5000.00, 155000.00, '실무자 JAVA 코스', '2024-07-19 13:15:00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 3, 63800.00, 2970.00, 60830.00, '그림으로 배우는 HTML/CSS, 입문!', '2024-12-23 08:06:48', -1, 0, '이븐학생', 11000, '서울시 영등포구', '여의도 한강공원', '', '010-1234-56', NULL),
(22, 1, 63800.00, 12970.00, 50830.00, 'HTML/CSS 베이스캠프', '2024-12-23 10:45:56', 0, 0, '', 0, '', '', '', '', NULL),
(23, 1, 63800.00, 3300.00, 60500.00, 'HTML/CSS 베이스캠프', '2024-12-23 10:47:52', 0, 0, '이븐관리자', 45617, '서울특별시 강남구', '101호', '', '010-1234-56', NULL),
(24, 1, 63800.00, 13300.00, 50500.00, 'HTML/CSS 베이스캠프', '2024-12-23 10:49:54', 3, 0, '이븐관리자', 45617, '서울특별시 강남구', '101호', '', '010-1234-56', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `order_delivery`
--

CREATE TABLE `order_delivery` (
  `oddvid` int(11) NOT NULL COMMENT '배송고유번호',
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `oddtid` int(11) NOT NULL COMMENT '주문상세고유번호',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `bookid` int(11) NOT NULL COMMENT '교재고유번호',
  `book_title` varchar(250) NOT NULL COMMENT '교재명',
  `cnt` int(11) NOT NULL COMMENT '수량',
  `order_date` datetime NOT NULL COMMENT '주문일자',
  `pay_status` tinyint(4) NOT NULL COMMENT '주문상태(0정상)',
  `delivery_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '배송상태(0배송준비중)',
  `arrival_date` datetime DEFAULT NULL COMMENT '배송완료일',
  `tracking_num` int(11) DEFAULT NULL COMMENT '운송장번호'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `order_delivery`
--

INSERT INTO `order_delivery` (`oddvid`, `odid`, `oddtid`, `uid`, `bookid`, `book_title`, `cnt`, `order_date`, `pay_status`, `delivery_status`, `arrival_date`, `tracking_num`) VALUES
(1, 20, 20, 34, 1, '실무자 JAVA 코스\r\n', 1, '2024-12-15 17:14:44', 0, 0, NULL, 2147483647);

-- --------------------------------------------------------

--
-- 테이블 구조 `order_details`
--

CREATE TABLE `order_details` (
  `oddtid` int(11) NOT NULL COMMENT '주문상세고유번호',
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `tc_uid` int(11) DEFAULT NULL COMMENT '강사의 회원고유번호',
  `leid` int(11) DEFAULT NULL COMMENT '강좌고유번호',
  `lec_title` varchar(250) DEFAULT NULL COMMENT '강좌명',
  `lec_price` decimal(10,2) DEFAULT NULL COMMENT '강좌가격',
  `discount_lec_price` decimal(10,2) DEFAULT NULL COMMENT '할인된강좌가격',
  `boid` int(11) DEFAULT NULL COMMENT '교재고유번호',
  `bo_title` varchar(250) DEFAULT NULL COMMENT '교재명',
  `bo_price` decimal(10,2) DEFAULT NULL COMMENT '교재가격',
  `pay_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문상태(0정상)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='주문 상세 항목';

--
-- 테이블의 덤프 데이터 `order_details`
--

INSERT INTO `order_details` (`oddtid`, `odid`, `tc_uid`, `leid`, `lec_title`, `lec_price`, `discount_lec_price`, `boid`, `bo_title`, `bo_price`, `pay_status`) VALUES
(1, 1, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(2, 2, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(3, 3, 2, 2, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, NULL, NULL, NULL, NULL, 0),
(4, 4, NULL, 2, '실무자 JAVA 코스', 20000.00, NULL, NULL, NULL, NULL, 0),
(5, 5, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(6, 6, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(7, 7, 2, 2, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, NULL, NULL, NULL, NULL, 0),
(8, 8, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(9, 9, 2, 2, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, NULL, NULL, NULL, NULL, 0),
(10, 10, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(11, 11, NULL, 2, '실무자 JAVA 코스', 20000.00, NULL, NULL, NULL, NULL, 0),
(12, 12, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(13, 13, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(14, 14, 2, 2, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, NULL, NULL, NULL, NULL, 0),
(15, 15, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(16, 16, NULL, 2, '실무자 JAVA 코스', 20000.00, NULL, NULL, NULL, NULL, 0),
(17, 17, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(18, 18, NULL, 2, '실무자 JAVA 코스', 20000.00, NULL, NULL, NULL, NULL, 0),
(19, 19, NULL, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, NULL, NULL, NULL, NULL, 0),
(20, 20, NULL, 2, '실무자 JAVA 코스', 20000.00, NULL, NULL, NULL, NULL, 0),
(21, 20, 2, 3, '[레시피] CSS Flex와 Grid 제대로 익히기', 50000.00, NULL, NULL, NULL, NULL, 0),
(37, 21, NULL, 51, '그림으로 배우는 HTML/CSS, 입문!', 19800.00, NULL, NULL, '', 0.00, 0),
(38, 21, NULL, 52, 'HTML/CSS 베이스캠프', 22000.00, NULL, 8, 'HTML&CSS 마스터북', 22000.00, 0),
(39, 22, NULL, 52, 'HTML/CSS 베이스캠프', 22000.00, NULL, 8, 'HTML&CSS 마스터북', 22000.00, 0),
(40, 22, NULL, 51, '그림으로 배우는 HTML/CSS, 입문!', 19800.00, NULL, NULL, '', 0.00, 0),
(41, 23, NULL, 52, 'HTML/CSS 베이스캠프', 22000.00, NULL, 8, 'HTML&CSS 마스터북', 22000.00, 0),
(42, 23, NULL, 51, '그림으로 배우는 HTML/CSS, 입문!', 19800.00, NULL, NULL, '', 0.00, 0),
(43, 24, NULL, 52, 'HTML/CSS 베이스캠프', 22000.00, NULL, 8, 'HTML&CSS 마스터북', 22000.00, 0),
(44, 24, NULL, 51, '그림으로 배우는 HTML/CSS, 입문!', 19800.00, NULL, NULL, '', 0.00, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `refunds`
--

CREATE TABLE `refunds` (
  `reid` int(11) NOT NULL COMMENT '환불고유번호',
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `refund_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '환불요청일자',
  `re_amount` decimal(10,2) NOT NULL COMMENT '환불금액',
  `re_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '환불상태(환불요청0)',
  `processed_date` datetime DEFAULT NULL COMMENT '환불처리일자',
  `admin_id` int(11) NOT NULL COMMENT '환불처리담당자',
  `reason` varchar(250) NOT NULL COMMENT '환불요청사유'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='환불요청/처리';

-- --------------------------------------------------------

--
-- 테이블 구조 `teachers`
--

CREATE TABLE `teachers` (
  `tcid` int(11) NOT NULL COMMENT '강사고유번호',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `cgid` int(11) DEFAULT NULL COMMENT '카테고리고유번호',
  `tc_userid` varchar(50) NOT NULL COMMENT '회원아이디',
  `tc_name` varchar(50) NOT NULL COMMENT '회원이름',
  `tc_userphone` varchar(50) NOT NULL,
  `tc_email` varchar(100) NOT NULL COMMENT '회원이메일',
  `tc_cate` varchar(50) NOT NULL COMMENT '대표분야',
  `tc_url` varchar(100) DEFAULT NULL COMMENT '사이트링크',
  `tc_thumbnail` varchar(100) DEFAULT NULL COMMENT '프로필이미지',
  `tc_main_intro` varchar(30) NOT NULL COMMENT '메인소개글',
  `tc_intro` text NOT NULL COMMENT '소개글',
  `tc_bank` varchar(50) DEFAULT NULL COMMENT '은행명',
  `tc_account` varchar(50) DEFAULT NULL COMMENT '계좌번호',
  `tc_ok` tinyint(4) NOT NULL DEFAULT 0 COMMENT '승인상태(심사중=0)',
  `isrecom` tinyint(4) DEFAULT NULL COMMENT '추천강사여부',
  `isnew` tinyint(4) DEFAULT NULL COMMENT '신규강사여부'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강사';

--
-- 테이블의 덤프 데이터 `teachers`
--

INSERT INTO `teachers` (`tcid`, `uid`, `cgid`, `tc_userid`, `tc_name`, `tc_userphone`, `tc_email`, `tc_cate`, `tc_url`, `tc_thumbnail`, `tc_main_intro`, `tc_intro`, `tc_bank`, `tc_account`, `tc_ok`, `isrecom`, `isnew`) VALUES
(1, 2, 1, 'even_teacher', '이븐선생', '010-4567-8910', 'eventeacher@even.co.kr', '1', '', '/code_even/admin/upload/teacher/20241230095951173803.jpg', '', '안녕하세요 익힘의 정도가 적절한 이븐선생입니다~', '', '', 1, 0, 0),
(2, 4, 1, 'my_teacher', '김동주', '010-4567-8910', 'rocks@even.co.kr', '1', 'https://www.youtube.com/@Ezweb', '/code_even/admin/upload/teacher/20241217071938198717.png', 'Rock’s Easyweb 차근차근 제대로 배워봅시다', '반갑습니다. 바위처럼, 이지웹입니다.', '', '', 1, 1, 0),
(3, 70, 2, 'teacher3', '조한결', '010-8723-4519', 'user70@example.com', '1', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241217063622106996.png', '웹 프론트엔드 한 입 크기로 잘라먹어 볼까요?', '웹 프론트엔드 한 입 크기로 잘라먹어 볼까요?! <br>\r\n\r\n안녕하세요 🙇‍♂ <br>\r\n\r\n저는 무엇이든 쉽고 재미있게 설명할 방법이 있다고 믿는 사람이자 <br>\r\n\r\n세상에서 가장 따뜻한 개발자 커뮤니티를 만들고자 하는 사람입니다. <br>\r\n\r\n \r\n\r\n도서) \"한 입 크기로 잘라먹는 리액트\" 출간 <br>\r\n강의) 한 입 크기로 잘라먹는 Next.js <br>\r\n강의) 한 입 크기로 잘라먹는 타입스크립트 <br>\r\n강의) 한 입 크기', '', '', 1, 1, 0),
(4, 68, 3, 'teacher4', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 1, 0, 0),
(5, 75, 1, 'teacher5', '코딩웍스', '010-2345-6789', 'randomuser1@example.com', '1', 'https://www.youtube.com/@CodingWorks', '/code_even/admin/upload/teacher/20241213083843819429.png', '', '', '', '', 1, 0, 0),
(6, 76, 1, 'teacher6', '얄코', '010-8765-4321', 'user6@example.com', '1', 'https://www.youtube.com/@yalco-coding', '/code_even/admin/upload/teacher/20241213084239189335.png', '', '유튜브 채널 [**얄팍한 코딩사전**](https://www.youtube.com/channel/UC2nkWbaJt1KQDi2r2XclzTQ/videos)을 방송하는 유튜버이자, IT서적들을 집필하는 작가입니다.  풀스택 개발자로 일해 온 경험을 살려, 어려운 프로그래밍 개념들을 초보자들이 이해하기 쉽도록 비유와 쉬운 예제, 때로는 애니메이션으로 설명하는 컨텐츠들을 만들고 있습니다.\r\n\r\n🎬\r\n\r\n[YouTube 얄팍한 코딩사전 채널 (클릭!)](https://www.youtube.com/channel/UC2nkWbaJt1KQDi2r2XclzTQ)\r\n\r\n📕\r\n\r\n[얄코의 책들 보러가기](https://www.yalco.kr/#books)\r\n\r\n(클릭!)', '', '', 1, 0, 0),
(7, 77, 1, 'teacher7', '조코딩', '010-9876-5432', 'lovelycat32@gmail.com', '1', 'https://www.youtube.com/@jocoding', '/code_even/admin/upload/teacher/20241213084539156010.png', '', '누구나 배울 수 있는 쉬운 코딩 교육 만들어가는 조코딩입니다. 프로그래밍에 대해 아무것도 모르더라도 개발이 가능하도록 기초부터 차근차근 쉽게 설명해드립니다. 또한, 단순히 코딩 지식을 배우는 것을 넘어서 웹, 앱, 게임 같은 결과물을 만들고 비즈니스 모델을 만들어 수익화 하거나 주식/코인 투자 자동화, 업무 자동화를 하는 등 실용적인 관점에서 코딩을 교육합니다.', '', '', 1, 0, 0),
(8, 78, 1, 'teacher8', '제주코딩베이스캠프', '010-1357-2468', 'user8@example.com', '1', 'https://www.youtube.com/channel/UC4GnvNKtuJ4cqWsYjxNxAEQ', '/code_even/admin/upload/teacher/20241213084623102898.png', '', '# **🧙‍♂ 안녕하세요. 제주코딩베이스캠프입니다.**\r\n\r\n# **제주코딩베이스캠프란?**\r\n\r\n**제주에서 가장 핫한 개발자들이 모여 작당한 부트캠프!** 열정있는 청년들에게 열정만큼 성장할 수 있는 기회를 제공합니다!\r\n\r\n제주코딩베이스캠프는 제주에서 가장 큰 ICT 교육 행사로 카카오, 구름, 제주산학융합원 등 기업 지자체와 함께 진행하고 있습니다.\r\n\r\n**서비스 구축 성공** 경험을 통해 이 취업난 시대에 자신감, 자존감, 성취감, 그리고 자립할 수 있는 능력을 배양해 보세요!\r\n\r\n으라차차 청춘 화이팅입니다! 😀', '', '', 1, 0, 0),
(9, 79, 1, 'teacher9', '홍팍', '010-4682-7351', 'supernova_77@yahoo.com', '1', 'https://www.youtube.com/channel/UCpW1MaTjw4X-2Y6MwAVptcQ', '/code_even/admin/upload/teacher/20241213084649125650.png', '', '프로그래밍 교육 전파에 진심인 🔥 [유튜버](https://www.youtube.com/@hongpark) 및 벤처 🧑🏻‍💻 개발자. 다양한 IT경험을 토대로, 누구나 쉽게 배울 수 있는 강의 제작에 힘쓰고 있다. 저서로는 📖 <[자바를 부탁해](http://www.yes24.com/Product/Goods/104740689)>, <[스프링부트3](https://www.yes24.com/Product/Goods/119952151)>가 있다.\r\n\r\n- 현) 유튜브 채널 👉 [\"홍팍\"](https://www.youtube.com/channel/UCpW1MaTjw4X-2Y6MwAVptcQ) 운영\r\n- 현) 프로그래밍 강사 및 튜터 활동\r\n- 현) 클라우드스터딩 운영\r\n- 전) 한국 항공대 무인 항공기 MAV Lab. 연구원\r\n- 전) 한국 항공대 아두이노 강의 조교\r\n- 전) 아이엠박스 개발팀장\r\n- 전) 시프트더블유 개발자', '', '', 1, 0, 0),
(10, 80, 1, 'teacher10', '김영보', '010-7890-1234', 'user10@example.com', '1', 'https://www.youtube.com/@tonextday', '/code_even/admin/upload/teacher/20241213084722188172.png', '', '40년 넘게 소프트웨어를 개발했으며, 지금도 개발하고 있습니다.\r\n\r\n23년 넘게 JavaScript 중심으로 개발했습니다.\r\n\r\n메일: [tonextday@gmail.com](mailto:tonextday@gmail.com)\r\n\r\n**동영상: 11개**\r\n\r\n클린업 자바스크립트, 자바스크립트 비기너, 자바스크립트 중고급\r\n\r\n모던 자바스크립트(ES6+) 기본, 모던 자바스크립트(ES6+) 심화\r\n\r\nDOM 기본, DOM 인터랙션\r\n\r\nReact 비기너, React 완전 끝내기\r\n\r\n요구분석 구현 방법\r\n\r\n자바스크립트 머신러닝 TensorFlow.js\r\n\r\n**저서: 9권**몰입! 자바스크립트, ECMAScript 6, HTML5, DOM 스크립팅자바스크립트 정규표현식, 요구분석을 위한 Event Process 모델링머신러닝 TensorFlow.js JavaScript, Ajax 활용, prototype.js 완전분석  9권 중에서 8권은 국내 최초 저자입니다.특히, \"머신러닝 TensorFlow.js JavaScript\"는 출판하는 시점에 amazon.com에 관련된 책이 없었습니다.', '', '', 1, 0, 0),
(11, 81, 1, 'teacher11', '개발자의 품격', '010-6543-2109', 'fastcar45@outlook.com', '1', 'https://www.youtube.com/@thegreat-programmers', '/code_even/admin/upload/teacher/20241213084808153324.png', '', '소프트웨어 기술을 통해 세상에 선한 영향력을 주고 싶은 24년차 소프트웨어 개발자.\r\n\r\n지식을 나누는 것을 좋아하고 항상 새로운 기술을 익히는 것을 즐겨요.\r\n\r\n국내외 60개가 넘는 글로벌 기업 ERP 시스템을 구축하는 컨설턴트 및 개발자로 활동하였고, 직접 개발한 소프트웨어를 국내는 물론 해외 유수의 기업에 판매를 한 경험 또한 가지고 있어요. IT스타트업 대표이사 이기도 해요.\r\n\r\n개발자 뿐만 아니라, UX 컨설턴트로, 때로는 비즈니스 컨설턴트로 일하면서 애플리케이션과 서비스 개발 시 기획에서 개발까지 전과정에 대한 수많은 경험을 쌓았고, 이제는 20년이 넘는 실무 경험을 바탕으로 후배들에게 정말 필요한 기술, 정말 제대로 된 지식을 전달하는 사명감을 갖고 지식 나눔에 일을 하고 있어요.\r\n\r\n이메일 - [seungwon.go@gmail.com](mailto:seungwon.go@gmail.com)', '', '', 1, 0, 0),
(12, 82, 1, 'teacher12', '윤재성', '010-3698-1472', 'bluebird99@hotmail.com', '1', 'https://www.youtube.com/@isoftcampus/search', '/code_even/admin/upload/teacher/20241213084833932891.png', '', 'T에 모든 강좌를 서비스하고 있는 소프트캠퍼스의 윤재성입니다.\r\n2001년 국내 모바일 콘텐츠 개발 언어(SK-VM,Brew,WIPI Clet,WIPI-Jlet)에 대한 2G 콘텐츠 개발 강의 부터 모바일 스마트폰 개발 분야 안드로이드,아이폰,웹 프로그래밍,데이터베이스 분야, 웹 프로트엔드 언어, 빅데이터분야 , 서버 분야에 IT에 다양한 교육을 지속적으로 무료로 서비스하고 있는 기관입니다.', '', '', 1, 0, 0),
(13, 83, 1, 'teacher13', '짐코딩', '010-1927-3648', 'user13@example.com', '1', 'https://www.youtube.com/@gymcoding', '/code_even/admin/upload/teacher/20241213084857119305.png', '', '안녕하세요.\r\n\r\n코딩 교육 크리에이터 짐코딩 입니다 🙂\r\n\r\n유튜브에서 코딩 교육 \"[**짐코딩 GYM CODING**](https://www.youtube.com/channel/UCZ30aWiMw5C8mGcESlAGQbA/?sub_confirmation=1)\"채널을 운영하고 있으며,\r\n\r\n인프런 교육 플랫폼에서 프로그래밍 지식을 공유하고 있습니다.\r\n\r\n제 강의의 특징은 이제 막 시작하시는 분들을 위하여\r\n\r\n설명하고자 할 때는 최대한 쉽게,\r\n\r\n알려드리고자 할 때는 최대한 알차게 설명드립니다.\r\n\r\n항상 수강생 입장에서 생각하는 코딩 교육 크리에이터가 되겠습니다.\r\n\r\n감사합니다.\r\n\r\n📨 이메일 bruce.lean17@gmail.com\r\n\r\n🏋️‍♀️ 헬스타그램 [@helinlee.gram](https://www.instagram.com/helinlee.gram/)\r\n\r\n🧑‍💻 코딩스타그램 [@gymcoding](https://www.instagram.com/gymcoding/)', '', '', 1, 0, 0),
(14, 84, 1, 'teacher14', '노마드크리에이터', '010-4729-3851', 'blud99@hotmail.com', '1', 'https://www.youtube.com/@creApplecom', '/code_even/admin/upload/teacher/20241230100101153737.png', '', '노마드크리에이터는 우리나라와 싱가포르에서 인공지능 핀테크 프로젝트를 수행하는 스타트업을 운영하고 있습니다. 실전에서 쌓은 경험과 노하우를 모아서 쉽고 재미있는 교육 컨텐츠를 제공하고 있습니다. 스타트업을 시작하기 전에는 약 25년간 LG CNS, Tmoney 등에서 System Engineer, Program/Project Manager, Business Developer, IT Consultant로 국내 및 해외에서 활동하며 쌓은 경험을 쌓았습니다.\r\n\r\n프로그램 개발 및 프로젝트 관리에 관심을 두고 PMP(Project Management Professional by PMI), SAP Business Warehouse, SCJP(Sun Certified Java Programmer), MCSE+DBA(Microsoft Certified System Engineer) 와 OCP(Oracle Certified Professional-DBA) 등의 자격과 전문성을 바탕으로 다양한 영역에서 도전을 이어가고 있습니다.', '', '', 1, 0, 0),
(15, 85, 1, 'teacher15', '코지코더', '010-8147-9263', 'techgeek2024@gmail.com', '1', 'https://github.com/kossiecoder', '', '', '', '', '', 1, 0, 0),
(16, 86, 1, 'teacher16', '제로초', '010-4758-2941', 'user16@example.com', '1', 'https://www.rallit.com/hub/resumes/1572/조현영', '/code_even/admin/upload/teacher/20241213085110178305.png', '', '# **조현영**\r\n\r\n직업\r\n**풀스택 개발자**\r\n\r\n간단 소개\r\n\r\n## **기술 스택**\r\n\r\n기술 스택\r\n\r\nReact, React Native, JavaScript, TypeScript, Python, Node.js, NestJS, Express, Vue.js\r\n\r\n## **경력**\r\n\r\n회사명\r\n\r\n**주식회사스모어톡**\r\n\r\n직급 | 부서 | 근무 유형\r\n\r\nCTO | 개발 | 재직 중\r\n\r\n근무 기간\r\n\r\n2023.05. ~ 재직 중 (1년 8개월)\r\n\r\n담당 업무\r\n\r\n회사명\r\n\r\n**주식회사카카오모빌리티**\r\n\r\n직급 | 부서 | 근무 유형\r\n\r\n파트장 | 풀필먼트개발팀\r\n\r\n근무 기간\r\n\r\n2022.03. ~ 2023.04. (1년 2개월)\r\n\r\n담당 업무\r\n\r\n회사명\r\n\r\n**주식회사오늘의픽업**\r\n\r\n직급 | 부서 | 근무 유형\r\n\r\nCTO | 개발\r\n\r\n근무 기간\r\n\r\n2020.12. ~ 2022.04. (1년 5개월)\r\n\r\n담당 업무\r\n\r\n## **자기소개**\r\n\r\n자기소개\r\n\r\nNode.js 교과서, 타입스크립트 교과서, 코딩자율학습 제로초의.자바스크립트 입문 저자', '', '', 1, 0, 0),
(17, 87, 2, 'teacher17', 'AWS강의실', '010-2391-8465', 'unshine_day@naver.com', '2', 'https://www.rallit.com/hub/resumes/196278/박상운', '/code_even/admin/upload/teacher/20241213085139185754.png', '', '저는 3S(AW**S**, Serverles**S,** NewJean**S** ) 를 좋아하는 개발자입니다.\r\n\r\nFrontend 5년 / Backend 9년 / AWS 9년 경력\r\n\r\n유튜브 “[AWS 강의실](https://www.youtube.com/@AWSClassroom)” 운영자\r\n\r\nAWS Serverless Community Builder\r\n\r\n㈜ 리콘랩스 Dev Lead\r\n\r\n이력서 : [resume.awsclassroom.kr](http://resume.awsclassroom.kr/)\r\n\r\n링크드인 : https://www.linkedin.com/in/spark323/', '', '', 1, 0, 0),
(18, 88, 2, 'teacher18', '이상희', '010-6874-9102', 'user18@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085200972435.png', '', '안녕하세요 이상희 강사(instructor@naver.com)입니다\r\n\r\n코드이븐을 통해 만나게 된 여러분 반갑습니다.\r\n\r\n강의를 수강하시는 모든 분들에게  IT분야에서의 큰 도전과 발전의 단초가 되기를 진심으로 기원합니다.\r\n\r\n강사약력\r\n\r\n단국대학교 경영대학원 전자정보처리 MIS석사\r\n\r\nIT 기술강의 30년(MS,Vmware,Cisco,EMC,CTT 등 주요벤더 공인강사)\r\n\r\n(전) KPC(한국생산성본부) 전문연구원\r\n\r\n(전) HP포함 IT 다국적기업 근무\r\n\r\n(현) 서울 디지털 대학교([www.sdu.ac.kr](http://www.sdu.ac.kr/)) AI소프트웨어공학과 객원교수\r\n\r\n주요 강의영역과 주요경력\r\n\r\nWindows ,Linux 운영체제 및 MS서버제품군(SQL,Exchange,SharePoint,TMG Server등)\r\n\r\nForeFront Office\r\n\r\nCisco CCNA 및 네트워크 기술 전문강의\r\n\r\nEMC 공인과정(STF,ETF,NAS,SAN등 스토리지기술)\r\n\r\n클라우드 인프라 구축 엔지니어 양성과정\r\n\r\n서버가상화,데스크탑가상화,애플리케이션가상화 구축과정\r\n\r\n도커와 쿠버네티스 운영 및 관리 과정\r\n\r\n파이썬 , R ,프로그래밍과정 ,데이터시각화,분석 빅데이터 교육 ,AI 관련과정 교육\r\n\r\n주요프로젝트 경력\r\n\r\n- KPC 인트라넷 기획및 설계 구축\r\n- 삼성반도체 MS Active Directory 설계 및 컨설팅 수행\r\n- 한국국제학교 MS 기반 인트라넷 Restructuring 및 message infra tunning\r\n- 연세대학교 U-Hospital 구현을 위한 인프라및 애플리케이션 구축 프로젝트 참여\r\n- 현대기아차 미주법인 클라우드기반 Global Messenger 인프라구축 프로젝트(미국 남가주)\r\n- 인프라 성능 분석을 위한 빅데이터 시스템 구축 프로젝트(업무 분석 및 설계, 구축(Vmware 솔루션기반 가상화 서버 및 VDI 관련) 등 다수', '', '', 1, 0, 0),
(19, 89, 2, 'teacher19', 'JeongSuk Lee', '010-3421-8674', 'happyworld2023@daum.net', '2', '', '/code_even/admin/upload/teacher/20241230100807419945.jpg', '', '한국/호주/영국에서 Full-stack developer, DevOps Engineer/Consultant로 15년 정도 일을 하고 있는 Digital Nomad IT Engineer 입니다. IT 조직 운영의 최적화를 위해 끊임 없이 새로운 주제에 대해서 공부를 하고 있으며, 은퇴할 때까지 Engineer로 생활하고 싶다는 꿈을 가지고 있습니다. 현재는 호주 Melbourne에 있는 한 은행의 Developer Experience 팀에서 DevOps로 활동하고 있습니다', '', '', 1, 0, 0),
(20, 90, 2, 'teacher20', '일프로', '010-5647-2831', 'user20@example.com', '2', 'https://www.rallit.com/hub/resumes/23145/김태민', '/code_even/admin/upload/teacher/20241213085248149827.png', '', '**쿠버네티스는** **코드(Code)로 인프라 환경**을 만드는 현재 가장 좋은, 가장 많이 사용되는 기술 입니다.\r\n\r\n예전에 한땀한땀 해왔던 수작업들을 이제는 코드로도 다 만들 수 있게 됐어요. 그래서 그동안 해왔던 **경험을 가지고 코드를 미리 만들어 놓으면 작업 속도는 말도 안되게 빨라집니다**. 인터넷 속도가 빨라지면서 예전엔 불가능했다고 생각했던 일들이 가능해졌다는거 아시나요?\r\n\r\n**하지만, 경험이 없으면 이 코드를 만들어 놓는 게 쉽지는 않아요.**\r\n\r\n그래서 저는 **제 경험을** 토대로 만들어 놓은 코드들을 **여러분께 공유**하고자 합니다. 그동안 제가 **정리했던 자료들도 함께요.**\r\n\r\n저는 지금까지 제가 쌓아온 걸 많은 사람들에게 보여드리고 싶은 **새로운 목표**가 생겼습니다. 그 목표의 시작은 **[쿠버네티스 어나더 클래스]**고요. 모두 청출어람 하셔서 저보다 잘 됐으면 좋겠습니다 :)', '', '', 1, 0, 0),
(21, 91, 2, 'teacher21', '데이터리안', '010-1482-7395', 'nightowl88@live.com', '2', '', '/code_even/admin/upload/teacher/20241213085311158494.png', '실무 경험이 탄탄한 데이터 강의', '실무 경험이 탄탄한 현업 분석가들이 데이터 분석 교육을 기획하고, 직접 강의합니다.\r\n\r\n데이터리안에 대해서 더 알아보고 싶다면 <br>\r\n\r\n👉 [https://www.datarian.io](https://www.datarian.io/webinar?utm_source=inflearn&utm_medium=inflearn&utm_campaign=referral&utm_content=profile)', '', '', 1, 1, 0),
(22, 92, 2, 'teacher22', '이성욱', '010-2874-5632', 'oceanview55@icloud.com', '2', '', '/code_even/admin/upload/teacher/20241230101414197015.png', '', '**경력**\r\n\r\n- CRM/DW 및 SI 프로젝트 수행\r\n- 네이버 & 라인 DB팀 근무\r\n- 카카오 DB팀 근무\r\n- (현) 당근마켓 인프라실 DB팀 팀장\r\n\r\n**저서**\r\n\r\n- Real MySQL 8.0 개정판 1권/2권\r\n- Real MongoDB\r\n- Real MariaDB\r\n- Real MySQL\r\n- MySQL 성능 최적화', '', '', 1, 0, 0),
(23, 93, 2, 'teacher23', '권철민', '010-9271-4638', 'user23@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085347197458.png', '', '(전) 엔코아 컨설팅\r\n\r\n(전) 한국 오라클\r\n\r\nAI 프리랜서 컨설턴트\r\n\r\n파이썬 머신러닝 완벽 가이드 저자', '', '', 1, 0, 0),
(24, 94, 2, 'teacher24', '잔재미코딩', '010-4758-9210', 'user24@example.com', '2', 'https://www.youtube.com/@fun-coding', '/code_even/admin/upload/teacher/20241213085421100170.png', '', '- **주요 경력**: 쿠팡 수석 개발 매니저/Principle Product Manager, 삼성전자 개발 매니저 (경력 약 15년)\r\n- **학력**: 고려대 일어일문 / 연세대 컴퓨터공학 석사 (완전 짬뽕)\r\n- **주요 개발 이력**: 삼성페이, 이커머스 검색 서비스, RTOS 컴파일러, Linux Kernel Patch for NAS\r\n- **저서**: 리눅스 커널 프로그래밍, 리눅스 운영 체제의 이해와 개발, 누구나 쓱 읽고 싹 이해하는 IT 핵심 기술, 왕초보를 위한 파이썬 프로그래밍 입문서\r\n- **운영 사이트**: [잔재미코딩 (http://www.fun-coding.org) [클릭]](https://www.fun-coding.org/)\r\n- 풀스택/데이터과학 관련 무료 자료를 공유하는 사이트입니다.\r\n- **기타**: [잔재미코딩 유투브 채널 [클릭]](https://www.youtube.com/@fun-coding)\r\n    - IT 학습에 도움이 되는 팁/ 짧은 무료 강의를 공유하고자, 조금씩 시작하고 있습니다~\r\n\r\n최신 현업과 IT 강의를 병행하며, 8년째 꾸준히 견고한 풀스택과 데이터과학 강의를 만들고 있습니다.', '', '', 1, 0, 0),
(25, 95, 2, 'teacher25', '김시훈', '010-8465-1273', 'user25@example.com', '2', 'https://www.linkedin.com/in/sihoon-kim/', '/code_even/admin/upload/teacher/20241230101707831589.png', '', '현재 공동창업한 작은 스타트업 Ninjalerts에서 CTO역할로 일하고 있습니다. Ninjalerts는 이더리움 블록체인 데이터를 기반으로 NFT 거래 정보들을 실시간으로 알려주는 서비스에요!\r\n\r\n전에 만나씨이에이에서 개발 팀장으로 있었어요. 시작은 기획자였는데 개발자가 부족한 탓에 외주를 맡기려다가 직접 개발할 기회가 생기면서 운 좋게 개발자로 전향했어요. 이후 자사몰을 자체 개발하면서 이커머스 개발팀장을 맡았어요.\r\n\r\n온라인에 나온 다양한 좋은 자료들 덕분에 빠르게 성장할 수 있었어요. 제 노하우가 여러분들에게도 도움이 되길 바랍니다 :)', '', '', 1, 0, 0),
(26, 96, 2, 'teacher26', '윤석찬', '010-9374-6581', 'user96@example.com', '2', 'https://www.youtube.com/watch?v=4ZnlZCbbN_A', '/code_even/admin/upload/teacher/20241213085514482122.png', '', 'Channy is a Principal Developer Advocate for AWS cloud. As an open web enthusiast and blogger at heart, he loves community-driven learning and sharing of technology.\r\n\r\nhttps://www.youtube.com/watch?v=4ZnlZCbbN_A', '', '', 1, 0, 0),
(27, 97, 2, 'teacher27', '쿠만', '010-2947-1365', 'user27@example.com', '2', '', '', '', '', '', '', -1, 0, 0),
(28, 98, 3, 'teacher28', '에릭권', '010-1284-9465', 'user28@example.com', '3', '', '/code_even/admin/upload/teacher/20241230102034901079.png', '', '2017년 부터 Xamarin, Wpf 개발을 시작으로한 C# 개발자입니다. 현재는 안드로이드 모바일 게임을 운영중이며 게임 서버와 웹 서버를 C#으로 개발하였습니다. \r\n기본이 안되어 있으면 어떤 서버를 만들든간에 안정적이지 못할것입니다. \r\n여러분이 추후에 멋진 서버를 만들기 위한 TCP 소켓의 기본기를 알려주기 위해 지식공유자가 되었습니다.', '', '', 1, 0, 0),
(29, 99, 3, 'teacher29', '널널한개발자', '010-5673-8492', 'user29@example.com', '3', 'https://www.youtube.com/@nullnull_not_eq_null', '/code_even/admin/upload/teacher/20241213085545212384.png', '차이를 만드는 첫걸음, 보안정복', '널널한 개발자 TV 채널 주인장이자\r\n\r\n30년 넘게 IT기술의 바다를 항해하고 있는 개발자 입니다.  반갑습니다. ^^', '', '', 1, 1, 0),
(30, 100, 3, 'teacher30', '컴공로드맵', '010-9483-1652', 'user30@example.com', '3', '', '/code_even/admin/upload/teacher/20241213085605345002.png', '', '프로그래밍부터 클라우드, 개인정보보호, 정보보안까지 컴퓨터 공학도에게 성공의 길을 제시합니다.', '', '', 1, 0, 0),
(31, 101, 3, 'teacher31', '제로미니', '010-2354-7890', 'user31@example.com', '3', 'https://www.youtube.com/@z3romini', '/code_even/admin/upload/teacher/20241213085627483951.png', '', '***(\'24.10월 기준 최종합격자 : 140명, 합격기업수 : 84곳)***\r\n\r\n전문성을 기반으로 빠른 취업 성공을 목표로 진행합니다.\r\n\r\n미래에 대응할 수 있는 IT 경력 개발을 제안합니다.', '', '', 1, 0, 0),
(32, 102, 1, 'teacher32', '장기효(캡틴판교)', '010-3852-9471', 'user32@example.com', '1', 'https://www.rallit.com/hub/resumes/126/장기효', '/code_even/admin/upload/teacher/20241213085025163488.png', '', '8년째 지식을 공유하고 있습니다. [🏠 **기술블로그**](https://joshua1988.github.io/), [💻 **깃헙**](https://github.com/joshua1988/) <br/>\r\n\r\n[**📗 Do it! Vue.js 입문](https://www.yes24.com/Product/Goods/58206961), [쉽게 시작하는 타입스크립트] <br/>(https://www.yes24.com/Product/Goods/119410497), [나는 네이버 프런트엔드 개발자입니다](https://www.yes24.com/Product/Goods/118444205).** 책 3권 집필 <br/>\r\n\r\n📖 [**Cracking Vue.js](https://joshua1988.github.io/vue-camp/), [타입스크립트 핸드북](https://joshua1988.github.io/ts/), [웹팩 핸드북] <br/>(https://joshua1988.github.io/webpack-guide/).** 온라인 무료 가이드북 3권 집필 <br/>\r\n\r\n👨‍💻 [**캡틴판교의 프론트엔드 개발 유튜브 채널**](https://www.youtube.com/@captainpangyo/) 운영 - 취준생, 주니어 개발자들의 고민을 들을 수 있는 곳 <br/>\r\n\r\n🥤 [**캡틴판교의 카카오톡 오픈 채팅방**](https://open.kakao.com/o/ghib5Brf) 운영 - 프런트엔드 개발 최신 정보와 업계 동료들의 생각과 고민을 들을 수 있는 곳 ', '', '', 1, 0, 0),
(33, 103, 1, 'teacher33', '쩡원', '010-9823-7415', 'user33@example.com', '1', 'https://www.youtube.com/@PHP', '/code_even/admin/upload/teacher/20241213085046193501.png', '', '유용한 IT 강의를 통해 여러분의 성장을 돕겠습니다.', '', '', 1, 0, 0),
(34, 63, 1, 'teacher63', '이정민', '010-4923-5718', 'user63@example.com', '1', '', '/code_even/admin/upload/teacher/20241230102635199517.png', '', '배움의 과정에서 겪는 불필요한 고통들이 사라지길 바라고, 또 그래야만 한다고 믿습니다.\r\n경험자의 진정성과 경험을 나누면 고통은 줄어들 수 있습니다.\r\n\r\n저의 모든 강의 콘텐츠에서 그런 마음을 느끼실 수 있도록 노력하겠습니다.\r\n많은 분들이 코딩을 재미있게 느끼고, 단순하게 이해할 수 있도록 돕기 위해 항상 노력하고 있습니다.\r\n\r\n감사합니다^^', NULL, NULL, 1, 0, 0),
(35, 62, 3, 'teacher62', '김민수', '010-8453-2198', 'user62@example.com', '3', 'https://www.youtube.com/@mincoding', NULL, '', '보안 해킹 전문가', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `userid` varchar(50) NOT NULL COMMENT '아이디',
  `username` varchar(50) NOT NULL COMMENT '이름',
  `usernick` varchar(50) NOT NULL COMMENT '닉네임',
  `userpw` varchar(200) NOT NULL COMMENT '비밀번호',
  `userphonenum` varchar(50) NOT NULL COMMENT '연락처',
  `useremail` varchar(100) DEFAULT NULL COMMENT '이메일',
  `email_ok` tinyint(4) DEFAULT NULL COMMENT '이메일수신여부(0거부,1동의)',
  `post_code` int(11) DEFAULT NULL COMMENT '우편번호',
  `addr_line1` varchar(100) DEFAULT NULL COMMENT '주소',
  `addr_line2` varchar(100) DEFAULT NULL COMMENT '상세주소',
  `addr_line3` varchar(100) DEFAULT NULL COMMENT '참고항목',
  `signup_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '가입일',
  `last_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '마지막접속일시',
  `user_level` int(11) NOT NULL DEFAULT 1 COMMENT '회원구분(1일반,10강사,100관리자)',
  `user_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '회원상태(0정상,-1정지,1탈퇴)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`uid`, `userid`, `username`, `usernick`, `userpw`, `userphonenum`, `useremail`, `email_ok`, `post_code`, `addr_line1`, `addr_line2`, `addr_line3`, `signup_date`, `last_date`, `user_level`, `user_status`) VALUES
(1, 'code_even', '이븐관리자', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 45617, '서울특별시 강남구', '101호', NULL, '2024-01-01 00:00:00', '2024-12-30 17:58:19', 100, 0),
(2, 'even_teacher', '이븐선생', '이븐하게', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'eventeacher@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', NULL, '2024-01-04 00:00:00', '2024-12-30 16:02:47', 10, 0),
(3, 'even_student', '이븐학생', '이븐학생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'even_student@even.co.kr', 1, 11000, '서울시 영등포구', '여의도 한강공원', NULL, '2024-01-17 00:00:00', '2024-12-30 19:56:53', 1, 0),
(4, 'my_teacher', '김동주', '멋진선생님', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'rocks@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '', '2024-01-20 00:00:00', '2024-12-17 08:51:00', 10, 0),
(5, 'user_kdhj_5', '이서윤', '학생A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2345-6789', 'randomuser1@example.com', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-01-21 00:00:00', '2024-11-19 10:15:30', 1, 0),
(6, 'user_abcd_6', '최민준', '유저B', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-12 00:00:00', '2024-11-18 09:45:20', 1, 0),
(7, 'user_efgh_7', '김하늘', '모범생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9876-5432', 'lovelycat32@gmail.com', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14 00:00:00', '2024-11-19 14:12:45', 1, 0),
(8, 'user_ijkl_8', '박서준', '친구C', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-02-18 00:00:00', '2024-11-17 07:55:10', 1, 0),
(9, 'user_mnop_9', '정예린', '참여자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4682-7351', 'supernova_77@yahoo.com', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15 00:00:00', '2024-11-18 15:30:22', 1, 0),
(10, 'user_qrst_10', '오지훈', '신입생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-20 00:00:00', '2024-11-19 08:47:59', 1, 0),
(11, 'user_uvwx_11', '김은정', '회원Z', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6543-2109', 'fastcar45@outlook.com', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-02-28 00:00:00', '2024-11-18 16:40:15', 1, 0),
(12, 'user_yzab_12', '황민서', '동아리장', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3698-1472', 'bluebird99@hotmail.com', NULL, 78452, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12 00:00:00', '2024-11-19 11:20:33', 1, 0),
(13, 'user_cdef_13', '이정호', '감독관', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-01 00:00:00', '2024-11-17 12:30:15', 1, 0),
(14, 'user_ghij_14', '박미라', '조직원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4729-3851', 'blud99@hotmail.com', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-03-05 00:00:00', '2024-11-18 13:22:08', 1, 0),
(15, 'user_klmn_15', '서진우', '시민D', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8147-9263', 'techgeek2024@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-03-15 00:00:00', '2024-11-19 17:09:43', 1, 0),
(16, 'user_opqr_16', '조예린', '연구자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-03-16 00:00:00', '2024-11-18 09:18:29', 1, 0),
(17, 'user_stuv_17', '강서윤', '관리자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2391-8465', 'unshine_day@naver.com', NULL, NULL, NULL, NULL, '참고 항목', '2024-03-20 00:00:00', '2024-11-19 16:27:14', 1, 0),
(18, 'user_wxyz_18', '홍민기', '팀장A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-29 00:00:00', '2024-11-19 14:52:38', 1, 0),
(19, 'user_abcd_19', '이주영', '회원F', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3421-8674', 'happyworld2023@daum.net', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-03-30 00:00:00', '2024-11-20 08:12:23', 1, 0),
(20, 'user_efgh_20', '김재현', '회원G', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-04-11 00:00:00', '2024-11-18 07:25:39', 1, 0),
(21, 'user_ijkl_21', '윤예지', '회원H', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-7395', 'nightowl88@live.com', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-04-12 00:00:00', '2024-11-19 15:45:16', 1, 0),
(22, 'user_mnop_22', '박지호', '시민E', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2874-5632', 'oceanview55@icloud.com', NULL, NULL, NULL, NULL, NULL, '2024-04-13 00:00:00', '2024-11-18 11:20:50', 1, 0),
(23, 'user_qrst_23', '전현민', '지원자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-04-14 00:00:00', '2024-11-19 17:35:40', 1, 0),
(24, 'user_uvwx_24', '송민지', '참가자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-9210', 'user24@example.com', NULL, 11900, NULL, NULL, NULL, '2024-05-15 00:00:00', '2024-11-17 12:47:39', 1, 0),
(25, 'user_yzab_25', '이세훈', '대표자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-05-16 00:00:00', '2024-11-19 18:19:54', 1, 0),
(26, 'user_cdef_26', '서민수', '부대표', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9374-6581', '', 1, NULL, NULL, NULL, NULL, '2024-05-17 00:00:00', '2024-05-19 14:30:10', 1, 0),
(27, 'user_ghij_27', '조윤호', '기술팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-05-18 00:00:00', '2024-11-20 10:35:48', 1, 0),
(28, 'user_klmn_28', '한예림', '행정팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-06-17 00:00:00', '2024-11-19 09:45:30', 1, 0),
(29, 'user_opqr_29', '이준혁', '재정팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15 00:00:00', '2024-06-20 14:15:40', 1, 0),
(30, 'user_stuv_30', '정수빈', '기획부', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-06-12 00:00:00', '2024-11-18 17:25:55', 1, 0),
(31, 'user_wxyz_31', '박진서', '개발팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-06-14 00:00:00', '2024-11-19 16:45:50', 1, 0),
(32, 'user_abcd_32', '조예원', '회계팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18 00:00:00', '2024-06-20 13:50:25', 1, 0),
(33, 'user_efgh_33', '김동현', '홍보팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-06-11 00:00:00', '2024-11-19 10:15:10', 1, 0),
(34, 'user_ijkl_34', '서윤아', '영업팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6471-8935', 'user34@example.com', NULL, NULL, '경상북도 구미시', NULL, NULL, '2024-06-15 00:00:00', '2024-11-18 12:00:00', 1, 0),
(35, 'user_mnop_35', '최서현', '연구팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1938-4756', 'user35@example.com', 0, NULL, NULL, NULL, NULL, '2024-07-16 00:00:00', '2024-07-19 18:10:00', 1, 0),
(36, 'user_qrst_36', '윤지호', '특별팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9381-2647', 'user36@example.com', 1, NULL, '울산광역시 울주군', '별관 1층', NULL, '2024-07-17 00:00:00', '2024-11-20 08:25:15', 1, 0),
(37, 'user_uvwx_37', '이예림', '개발자A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3751-9824', 'user37@example.com', NULL, 11300, '충청북도 청주시', '빌딩 2층', NULL, '2024-07-18 00:00:00', '2024-11-20 09:50:32', 1, 0),
(38, 'user_yzab_38', '정하윤', '디자이너', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1983-6475', 'user38@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-14 00:00:00', '2024-07-19 11:25:50', 1, 0),
(39, 'user_cdef_39', '박지민', '운영자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2871-9456', 'user39@example.com', 1, 7878, '강원도 강릉시', '건물 B동', '기타 참고 사항', '2024-07-13 00:00:00', '2024-11-19 14:00:25', 1, 0),
(40, 'user_ghij_40', '김수호', '회원H', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8346-1274', 'user40@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-19 00:00:00', '2024-11-20 10:30:45', 1, 0),
(41, 'user_klmn_41', '이하늘', '프로젝트매니저', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6478-1328', 'user41@example.com', 1, NULL, '서울특별시 동작구', '아파트 C동', NULL, '2024-11-16 00:00:00', '2024-11-19 17:15:20', 1, 0),
(42, 'user_opqr_42', '서영준', '기술지원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9328-4157', 'user42@example.com', 0, 15234, '인천광역시 남동구', NULL, NULL, '2024-07-15 00:00:00', '2024-11-18 16:35:48', 1, 0),
(43, 'user_stuv_43', '홍세영', '인사팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3461-7829', 'user43@example.com', 1, 13300, NULL, NULL, NULL, '2024-07-14 00:00:00', '0000-00-00 00:00:00', 1, 0),
(44, 'user_wxyz_44', '김태희', 'IT부서', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8293-6174', 'user44@example.com', NULL, NULL, NULL, NULL, '특별참조', '2024-07-12 00:00:00', '2024-11-20 15:20:05', 1, 0),
(45, 'user_abcd_45', '이정석', '회원I', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9234-8172', 'user45@example.com', NULL, 11123, '광주광역시 동구', '기타 건물', NULL, '2024-07-18 00:00:00', '2024-11-19 16:45:00', 1, 0),
(46, 'user_efgh_46', '박소정', '팀리더', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7452-8936', 'user46@example.com', 0, NULL, NULL, NULL, NULL, '2024-08-14 00:00:00', '2024-11-18 13:25:30', 1, 0),
(47, 'user_ijkl_47', '최승민', '운영자B', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3784-2591', 'user47@example.com', NULL, 12300, '경기도 안산시', '지하 1층', NULL, '2024-08-14 00:00:00', '2024-11-19 14:30:45', 1, 0),
(48, 'user_mnop_48', '김현아', '회원J', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9234-5617', 'user48@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-19 00:00:00', '2024-11-20 08:40:20', 1, 0),
(49, 'user_qrst_49', '정민재', '프로모션팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-9635', 'user49@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-15 00:00:00', '2024-11-20 12:45:35', 1, 0),
(50, 'user_efgh_50', '이채영', '졸림핑', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8239-6517', 'user50@example.com', NULL, 13245, '경기도 파주시', '별관 2층', NULL, '2024-08-18 00:00:00', '2024-11-20 12:50:20', 1, 0),
(51, 'user_ijkl_51', '박준혁', '코딩핑', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9283-4561', 'user51@example.com', 1, 14200, '전라북도 군산시', '빌라 A동', NULL, '2024-08-17 00:00:00', '2024-11-19 15:20:35', 1, 0),
(52, 'user_mnop_52', '정은채', '달빛냥', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7381-9642', 'user52@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-16 00:00:00', '2024-08-19 11:30:00', 1, 0),
(53, 'user_qrst_53', '최하늘', '별빛스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9182-6437', 'user53@example.com', 0, 12450, NULL, NULL, NULL, '2024-08-15 00:00:00', '2024-11-20 14:35:10', 1, 0),
(54, 'user_uvwx_54', '윤도영', '청춘깡', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3741-2584', 'user54@example.com', 1, NULL, '경상북도 포항시', NULL, NULL, '2024-09-18 00:00:00', '2024-11-19 12:40:15', 1, 0),
(55, 'user_yzab_55', '이현수', '햇살쿨', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2983-7651', 'user55@example.com', NULL, 13210, '부산광역시 해운대구', '건물 C동', NULL, '2024-09-12 00:00:00', '2024-11-19 09:15:45', 1, 0),
(56, 'user_cdef_56', '김민정', '달려라거북', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9371-4629', 'user56@example.com', 1, NULL, NULL, NULL, NULL, '2024-09-11 00:00:00', '2024-11-20 13:25:30', 1, 0),
(57, 'user_ghij_57', '박서윤', '미소캣', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4672-1584', 'user57@example.com', NULL, NULL, NULL, NULL, '메모사항', '2024-09-14 00:00:00', '2024-11-19 18:40:20', 1, 0),
(58, 'user_klmn_58', '최승호', '노을빛', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3485-7391', 'user58@example.com', NULL, 11235, '서울특별시 강동구', NULL, NULL, '2024-09-13 00:00:00', '2024-11-18 11:15:30', 1, 0),
(59, 'user_opqr_59', '강진우2', '꿈꾸는별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7584-1937', 'user59@example.com', 0, NULL, '', '', '', '2024-10-15 00:00:00', '2024-11-19 17:25:50', 1, 0),
(60, 'user_stuv_60', '서지민', '비상하는매', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8193-2547', 'user60@example.com', NULL, 13321, '대전광역시 서구', NULL, NULL, '2024-11-14 00:00:00', '2024-11-20 14:40:35', 1, 0),
(61, 'user_wxyz_61', '조윤호', '강한바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7483-9165', 'user61@example.com', 1, NULL, NULL, NULL, '특별 메모', '2024-10-17 00:00:00', '2024-11-19 10:05:25', 1, 0),
(62, 'teacher62', '김민수', '별빛반짝', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8453-2198', 'user62@example.com', NULL, 13400, '경기도 의정부시', '지하 3층', NULL, '2024-10-18 00:00:00', '2024-12-23 11:14:27', 1, 0),
(63, 'teacher63', '이정민', '구름산책', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4923-5718', 'user63@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16 00:00:00', '2024-12-23 11:10:38', 10, 0),
(64, 'user_ijkl_64', '박진영', '햇빛추적', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9385-7216', 'user64@example.com', NULL, NULL, NULL, NULL, NULL, '2024-10-12 00:00:00', '2024-11-18 16:20:55', 1, 0),
(65, 'user_mnop_65', '최서영', '사랑가득', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2384-7512', 'user65@example.com', 1, NULL, '', '', '', '2024-10-19 00:00:00', '2024-11-20 09:00:10', 1, -1),
(66, 'user_qrst_66', '정은호', '도전왕', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1934-8527', 'user66@example.com', NULL, NULL, NULL, NULL, '중요 참고 사항', '2024-10-18 00:00:00', '2024-11-19 19:20:05', 1, 0),
(67, 'user_uvwx_67', '윤지수2', '꽃바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8934-2158', 'user67@example.com', 0, NULL, '', '', '', '2024-11-17 00:00:00', '2024-11-20 12:50:40', 1, 0),
(68, 'teacher4', '이상민', '이상민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9482-1365', 'user68@example.com', 1, NULL, '제주특별자치도 서귀포시', '1층 사무실', NULL, '2024-11-16 00:00:00', '2024-11-19 17:15:30', 10, 0),
(69, 'user_cdef_69', '한유진2', '바다별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3492-1758', 'user69@example.com', 0, 13100, '', '', '', '2024-11-15 00:00:00', '2024-11-19 14:25:20', 1, -1),
(70, 'teacher3', '조한결', '조한결', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8723-4519', 'user70@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12 00:00:00', '2024-12-16 02:03:59', 10, 0),
(71, 'user_klmn_71', '정민아', '그린스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2394-1765', 'user71@example.com', 0, NULL, '경상남도 김해시', '빌딩 A동', '참고사항', '2024-11-14 00:00:00', '2024-11-19 16:40:25', 1, 1),
(72, 'ctest', '내이름', '쿠폰테스트', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@hong.com', NULL, NULL, NULL, NULL, NULL, '2024-11-22 00:00:00', '2024-11-22 11:44:44', 1, 0),
(73, 'test1', '박이름', '박네임', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5555-6666', 'abc@abc.com', NULL, NULL, NULL, NULL, NULL, '2024-11-24 00:00:00', '2024-11-25 01:30:33', 1, 0),
(74, 'example_user', '예시용', '예시입니다', '12345', '010-0000-0000', '0627_b@naver.com', 1, NULL, '', '', '', '2024-11-25 00:00:00', '2024-11-25 11:17:16', 1, 0),
(75, 'teacher5', '코딩웍스', '코딩웍스', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2345-6789', 'randomuser1@example.com', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-01-21 00:00:00', '2024-12-11 15:05:59', 10, 0),
(76, 'teacher6', '얄코', '얄코', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-12 00:00:00', '2024-12-17 06:10:19', 10, 0),
(77, 'teacher7', '조코딩', '조코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9876-5432', 'lovelycat32@gmail.com', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14 00:00:00', '2024-12-17 05:55:39', 10, 0),
(78, 'teacher8', '제주코딩베이스캠프', '제주코딩베이스캠프', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-02-18 00:00:00', '2024-12-17 05:38:18', 10, 0),
(79, 'teacher9', '홍팍', '홍팍', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4682-7351', 'supernova_77@yahoo.com', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15 00:00:00', '2024-12-17 05:09:38', 10, 0),
(80, 'teacher10', '김영보', '김영보', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-20 00:00:00', '2024-12-17 04:34:13', 10, 0),
(81, 'teacher11', '개발자의 품격', '개발자의 품격', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6543-2109', 'fastcar45@outlook.com', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-02-28 00:00:00', '2024-12-17 04:11:56', 10, 0),
(82, 'teacher12', '윤재성', '윤재성', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3698-1472', 'bluebird99@hotmail.com', NULL, 78452, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12 00:00:00', '2024-12-17 03:50:25', 10, 0),
(83, 'teacher13', '짐코딩', '짐코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-01 00:00:00', '2024-12-16 02:22:18', 10, 0),
(84, 'teacher14', '노마드크리에이터', '노마드크리에이터', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4729-3851', 'blud99@hotmail.com', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-03-05 00:00:00', '2024-12-16 01:52:13', 10, 0),
(85, 'teacher15', '코지코더', '코지코더', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8147-9263', 'techgeek2024@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-03-15 00:00:00', '2024-12-16 01:36:34', 10, 0),
(86, 'teacher16', '제로초', '제로초', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-03-16 00:00:00', '2024-12-16 00:14:30', 10, 0),
(87, 'teacher17', 'AWS강의실', 'AWS강의실', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2391-8465', 'unshine_day@naver.com', NULL, NULL, NULL, NULL, '참고 항목', '2024-03-20 00:00:00', '2024-12-16 00:02:22', 10, 0),
(88, 'teacher18', '이상희', '이상희', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-29 00:00:00', '2024-12-15 23:52:07', 10, 0),
(89, 'teacher19', 'JeongSuk Lee', 'JeongSuk Lee', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3421-8674', 'happyworld2023@daum.net', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-03-30 00:00:00', '2024-12-15 23:24:25', 10, 0),
(90, 'teacher20', '일프로', '일프로', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-04-11 00:00:00', '2024-12-15 16:59:11', 10, 0),
(91, 'teacher21', '데이터리안', '데이터리안', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-7395', 'nightowl88@live.com', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-04-12 00:00:00', '2024-12-15 16:43:40', 10, 0),
(92, 'teacher22', '이성욱', '이성욱', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2874-5632', 'oceanview55@icloud.com', NULL, NULL, NULL, NULL, NULL, '2024-04-13 00:00:00', '2024-12-15 16:27:53', 10, 0),
(93, 'teacher23', '권철민', '권철민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-04-14 00:00:00', '2024-12-15 16:10:33', 10, 0),
(94, 'teacher24', '잔재미코딩', '잔재미코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-9210', 'user24@example.com', NULL, 11900, NULL, NULL, NULL, '2024-05-15 00:00:00', '2024-12-15 16:00:43', 10, 0),
(95, 'teacher25', '김시훈', '김시훈', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-05-16 00:00:00', '2024-12-15 15:51:32', 10, 0),
(96, 'teacher26', '윤석찬', '윤석찬', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9374-6581', 'user96@example.com', 1, NULL, NULL, NULL, NULL, '2024-05-17 00:00:00', '2024-12-15 15:33:21', 10, 0),
(97, 'teacher27', '쿠만', '쿠만', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-05-18 00:00:00', '2024-12-15 15:14:42', 1, 0),
(98, 'teacher28', '에릭권', '에릭권', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-06-17 00:00:00', '2024-12-15 15:02:01', 10, 0),
(99, 'teacher29', '널널한개발자', '널널한개발자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15 00:00:00', '2024-12-15 14:33:53', 10, 0),
(100, 'teacher30', '컴공로드맵', '컴공로드맵', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-06-12 00:00:00', '2024-12-15 04:13:11', 10, 0),
(101, 'teacher31', '제로미니', '제로미니', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-06-14 00:00:00', '2024-12-15 02:16:57', 10, 0),
(102, 'teacher32', '장기효(캡틴판교)', '장기효(캡틴판교)', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18 00:00:00', '2024-12-17 06:21:21', 10, 0),
(103, 'teacher33', '쩡원', '쩡원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-06-11 00:00:00', '2024-12-17 07:47:24', 10, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `wishlist`
--

CREATE TABLE `wishlist` (
  `wishid` int(11) NOT NULL COMMENT '찜하기고유번호',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `leid` int(11) NOT NULL COMMENT '강좌고유번호',
  `regdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT '찜한날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `book_sales`
--
ALTER TABLE `book_sales`
  ADD PRIMARY KEY (`boid`,`sale_date`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- 테이블의 인덱스 `lecture_sales`
--
ALTER TABLE `lecture_sales`
  ADD PRIMARY KEY (`leid`,`sale_date`) USING BTREE;

--
-- 테이블의 인덱스 `monthly_sales`
--
ALTER TABLE `monthly_sales`
  ADD PRIMARY KEY (`data_year_month`);

--
-- 테이블의 인덱스 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`odid`),
  ADD KEY `od_uid_IDX` (`uid`) USING BTREE;

--
-- 테이블의 인덱스 `order_delivery`
--
ALTER TABLE `order_delivery`
  ADD PRIMARY KEY (`oddvid`),
  ADD KEY `oddtid_cascade` (`oddtid`),
  ADD KEY `oddel_uid_INDEX` (`uid`) USING BTREE,
  ADD KEY `oddel_odid_INDEX` (`odid`) USING BTREE;

--
-- 테이블의 인덱스 `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`oddtid`),
  ADD KEY `oddt_odid_IDX` (`odid`) USING BTREE;

--
-- 테이블의 인덱스 `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`reid`),
  ADD KEY `oddtid` (`odid`);

--
-- 테이블의 인덱스 `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tcid`),
  ADD KEY `fk_1_userid` (`uid`),
  ADD KEY `fk_2_cateid` (`cgid`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 테이블의 인덱스 `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishid`),
  ADD KEY `wish_leidfk_1` (`leid`),
  ADD KEY `wish_userfk_1` (`uid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT COMMENT '장바구니고유번호';

--
-- 테이블의 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `odid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문고유번호', AUTO_INCREMENT=25;

--
-- 테이블의 AUTO_INCREMENT `order_delivery`
--
ALTER TABLE `order_delivery`
  MODIFY `oddvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '배송고유번호', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `oddtid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문상세고유번호', AUTO_INCREMENT=45;

--
-- 테이블의 AUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT COMMENT '환불고유번호';

--
-- 테이블의 AUTO_INCREMENT `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '강사고유번호', AUTO_INCREMENT=36;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=104;

--
-- 테이블의 AUTO_INCREMENT `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishid` int(11) NOT NULL AUTO_INCREMENT COMMENT '찜하기고유번호';

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `odid_cascade` FOREIGN KEY (`odid`) REFERENCES `orders` (`odid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`odid`) REFERENCES `orders` (`odid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
