-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-23 05:58
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
  `ssid` varchar(100) DEFAULT NULL COMMENT '세션번호',
  `product_id` int(11) DEFAULT NULL COMMENT '강좌or교재 고유번호',
  `product_type` tinyint(4) DEFAULT NULL COMMENT '상품유형(강좌1)',
  `price` decimal(10,2) DEFAULT NULL COMMENT '강좌or교재가격',
  `cnt` int(11) DEFAULT NULL COMMENT '수량',
  `total_price` decimal(10,2) DEFAULT NULL COMMENT '총가격(수량*가격)',
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
(1, 3, 100000.00, 10000.00, 90000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-01-24 14:48:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(13, 30, 95000.00, 5000.00, 90000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-12-01 12:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 55, 185000.00, 25000.00, 160000.00, 'HTML/CSS : 기초부터 실전까지 올인원', '2024-01-29 16:30:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 8, 99000.00, 10000.00, 89000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-02-14 10:15:55', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 49, 125000.00, 20000.00, 105000.00, '실무자 JAVA 코스', '2024-03-21 11:45:40', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 14, 155000.00, 5000.00, 150000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-04-27 08:30:22', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 66, 195000.00, 10000.00, 185000.00, '실무자 JAVA 코스', '2024-05-13 14:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 28, 130000.00, 15000.00, 115000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2024-06-25 17:40:45', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 34, 160000.00, 5000.00, 155000.00, '실무자 JAVA 코스', '2024-07-19 13:15:00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- 테이블 구조 `order_details`
--

CREATE TABLE `order_details` (
  `oddtid` int(11) NOT NULL COMMENT '주문상세고유번호',
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `product_id` int(11) NOT NULL COMMENT '강좌or교재 고유번호',
  `product_type` tinyint(4) NOT NULL COMMENT '상품유형(강좌1,교재2)',
  `product_title` varchar(250) NOT NULL COMMENT '강좌명or교재명',
  `price` decimal(10,2) NOT NULL COMMENT '강좌or교재 가격',
  `cnt` int(11) NOT NULL DEFAULT 1 COMMENT '수량',
  `pay_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문상태(0정상)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='주문 상세 항목';

--
-- 테이블의 덤프 데이터 `order_details`
--

INSERT INTO `order_details` (`oddtid`, `odid`, `product_id`, `product_type`, `product_title`, `price`, `cnt`, `pay_status`) VALUES
(1, 1, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(2, 2, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(3, 3, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(4, 4, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(5, 5, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 3, 0),
(6, 6, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(7, 7, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(8, 8, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(9, 9, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(10, 10, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(11, 11, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(12, 12, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(13, 13, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(14, 14, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(15, 15, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(16, 16, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(17, 17, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(18, 18, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(19, 19, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(20, 20, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(21, 20, 3, 1, 'CSS Flex와 Grid 제대로 익히기', 50000.00, 1, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `refunds`
--

CREATE TABLE `refunds` (
  `reid` int(11) NOT NULL COMMENT '환불고유번호',
  `oddtid` int(11) NOT NULL COMMENT '주문상세항목고유번호',
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
  `tc_intro` varchar(250) NOT NULL COMMENT '소개글',
  `tc_bank` varchar(50) DEFAULT NULL COMMENT '은행명',
  `tc_account` varchar(50) DEFAULT NULL COMMENT '계좌번호',
  `tc_ok` tinyint(4) NOT NULL DEFAULT 0 COMMENT '승인상태(심사중=0)',
  `isrecom` tinyint(4) DEFAULT NULL COMMENT '추천강사여부',
  `isnew` tinyint(4) DEFAULT NULL COMMENT '신규강사여부'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강사';

--
-- 테이블의 덤프 데이터 `teachers`
--

INSERT INTO `teachers` (`tcid`, `uid`, `cgid`, `tc_userid`, `tc_name`, `tc_userphone`, `tc_email`, `tc_cate`, `tc_url`, `tc_thumbnail`, `tc_intro`, `tc_bank`, `tc_account`, `tc_ok`, `isrecom`, `isnew`) VALUES
(1, 2, 1, 'even_teacher', '이븐선생', '010-4567-8910', 'eventeacher@even.co.kr', '1', '', '', '안녕하세요 익힘의 정도가 적절한 이븐선생입니다~', '', '', 1, 1, 0),
(2, 4, 1, 'my_teacher', '김동주', '010-4567-8910', 'rocks@even.co.kr', '1', 'https://www.youtube.com/@Ezweb', '/code_even/admin/upload/teacher/20241120172340324741.jpg', '반갑습니다. 바위처럼, 이지웹입니다.', '', '', 1, 1, 0),
(3, 70, 2, 'teacher2', '조한결', '010-8723-4519', 'user70@example.com', '2', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241120175857212464.png', 'JoCODE 조한결 입니다.', '', '', 1, 0, 1),
(4, 68, 3, 'teacher3', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 0, 0, 0);

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
  `signup_date` date NOT NULL DEFAULT current_timestamp() COMMENT '가입일',
  `last_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '마지막접속일시',
  `user_level` int(11) NOT NULL DEFAULT 1 COMMENT '회원구분(1일반,10강사,100관리자)',
  `user_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '회원상태(0정상,-1정지,1탈퇴)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`uid`, `userid`, `username`, `usernick`, `userpw`, `userphonenum`, `useremail`, `email_ok`, `post_code`, `addr_line1`, `addr_line2`, `addr_line3`, `signup_date`, `last_date`, `user_level`, `user_status`) VALUES
(1, 'code_even', '이븐관리자', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 45617, '서울특별시 강남구', '101호', NULL, '2024-01-01', '2024-11-22 12:06:41', 100, 0),
(2, 'even_teacher', '이븐선생', '이븐하게', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'eventeacher@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', NULL, '2024-01-04', '2024-11-18 00:34:45', 10, 0),
(3, 'even_student', '이븐학생', '이도령', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5600', '2doryung@even.co.kr', 1, 11000, '서울시 영등포구', '여의도 한강공원', NULL, '2024-01-17', '2024-01-17 08:01:44', 1, 0),
(4, 'my_teacher', '김동주', '멋진선생님', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'rocks@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '', '2024-01-20', '2024-11-21 12:52:16', 10, 0),
(5, 'user_kdhj_5', '이서윤', '학생A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2345-6789', 'randomuser1@example.com', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-01-21', '2024-11-19 10:15:30', 1, 0),
(6, 'user_abcd_6', '최민준', '유저B', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-12', '2024-11-18 09:45:20', 1, 0),
(7, 'user_efgh_7', '김하늘', '모범생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9876-5432', 'lovelycat32@gmail.com', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14', '2024-11-19 14:12:45', 1, 0),
(8, 'user_ijkl_8', '박서준', '친구C', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-02-18', '2024-11-17 07:55:10', 1, 0),
(9, 'user_mnop_9', '정예린', '참여자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4682-7351', 'supernova_77@yahoo.com', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15', '2024-11-18 15:30:22', 1, 0),
(10, 'user_qrst_10', '오지훈', '신입생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-20', '2024-11-19 08:47:59', 1, 0),
(11, 'user_uvwx_11', '김은정', '회원Z', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6543-2109', 'fastcar45@outlook.com', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-02-28', '2024-11-18 16:40:15', 1, 0),
(12, 'user_yzab_12', '황민서', '동아리장', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3698-1472', 'bluebird99@hotmail.com', NULL, 78452, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12', '2024-11-19 11:20:33', 1, 0),
(13, 'user_cdef_13', '이정호', '감독관', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-01', '2024-11-17 12:30:15', 1, 0),
(14, 'user_ghij_14', '박미라', '조직원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4729-3851', 'blud99@hotmail.com', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-03-05', '2024-11-18 13:22:08', 1, 0),
(15, 'user_klmn_15', '서진우', '시민D', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8147-9263', 'techgeek2024@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-03-15', '2024-11-19 17:09:43', 1, 0),
(16, 'user_opqr_16', '조예린', '연구자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-03-16', '2024-11-18 09:18:29', 1, 0),
(17, 'user_stuv_17', '강서윤', '관리자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2391-8465', 'unshine_day@naver.com', NULL, NULL, NULL, NULL, '참고 항목', '2024-03-20', '2024-11-19 16:27:14', 1, 0),
(18, 'user_wxyz_18', '홍민기', '팀장A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-29', '2024-11-19 14:52:38', 1, 0),
(19, 'user_abcd_19', '이주영', '회원F', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3421-8674', 'happyworld2023@daum.net', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-03-30', '2024-11-20 08:12:23', 1, 0),
(20, 'user_efgh_20', '김재현', '회원G', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-04-11', '2024-11-18 07:25:39', 1, 0),
(21, 'user_ijkl_21', '윤예지', '회원H', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-7395', 'nightowl88@live.com', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-04-12', '2024-11-19 15:45:16', 1, 0),
(22, 'user_mnop_22', '박지호', '시민E', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2874-5632', 'oceanview55@icloud.com', NULL, NULL, NULL, NULL, NULL, '2024-04-13', '2024-11-18 11:20:50', 1, 0),
(23, 'user_qrst_23', '전현민', '지원자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-04-14', '2024-11-19 17:35:40', 1, 0),
(24, 'user_uvwx_24', '송민지', '참가자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-9210', 'user24@example.com', NULL, 11900, NULL, NULL, NULL, '2024-05-15', '2024-11-17 12:47:39', 1, 0),
(25, 'user_yzab_25', '이세훈', '대표자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-05-16', '2024-11-19 18:19:54', 1, 0),
(26, 'user_cdef_26', '서민수', '부대표', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9374-6581', '', 1, NULL, NULL, NULL, NULL, '2024-05-17', '2024-05-19 14:30:10', 1, 0),
(27, 'user_ghij_27', '조윤호', '기술팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-05-18', '2024-11-20 10:35:48', 1, 0),
(28, 'user_klmn_28', '한예림', '행정팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-06-17', '2024-11-19 09:45:30', 1, 0),
(29, 'user_opqr_29', '이준혁', '재정팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15', '2024-06-20 14:15:40', 1, 0),
(30, 'user_stuv_30', '정수빈', '기획부', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-06-12', '2024-11-18 17:25:55', 1, 0),
(31, 'user_wxyz_31', '박진서', '개발팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-06-14', '2024-11-19 16:45:50', 1, 0),
(32, 'user_abcd_32', '조예원', '회계팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18', '2024-06-20 13:50:25', 1, 0),
(33, 'user_efgh_33', '김동현', '홍보팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-06-11', '2024-11-19 10:15:10', 1, 0),
(34, 'user_ijkl_34', '서윤아', '영업팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6471-8935', 'user34@example.com', NULL, NULL, '경상북도 구미시', NULL, NULL, '2024-06-15', '2024-11-18 12:00:00', 1, 0),
(35, 'user_mnop_35', '최서현', '연구팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1938-4756', 'user35@example.com', 0, NULL, NULL, NULL, NULL, '2024-07-16', '2024-07-19 18:10:00', 1, 0),
(36, 'user_qrst_36', '윤지호', '특별팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9381-2647', 'user36@example.com', 1, NULL, '울산광역시 울주군', '별관 1층', NULL, '2024-07-17', '2024-11-20 08:25:15', 1, 0),
(37, 'user_uvwx_37', '이예림', '개발자A', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3751-9824', 'user37@example.com', NULL, 11300, '충청북도 청주시', '빌딩 2층', NULL, '2024-07-18', '2024-11-20 09:50:32', 1, 0),
(38, 'user_yzab_38', '정하윤', '디자이너', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1983-6475', 'user38@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-14', '2024-07-19 11:25:50', 1, 0),
(39, 'user_cdef_39', '박지민', '운영자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2871-9456', 'user39@example.com', 1, 7878, '강원도 강릉시', '건물 B동', '기타 참고 사항', '2024-07-13', '2024-11-19 14:00:25', 1, 0),
(40, 'user_ghij_40', '김수호', '회원H', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8346-1274', 'user40@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-19', '2024-11-20 10:30:45', 1, 0),
(41, 'user_klmn_41', '이하늘', '프로젝트매니저', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6478-1328', 'user41@example.com', 1, NULL, '서울특별시 동작구', '아파트 C동', NULL, '2024-11-16', '2024-11-19 17:15:20', 1, 0),
(42, 'user_opqr_42', '서영준', '기술지원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9328-4157', 'user42@example.com', 0, 15234, '인천광역시 남동구', NULL, NULL, '2024-07-15', '2024-11-18 16:35:48', 1, 0),
(43, 'user_stuv_43', '홍세영', '인사팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3461-7829', 'user43@example.com', 1, 13300, NULL, NULL, NULL, '2024-07-14', '2024-00-17 18:45:10', 1, 0),
(44, 'user_wxyz_44', '김태희', 'IT부서', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8293-6174', 'user44@example.com', NULL, NULL, NULL, NULL, '특별참조', '2024-07-12', '2024-11-20 15:20:05', 1, 0),
(45, 'user_abcd_45', '이정석', '회원I', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9234-8172', 'user45@example.com', NULL, 11123, '광주광역시 동구', '기타 건물', NULL, '2024-07-18', '2024-11-19 16:45:00', 1, 0),
(46, 'user_efgh_46', '박소정', '팀리더', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7452-8936', 'user46@example.com', 0, NULL, NULL, NULL, NULL, '2024-08-14', '2024-11-18 13:25:30', 1, 0),
(47, 'user_ijkl_47', '최승민', '운영자B', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3784-2591', 'user47@example.com', NULL, 12300, '경기도 안산시', '지하 1층', NULL, '2024-08-14', '2024-11-19 14:30:45', 1, 0),
(48, 'user_mnop_48', '김현아', '회원J', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9234-5617', 'user48@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-19', '2024-11-20 08:40:20', 1, 0),
(49, 'user_qrst_49', '정민재', '프로모션팀', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-9635', 'user49@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-15', '2024-11-20 12:45:35', 1, 0),
(50, 'user_efgh_50', '이채영', '졸림핑', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8239-6517', 'user50@example.com', NULL, 13245, '경기도 파주시', '별관 2층', NULL, '2024-08-18', '2024-11-20 12:50:20', 1, 0),
(51, 'user_ijkl_51', '박준혁', '코딩핑', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9283-4561', 'user51@example.com', 1, 14200, '전라북도 군산시', '빌라 A동', NULL, '2024-08-17', '2024-11-19 15:20:35', 1, 0),
(52, 'user_mnop_52', '정은채', '달빛냥', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7381-9642', 'user52@example.com', NULL, NULL, NULL, NULL, NULL, '2024-08-16', '2024-08-19 11:30:00', 1, 0),
(53, 'user_qrst_53', '최하늘', '별빛스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9182-6437', 'user53@example.com', 0, 12450, NULL, NULL, NULL, '2024-08-15', '2024-11-20 14:35:10', 1, 0),
(54, 'user_uvwx_54', '윤도영', '청춘깡', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3741-2584', 'user54@example.com', 1, NULL, '경상북도 포항시', NULL, NULL, '2024-09-18', '2024-11-19 12:40:15', 1, 0),
(55, 'user_yzab_55', '이현수', '햇살쿨', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2983-7651', 'user55@example.com', NULL, 13210, '부산광역시 해운대구', '건물 C동', NULL, '2024-09-12', '2024-11-19 09:15:45', 1, 0),
(56, 'user_cdef_56', '김민정', '달려라거북', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9371-4629', 'user56@example.com', 1, NULL, NULL, NULL, NULL, '2024-09-11', '2024-11-20 13:25:30', 1, 0),
(57, 'user_ghij_57', '박서윤', '미소캣', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4672-1584', 'user57@example.com', NULL, NULL, NULL, NULL, '메모사항', '2024-09-14', '2024-11-19 18:40:20', 1, 0),
(58, 'user_klmn_58', '최승호', '노을빛', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3485-7391', 'user58@example.com', NULL, 11235, '서울특별시 강동구', NULL, NULL, '2024-09-13', '2024-11-18 11:15:30', 1, 0),
(59, 'user_opqr_59', '강진우2', '꿈꾸는별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7584-1937', 'user59@example.com', 0, NULL, '', '', '', '2024-10-15', '2024-11-19 17:25:50', 1, 0),
(60, 'user_stuv_60', '서지민', '비상하는매', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8193-2547', 'user60@example.com', NULL, 13321, '대전광역시 서구', NULL, NULL, '2024-11-14', '2024-11-20 14:40:35', 1, 0),
(61, 'user_wxyz_61', '조윤호', '강한바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7483-9165', 'user61@example.com', 1, NULL, NULL, NULL, '특별 메모', '2024-10-17', '2024-11-19 10:05:25', 1, 0),
(62, 'user_abcd_62', '김민수', '별빛반짝', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8453-2198', 'user62@example.com', NULL, 13400, '경기도 의정부시', '지하 3층', NULL, '2024-10-18', '2024-11-20 12:35:40', 1, 0),
(63, 'teacher5', '이정민', '구름산책', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4923-5718', 'user63@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16', '2024-11-21 12:12:33', 1, 0),
(64, 'user_ijkl_64', '박진영', '햇빛추적', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9385-7216', 'user64@example.com', NULL, NULL, NULL, NULL, NULL, '2024-10-12', '2024-11-18 16:20:55', 1, 0),
(65, 'user_mnop_65', '최서영', '사랑가득', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2384-7512', 'user65@example.com', 1, NULL, '', '', '', '2024-10-19', '2024-11-20 09:00:10', 1, -1),
(66, 'user_qrst_66', '정은호', '도전왕', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1934-8527', 'user66@example.com', NULL, NULL, NULL, NULL, '중요 참고 사항', '2024-10-18', '2024-11-19 19:20:05', 1, 0),
(67, 'user_uvwx_67', '윤지수2', '꽃바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8934-2158', 'user67@example.com', 0, NULL, '', '', '', '2024-11-17', '2024-11-20 12:50:40', 1, 0),
(68, 'teacher3', '이상민', 'L', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9482-1365', 'user68@example.com', 1, NULL, '제주특별자치도 서귀포시', '1층 사무실', NULL, '2024-11-16', '2024-11-19 17:15:30', 1, 0),
(69, 'user_cdef_69', '한유진2', '바다별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3492-1758', 'user69@example.com', 0, 13100, '', '', '', '2024-11-15', '2024-11-19 14:25:20', 1, -1),
(70, 'teacher2', '조한결', '조코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8723-4519', 'user70@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12', '2024-11-20 11:45:05', 10, 0),
(71, 'user_klmn_71', '정민아', '그린스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2394-1765', 'user71@example.com', 0, NULL, '경상남도 김해시', '빌딩 A동', '참고사항', '2024-11-14', '2024-11-19 16:40:25', 1, 1),
(72, 'ctest', '내이름', '쿠폰테스트', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@hong.com', NULL, NULL, NULL, NULL, NULL, '2024-11-22', '2024-11-22 11:44:44', 1, 0);

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
  ADD KEY `oddtid` (`oddtid`);

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
  MODIFY `odid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문고유번호', AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `order_delivery`
--
ALTER TABLE `order_delivery`
  MODIFY `oddvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '배송고유번호';

--
-- 테이블의 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `oddtid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문상세고유번호', AUTO_INCREMENT=22;

--
-- 테이블의 AUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT COMMENT '환불고유번호';

--
-- 테이블의 AUTO_INCREMENT `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '강사고유번호', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=73;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `uid_ondel_setnull` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `order_delivery`
--
ALTER TABLE `order_delivery`
  ADD CONSTRAINT `oddtid_cascade` FOREIGN KEY (`oddtid`) REFERENCES `order_details` (`oddtid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_delivery_ibfk_1` FOREIGN KEY (`odid`) REFERENCES `orders` (`odid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_delivery_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `odid_cascade` FOREIGN KEY (`odid`) REFERENCES `orders` (`odid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`oddtid`) REFERENCES `order_details` (`oddtid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_1_userid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_2_cateid` FOREIGN KEY (`cgid`) REFERENCES `category` (`cgid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
