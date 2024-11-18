-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-18 07:30
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
-- 테이블 구조 `blog`
--

CREATE TABLE `blog` (
  `post_id` int(11) NOT NULL COMMENT '게시물id',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `titles` varchar(250) NOT NULL COMMENT '글제목',
  `thumnails` varchar(250) NOT NULL COMMENT '썸네일',
  `contents` text NOT NULL COMMENT '글내용',
  `likes` int(11) NOT NULL COMMENT '좋아요',
  `comments` int(11) NOT NULL COMMENT '댓글수',
  `hits` int(11) NOT NULL COMMENT '조회수',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='블로그';

--
-- 테이블의 덤프 데이터 `blog`
--

INSERT INTO `blog` (`post_id`, `uid`, `titles`, `thumnails`, `contents`, `likes`, `comments`, `hits`, `regdate`) VALUES
(1, 3, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/admin/community/blog/img/20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 0, 0, 0, '2024-11-11 19:45:45');

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

INSERT INTO `book` (`boid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `name`, `price`, `pd`, `book`, `writer`, `company`) VALUES
(1, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '홍길동', 15000, '2024-11-17 10:08:39', 'html 도장 깨기', '홍길동', '길동사');

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
(1, 'A0001', '', '웹 개발', 1),
(2, 'B0001', 'A0001', '프론트엔드', 2),
(3, 'C0001', 'B0001', 'HTML/CSS', 3),
(4, 'A0002', NULL, '클라우드 / DB', 1),
(5, 'A0003', NULL, '보안 / 네트워크', 1),
(6, 'B0002', 'A0001', '백엔드', 2),
(7, 'C0002', 'B0001', 'Javascript', 3),
(8, 'C0003', 'B0001', 'J-Query', 3);

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
-- 테이블 구조 `company_info`
--

CREATE TABLE `company_info` (
  `comid` int(11) NOT NULL COMMENT '상점정보 고유번호(자동)',
  `company` varchar(250) NOT NULL COMMENT '회사명',
  `ceo_name` varchar(100) NOT NULL COMMENT '대표자이름',
  `address_one` varchar(250) NOT NULL COMMENT '기본주소',
  `address_two` varchar(250) NOT NULL COMMENT '상세주소',
  `bussiness_registration_num` varchar(50) NOT NULL COMMENT '사업자등록번호',
  `commerce_registration_num` varchar(50) NOT NULL COMMENT '통신판매업신고 번호',
  `cs_number` varchar(20) NOT NULL COMMENT '고객센터 전화번호',
  `email` varchar(100) NOT NULL COMMENT '이메일',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '상점개설일',
  `tax_manager_department` varchar(20) DEFAULT NULL COMMENT '세무 담당자 부서',
  `tax_manager_name` varchar(20) NOT NULL COMMENT '세무 담당자',
  `tax_bill_email` varchar(20) NOT NULL COMMENT '세금계산서 발급 이메일',
  `tax_manager_phone` varchar(20) NOT NULL COMMENT '세무 담당자 전화번호',
  `privacy_manager_department` varchar(20) DEFAULT NULL COMMENT '개인정보\r\n  담당자 부서',
  `privacy_manager_name` varchar(20) NOT NULL COMMENT '개인정보  담당자 ',
  `privacy_manager_email` varchar(20) NOT NULL COMMENT '개인정보\r\n  담당자 이메일',
  `privacy_manager_phone` varchar(20) DEFAULT NULL COMMENT '개인정보\r\n  담당자 전화번호'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='상점 정보';

--
-- 테이블의 덤프 데이터 `company_info`
--

INSERT INTO `company_info` (`comid`, `company`, `ceo_name`, `address_one`, `address_two`, `bussiness_registration_num`, `commerce_registration_num`, `cs_number`, `email`, `created_at`, `tax_manager_department`, `tax_manager_name`, `tax_bill_email`, `tax_manager_phone`, `privacy_manager_department`, `privacy_manager_name`, `privacy_manager_email`, `privacy_manager_phone`) VALUES
(1, '주식회사 디제이컴퍼니', '김동주', '03192 서울 종로구 수표로 96 드림팰리스', '드림팰리스2층 종로캠퍼스', '192-01-23456', '2024-서울종로-1234', '1544-1234', 'djcompany@djcompany.com', '2024-11-11 19:08:38', '회계과', '홍길동 주임', 'gildong1234@djcompan', '010-1234-6589', '총무과', '이도령 대리', 'djcompany@djcompany.', '010-4567-8900');

-- --------------------------------------------------------

--
-- 테이블 구조 `counsel`
--

CREATE TABLE `counsel` (
  `post_id` int(11) NOT NULL COMMENT '게시물id',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `status` tinyint(4) NOT NULL COMMENT '상태(미해결,해결)',
  `titles` varchar(250) NOT NULL COMMENT '글제목',
  `contents` text NOT NULL COMMENT '글내용',
  `likes` int(11) NOT NULL COMMENT '좋아요',
  `comments` int(11) NOT NULL COMMENT '댓글수',
  `hits` int(11) NOT NULL COMMENT '조회수',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='고민상담';

--
-- 테이블의 덤프 데이터 `counsel`
--

INSERT INTO `counsel` (`post_id`, `uid`, `status`, `titles`, `contents`, `likes`, `comments`, `hits`, `regdate`) VALUES
(1, 3, 1, '실무에 바로 적용해야 하는데 NODEjs 기초 수업 추천해주세요', '지금 프론트엔드 현직자입니다.\r\nAngular는 잘 모르는데 이번에 클라이언트가 Angular로 진행을 원해서 급하게 준비해야하게 되었습니다.\r\n기간이 너무 촉박하기도 하고 강의 들으면서 바로 쓸 수 있는 레시피 강좌 있을까요?\r\n추천 부탁드립니다!', 0, 0, 0, '2024-11-11 19:13:59'),
(2, 3, 1, '선생님은 학습을 어떻게 하시나요??', '도커를 몰라서 강의를 들으면 빠른데 선생님은 aws에서 객체 라이터를 선택을 해야되는 둥 이런 부가적인 옵션 또는 지식들을 어떻게 습득하신걸까요 궁금합니다', 0, 0, 0, '2024-11-18 05:54:45'),
(3, 3, 0, '랜덤포레스트 결과가 다르게 나와요', '랜덤포레스트 결과가 다르게 나와요', 0, 0, 0, '2024-11-18 05:55:45'),
(4, 3, 0, '메모리 누수에 대해서 질문드립니다.', '강의에서 SkillSystem의 Unregister함수를 보면\r\n\r\nDestroy(skill);을 통해 Skill 객체를 지우는데\r\n이때 메모리 누수가 발생하지 않는지 궁금합니다.\r\n예를 들어 Skill은 SetUpStateMachine() 메소드에서\r\nStateMachine.onStateChanged 이벤트에 익명메소드로 구독을 하는데\r\n\r\nStateMachine.onStateChanged += (_, newState, prevState, layer)\r\n\r\n=> onStateChanged?.Invoke(this, newState, prevState, layer);\r\n\r\n \r\n\r\n구독을 해제하는 부분은 따로 찾지 못해서\r\n이런 경우 메모리 누수가 없이 이벤트도 Skill 객체와 함께 정상적으로 삭제가 되는지 궁금합니다.\r\n아직 메모리 관리에 대한 지식이 부족해 이러한 경우 메모리 누수가 발생하는지 아닌지를 어떻게 찾아봐야 할지 모르겠어서 강사님에게 질문드립니다.', 0, 0, 0, '2024-11-18 05:57:32'),
(5, 3, 0, '어떤식으로 정리하면 좋을까요??', '안녕하세요 강사님 강의 정말 잘 듣고 있습니다.\r\n\r\n강의 내용을 제 블로그에 따로 정리를 해보는 식으로\r\n\r\n정리를 하고 싶은데 어떤식으로 해야할지 감이 안 잡힙니다. 프로그래밍 공부하면서 개념을 정리하는 방법 같은거 혹시 있을까요? 어떤식으로 정리하면 좋을까요?\r\n\r\n \r\n\r\n감사합니다!', 0, 0, 0, '2024-11-18 05:58:01');

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
-- 테이블 구조 `faq`
--

CREATE TABLE `faq` (
  `fqid` int(11) NOT NULL COMMENT 'FAQ고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `category` int(11) NOT NULL COMMENT '주제분류',
  `target` enum('일반회원','강사') NOT NULL COMMENT '대상',
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
(1, 1, 2, '', '강의 수강은 어떻게 하나요?', '강의 수강은 어떻게 하나요?', 0, '2024-11-16 17:24:50', 'off'),
(2, 1, 4, '', '탈퇴는 어떻게 하나요?', '탈퇴는 어떻게 하나요?', 0, '2024-11-16 18:30:18', 'off'),
(3, 1, 1, '', '환불은 어떻게 진행이 되나요?', '환불은 어떻게 진행이 되나요?', 0, '2024-11-17 02:47:25', 'off');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecdraft`
--

CREATE TABLE `lecdraft` (
  `draft_id` int(11) NOT NULL COMMENT '번호',
  `leid` int(11) NOT NULL COMMENT '강좌id',
  `lecid` int(11) NOT NULL COMMENT '강사 고유id',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `image` varchar(250) NOT NULL COMMENT '이미지',
  `title` varchar(100) NOT NULL COMMENT '강좌명',
  `des` text NOT NULL COMMENT '강좌 소개',
  `name` varchar(50) NOT NULL COMMENT '등록자',
  `video_url` varchar(250) NOT NULL COMMENT '강의',
  `file` varchar(100) DEFAULT NULL COMMENT '실습 파일',
  `period` int(11) NOT NULL COMMENT '학습 기간',
  `isrecipe` varchar(10) NOT NULL COMMENT '레시피',
  `isgeneral` varchar(10) NOT NULL COMMENT '일반',
  `isbest` varchar(10) NOT NULL COMMENT '베스트',
  `isrecom` varchar(10) NOT NULL COMMENT '추천',
  `state` tinyint(4) NOT NULL COMMENT '상태',
  `approval` tinyint(4) NOT NULL COMMENT '승인',
  `price` decimal(10,0) NOT NULL COMMENT '가격',
  `level` int(11) NOT NULL COMMENT '레벨',
  `created_at` datetime NOT NULL COMMENT '임시 저장된 날짜 및 시간',
  `isfinal` tinyint(4) NOT NULL COMMENT '최종 저장 여부'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture`
--

CREATE TABLE `lecture` (
  `leid` int(11) NOT NULL COMMENT '번호',
  `lecid` int(11) NOT NULL COMMENT '강사고유id',
  `cate1` varchar(50) NOT NULL COMMENT '대분류',
  `cate2` varchar(50) NOT NULL COMMENT '중분류',
  `cate3` varchar(50) NOT NULL COMMENT '소분류',
  `image` varchar(250) NOT NULL COMMENT '이미지',
  `title` varchar(100) NOT NULL COMMENT '강좌명',
  `des` text NOT NULL COMMENT '강좌 소개',
  `name` varchar(50) NOT NULL COMMENT '등록자',
  `video_url` varchar(250) NOT NULL COMMENT '강의',
  `file` varchar(100) DEFAULT NULL COMMENT '실습 파일',
  `period` int(11) NOT NULL COMMENT '학습 기간',
  `isrecipe` varchar(10) NOT NULL COMMENT '레시피',
  `isgeneral` varchar(10) NOT NULL COMMENT '일반',
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

INSERT INTO `lecture` (`leid`, `lecid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `des`, `name`, `video_url`, `file`, `period`, `isrecipe`, `isgeneral`, `isbest`, `isrecom`, `state`, `approval`, `price`, `level`, `date`) VALUES
(1, 0, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '초보자를 위한 쉽고 재미있는 HTML, CSS 기초입니다. 천천히 보면서 이해하면서 따라해 보세요!', '홍길동', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', '', 1, 1, 15000, 50, '2024-11-18 14:40:26'),
(2, 2, 'A0001', 'B0001', 'C0001', '', '2기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2초보자를 위한 쉽고 재미있는 HTML, CSS 기초입니다. 천천히 보면서 이해하면서 따라해 보세요!', '이븐선생', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, '', '', '', '', 1, 1, 35000, 50, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_sales`
--

CREATE TABLE `lecture_sales` (
  `leid` int(11) NOT NULL COMMENT '강좌고유번호',
  `lec_title` varchar(100) NOT NULL COMMENT '강좌제목',
  `th_name` varchar(50) NOT NULL COMMENT '강사명',
  `order_count` int(11) NOT NULL DEFAULT 0 COMMENT '강좌주문건수',
  `total_order_amount` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT '강좌총주문금액(쿠폰전)',
  `total_discount_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌총할인금액',
  `net_order_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌실결제금액(쿠폰후)',
  `total_refund_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌환불금액',
  `final_sales_amount` decimal(16,2) NOT NULL DEFAULT 0.00 COMMENT '강좌최종매출액(환불후)',
  `lec_type` tinyint(4) NOT NULL COMMENT '강좌유형(일반=1)',
  `lec_cate` tinyint(4) NOT NULL COMMENT '강좌분류(웹개발=1)',
  `sale_date` date NOT NULL COMMENT '판매날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강좌별매출통계';

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

-- --------------------------------------------------------

--
-- 테이블 구조 `levideo`
--

CREATE TABLE `levideo` (
  `vdid` int(11) NOT NULL COMMENT '동영상 ID',
  `lecpid` int(11) NOT NULL COMMENT '강좌 ID (외래키)',
  `lepid` int(11) NOT NULL COMMENT '강사 고유 ID (외래키)',
  `video_url` varchar(255) NOT NULL COMMENT '동영상 URL',
  `uploaded` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '등록 시간',
  `orders` int(11) NOT NULL COMMENT '강의 순서'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강의';

--
-- 테이블의 덤프 데이터 `levideo`
--

INSERT INTO `levideo` (`vdid`, `lecpid`, `lepid`, `video_url`, `uploaded`, `orders`) VALUES
(1, 1, 0, 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', '2024-11-18 05:45:33', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `manual`
--

CREATE TABLE `manual` (
  `mnid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `writer` varchar(50) DEFAULT NULL,
  `write_date` date DEFAULT NULL,
  `type` enum('관리자','강사','학생') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `manual`
--

INSERT INTO `manual` (`mnid`, `title`, `writer`, `write_date`, `type`) VALUES
(1, '대쉬보드 매뉴얼', '코드이븐', '2024-11-07', '관리자'),
(20, '대쉬보드 매뉴얼', '코드이븐', '2024-11-07', '강사');

-- --------------------------------------------------------

--
-- 테이블 구조 `manual_contents`
--

CREATE TABLE `manual_contents` (
  `mcid` int(11) NOT NULL,
  `mnnid` int(11) DEFAULT NULL,
  `conid` int(11) DEFAULT NULL,
  `type` enum('txt','img') DEFAULT NULL,
  `text` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `manual_contents`
--

INSERT INTO `manual_contents` (`mcid`, `mnnid`, `conid`, `type`, `text`, `image`) VALUES
(1, 1, 1, 'txt', '1번 대쉬보드좌측메뉴에서 모든걸 보실 수 있습니다.', NULL),
(2, 1, 2, 'img', NULL, 'image_path_1.jpg'),
(3, 20, 1, 'txt', '1번 대쉬보드좌측메뉴에서 모든걸 보실 수 있습니다.', NULL),
(4, 20, 2, 'img', NULL, 'image_path_2.jpg');

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
-- 테이블 구조 `orders`
--

CREATE TABLE `orders` (
  `odid` int(11) NOT NULL COMMENT '주문고유번호',
  `uid` int(11) DEFAULT NULL COMMENT '회원고유번호',
  `total_amount` decimal(10,2) NOT NULL COMMENT '전체결제금액(쿠폰적용 전)',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '할인 금액',
  `final_amount` decimal(10,2) NOT NULL COMMENT '할인 적용 후 결제 금액',
  `order_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '주문일자',
  `pay_method` tinyint(4) NOT NULL COMMENT '결제수단',
  `pay_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문상태 (0=정상)',
  `receiver` varchar(50) DEFAULT NULL COMMENT '수령인',
  `zipcode` int(6) DEFAULT NULL COMMENT '우편번호',
  `addr_line1` varchar(100) DEFAULT NULL COMMENT '수령주소',
  `addr_line2` varchar(100) DEFAULT NULL COMMENT '상세주소',
  `receiver_phone` varchar(11) DEFAULT NULL COMMENT '수령인전화번호',
  `request` varchar(100) DEFAULT NULL COMMENT '요청사항'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='주문';

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
  `price` decimal(10,2) NOT NULL COMMENT '강좌or교재 가격',
  `cnt` int(11) NOT NULL DEFAULT 1 COMMENT '수량',
  `pay_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '주문상태(0정상)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='주문 상세 항목';

-- --------------------------------------------------------

--
-- 테이블 구조 `post_comment`
--

CREATE TABLE `post_comment` (
  `commid` int(11) NOT NULL COMMENT '댓글id',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `board_type` enum('C','B','T') NOT NULL COMMENT '게시판종류',
  `post_id` int(11) NOT NULL COMMENT '게시물id',
  `contents` text NOT NULL COMMENT '댓글내용',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '댓글작성시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='댓글';

--
-- 테이블의 덤프 데이터 `post_comment`
--

INSERT INTO `post_comment` (`commid`, `uid`, `board_type`, `post_id`, `contents`, `regdate`) VALUES
(1, 3, 'C', 1, '프론트엔드는 김동주 선생님이죠! 쉽게 바로 예제로 설명해주셔서 저도 많이 도움받았어요 추천요!', '2024-11-11 19:16:38'),
(2, 3, 'B', 1, '앗싸 세일~', '2024-11-11 19:18:06');

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
  `explan` text NOT NULL COMMENT '해설',
  `pnlevel` tinyint(4) NOT NULL COMMENT '문제 수준'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='퀴즈';

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
(1, 2, 1, 'teacher1', '이코딩', '0', 'teacher1111@gmail.com', '1', '', '/CODE_EVEN/admin/upload/tc_thumb/20241117230347634682.jpg', '안녕하세요, 코딩짱 이코딩 강사입니다.', '신한', '2147483647', 0, 0, 0),
(2, 3, 1, 'ezweb', '김동주', '0', 'abc@abc.com', '1', '', '/CODE_EVEN/admin/upload/tc_thumb/20241117230149196326.jpg', '안녕하세요, 김동주 강사입니다.', '신한', '2147483647', 1, 0, 1),
(3, 4, 1, 'tc1', '홍이름', '010-5645-6283', 'abc@abc.com', '1', '', '/CODE_EVEN/admin/upload/tc_thumb/20241117225035107300.jpg', '안녕하세요. 졸림핑이네요.', '', '110222333333', 1, 1, 1);

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

-- --------------------------------------------------------

--
-- 테이블 구조 `teamproject`
--

CREATE TABLE `teamproject` (
  `post_id` int(11) NOT NULL COMMENT '게시물id(자동)',
  `uid` int(11) NOT NULL COMMENT '회원고유번호(user)',
  `status` enum('모집중','모집완료') NOT NULL COMMENT '상태(모집중,모집완료)',
  `titles` varchar(250) NOT NULL COMMENT '글제목',
  `start_date` date NOT NULL COMMENT '시작예정일',
  `mode` enum('온라인','온/오프라인','오프라인') NOT NULL COMMENT '진행방식(온라인,온/오프라인,오프라인)',
  `dev_env` varchar(100) NOT NULL COMMENT '개발환경',
  `durations` enum('단기(1~2개월)','중기(3~6개월)','장기(6개월이상)') NOT NULL COMMENT '예상기간(단기,중기,장기)',
  `contact_url` varchar(250) NOT NULL COMMENT '지원방법',
  `roles` tinyint(4) NOT NULL COMMENT '모집\r\n  분야(기획자,웹디자이너등)',
  `contents` text NOT NULL COMMENT '글\r\n  내용',
  `likes` int(11) NOT NULL COMMENT '좋아요',
  `comments` int(11) NOT NULL COMMENT '댓글수',
  `hits` int(11) NOT NULL COMMENT '조회수',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='팀 프로젝트';

--
-- 테이블의 덤프 데이터 `teamproject`
--

INSERT INTO `teamproject` (`post_id`, `uid`, `status`, `titles`, `start_date`, `mode`, `dev_env`, `durations`, `contact_url`, `roles`, `contents`, `likes`, `comments`, `hits`, `regdate`) VALUES
(1, 3, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', '피그마, 리액트 혹은 뷰, AWS, Docker, Nestjs, 노션, 디스코드', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 0, 0, 0, '2024-11-11 19:33:41');

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
  `explan` text NOT NULL COMMENT '해설',
  `pnlevel` tinyint(4) NOT NULL COMMENT '문제 수준'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='시험';

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
-- 테이블의 인덱스 `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`post_id`);

--
-- 테이블의 인덱스 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`boid`);

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
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cgid`);

--
-- 테이블의 인덱스 `class_data`
--
ALTER TABLE `class_data`
  ADD PRIMARY KEY (`cdid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `leid` (`leid`),
  ADD KEY `exid` (`exid`);

--
-- 테이블의 인덱스 `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`comid`);

--
-- 테이블의 인덱스 `counsel`
--
ALTER TABLE `counsel`
  ADD PRIMARY KEY (`post_id`);

--
-- 테이블의 인덱스 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`cpid`);

--
-- 테이블의 인덱스 `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`fqid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `lecdraft`
--
ALTER TABLE `lecdraft`
  ADD PRIMARY KEY (`draft_id`);

--
-- 테이블의 인덱스 `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`leid`);

--
-- 테이블의 인덱스 `lecture_sales`
--
ALTER TABLE `lecture_sales`
  ADD PRIMARY KEY (`leid`,`sale_date`) USING BTREE;

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
-- 테이블의 인덱스 `manual`
--
ALTER TABLE `manual`
  ADD PRIMARY KEY (`mnid`);

--
-- 테이블의 인덱스 `manual_contents`
--
ALTER TABLE `manual_contents`
  ADD PRIMARY KEY (`mcid`);

--
-- 테이블의 인덱스 `monthly_sales`
--
ALTER TABLE `monthly_sales`
  ADD PRIMARY KEY (`data_year_month`);

--
-- 테이블의 인덱스 `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`ntid`),
  ADD KEY `uid` (`uid`);

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
  ADD UNIQUE KEY `oddt_odid_IDX` (`odid`);

--
-- 테이블의 인덱스 `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`commid`);

--
-- 테이블의 인덱스 `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`exid`);

--
-- 테이블의 인덱스 `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`reid`),
  ADD KEY `oddtid` (`oddtid`);

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
-- 테이블의 인덱스 `stuscores`
--
ALTER TABLE `stuscores`
  ADD PRIMARY KEY (`exid`);

--
-- 테이블의 인덱스 `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tcid`),
  ADD KEY `fk_1_userid` (`uid`),
  ADD KEY `fk_2_cateid` (`cgid`);

--
-- 테이블의 인덱스 `teacher_qna`
--
ALTER TABLE `teacher_qna`
  ADD PRIMARY KEY (`asid`),
  ADD UNIQUE KEY `sqid` (`sqid`),
  ADD KEY `tcid` (`tcid`);

--
-- 테이블의 인덱스 `teamproject`
--
ALTER TABLE `teamproject`
  ADD PRIMARY KEY (`post_id`);

--
-- 테이블의 인덱스 `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`exid`);

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
-- 테이블의 AUTO_INCREMENT `admin_answer`
--
ALTER TABLE `admin_answer`
  MODIFY `aaid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유번호', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `admin_question`
--
ALTER TABLE `admin_question`
  MODIFY `aqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT COMMENT '장바구니고유번호';

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `class_data`
--
ALTER TABLE `class_data`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID';

--
-- 테이블의 AUTO_INCREMENT `company_info`
--
ALTER TABLE `company_info`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT COMMENT '상점정보 고유번호(자동)', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `counsel`
--
ALTER TABLE `counsel`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호', AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `lecdraft`
--
ALTER TABLE `lecdraft`
  MODIFY `draft_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

--
-- 테이블의 AUTO_INCREMENT `lecture`
--
ALTER TABLE `lecture`
  MODIFY `leid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `lefile`
--
ALTER TABLE `lefile`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT COMMENT '파일 ID';

--
-- 테이블의 AUTO_INCREMENT `levideo`
--
ALTER TABLE `levideo`
  MODIFY `vdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '동영상 ID', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `manual`
--
ALTER TABLE `manual`
  MODIFY `mnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `manual_contents`
--
ALTER TABLE `manual_contents`
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `notice`
--
ALTER TABLE `notice`
  MODIFY `ntid` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항고유번호', AUTO_INCREMENT=61;

--
-- 테이블의 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `odid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문고유번호';

--
-- 테이블의 AUTO_INCREMENT `order_delivery`
--
ALTER TABLE `order_delivery`
  MODIFY `oddvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '배송고유번호';

--
-- 테이블의 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `oddtid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문상세고유번호';

--
-- 테이블의 AUTO_INCREMENT `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `commid` int(11) NOT NULL AUTO_INCREMENT COMMENT '댓글id', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

--
-- 테이블의 AUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT COMMENT '환불고유번호';

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
-- 테이블의 AUTO_INCREMENT `stuscores`
--
ALTER TABLE `stuscores`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

--
-- 테이블의 AUTO_INCREMENT `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '강사고유번호', AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `teacher_qna`
--
ALTER TABLE `teacher_qna`
  MODIFY `asid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유ID';

--
-- 테이블의 AUTO_INCREMENT `teamproject`
--
ALTER TABLE `teamproject`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id(자동)', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

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
