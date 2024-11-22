-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-21 08:40
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
  `status` enum('waiting','done') NOT NULL DEFAULT 'done' COMMENT '상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='1:1 문의 (관리자답변)';

--
-- 테이블의 덤프 데이터 `admin_answer`
--

INSERT INTO `admin_answer` (`aaid`, `aqid`, `acontent`, `status`) VALUES
(1, 1, '강의 결제 실패 메시지가 뜨는 경우, 결제 시스템 오류나 카드 승인 문제일 수 있습니다. 고객센터로 문의하여 결제 상태를 확인하시고, 필요시 재시도 또는 다른 결제 방법을 사용해보세요.', 'done'),
(2, 2, '영상 재생 문제는 브라우저 캐시 문제나 인터넷 속도와 관련이 있을 수 있습니다. 브라우저를 새로 고침하고, 다른 브라우저나 기기에서 시도해 보세요. 문제가 지속되면 고객센터로 문의해주세요.', 'done'),
(3, 3, '쿠폰이 적용되지 않는 경우, 쿠폰 유효 기간을 확인해 보세요. 또한, 결제 시 쿠폰 코드를 정확히 입력했는지 확인하고, 조건에 맞는 강의를 선택해야 적용됩니다.', 'done'),
(4, 4, '회원 탈퇴는 계정 설정 메뉴에서 가능하지만, 탈퇴 전에 모든 데이터를 백업해 두는 것을 권장합니다. 탈퇴 후 복구가 불가능하므로 신중하게 결정해 주세요.', 'done'),
(5, 5, '학생과의 소통 방법은 Q&A 외에도 강의별 댓글, 이메일 등을 통해 이루어집니다. 강의 진행 중 실시간 질문이 필요한 경우, 실시간 채팅 기능을 활용할 수 있습니다.', 'done'),
(6, 6, '수강이수증은 강의를 모두 수료한 후에 수료증 발급 버튼이 활성화됩니다. 만약 수료증 발급에 문제가 있다면 고객센터로 문의해주세요.', 'done'),
(7, 7, '정산 지연은 시스템 처리나 결제 확인 문제일 수 있습니다. 정산 일정에 대한 확인은 강사 대시보드에서 할 수 있으며, 정확한 정산 내역은 매월 업데이트됩니다.', 'done'),
(8, 8, '강사의 이력 정보는 강사 페이지에서 확인할 수 있습니다. 이력 정보가 업데이트되지 않은 경우, 계정 설정에서 프로필을 수정하여 반영되도록 하세요.', 'done'),
(9, 9, '강의 개설 절차는 강의 신청서를 제출하고, 강의 내용 및 계획서를 검토 후 승인됩니다. 필요한 서류를 준비하여 신청서를 제출해 주세요.', 'done'),
(10, 10, '', 'done');

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
  `regdate` date NOT NULL DEFAULT current_timestamp() COMMENT '등록일',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='1:1 문의 (사용자질문)';

--
-- 테이블의 덤프 데이터 `admin_question`
--

INSERT INTO `admin_question` (`aqid`, `uid`, `category`, `qtitle`, `qcontent`, `regdate`, `file`) VALUES
(1, 2, 1, '강의 결제 관련 문의', '강의 결제 시 결제 실패 메시지가 뜨는데 어떻게 해결하나요?', '2024-11-18', NULL),
(2, 3, 2, '강의 수강 관련 문의', '강의를 수강 중에 영상이 제대로 재생되지 않아요. 해결 방법이 있을까요?', '2024-11-18', NULL),
(3, 2, 3, '쿠폰 발급 관련 문의', '강의 쿠폰을 발급받았는데 적용이 되지 않아요. 어떻게 해야 하나요?', '2024-11-18', NULL),
(4, 3, 4, '회원 탈퇴 문의', '회원 탈퇴를 하려고 하는데 절차가 잘 안 나옵니다. 어떻게 해야 하나요?', '2024-11-18', NULL),
(5, 2, 5, '강의 소통 방법 문의', '학생과의 소통에 대해 Q&A 외에 다른 방법은 없나요?', '2024-11-18', NULL),
(6, 3, 6, '수강이수증 발급 문의', '수강이수증을 발급받으려면 어떻게 해야 하나요? 강의를 완료했는데 아직 수강이수증이 안 나왔어요.', '2024-11-18', NULL),
(7, 2, 7, '정산 관련 문의', '강의 수익 정산이 지연되고 있는데 확인 부탁드립니다.', '2024-11-18', NULL),
(8, 3, 8, '강사 이력 확인 문의', '강사의 이력 정보가 업데이트되지 않은 것 같습니다. 어떻게 해야 하나요?', '2024-11-18', NULL),
(9, 2, 2, '강의 개설 관련 문의', '새로운 강의를 개설하려고 하는데, 등록 절차에 대해 안내받고 싶습니다.', '2024-11-18', NULL),
(10, 3, 1, '결제 환불 관련 문의', '강의를 구매했는데, 환불이 불가능한 경우는 무엇인가요?', '2024-11-18', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `blog`
--

CREATE TABLE `blog` (
  `post_id` int(11) NOT NULL COMMENT '게시물id',
  `uid` int(11) NOT NULL COMMENT '회원고유번호',
  `titles` varchar(250) NOT NULL COMMENT '글제목',
  `thumbnails` varchar(250) NOT NULL COMMENT '썸네일',
  `contents` text NOT NULL COMMENT '글내용',
  `likes` int(11) NOT NULL COMMENT '좋아요',
  `comments` int(11) NOT NULL COMMENT '댓글수',
  `hits` int(11) NOT NULL COMMENT '조회수',
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='블로그';

--
-- 테이블의 덤프 데이터 `blog`
--

INSERT INTO `blog` (`post_id`, `uid`, `titles`, `thumbnails`, `contents`, `likes`, `comments`, `hits`, `regdate`) VALUES
(1, 3, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/code_even/admin/upload/blog/co_20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 13, 2, 312, '2024-10-11 02:58:40'),
(2, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-10-14 02:58:59'),
(3, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 03:29:22'),
(4, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-19 03:29:36'),
(5, 1, '코드이븐 쿠폰 기능 오픈!', '/code_even/admin/upload/blog/co_20241112grandopen.png\r\n', '코드이븐 쿠폰 기능이 오픈 되었습니다!\r\n회원 가입시 모든 회원에게 적용되는 쿠폰을 받으실 수 있습니다.', 20, 0, 530, '2024-11-01 02:58:59'),
(6, 1, '코드이븐 쿠폰 기능 오픈!', '/code_even/admin/upload/blog/co_20241112grandopen.png\r\n', '코드이븐 쿠폰 기능이 오픈 되었습니다!\r\n회원 가입시 모든 회원에게 적용되는 쿠폰을 받으실 수 있습니다.', 20, 0, 530, '2024-11-01 02:58:59'),
(7, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-19 03:29:36'),
(8, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 03:29:22'),
(9, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-10-14 02:58:59'),
(10, 3, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/code_even/admin/upload/blog/co_20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 13, 2, 312, '2024-10-11 02:58:40'),
(11, 1, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/code_even/admin/upload/blog/co_20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 13, 2, 312, '2024-11-19 06:26:42'),
(12, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-11-19 10:26:42'),
(13, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 20:26:42'),
(14, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-20 02:26:42'),
(15, 1, '코드이븐 쿠폰 기능 오픈!', '/code_even/admin/upload/blog/co_20241112grandopen.png\r\n', '코드이븐 쿠폰 기능이 오픈 되었습니다!\r\n회원 가입시 모든 회원에게 적용되는 쿠폰을 받으실 수 있습니다.', 20, 0, 530, '2024-11-21 06:28:51');

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
(1, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '홍길동', 15000, '2024-11-17 10:08:39', 'html 도장 깨기', '홍길동', '길동사'),
(2, 'A0001', 'B0002', 'C0008', '', '실무자 JAVA 코스', '홍이븐', 20000, '2024-11-20 08:32:56', 'JAVA 마스터하기', '김길동', '길벗');

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

--
-- 테이블의 덤프 데이터 `class_data`
--

INSERT INTO `class_data` (`cdid`, `uid`, `leid`, `exid`, `course_cert`, `progress_rate`) VALUES
(1, 3, 1, NULL, '', 0),
(2, 42, 2, NULL, '', 0),
(3, 53, 1, NULL, '', 0),
(4, 61, 2, NULL, '', 0),
(5, 12, 2, NULL, '', 0),
(6, 25, 1, NULL, '', 0),
(7, 67, 1, NULL, '', 0),
(8, 55, 2, NULL, '', 0),
(9, 8, 1, NULL, '', 0),
(10, 14, 1, NULL, '', 0),
(11, 28, 1, NULL, '', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `company_info`
--

CREATE TABLE `company_info` (
  `comid` int(11) NOT NULL COMMENT '상점정보 고유번호(자동)',
  `company` varchar(250) NOT NULL COMMENT '회사명',
  `ceo_name` varchar(100) NOT NULL COMMENT '대표자이름',
  `post_code` int(11) NOT NULL COMMENT '우편번호',
  `address_one` varchar(250) NOT NULL COMMENT '기본주소',
  `address_two` varchar(250) NOT NULL COMMENT '상세주소',
  `address_three` varchar(100) NOT NULL COMMENT '첨부주소',
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

INSERT INTO `company_info` (`comid`, `company`, `ceo_name`, `post_code`, `address_one`, `address_two`, `address_three`, `bussiness_registration_num`, `commerce_registration_num`, `cs_number`, `email`, `created_at`, `tax_manager_department`, `tax_manager_name`, `tax_bill_email`, `tax_manager_phone`, `privacy_manager_department`, `privacy_manager_name`, `privacy_manager_email`, `privacy_manager_phone`) VALUES
(1, '주식회사 디제이컴퍼니', '김동주', 12345, '03192 서울 종로구 수표로 96 드림팰리스', '드림팰리스2층 종로캠퍼스', '(관수동, 국일관드림펠리스)', '192-01-23456', '2024-서울종로-1234', '1544-1234', 'djcompany@djcompany.com', '2024-11-20 01:13:06', '회계과', '홍길동 주임', 'gildong1234@djcompan', '010-1234-6589', '총무과', '이도령 대리', 'djcompany@djcompany.', '010-4567-8900');

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
(1, 3, 0, '실무에 바로 적용해야 하는데 NODEjs 기초 수업 추천해주세요', '지금 프론트엔드 현직자입니다.\r\nAngular는 잘 모르는데 이번에 클라이언트가 Angular로 진행을 원해서 급하게 준비해야하게 되었습니다.\r\n기간이 너무 촉박하기도 하고 강의 들으면서 바로 쓸 수 있는 레시피 강좌 있을까요?\r\n추천 부탁드립니다!', 0, 0, 20, '2024-11-21 06:40:59'),
(2, 3, 0, 'find함수 사용해서 다수의 데이터 가져오기', 'post맨으로\r\n\r\nhttp://localhost:3000/posts\r\n\r\n조회 했더니\r\n\r\n[]로 안뜨고 \r\n\r\nasync getAllPosts() {\r\nreturn this.postsRepository.find();\r\n}\r\n로 뜹니다. 왜그러죠?', 0, 0, 135, '2024-11-21 06:40:59'),
(3, 3, 0, 'c++,c# wpf 프로젝트 어떤강의듣으면되죠?', '콘솔 앱을 만들고 싶은데\r\n제작언어를 물어보니\r\nC++, C# WPF를 사용했다고 합니다.\r\n어떤강의 듣으면되죠?', 2, 0, 240, '2024-11-21 06:40:59'),
(4, 3, 0, '선생님은 학습을 어떻게 하시나요??', '도커를 몰라서 강의를 들으면 빠른데 선생님은 aws에서 객체 라이터를 선택을 해야되는 둥 이런 부가적인 옵션 또는 지식들을 어떻게 습득하신걸까요 궁금합니다', 5, 0, 53, '2024-11-21 06:40:59'),
(5, 3, 0, '안녕하세요 혼자 열심히 공부하고 있는데 질문이 있습니다.', 'RTOS코드를 짰습니다. 문제는 UltraSoundTask에 if문을 추가하면, distance가 6혹은7로 고정이 되면서, 바로 시스템이 맛이 가게 됩니다. 이유가 뭘까요?', 1, 0, 152, '2024-11-21 06:40:59'),
(6, 3, 0, '메모리 누수에 대해서 질문드립니다.', '강의에서 SkillSystem의 Unregister함수를 보면\r\n\r\nDestroy(skill);을 통해 Skill 객체를 지우는데\r\n이때 메모리 누수가 발생하지 않는지 궁금합니다.\r\n예를 들어 Skill은 SetUpStateMachine() 메소드에서\r\nStateMachine.onStateChanged 이벤트에 익명메소드로 구독을 하는데\r\n\r\nStateMachine.onStateChanged += (_, newState, prevState, layer)\r\n\r\n=> onStateChanged?.Invoke(this, newState, prevState, layer);\r\n\r\n \r\n\r\n구독을 해제하는 부분은 따로 찾지 못해서\r\n이런 경우 메모리 누수가 없이 이벤트도 Skill 객체와 함께 정상적으로 삭제가 되는지 궁금합니다.\r\n아직 메모리 관리에 대한 지식이 부족해 이러한 경우 메모리 누수가 발생하는지 아닌지를 어떻게 찾아봐야 할지 모르겠어서 강사님에게 질문드립니다.', 1, 0, 185, '2024-11-21 06:40:59'),
(7, 3, 0, '스프링 공부 시기 + 자바', '현재 백엔드를 공부해보고 싶어 JAVA를 공부중인 1학년 학생입니다!\r\n\r\n김영한 강사님 강의 듣고 있는데 중급편 2까지 듣고 스프링 로드맵 들으면 되는 걸까요?\r\n\r\n강의 자료에 나오는 문제 말고도 클래스,상속 같은 것에 익숙해질 수 있는 문제 사이트나? 예시들이 있는 곳도 궁금합니다!!', 15, 0, 253, '2024-11-21 06:40:59'),
(8, 3, 0, '까먹더라도 이해하는 시간을 가져야 할까요 ?', '강의를 봐도 심도 있게 이해하려고 하면 진도가 안 나가고 시간이 너무 걸려요 그렇게 해도 까먹고요 ㅠㅠ 까먹더라도 이해하는 시간을 가져야 할까요 ?', 20, 0, 345, '2024-11-21 06:40:59'),
(9, 3, 0, '구글 코랩 대신 사용할 환경은 없을까요?', '구글 코랩등 이런 접속 제한이 있는 환경에서 공부를 하려 합니다.\r\n\r\n대체 환경없나요?', 25, 0, 327, '2024-11-21 06:40:59'),
(10, 3, 0, '강의 수강 관련', '강의를 새로 구매하기에는 비용이 부담되어 현재 수강 중인 것 기간만료 후 연장하고 싶은데, 방법이 있을까요?\r\n\r\n비용을 조금 추가하는 방법이라도 좋으니, 2주정도만 연장하고 싶습니다. 양해 부탁드립니다.', 35, 0, 332, '2024-11-21 06:40:59'),
(11, 3, 0, '일단 기초적인 것부터 시작을 하려고 하는데요', '일단 로드맵을 따라 가면서 백엔드를 공부하고자 합니다그래서 예전에는 아무것도 모르는 상태로 웹사이트에 도전했는데 이해가 잘안가서 철수를 했습니다.그러나 이번에는 차곡차곡 어떤순서로 접해야 기초를 잡고 java백엔드쪽을 배울 수 있는지 여쭙고자 합니다.기초란 어떤 순서를 통해야 프로그래밍세계에 입문할 수 있는지 정도요!', 45, 0, 453, '2024-11-21 06:40:59'),
(12, 3, 0, '질문프론트엔드 취업에 대해 질문있습니다.', '현재 프론트엔드 신입으로 취업을 위해 공부중에 있습니다. 작년에 국비학원을 수료후 인강을 보면서 공부를 하고 있는데 혼자서 간단한거라도 만들어봐야되는데 뭔가 계속 실력이 많이 부족하다라는 생각이 계속들어서 인강을 보면서 계속 공부만 하다가 일단 한번 해보자라는 생각에 api를 이용하여 간단한 지역 명소 사이트를 간단하게 만들었습니다. 한국관광공사api를 사용하여 axios로 인스턴스를 만들어서 사용했고 라우터, 그리고 클릭시 모달 상세창 등을 혼자 만들수 있는 정도가 되었는데 하지만 이걸로 취업을 할 수있는정도가 아니기때문에 제가 여쭤보고 싶은것이 이 상황에서 리액트를 더 공부를 해야되는지 아니면 타입스크립트와 next.js를 계속 이어서 공부를 하면되는지 마지막으로 그렇다면 신입으로 어느정도 알고있고 어느정도 실력이면 이력서를 내도되는지 궁금합니다.', 3, 0, 547, '2024-11-21 06:40:59');

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
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한',
  `cp_desc` varchar(100) DEFAULT NULL COMMENT '쿠폰내용'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`cpid`, `couponid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `userid`, `max_value`, `use_min_price`, `use_max_date`, `cp_desc`) VALUES
(1, 1001, '리뷰쿠폰', '/code_even/admin/upload/coupons/20241120014236135047.png', 1, 5000, 0, 1, '2024-11-18 10:09:49', 'admin', 5000, 30000, '2024-12-31 00:00:00', NULL),
(2, 1002, '10% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042304161737.png', 2, 0, 0, 1, '2024-11-18 10:09:49', 'admin', 10000, 50000, '2024-12-31 00:00:00', '수강 10% 할인 쿠폰'),
(3, 1003, '수강 환승쿠폰', '/code_even/admin/upload/coupons/20241120042250105391.png', 1, 10000, 0, 1, '2024-11-18 10:09:49', 'user123', 10000, 25000, '2025-01-31 00:00:00', '수강 환승쿠폰'),
(4, 1004, '신규 회원 15% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042237197337.png', 2, 0, 0, 2, '2024-11-18 10:09:49', 'newuser', 15000, 20000, '2024-12-31 00:00:00', '신규 회원 15% 할인 쿠폰 바로증정!');

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
(1, 1, 1, 'teacher', '학생의 환불 요청을 어떻게 처리하나요?', '학생의 환불 요청은 고객센터를 통해 접수된 후, 환불 정책에 따라 처리됩니다. 세부 절차를 확인하고 환불을 진행하세요.', 5, '2024-11-16 17:24:50', 'off'),
(2, 1, 2, 'student', '강의는 어떻게 수강하나요?', '강의를 수강하려면, 회원 가입 후 로그인하고 원하는 강의를 선택하여 수강 신청을 하시면 됩니다.', 0, '2024-11-16 17:25:50', 'off'),
(3, 1, 3, 'teacher', '학생이 사용하는 쿠폰을 어떻게 관리하나요?', '쿠폰 관리는 사이트 관리자의 권한에 따라 이루어집니다. 학생에게 제공할 쿠폰을 생성하고, 관리 시스템을 통해 발급할 수 있습니다.', 2, '2024-11-16 17:26:30', 'off'),
(4, 1, 4, 'student', '회원 탈퇴는 어떻게 하나요?', '회원 탈퇴를 원하시면, 계정 설정에서 탈퇴 버튼을 클릭하여 진행하실 수 있습니다. 탈퇴 후에는 데이터 복구가 불가능하므로 주의해 주세요.', 0, '2024-11-16 17:27:15', 'on'),
(5, 1, 5, 'teacher', '강의에 대해 학생과의 소통 방법은 어떻게 되나요?', '학생과의 소통은 주로 강의 댓글 기능, 이메일, 실시간 Q&A 등을 통해 이루어집니다. 각 강의에 맞는 소통 방법을 활용하세요.', 0, '2024-11-16 17:28:05', 'off'),
(6, 1, 6, 'student', '수강 이수증은 어떻게 발급하나요?', '강의를 모두 수료한 후, 강의 내용 확인 후 수료증을 발급 받을 수 있습니다. 수료증은 PDF 형태로 제공됩니다.', 0, '2024-11-16 17:29:00', 'on'),
(7, 1, 7, 'teacher', '강사 정산은 언제 이루어지나요?', '강사의 정산은 월별로 이루어지며, 정산 금액은 수업 완료 후 약 15일 이내에 지급됩니다. 정산 내역은 강사 페이지에서 확인할 수 있습니다.', 1, '2024-11-16 17:29:45', 'off'),
(8, 1, 8, 'student', '강사의 이력은 어떻게 확인하나요?', '강사의 이력은 강의 설명 페이지에서 확인할 수 있습니다. 강사 이름을 클릭하면, 자세한 정보를 볼 수 있습니다.', 0, '2024-11-16 17:30:30', 'off'),
(9, 1, 2, 'student', '강의 자료는 어떻게 다운로드 하나요?', '강의 자료는 강의 수업 페이지에서 다운로드 가능합니다. 각 강의 페이지에 제공된 다운로드 링크를 통해 파일을 받으실 수 있습니다.', 20, '2024-11-16 17:31:15', 'on'),
(10, 1, 1, 'teacher', '강의 수익은 어떻게 확인하나요?', '강의 수익은 강사 대시보드에서 확인할 수 있으며, 판매된 강의의 수익 내역과 정산 상태를 표시합니다.', 0, '2024-11-16 17:32:00', 'off'),
(11, 1, 1, 'student', '강의 결제는 어떻게 하나요?', '강의 결제는 사이트 내 결제 시스템을 통해 가능합니다. 결제 방법을 선택하고, 결제 정보를 입력하시면 완료됩니다.', 0, '2024-11-16 17:24:50', 'on'),
(12, 1, 2, 'teacher', '강의를 어떻게 개설하나요?', '강의를 개설하려면 강의 개설 신청서를 작성하고, 강의 내용 및 계획을 제출해야 합니다. 승인 후 강의가 등록됩니다.', 1, '2024-11-16 17:25:50', 'on'),
(13, 1, 3, 'student', '쿠폰은 어떻게 사용하나요?', '쿠폰은 결제 시, 쿠폰 코드 입력란에 코드를 입력하여 사용하실 수 있습니다. 쿠폰은 특정 조건에 따라 제공됩니다.', 0, '2024-11-16 17:26:30', 'off'),
(14, 1, 4, 'teacher', '강사 계정 탈퇴는 어떻게 하나요?', '강사 계정 탈퇴는 계정 설정에서 탈퇴 요청을 통해 진행할 수 있습니다. 탈퇴 후에는 다시 복구할 수 없으므로 신중히 결정하세요.', 0, '2024-11-16 17:27:15', 'on'),
(15, 1, 5, 'student', '사이트 이용 중 오류가 발생했어요, 어떻게 해야 하나요?', '사이트 이용 중 발생한 오류는 고객센터로 문의해 주시면, 빠르게 해결해드리겠습니다.', 8, '2024-11-16 17:28:05', 'off'),
(16, 1, 6, 'teacher', '강의 수료 조건은 무엇인가요?', '강의 수료 조건은 강의 수강과 특정 과제나 시험을 완료하는 것입니다. 수료 기준은 강의 페이지에서 확인할 수 있습니다.', 0, '2024-11-16 17:29:00', 'on'),
(17, 1, 7, 'student', '결제 금액의 세금 계산서는 언제 발급되나요?', '세금 계산서는 결제 완료 후 7일 이내에 이메일로 발급됩니다. 이메일 확인을 부탁드립니다.', 0, '2024-11-16 17:29:45', 'off'),
(18, 1, 8, 'teacher', '강사 프로필은 어떻게 수정하나요?', '강사 프로필 수정은 계정 설정에서 가능합니다. 강사 프로필 사진, 자기소개 등을 업데이트할 수 있습니다.', 0, '2024-11-16 17:30:30', 'on'),
(19, 1, 2, 'student', '학생의 질문에 어떻게 답변하나요?', '학생의 질문은 강의 내 Q&A나 댓글 시스템을 통해 답변할 수 있습니다. 학습 자료를 추가하거나 설명을 덧붙여 주세요.', 7, '2024-11-16 17:31:15', 'off'),
(20, 1, 1, 'student', '환불은 어떻게 받나요?', '강의를 구매한 후 환불을 원하시면, 고객센터를 통해 환불 절차를 진행할 수 있습니다. 환불 정책에 따라 일부 제한이 있을 수 있습니다.', 9, '2024-11-16 17:32:00', 'off'),
(21, 1, 1, 'teacher', '강의에 대한 평가 시스템은 어떻게 되나요?', '강의에 대한 평가는 수강생이 강의를 완료한 후 제공하는 평가 시스템을 통해 이루어집니다. 평가 점수는 강사의 피드백에 반영됩니다.', 0, '2024-11-16 17:33:00', 'off'),
(22, 1, 2, 'teacher', '학생의 학습 진행 상황을 어떻게 확인하나요?', '학생의 학습 진행 상황은 강의 대시보드에서 확인할 수 있습니다. 각 학생의 수료 여부와 과제 완료 상태를 추적할 수 있습니다.', 0, '2024-11-16 17:34:00', 'on'),
(23, 1, 3, 'teacher', '강의 자료의 업로드는 어떻게 하나요?', '강의 자료는 강의 관리 페이지에서 업로드할 수 있습니다. 각 강의에 맞는 자료를 선택하고, 필요한 파일 형식으로 업로드합니다.', 0, '2024-11-16 17:35:00', 'on'),
(24, 1, 4, 'teacher', '학생과의 개별 상담은 어떻게 진행하나요?', '학생과의 개별 상담은 이메일이나 실시간 Q&A 기능을 통해 진행할 수 있습니다. 필요 시 예약 시스템을 통해 상담 일정을 조율할 수 있습니다.', 1, '2024-11-16 17:36:00', 'off'),
(25, 1, 5, 'teacher', '강사 인증 절차는 무엇인가요?', '강사 인증 절차는 제출된 학력과 경력 증명서를 바탕으로 진행됩니다. 인증 절차 완료 후 강사로 등록됩니다.', 2, '2024-11-16 17:37:00', 'off'),
(26, 1, 6, 'teacher', '강의를 휴강하려면 어떻게 하나요?', '강의를 휴강하려면 강의 관리 페이지에서 휴강 신청을 하시면 됩니다. 휴강 일정을 조정할 수 있는 옵션도 제공됩니다.', 0, '2024-11-16 17:38:00', 'off'),
(27, 1, 7, 'teacher', '강의 자료의 수정은 어떻게 하나요?', '강의 자료는 강의 관리 페이지에서 수정 가능합니다. 변경된 자료는 수강생들에게 자동으로 업데이트됩니다.', 0, '2024-11-16 17:39:00', ''),
(28, 1, 8, 'teacher', '강의 평가에 대한 피드백은 어떻게 제공하나요?', '강의 평가에 대한 피드백은 평가 후 제공되는 설문지를 통해 작성할 수 있습니다. 강사와 학생 간의 건설적인 피드백을 주고받을 수 있습니다.', 0, '2024-11-16 17:40:00', 'off');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture`
--

CREATE TABLE `lecture` (
  `leid` int(11) NOT NULL COMMENT '번호',
  `cgid` int(11) DEFAULT NULL,
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
  `isrecipe` tinyint(4) NOT NULL COMMENT '레시피',
  `isgeneral` tinyint(4) NOT NULL COMMENT '일반',
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

INSERT INTO `lecture` (`leid`, `cgid`, `boid`, `lecid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `des`, `name`, `video_url`, `file`, `period`, `isrecipe`, `isgeneral`, `isbest`, `isrecom`, `state`, `approval`, `price`, `level`, `date`) VALUES
(0, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 0, '', '', 2, 0, 30000, 0, '2024-11-20 10:22:33'),
(1, NULL, 0, 0, 'A0001', 'B0001', 'C0001', '', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '초보자를 위한 쉽고 재미있는 HTML, CSS 기초입니다. 천천히 보면서 이해하면서 따라해 보세요!', '홍길동', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 1, 15000, 50, '2024-11-18 14:40:26'),
(2, NULL, 0, 2, 'A0001', 'B0001', 'C0001', '', '2기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2초보자를 위한 쉽고 재미있는 HTML, CSS 기초입니다. 천천히 보면서 이해하면서 따라해 보세요!', '이븐선생', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 1, 35000, 50, '0000-00-00 00:00:00'),
(3, NULL, 0, 0, 'A0001', 'B0001', 'C0001', '', 'HTML 정도는 껌이지', '', '', '', NULL, 0, 1, 0, '', '', 1, 0, 50000, 0, '2024-11-19 02:12:51'),
(4, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/default.png', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', '', NULL, 30, 1, 0, '', '', 0, 0, 0, 0, '2024-11-20 02:57:33'),
(5, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', '', NULL, 30, 0, 1, '', '', 1, 0, 50, 0, '2024-11-20 03:01:12'),
(6, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'default_video_url', NULL, 30, 0, 1, '', '', 1, 0, 50000, 0, '2024-11-20 04:35:15'),
(7, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'default_video_url', NULL, 30, 0, 1, '', '', 1, 0, 50000, 0, '2024-11-20 04:36:00'),
(8, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이브관리자', 'https://youtu.be/oHTt2fEkmGA?si=fNAGtOcPEzpxwXDM', NULL, 30, 0, 1, '', '', 1, 0, 50000, 0, '2024-11-20 05:10:39'),
(9, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/IMG_2450.jpeg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 1, 0, '', '', 1, 0, 50000, 0, '2024-11-20 05:35:37'),
(10, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 1, 0, '', '', 1, 0, 100000, 0, '2024-11-20 09:51:34'),
(11, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-4738796_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 1, 0, '', '', 2, 0, 100000, 0, '2024-11-20 09:57:07'),
(12, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-4738796_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 100000, 0, '2024-11-20 10:00:54'),
(13, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 100000, 0, '2024-11-20 10:01:35'),
(14, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 100000, 0, '2024-11-20 10:01:55'),
(15, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-2480777_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 50000, 0, '2024-11-20 10:10:10'),
(16, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 100000, 0, '2024-11-20 10:10:52'),
(17, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/cat-5270323_1280.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 2, 0, 100000, 0, '2024-11-20 10:14:24'),
(18, NULL, 0, 1, 'A0001', 'B0001', 'C0001', '/uploads/images/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', NULL, '이븐관리자', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 0, 1, '', '', 1, 0, 30000, 0, '2024-11-20 10:20:11');

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
(1, 1, '[공지] 서비스 점검 안내', '안녕하세요. 서비스 점검이 예정되어 있습니다. 점검 시간은 11월 18일부터 11월 19일까지입니다. 양해 부탁드립니다.', 0, '2024-11-16', 'off', NULL),
(2, 1, '[공지] 개인정보 처리방침 변경', '개인정보 처리방침이 일부 수정되었습니다. 변경된 내용은 홈페이지에서 확인할 수 있습니다.', 0, '2024-11-16', 'off', NULL),
(3, 1, '[공지] 신규 강의 추가 안내', '새로운 강의가 추가되었습니다. \"프로그래밍 입문\" 강의를 확인해보세요!', 0, '2024-11-16', 'off', NULL),
(4, 1, '[공지] 사이트 보안 업데이트', '사이트 보안 강화를 위한 업데이트가 진행됩니다. 업데이트 기간 동안 일부 기능이 제한될 수 있습니다.', 0, '2024-11-17', 'off', NULL),
(5, 1, '[공지] 서버 점검 안내', '서버 점검 작업이 예정되어 있습니다. 점검 시간은 11월 20일 오후 3시부터 5시까지입니다.', 0, '2024-11-17', 'off', NULL),
(6, 1, '[공지] 이메일 인증 시스템 변경', '이메일 인증 방식이 변경되었습니다. 새 시스템에 따라 인증을 진행해주세요.', 0, '2024-11-18', 'off', NULL),
(7, 1, '[공지] 로그인 오류 수정', '일부 사용자에서 발생한 로그인 오류가 수정되었습니다. 이제 정상적으로 로그인하실 수 있습니다.', 0, '2024-11-18', 'off', NULL),
(8, 1, '[공지] 강의 자료 다운로드 오류', '강의 자료 다운로드에 오류가 발생했습니다. 빠른 시일 내에 해결할 예정입니다.', 0, '2024-11-19', 'off', NULL),
(9, 1, '[공지] 모바일 앱 업데이트 안내', '모바일 앱의 새로운 버전이 출시되었습니다. 최신 버전으로 업데이트하여 더 나은 서비스를 이용해 주세요.', 0, '2024-11-19', 'off', NULL),
(10, 1, '[공지] 강의 일정 변경 안내', '일부 강의 일정이 변경되었습니다. 변경된 강의 일정을 확인해주세요.', 0, '2024-11-19', 'off', NULL),
(11, 1, '[공지] 회원가입 절차 변경', '회원가입 절차가 일부 변경되었습니다. 신규 회원은 변경된 절차에 따라 가입을 진행해주세요.', 0, '2024-11-20', 'on', NULL),
(12, 1, '[공지] 과제 제출 마감일 연장', '과제 제출 마감일이 11월 25일로 연장되었습니다. 기한 내에 제출해 주세요.', 0, '2024-11-20', 'off', NULL),
(13, 1, '[공지] 사이트 이용 약관 변경', '사이트 이용 약관이 업데이트되었습니다. 변경된 사항을 확인하시기 바랍니다.', 0, '2024-11-21', 'on', NULL),
(14, 1, '[공지] 결제 시스템 점검 안내', '결제 시스템 점검이 예정되어 있습니다. 점검 시간 동안 결제가 불가능할 수 있습니다.', 0, '2024-11-21', 'off', NULL),
(15, 1, '[공지] 신규 기능 추가 안내', '새로운 기능이 추가되었습니다. \"자동 과제 제출\" 기능을 확인해보세요.', 0, '2024-11-22', 'off', NULL),
(16, 1, '[공지] 개인정보 보호 정책 업데이트', '개인정보 보호 정책이 업데이트되었습니다. 정책 변경 사항을 확인해 주세요.', 0, '2024-11-22', 'on', NULL),
(17, 1, '[공지] 로그인 인증 강화', '로그인 인증 절차가 강화되었습니다. 이제 2단계 인증을 사용하여 보안을 강화해주세요.', 0, '2024-11-23', 'off', NULL),
(18, 1, '[공지] 강의 리뷰 기능 추가', '강의 리뷰 기능이 추가되었습니다. 강의를 수강한 후 리뷰를 남겨주세요!', 0, '2024-11-23', 'off', NULL),
(19, 1, '[공지] 사이트 장애 발생 안내', '사이트에서 장애가 발생하여 일부 기능이 불안정합니다. 빠르게 복구 중이니 양해 부탁드립니다.', 0, '2024-11-24', 'on', NULL),
(20, 1, '[공지] 설문 조사 참여 요청', '회원님들의 의견을 듣기 위해 설문 조사를 진행합니다. 참여 부탁드립니다!', 0, '2024-11-24', 'off', NULL);

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
(1, 3, 100000.00, 10000.00, 90000.00, '', '2023-01-24 14:48:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 35, 150000.00, 10000.00, 140000.00, '', '2023-01-15 10:45:23', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 42, 120000.00, 20000.00, 100000.00, '', '2023-02-20 14:32:11', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 27, 130000.00, 15000.00, 115000.00, '', '2023-03-12 08:20:05', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 53, 170000.00, 20000.00, 150000.00, '', '2023-04-08 16:05:45', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 18, 90000.00, 10000.00, 80000.00, '', '2023-05-30 11:15:33', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 61, 200000.00, 25000.00, 175000.00, '', '2023-06-15 13:50:12', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 39, 110000.00, 10000.00, 100000.00, '', '2023-07-22 17:00:00', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 12, 140000.00, 5000.00, 135000.00, '', '2023-08-09 15:25:27', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 25, 175000.00, 15000.00, 160000.00, '', '2023-09-11 09:35:12', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 44, 210000.00, 30000.00, 180000.00, '', '2023-10-05 14:45:18', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 67, 115000.00, 20000.00, 95000.00, '', '2023-11-14 13:10:45', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 30, 95000.00, 5000.00, 90000.00, '', '2023-12-01 12:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 55, 185000.00, 25000.00, 160000.00, '', '2023-01-29 16:30:12', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 8, 99000.00, 10000.00, 89000.00, '', '2023-02-14 10:15:55', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 49, 125000.00, 20000.00, 105000.00, '', '2023-03-21 11:45:40', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 14, 155000.00, 5000.00, 150000.00, '', '2023-04-27 08:30:22', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 66, 195000.00, 10000.00, 185000.00, '', '2023-05-13 14:00:33', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 28, 130000.00, 15000.00, 115000.00, '', '2023-06-25 17:40:45', 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 34, 160000.00, 5000.00, 155000.00, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', '2023-07-19 13:15:00', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, 1, 1, 1, '0', 15000.00, 1, 0),
(2, 2, 1, 2, '0', 15000.00, 2, 0),
(3, 3, 2, 1, '0', 35000.00, 1, 0),
(4, 4, 2, 2, '0', 20000.00, 1, 0),
(5, 5, 1, 1, '0', 15000.00, 3, 0),
(6, 6, 1, 2, '0', 15000.00, 1, 0),
(7, 7, 2, 1, '0', 35000.00, 1, 0),
(8, 8, 1, 2, '0', 15000.00, 2, 0),
(9, 9, 2, 1, '0', 35000.00, 1, 0),
(10, 10, 1, 1, '0', 15000.00, 2, 0),
(11, 11, 2, 2, '0', 20000.00, 1, 0),
(12, 12, 1, 1, '0', 15000.00, 1, 0),
(13, 13, 1, 2, '0', 15000.00, 1, 0),
(14, 14, 2, 1, '0', 35000.00, 1, 0),
(15, 15, 1, 1, '0', 15000.00, 1, 0),
(16, 16, 2, 2, '0', 20000.00, 1, 0),
(17, 17, 1, 1, '0', 15000.00, 1, 0),
(18, 18, 2, 2, '0', 20000.00, 1, 0),
(19, 19, 1, 1, '0', 15000.00, 1, 0),
(20, 20, 2, 2, '0', 20000.00, 1, 0),
(21, 20, 3, 1, 'HTML 정도는 껌이지', 50000.00, 1, 0);

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
  `rtitle` varchar(255) NOT NULL COMMENT '제목',
  `content` text NOT NULL COMMENT '내용',
  `regdate` datetime NOT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강 후기';

--
-- 테이블의 덤프 데이터 `review`
--

INSERT INTO `review` (`rvid`, `cdid`, `rating`, `rtitle`, `content`, `regdate`) VALUES
(1, 1, 5, 'HTML과 CSS 기초 수업, 정말 유익했습니다!', '처음에는 HTML과 CSS가 어려울까 걱정했지만, 수업을 듣고 나니 기초부터 차근차근 배우면서 자신감을 얻을 수 있었습니다. 특히 HTML 태그와 속성의 차이를 쉽게 이해할 수 있었고, CSS로 웹페이지를 꾸미는 재미를 느꼈습니다. 수업이 체계적으로 구성되어 있어 실습을 통해 바로 적용할 수 있었고, 기본적인 웹 디자인을 만드는 데 큰 도움이 되었습니다.', '2024-11-20 09:27:03'),
(2, 2, 5, '박스 모델을 이해하고 나니 디자인이 훨씬 쉬워졌어요', 'CSS 박스 모델에 대해 처음 배우고 나니, 웹 요소들이 어떻게 배치되는지 명확히 이해할 수 있었습니다. 패딩, 보더, 마진의 역할을 이해하고 나니, 레이아웃을 디자인할 때 각 요소가 어떤 영향을 미치는지 알게 되어 더 효과적으로 작업할 수 있었습니다. 이 수업 덕분에 HTML과 CSS에 대한 기본 지식이 쌓였어요.', '2024-11-20 09:27:35'),
(3, 3, 5, '반응형 웹 디자인 구현, 미디어 쿼리가 핵심이네요!', '모바일과 데스크탑에서 모두 잘 보이는 웹사이트를 만드는 방법에 대해 배우고, 미디어 쿼리를 적용하는 방법을 익혔습니다. 반응형 디자인은 이제 필수적인 기술인데, 이번 수업을 통해 화면 크기에 맞춰 스타일을 적용하는 방법을 배워서 실무에서 바로 사용할 수 있을 것 같습니다.', '2024-11-20 09:27:54'),
(4, 4, 4, 'HTML 폼을 만들고 스타일링하는 과정이 정말 흥미로웠어요', 'HTML 폼을 어떻게 만드는지, 그 후 CSS로 스타일을 입히는 방법을 배운 후 폼을 사용자 친화적으로 디자인할 수 있게 되었습니다. 버튼과 입력 필드에 스타일을 적용하면서 실제 웹사이트에서 사용하는 폼을 만드는 데 필요한 기술을 익혔습니다. 매우 유용한 수업이었어요!', '2024-11-20 09:28:10'),
(5, 5, 5, 'Flexbox와 Grid, 레이아웃이 훨씬 간편해졌습니다!', 'Flexbox와 Grid 시스템을 배우면서 레이아웃을 설정하는 방식이 훨씬 간편해졌습니다. 복잡한 레이아웃을 만들 때 Flexbox와 Grid를 적절하게 조합하는 방법을 배운 후, 웹 디자인 작업을 훨씬 더 쉽게 할 수 있었어요. 두 기술의 차이점도 명확하게 이해되어 실무에 바로 적용할 수 있을 것 같습니다.', '2024-11-20 09:33:03'),
(6, 6, 4, 'CSS 선택자와 스타일링 기법, 정말 실용적이에요', '다양한 CSS 선택자들을 배우면서 웹페이지의 특정 요소를 어떻게 선택하고 스타일을 적용할 수 있는지 잘 이해할 수 있었습니다. 특히 클래스 선택자와 ID 선택자의 차이를 구체적으로 배운 후, 다양한 방식으로 스타일을 적용할 수 있는 능력이 생겼어요. 이 수업 덕분에 CSS의 기초가 튼튼해졌습니다.\r\n', '2024-11-20 09:33:20'),
(7, 7, 5, 'HTML 문서 구조를 정확히 이해할 수 있었습니다', 'HTML 문서의 구조와 각 요소의 역할을 배우면서, 웹페이지를 만드는 기본적인 틀을 잘 이해하게 되었습니다. <html>, <head>, <body> 태그의 역할을 정확히 알게 되어 문서를 구성할 때 어떤 요소들이 필요한지 확실히 알 수 있었습니다. 이 수업을 통해 HTML의 기초가 매우 잘 다져졌습니다.', '2024-11-20 09:33:36'),
(8, 8, 5, '이미지와 링크 스타일링, 웹사이트가 훨씬 세련되었어요', 'HTML에서 이미지를 삽입하고, CSS로 스타일링하는 방법을 배운 후 웹사이트에 이미지를 적용하는 것이 훨씬 쉬워졌습니다. 또한 링크를 스타일링하는 다양한 방법을 익히면서 웹사이트의 전반적인 디자인이 세련되게 변했어요. 수업에서 배운 내용을 실습하면서 디자인 감각도 한층 향상된 것 같아요.', '2024-11-20 09:34:18'),
(9, 9, 4, 'CSS로 웹페이지 색상과 배경을 설정하는 게 재밌었어요', 'CSS로 색상과 배경을 설정하는 방법을 배우면서 웹페이지를 꾸미는 재미를 느꼈습니다. 다양한 색상 표현 방법(HEX, RGB 등)을 배우고, 이를 웹페이지에 적용하는 방법을 익혔습니다. 웹사이트를 만들 때 색상이 얼마나 중요한지를 새롭게 알게 되었고, 스타일링에 있어 색상의 역할을 이해하게 되었습니다.', '2024-11-20 09:34:43'),
(10, 10, 4, '기초부터 실습까지, HTML과 CSS를 완벽하게 배웠어요', 'HTML과 CSS의 기초부터 고급 내용까지 실습 위주로 배울 수 있어 정말 유익한 수업이었습니다. 수업에서 다룬 예시와 실습을 통해 기본적인 웹페이지를 만들 수 있는 능력을 얻었고, 이 수업을 통해 웹 디자인에 대한 자신감이 생겼습니다. 앞으로도 이 내용을 바탕으로 더 많은 웹페이지를 만들 수 있을 것 같아요.', '2024-11-20 09:35:00');

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

--
-- 테이블의 덤프 데이터 `send_email`
--

INSERT INTO `send_email` (`emid`, `uid`, `title`, `content`, `regdate`) VALUES
(1, 3, '코딩 수업 일정 변경 안내', '안녕하세요, 수업 일정이 변경되었습니다. 새로운 수업 일정은 2024년 11월 21일 10시입니다. 참고 부탁드립니다.', '2024-11-19 04:30:42'),
(2, 3, '수업 진도 안내', '이번 주 수업에서 다룰 내용은 \"PHP 기초\"입니다. 미리 복습하고 오시면 도움이 됩니다.', '2024-11-19 04:35:00'),
(3, 3, '과제 제출 기한 안내', '코딩 수업 과제 제출 기한이 2024년 11월 25일까지입니다. 제출을 잊지 마세요.', '2024-11-19 04:40:00'),
(4, 3, '주간 실습 시간 안내', '이번 주 실습 시간은 11월 20일 오후 2시부터 4시까지입니다. 실습실에서 만나요!', '2024-11-19 04:45:00'),
(5, 3, '코딩 실력 향상을 위한 팁', '코딩 실력을 키우려면 꾸준한 연습과 문제 해결 능력 향상이 중요합니다. 매일 1시간씩 연습해 보세요!', '2024-11-19 04:50:00'),
(6, 3, '수업 자료 다운로드 링크', '지난 수업 자료는 아래 링크에서 다운로드 가능합니다. 복습에 유용하게 활용하세요.\n[다운로드 링크]', '2024-11-19 04:55:00'),
(7, 3, '과제 피드백 안내', '이번 과제에 대한 피드백을 2024년 11월 22일에 제공할 예정입니다. 피드백을 참고하여 다음 과제를 준비하세요.', '2024-11-19 05:00:00'),
(8, 3, '프로젝트 발표 준비 안내', '수업 마지막 주에 프로젝트 발표가 있을 예정입니다. 발표 준비를 미리 해두시기 바랍니다.', '2024-11-19 05:05:00'),
(9, 3, '코딩 수업 진도표 확인', '이번 학기 코딩 수업의 전체 진도표를 확인하세요. 각 주차별 수업 내용과 과제에 대한 정보가 포함되어 있습니다.', '2024-11-19 05:10:00'),
(10, 3, '수업 참여율 체크', '수업 참여율이 낮은 학생에게는 별도로 안내를 드릴 예정입니다. 꾸준히 참여해 주세요!', '2024-11-19 05:15:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `student_qna`
--

CREATE TABLE `student_qna` (
  `sqid` int(11) NOT NULL COMMENT '질문고유번호',
  `cdid` int(11) DEFAULT NULL COMMENT '수강데이터ID',
  `qtitle` varchar(255) NOT NULL COMMENT '질문제목',
  `qcontent` text NOT NULL COMMENT '질문내용',
  `regdate` datetime NOT NULL COMMENT '등록일',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 질문';

--
-- 테이블의 덤프 데이터 `student_qna`
--

INSERT INTO `student_qna` (`sqid`, `cdid`, `qtitle`, `qcontent`, `regdate`, `file`) VALUES
(1, 3, '시맨틱 태그의 필요성과 활용 방법은?', 'HTML5에서 시맨틱 태그가 중요한 이유는 무엇인가요? <header>, <footer>, <article>와 같은 태그는 각각 어떤 용도로 사용되며, 작성 시 유의할 점은 무엇인가요?', '2024-11-20 09:21:17', NULL),
(2, 4, 'CSS와 HTML은 어떻게 연결되나요?', 'CSS는 HTML과 어떻게 통합해서 사용하는 건가요? 외부 스타일시트, 내부 스타일시트, 인라인 스타일 간의 차이를 알고 싶어요.', '2024-11-20 09:21:48', NULL),
(3, 5, 'CSS 선택자와 우선순위 이해하기', 'CSS에서 요소를 스타일링할 때 선택자를 어떻게 사용하는지 궁금합니다. 클래스, ID, 태그 선택자의 차이와 우선순위 계산 방법도 알고 싶어요.', '2024-11-20 09:22:07', NULL),
(4, 6, '박스 모델이란 무엇인가요?', 'CSS 박스 모델에 대해 설명해 주세요. 각 요소(마진, 패딩, 테두리, 콘텐츠)는 무엇이고, 레이아웃을 만들 때 어떻게 영향을 주나요?', '2024-11-20 09:22:21', NULL),
(5, 7, 'CSS를 활용한 기본 레이아웃 설계 방법', 'HTML과 CSS를 사용해서 간단한 웹 페이지 레이아웃을 만드는 방법을 알고 싶어요. 플렉스박스와 그리드의 차이점도 설명해 주세요.', '2024-11-20 09:22:45', NULL),
(6, 8, 'CSS로 글꼴과 색상을 스타일링하기', '텍스트 스타일링을 위한 CSS 속성(예: 폰트 크기, 글꼴, 색상) 사용법과 주의사항이 궁금합니다. 특히 웹 접근성을 고려할 때 어떤 점에 유의해야 하나요?', '2024-11-20 09:23:02', NULL);

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
(1, 2, 1, 'even_teacher', '이븐선생', '010-4567-8910', 'eventeacher@even.co.kr', '1', '', '', '안녕하세요 익힘의 정도가 적절한 이븐선생입니다~', '', '', 1, 1, 0),
(2, 4, 1, 'my_teacher', '김동주', '010-4567-8910', 'rocks@even.co.kr', '1', 'https://www.youtube.com/@Ezweb', '/code_even/admin/upload/teacher/20241120172340324741.jpg', '반갑습니다. 바위처럼, 이지웹입니다.', '', '', 1, 1, 0),
(3, 70, 2, 'teacher2', '조한결', '010-8723-4519', 'user70@example.com', '2', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241120175857212464.png', 'JoCODE 조한결 입니다.', '', '', 1, 0, 1),
(4, 68, 3, 'teacher3', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `teacher_qna`
--

CREATE TABLE `teacher_qna` (
  `asid` int(11) NOT NULL COMMENT '답변고유ID',
  `sqid` int(11) DEFAULT NULL COMMENT '질문고유ID',
  `content` text NOT NULL COMMENT '답변내용'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강사 답변';

--
-- 테이블의 덤프 데이터 `teacher_qna`
--

INSERT INTO `teacher_qna` (`asid`, `sqid`, `content`) VALUES
(1, 2, '외부 스타일시트 (External Style Sheet):\r\n\r\n외부 스타일시트는 별도의 .css 파일에 스타일을 작성하고, HTML 문서 내에서 해당 파일을 <link> 태그를 사용해 연결하는 방식입니다.\r\nHTML 파일에서 CSS를 독립적으로 관리할 수 있어 여러 HTML 파일에서 동일한 스타일을 재사용할 수 있습니다.'),
(4, 3, 'CSS에서 선택자는 HTML 요소를 선택하여 스타일을 적용하는 데 사용됩니다. 선택자는 다양한 형태로 존재하며, 각각의 특성에 따라 우선순위가 다르게 적용됩니다.');

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
(1, 3, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', '피그마, 리액트 혹은 뷰, AWS, Docker, Nestjs, 노션, 디스코드', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-11-21 07:06:12'),
(2, 3, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', '피그마, ios / andriod 앱 개발', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-11-21 07:09:19'),
(3, 3, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', '피그마, ios / andriod 앱 개발', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-11-21 07:06:28'),
(4, 3, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', '뷰, 타입스크립트', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-11-20 19:33:41'),
(5, 5, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', '피그마', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '[개발 프로젝트 모집 내용 예시]\r\n\r\n프로젝트 주제 : 책 평점 등록 사이트 \r\n예상 모집인원 : 1명\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, 디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!. 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n사이트 링크\r\nhttps://book-rating-123456\r\n카카오 오픈채팅방으로 연락주세요!\r\n', 10, 0, 135, '2024-11-21 06:56:39'),
(6, 7, '모집완료', '프로젝트 함께하실 (디자인/앱) 모집합니다🍀', '2024-12-09', '온라인', '피그마, HTML/CSS, Javascript, 리액트', '단기(1~2개월)', 'https://open.kakao.com/87654321', 4, '안녕하세요 😃\r\n\r\n웹/앱 크로스플랫폼 기반의 수익 창출까지 진행해볼 프로젝트 멤버를 모집합니다! 🚗\r\n\r\n수익 창출이 되는 프로젝트 완성이 최종 목표이지만 프로젝트에 적용할 기술 스택도 같이 공부하면서\r\n\r\n아이디어부터 천천히 디벨롭 할 예정입니다.\r\n\r\n단순 이력서용이 아닌 팀 프로젝트를 통해 발전하고 싶으신 분들은 모두 환영입니다!\r\n\r\n관심 혹은 질문 있으신 분은 아래의 오픈카톡으로 문의 부탁드립니다!!!\r\n\r\n \r\n\r\n주제는 팀 빌딩 이후 같이 아이디어 회의를 진행할 예정입니다.\r\n\r\n \r\n\r\n모집 인원(우선 모집 후에 인원 추가 예정입니다.)⭐️ \r\n\r\n현재 인원\r\n\r\n- 백엔드(Spring Boot): 3명 \r\n\r\n - 프론트엔드(React): 3명\r\n\r\n \r\n\r\n지원 자격 ⭐\r\n- 앱개발자의 경우 취준생 및 주니어\r\n\r\n- 끝까지 함께 하실 분! ⭐ ⭐ ⭐\r\n\r\n- 평일 오후 9시 이후 디스코드 온라인 회의 가능하신 분\r\n\r\n- 서울 오프라인 회의 참석 가능하신 분(월 1회 예정)\r\n\r\n- 커뮤니케이션 원활하고 적극적이신 분! ⭐ ⭐ ⭐\r\n\r\n \r\n\r\n주의 사항 ⭐\r\n- 취업 및 이직용 포트폴리오가 목적이 아니에요 !\r\n\r\n- 수익 창출까지 진행하면서 과정 속에서 기술도 습득하고 역량을 키우는 것 또한 목적에 포함되어 있어요 !\r\n\r\n- 다 함께 편안한 분위기에서 개발하는 것을 지향해요 !\r\n\r\n- 물론 실력이 좋으신 분이면 좋지만, 그렇지 않아도 열심히 하실 분이면 모두 지원해주세요 !', 8, 0, 125, '2024-11-21 07:09:29'),
(7, 8, '모집중', '🕐 [iOS] 약속 관리 플랫폼 \'아이쿠\'에서 Swift 개발자를 찾습니다!', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/87654321', 4, '현재 개발이 80% 정도 진행된 상태이며, iOS 개발 팀 분들의 개인적인 사정으로 새로운 개발자 분을 찾게 되었습니다!\r\n\r\n기존 코드의 리팩토링과 기능 개발을 맡아주시게 될 것 같습니다.\r\n\r\n(이전 개발자 분들의 인계는 정상적으로 이루어질 예정입니다.)\r\n\r\n \r\n\r\n주제 : 약속 관리 어플리케이션 (합류 후 세부 내용 공유)\r\n\r\n일정 : 12월 중순 런칭 예정\r\n\r\n🌟 필수 조건 🌟\r\n\r\n서버와 통신 경험을 갖고 계신 분\r\n책임감을 갖고 런칭까지 열정적으로 완주 가능하신 분!\r\n \r\n\r\n🌟 우대 사항 🌟\r\n\r\n지도 API를 경험해 보신 분\r\n서비스 중심의 관점을 갖고 확장 및 아이디어 제시에 관심을 가지신 분 \r\n \r\n\r\n취준 중이신분, 대학생 모두 환영입니다.\r\n\r\n런칭 이후에도 해당 프로젝트가 스펙으로써 활용 될 수 있도록 유의미한 경험이 되셨으면 좋겠습니다.', 3, 0, 162, '2024-11-21 06:57:18'),
(8, 9, '모집중', '[교육 스타트업 - 창업 멤버 모집]', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/12345', 16, '[교육 스타트업 - 창업 멤버 모집]\r\n\r\n대입 수시 학생부종합전형 준비를 위한 ① Open AI를 활용한 탐구보고서 데이터 생성 판매 ②\'설탭 & 콴다\' 유형의 비교과 수업 강사 학생 매칭 플랫폼 사업을 준비중인 서울대학교 학생입니다.\r\n\r\n단순한 탐구주제 제시가 아니라, 10년동안 대치동 TOP 하이엔드 수시종합전형 전문학원의 연구진이 학교생활기록부 내신 / 비교과 진단평가 프로그램 SET + 개인 맞춤형 포트폴리오 생성 SET + 대학의 평가요소를 충족시키는 탐구보고서 작성을 위한 개인 키워드 맞춤형 탐구보고서 작성 자료 SET 2,000여편이 현재 70% 이상 준비, 개발되어 있는 상태입니다. 연내 의미있는 사이즈의 매출이 가능한 상태입니다.\r\n\r\n2028학년도 수능의 자격고사화, 현재 중3부터 고교학점제 시행 등으로 인한 빅 마켓사이즈 및 상장 경험이 많은 동업 경영진과 1년간 협업중입니다. 기존 브랜드, SNS, 마케팅 플랫폼, 오프라인 학원이 준비되어 있습니다. 로드맵 별로 설립/ 매출/ 엔젤투자/ 기관투자/ IPO 시나리오/ 강남 사무실 등이 준비되어 있습니다. 함께 창업을 통해 결실을 거둘 수 있는 멤버를 원합니다. 대학생 - 대학원생 - 초기창업자 - 관련 강사 등 미래를 위한 꿈과 실력을 갖출 수 있는 동료를 기다리겠습니다\r\n\r\n- 기획 마케팅 전문가\r\n\r\n- 프론트 백엔드 개발자\r\n\r\n- Devops 개발자\r\n\r\n- 디자이너\r\n\r\n- 웹 개발자\r\n\r\n- AI 개발자\r\n\r\n- 빅데이터 분석', 42, 0, 324, '2024-11-21 06:57:18'),
(9, 13, '모집중', '[엑셀러레이터선정] Corporate Analytics 마지막 모집', '2024-11-25', '온라인', '협력툴: Confluence 와 슬랙 그리고 Jira 플랫폼\r\n백엔드/클라우드: GCP, BigQuery, Scala, Java, Python, MongoDB, Django등', '장기(6개월이상)', ' https://forms.gle/MQgv7z12345', 4, '소개:\r\n\r\n런던, 뉴욕, 홍콩의 외국 금융사에 특화 된 대안 데이터 기반 기업 위험 산정 및 시그널 인텔리젼스 웹 어플리케이션 입니다.\r\n\r\n지식산업으로 30조원의 매출을 내는 다국적기업에서 일하며 체득한 경험을 살려\r\n\r\n알고 있는 문제점들을 보완 해 170조원의 수출 시장을 공략하고 있습니다.\r\n\r\n2024년 8월 사업계획을 잡아 8월 중순에 엑셀러레이팅 주관사로부터 선정 되었습니다.\r\n\r\n전반적인 사업 계획 및 타임라인은 아래와 같습니다\r\n\r\n타임라인:\r\n\r\n프로토타입 개발 중이며 25년 1월중 완성 후 지원 사업 및 VC 투자 받은 후 직접 직장을 만드는 자유도 높은 과정 입니다.\r\n\r\n고객군이 해외에 있는 서비스 특성상, 해외 본사 그리고 국내 연구 개발 지사 형태로 법인설립을 고려하고 있습니다.\r\n\r\n제가 처음에는 프로덕 개발과 구성 및 기능에 참여하고 나중에는 해외 B2B 세일즈 및 네트워크 홍보 그리고 국내외 지원 사업\r\n\r\nIR 및 연구개발 사업 모집에 다닐 것으로 예상하고 있습니다.\r\n\r\n금년\r\n\r\n8월 -12월 엑셀러레이팅 과정 진행 및 VC 멘토링\r\n\r\n2025년 1월 - 4월 지주회사 및 국내 법인 설립\r\n\r\n정예 인원으로 각 분야에서 경력 및 전문성이 유망하신 분들이 참여해 주시고 있습니다.\r\n\r\n현재 참여 인원은 아래와 같습니다\r\n\r\n사업 총괄: 다국적기업 글로벌 데이터과학부서 연구전문 (인텔리전스 특화)\r\n\r\n백엔드/클라우드: 10년차 엔지니어 GCP, BigQuery, Scala, Java, Python, MongoDB, Django, JS 등 \r\n\r\n데이터 엔지니어: 5년차 엔지니어 Azure, Confluent, Debezium, Hadoop, CDC Pipilines, Databricks\r\n\r\nAI: 1.5년차 AI 엔지니어 Word Vector, Keras, Tensorflow, GraphNLP, React, Deeplearning research\r\n\r\n마케팅 자문: 외국계 B2B 컨슈머 리서치 및 마케팅 팀장 10년+ 경력\r\n\r\n주요 관심 인력은 아래와 같습니다\r\n\r\n지분 참여형 프론트엔드 1분 - 웹어플리케이션 SaaS 제품이나 서비스 개발 경력 연관성이 많습니다. UI/UX 경험도 환영합니다.\r\n\r\nUI/UX 경력 및 전문가 계시면 또한 연락 주세요 (1분)\r\n\r\n현재 일주일에 한번 서로 주로 역삼동에서 오프라인으로 만나보며 편하게 진행하고 있으며 온라인으로는 Confluence 와 슬랙 그리고 Jira 플랫폼을 이용합니다.\r\n\r\n나이/성별/타이틀/회사소중대무/국립사립/대졸고졸/대학회사브랜드인지도 상관없이 이 과정에서 좋은 분들을 만나고 뜻있게 만들고자 하시는 분들은 많은 성원 주시길 바랍니다.', 42, 0, 178, '2024-11-21 07:05:58'),
(10, 25, '모집중', '같이 포트폴리오용 프로젝트 하실 취준생(대학생) 구해요.', '2024-12-02', '온라인', '로스트아크 API \r\n닉네임 텍스트 추출(Tesseract.js, Clova OCR, OpenCV) 블랙리스트 데이터베이스 구축 및 실시간 연동\r\nAWS배포', '장기(6개월이상)', ' https://forms.gle/Mv7z12345', 7, '프로젝트 주제 : 로스트아크의 파티 신청 화면을 실시간으로 공유받아, 컴퓨터 비전을 통해 닉네임 텍스트를 읽어오고, 이를 바탕으로 로스트아크 API를 호출해 정보를 제공하는 웹사이트 개발 프로젝트입니다.추가로, 블랙리스트 데이터베이스를 이용해 사용자들끼리 불량 플레이어 정보를 공유하여, 파티 가입 전에 예방할 수 있는 시스템을 구현합니다\r\n \r\n\r\n프로젝트 목표 : 기획, 개발, 배포까지의 전 과정을 직접 경험하며 실무 역량을 키우고 포트폴리오 제작\r\n예상 프로젝트 일정(횟수) : 약 1개월 (MVP 완성까지, 중도 하차 가능)\r\n\r\n프로젝트 소개와 개설 이유 : 개발 전 과정을 경험하고, 실무에 필요한 기술 스택을 익히기 위해포트폴리오로 활용 가능한 프로젝트를 완성하기 위해취업/창업을 목표로, 실무 환경에서의 협업 경험을 쌓기 위해\r\n \r\n\r\n프로젝트 관련 주의사항 : Git 및 협업 도구에 익숙하지 않아도 괜찮습니다.로컬 환경 개발만 해봤거나, 외부 배포 경험이 없어도 지원 가능합니다.이 프로젝트는 수익 창출이 목적이 아니며, 서버/API 비용 발생 시 제가 지불할 예정입니다.기본 API 연동 및 URL 처리 부분은 개발이 완료된 상태이며, 필요 시 다시 설계해도 무방합니다.\r\n', 22, 0, 175, '2024-11-21 07:05:58'),
(11, 3, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', '피그마, 리액트 혹은 뷰, AWS, Docker, Nestjs, 노션, 디스코드', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-11-21 07:06:12'),
(12, 3, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', '피그마, ios / andriod 앱 개발', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-11-21 07:09:19'),
(13, 3, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', '피그마, ios / andriod 앱 개발', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-11-21 07:06:28'),
(14, 3, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', '뷰, 타입스크립트', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-11-20 19:33:41'),
(15, 5, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', '피그마', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '[개발 프로젝트 모집 내용 예시]\r\n\r\n프로젝트 주제 : 책 평점 등록 사이트 \r\n예상 모집인원 : 1명\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, 디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!. 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n사이트 링크\r\nhttps://book-rating-123456\r\n카카오 오픈채팅방으로 연락주세요!\r\n', 10, 0, 135, '2024-11-21 06:56:39'),
(16, 7, '모집완료', '프로젝트 함께하실 (디자인/앱) 모집합니다🍀', '2024-12-09', '온라인', '피그마, HTML/CSS, Javascript, 리액트', '단기(1~2개월)', 'https://open.kakao.com/87654321', 4, '안녕하세요 😃\r\n\r\n웹/앱 크로스플랫폼 기반의 수익 창출까지 진행해볼 프로젝트 멤버를 모집합니다! 🚗\r\n\r\n수익 창출이 되는 프로젝트 완성이 최종 목표이지만 프로젝트에 적용할 기술 스택도 같이 공부하면서\r\n\r\n아이디어부터 천천히 디벨롭 할 예정입니다.\r\n\r\n단순 이력서용이 아닌 팀 프로젝트를 통해 발전하고 싶으신 분들은 모두 환영입니다!\r\n\r\n관심 혹은 질문 있으신 분은 아래의 오픈카톡으로 문의 부탁드립니다!!!\r\n\r\n \r\n\r\n주제는 팀 빌딩 이후 같이 아이디어 회의를 진행할 예정입니다.\r\n\r\n \r\n\r\n모집 인원(우선 모집 후에 인원 추가 예정입니다.)⭐️ \r\n\r\n현재 인원\r\n\r\n- 백엔드(Spring Boot): 3명 \r\n\r\n - 프론트엔드(React): 3명\r\n\r\n \r\n\r\n지원 자격 ⭐\r\n- 앱개발자의 경우 취준생 및 주니어\r\n\r\n- 끝까지 함께 하실 분! ⭐ ⭐ ⭐\r\n\r\n- 평일 오후 9시 이후 디스코드 온라인 회의 가능하신 분\r\n\r\n- 서울 오프라인 회의 참석 가능하신 분(월 1회 예정)\r\n\r\n- 커뮤니케이션 원활하고 적극적이신 분! ⭐ ⭐ ⭐\r\n\r\n \r\n\r\n주의 사항 ⭐\r\n- 취업 및 이직용 포트폴리오가 목적이 아니에요 !\r\n\r\n- 수익 창출까지 진행하면서 과정 속에서 기술도 습득하고 역량을 키우는 것 또한 목적에 포함되어 있어요 !\r\n\r\n- 다 함께 편안한 분위기에서 개발하는 것을 지향해요 !\r\n\r\n- 물론 실력이 좋으신 분이면 좋지만, 그렇지 않아도 열심히 하실 분이면 모두 지원해주세요 !', 8, 0, 125, '2024-11-21 07:09:29'),
(17, 8, '모집중', '🕐 [iOS] 약속 관리 플랫폼 \'아이쿠\'에서 Swift 개발자를 찾습니다!', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/87654321', 4, '현재 개발이 80% 정도 진행된 상태이며, iOS 개발 팀 분들의 개인적인 사정으로 새로운 개발자 분을 찾게 되었습니다!\r\n\r\n기존 코드의 리팩토링과 기능 개발을 맡아주시게 될 것 같습니다.\r\n\r\n(이전 개발자 분들의 인계는 정상적으로 이루어질 예정입니다.)\r\n\r\n \r\n\r\n주제 : 약속 관리 어플리케이션 (합류 후 세부 내용 공유)\r\n\r\n일정 : 12월 중순 런칭 예정\r\n\r\n🌟 필수 조건 🌟\r\n\r\n서버와 통신 경험을 갖고 계신 분\r\n책임감을 갖고 런칭까지 열정적으로 완주 가능하신 분!\r\n \r\n\r\n🌟 우대 사항 🌟\r\n\r\n지도 API를 경험해 보신 분\r\n서비스 중심의 관점을 갖고 확장 및 아이디어 제시에 관심을 가지신 분 \r\n \r\n\r\n취준 중이신분, 대학생 모두 환영입니다.\r\n\r\n런칭 이후에도 해당 프로젝트가 스펙으로써 활용 될 수 있도록 유의미한 경험이 되셨으면 좋겠습니다.', 3, 0, 162, '2024-11-21 06:57:18'),
(18, 9, '모집중', '[교육 스타트업 - 창업 멤버 모집]', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/12345', 16, '[교육 스타트업 - 창업 멤버 모집]\r\n\r\n대입 수시 학생부종합전형 준비를 위한 ① Open AI를 활용한 탐구보고서 데이터 생성 판매 ②\'설탭 & 콴다\' 유형의 비교과 수업 강사 학생 매칭 플랫폼 사업을 준비중인 서울대학교 학생입니다.\r\n\r\n단순한 탐구주제 제시가 아니라, 10년동안 대치동 TOP 하이엔드 수시종합전형 전문학원의 연구진이 학교생활기록부 내신 / 비교과 진단평가 프로그램 SET + 개인 맞춤형 포트폴리오 생성 SET + 대학의 평가요소를 충족시키는 탐구보고서 작성을 위한 개인 키워드 맞춤형 탐구보고서 작성 자료 SET 2,000여편이 현재 70% 이상 준비, 개발되어 있는 상태입니다. 연내 의미있는 사이즈의 매출이 가능한 상태입니다.\r\n\r\n2028학년도 수능의 자격고사화, 현재 중3부터 고교학점제 시행 등으로 인한 빅 마켓사이즈 및 상장 경험이 많은 동업 경영진과 1년간 협업중입니다. 기존 브랜드, SNS, 마케팅 플랫폼, 오프라인 학원이 준비되어 있습니다. 로드맵 별로 설립/ 매출/ 엔젤투자/ 기관투자/ IPO 시나리오/ 강남 사무실 등이 준비되어 있습니다. 함께 창업을 통해 결실을 거둘 수 있는 멤버를 원합니다. 대학생 - 대학원생 - 초기창업자 - 관련 강사 등 미래를 위한 꿈과 실력을 갖출 수 있는 동료를 기다리겠습니다\r\n\r\n- 기획 마케팅 전문가\r\n\r\n- 프론트 백엔드 개발자\r\n\r\n- Devops 개발자\r\n\r\n- 디자이너\r\n\r\n- 웹 개발자\r\n\r\n- AI 개발자\r\n\r\n- 빅데이터 분석', 42, 0, 324, '2024-11-21 06:57:18'),
(19, 13, '모집중', '[엑셀러레이터선정] Corporate Analytics 마지막 모집', '2024-11-25', '온라인', '협력툴: Confluence 와 슬랙 그리고 Jira 플랫폼\r\n백엔드/클라우드: GCP, BigQuery, Scala, Java, Python, MongoDB, Django등', '장기(6개월이상)', ' https://forms.gle/MQgv7z12345', 4, '소개:\r\n\r\n런던, 뉴욕, 홍콩의 외국 금융사에 특화 된 대안 데이터 기반 기업 위험 산정 및 시그널 인텔리젼스 웹 어플리케이션 입니다.\r\n\r\n지식산업으로 30조원의 매출을 내는 다국적기업에서 일하며 체득한 경험을 살려\r\n\r\n알고 있는 문제점들을 보완 해 170조원의 수출 시장을 공략하고 있습니다.\r\n\r\n2024년 8월 사업계획을 잡아 8월 중순에 엑셀러레이팅 주관사로부터 선정 되었습니다.\r\n\r\n전반적인 사업 계획 및 타임라인은 아래와 같습니다\r\n\r\n타임라인:\r\n\r\n프로토타입 개발 중이며 25년 1월중 완성 후 지원 사업 및 VC 투자 받은 후 직접 직장을 만드는 자유도 높은 과정 입니다.\r\n\r\n고객군이 해외에 있는 서비스 특성상, 해외 본사 그리고 국내 연구 개발 지사 형태로 법인설립을 고려하고 있습니다.\r\n\r\n제가 처음에는 프로덕 개발과 구성 및 기능에 참여하고 나중에는 해외 B2B 세일즈 및 네트워크 홍보 그리고 국내외 지원 사업\r\n\r\nIR 및 연구개발 사업 모집에 다닐 것으로 예상하고 있습니다.\r\n\r\n금년\r\n\r\n8월 -12월 엑셀러레이팅 과정 진행 및 VC 멘토링\r\n\r\n2025년 1월 - 4월 지주회사 및 국내 법인 설립\r\n\r\n정예 인원으로 각 분야에서 경력 및 전문성이 유망하신 분들이 참여해 주시고 있습니다.\r\n\r\n현재 참여 인원은 아래와 같습니다\r\n\r\n사업 총괄: 다국적기업 글로벌 데이터과학부서 연구전문 (인텔리전스 특화)\r\n\r\n백엔드/클라우드: 10년차 엔지니어 GCP, BigQuery, Scala, Java, Python, MongoDB, Django, JS 등 \r\n\r\n데이터 엔지니어: 5년차 엔지니어 Azure, Confluent, Debezium, Hadoop, CDC Pipilines, Databricks\r\n\r\nAI: 1.5년차 AI 엔지니어 Word Vector, Keras, Tensorflow, GraphNLP, React, Deeplearning research\r\n\r\n마케팅 자문: 외국계 B2B 컨슈머 리서치 및 마케팅 팀장 10년+ 경력\r\n\r\n주요 관심 인력은 아래와 같습니다\r\n\r\n지분 참여형 프론트엔드 1분 - 웹어플리케이션 SaaS 제품이나 서비스 개발 경력 연관성이 많습니다. UI/UX 경험도 환영합니다.\r\n\r\nUI/UX 경력 및 전문가 계시면 또한 연락 주세요 (1분)\r\n\r\n현재 일주일에 한번 서로 주로 역삼동에서 오프라인으로 만나보며 편하게 진행하고 있으며 온라인으로는 Confluence 와 슬랙 그리고 Jira 플랫폼을 이용합니다.\r\n\r\n나이/성별/타이틀/회사소중대무/국립사립/대졸고졸/대학회사브랜드인지도 상관없이 이 과정에서 좋은 분들을 만나고 뜻있게 만들고자 하시는 분들은 많은 성원 주시길 바랍니다.', 42, 0, 178, '2024-11-21 07:05:58'),
(20, 25, '모집중', '같이 포트폴리오용 프로젝트 하실 취준생(대학생) 구해요.', '2024-12-02', '온라인', '로스트아크 API \r\n닉네임 텍스트 추출(Tesseract.js, Clova OCR, OpenCV) 블랙리스트 데이터베이스 구축 및 실시간 연동\r\nAWS배포', '장기(6개월이상)', ' https://forms.gle/Mv7z12345', 7, '프로젝트 주제 : 로스트아크의 파티 신청 화면을 실시간으로 공유받아, 컴퓨터 비전을 통해 닉네임 텍스트를 읽어오고, 이를 바탕으로 로스트아크 API를 호출해 정보를 제공하는 웹사이트 개발 프로젝트입니다.추가로, 블랙리스트 데이터베이스를 이용해 사용자들끼리 불량 플레이어 정보를 공유하여, 파티 가입 전에 예방할 수 있는 시스템을 구현합니다\r\n \r\n\r\n프로젝트 목표 : 기획, 개발, 배포까지의 전 과정을 직접 경험하며 실무 역량을 키우고 포트폴리오 제작\r\n예상 프로젝트 일정(횟수) : 약 1개월 (MVP 완성까지, 중도 하차 가능)\r\n\r\n프로젝트 소개와 개설 이유 : 개발 전 과정을 경험하고, 실무에 필요한 기술 스택을 익히기 위해포트폴리오로 활용 가능한 프로젝트를 완성하기 위해취업/창업을 목표로, 실무 환경에서의 협업 경험을 쌓기 위해\r\n \r\n\r\n프로젝트 관련 주의사항 : Git 및 협업 도구에 익숙하지 않아도 괜찮습니다.로컬 환경 개발만 해봤거나, 외부 배포 경험이 없어도 지원 가능합니다.이 프로젝트는 수익 창출이 목적이 아니며, 서버/API 비용 발생 시 제가 지불할 예정입니다.기본 API 연동 및 URL 처리 부분은 개발이 완료된 상태이며, 필요 시 다시 설계해도 무방합니다.\r\n', 22, 0, 175, '2024-11-21 07:05:58'),
(21, 3, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', '피그마, 리액트 혹은 뷰, AWS, Docker, Nestjs, 노션, 디스코드', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-11-21 07:06:12'),
(22, 3, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', '피그마, ios / andriod 앱 개발', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-11-21 07:09:19'),
(23, 3, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', '피그마, ios / andriod 앱 개발', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-11-21 07:06:28'),
(24, 3, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', '뷰, 타입스크립트', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-11-20 19:33:41'),
(25, 5, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', '피그마', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '[개발 프로젝트 모집 내용 예시]\r\n\r\n프로젝트 주제 : 책 평점 등록 사이트 \r\n예상 모집인원 : 1명\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, 디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!. 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n사이트 링크\r\nhttps://book-rating-123456\r\n카카오 오픈채팅방으로 연락주세요!\r\n', 10, 0, 135, '2024-11-21 06:56:39'),
(26, 7, '모집완료', '프로젝트 함께하실 (디자인/앱) 모집합니다🍀', '2024-12-09', '온라인', '피그마, HTML/CSS, Javascript, 리액트', '단기(1~2개월)', 'https://open.kakao.com/87654321', 4, '안녕하세요 😃\r\n\r\n웹/앱 크로스플랫폼 기반의 수익 창출까지 진행해볼 프로젝트 멤버를 모집합니다! 🚗\r\n\r\n수익 창출이 되는 프로젝트 완성이 최종 목표이지만 프로젝트에 적용할 기술 스택도 같이 공부하면서\r\n\r\n아이디어부터 천천히 디벨롭 할 예정입니다.\r\n\r\n단순 이력서용이 아닌 팀 프로젝트를 통해 발전하고 싶으신 분들은 모두 환영입니다!\r\n\r\n관심 혹은 질문 있으신 분은 아래의 오픈카톡으로 문의 부탁드립니다!!!\r\n\r\n \r\n\r\n주제는 팀 빌딩 이후 같이 아이디어 회의를 진행할 예정입니다.\r\n\r\n \r\n\r\n모집 인원(우선 모집 후에 인원 추가 예정입니다.)⭐️ \r\n\r\n현재 인원\r\n\r\n- 백엔드(Spring Boot): 3명 \r\n\r\n - 프론트엔드(React): 3명\r\n\r\n \r\n\r\n지원 자격 ⭐\r\n- 앱개발자의 경우 취준생 및 주니어\r\n\r\n- 끝까지 함께 하실 분! ⭐ ⭐ ⭐\r\n\r\n- 평일 오후 9시 이후 디스코드 온라인 회의 가능하신 분\r\n\r\n- 서울 오프라인 회의 참석 가능하신 분(월 1회 예정)\r\n\r\n- 커뮤니케이션 원활하고 적극적이신 분! ⭐ ⭐ ⭐\r\n\r\n \r\n\r\n주의 사항 ⭐\r\n- 취업 및 이직용 포트폴리오가 목적이 아니에요 !\r\n\r\n- 수익 창출까지 진행하면서 과정 속에서 기술도 습득하고 역량을 키우는 것 또한 목적에 포함되어 있어요 !\r\n\r\n- 다 함께 편안한 분위기에서 개발하는 것을 지향해요 !\r\n\r\n- 물론 실력이 좋으신 분이면 좋지만, 그렇지 않아도 열심히 하실 분이면 모두 지원해주세요 !', 8, 0, 125, '2024-11-21 07:09:29'),
(27, 8, '모집중', '🕐 [iOS] 약속 관리 플랫폼 \'아이쿠\'에서 Swift 개발자를 찾습니다!', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/87654321', 4, '현재 개발이 80% 정도 진행된 상태이며, iOS 개발 팀 분들의 개인적인 사정으로 새로운 개발자 분을 찾게 되었습니다!\r\n\r\n기존 코드의 리팩토링과 기능 개발을 맡아주시게 될 것 같습니다.\r\n\r\n(이전 개발자 분들의 인계는 정상적으로 이루어질 예정입니다.)\r\n\r\n \r\n\r\n주제 : 약속 관리 어플리케이션 (합류 후 세부 내용 공유)\r\n\r\n일정 : 12월 중순 런칭 예정\r\n\r\n🌟 필수 조건 🌟\r\n\r\n서버와 통신 경험을 갖고 계신 분\r\n책임감을 갖고 런칭까지 열정적으로 완주 가능하신 분!\r\n \r\n\r\n🌟 우대 사항 🌟\r\n\r\n지도 API를 경험해 보신 분\r\n서비스 중심의 관점을 갖고 확장 및 아이디어 제시에 관심을 가지신 분 \r\n \r\n\r\n취준 중이신분, 대학생 모두 환영입니다.\r\n\r\n런칭 이후에도 해당 프로젝트가 스펙으로써 활용 될 수 있도록 유의미한 경험이 되셨으면 좋겠습니다.', 3, 0, 162, '2024-11-21 06:57:18'),
(28, 9, '모집중', '[교육 스타트업 - 창업 멤버 모집]', '2024-11-21', '온라인', '프레임워크: SwiftUI\r\nAPI 관리툴: Moya\r\n아키텍처: MVVM, Router', '장기(6개월이상)', 'https://open.kakao.com/12345', 16, '[교육 스타트업 - 창업 멤버 모집]\r\n\r\n대입 수시 학생부종합전형 준비를 위한 ① Open AI를 활용한 탐구보고서 데이터 생성 판매 ②\'설탭 & 콴다\' 유형의 비교과 수업 강사 학생 매칭 플랫폼 사업을 준비중인 서울대학교 학생입니다.\r\n\r\n단순한 탐구주제 제시가 아니라, 10년동안 대치동 TOP 하이엔드 수시종합전형 전문학원의 연구진이 학교생활기록부 내신 / 비교과 진단평가 프로그램 SET + 개인 맞춤형 포트폴리오 생성 SET + 대학의 평가요소를 충족시키는 탐구보고서 작성을 위한 개인 키워드 맞춤형 탐구보고서 작성 자료 SET 2,000여편이 현재 70% 이상 준비, 개발되어 있는 상태입니다. 연내 의미있는 사이즈의 매출이 가능한 상태입니다.\r\n\r\n2028학년도 수능의 자격고사화, 현재 중3부터 고교학점제 시행 등으로 인한 빅 마켓사이즈 및 상장 경험이 많은 동업 경영진과 1년간 협업중입니다. 기존 브랜드, SNS, 마케팅 플랫폼, 오프라인 학원이 준비되어 있습니다. 로드맵 별로 설립/ 매출/ 엔젤투자/ 기관투자/ IPO 시나리오/ 강남 사무실 등이 준비되어 있습니다. 함께 창업을 통해 결실을 거둘 수 있는 멤버를 원합니다. 대학생 - 대학원생 - 초기창업자 - 관련 강사 등 미래를 위한 꿈과 실력을 갖출 수 있는 동료를 기다리겠습니다\r\n\r\n- 기획 마케팅 전문가\r\n\r\n- 프론트 백엔드 개발자\r\n\r\n- Devops 개발자\r\n\r\n- 디자이너\r\n\r\n- 웹 개발자\r\n\r\n- AI 개발자\r\n\r\n- 빅데이터 분석', 42, 0, 324, '2024-11-21 06:57:18'),
(29, 13, '모집중', '[엑셀러레이터선정] Corporate Analytics 마지막 모집', '2024-11-25', '온라인', '협력툴: Confluence 와 슬랙 그리고 Jira 플랫폼\r\n백엔드/클라우드: GCP, BigQuery, Scala, Java, Python, MongoDB, Django등', '장기(6개월이상)', ' https://forms.gle/MQgv7z12345', 4, '소개:\r\n\r\n런던, 뉴욕, 홍콩의 외국 금융사에 특화 된 대안 데이터 기반 기업 위험 산정 및 시그널 인텔리젼스 웹 어플리케이션 입니다.\r\n\r\n지식산업으로 30조원의 매출을 내는 다국적기업에서 일하며 체득한 경험을 살려\r\n\r\n알고 있는 문제점들을 보완 해 170조원의 수출 시장을 공략하고 있습니다.\r\n\r\n2024년 8월 사업계획을 잡아 8월 중순에 엑셀러레이팅 주관사로부터 선정 되었습니다.\r\n\r\n전반적인 사업 계획 및 타임라인은 아래와 같습니다\r\n\r\n타임라인:\r\n\r\n프로토타입 개발 중이며 25년 1월중 완성 후 지원 사업 및 VC 투자 받은 후 직접 직장을 만드는 자유도 높은 과정 입니다.\r\n\r\n고객군이 해외에 있는 서비스 특성상, 해외 본사 그리고 국내 연구 개발 지사 형태로 법인설립을 고려하고 있습니다.\r\n\r\n제가 처음에는 프로덕 개발과 구성 및 기능에 참여하고 나중에는 해외 B2B 세일즈 및 네트워크 홍보 그리고 국내외 지원 사업\r\n\r\nIR 및 연구개발 사업 모집에 다닐 것으로 예상하고 있습니다.\r\n\r\n금년\r\n\r\n8월 -12월 엑셀러레이팅 과정 진행 및 VC 멘토링\r\n\r\n2025년 1월 - 4월 지주회사 및 국내 법인 설립\r\n\r\n정예 인원으로 각 분야에서 경력 및 전문성이 유망하신 분들이 참여해 주시고 있습니다.\r\n\r\n현재 참여 인원은 아래와 같습니다\r\n\r\n사업 총괄: 다국적기업 글로벌 데이터과학부서 연구전문 (인텔리전스 특화)\r\n\r\n백엔드/클라우드: 10년차 엔지니어 GCP, BigQuery, Scala, Java, Python, MongoDB, Django, JS 등 \r\n\r\n데이터 엔지니어: 5년차 엔지니어 Azure, Confluent, Debezium, Hadoop, CDC Pipilines, Databricks\r\n\r\nAI: 1.5년차 AI 엔지니어 Word Vector, Keras, Tensorflow, GraphNLP, React, Deeplearning research\r\n\r\n마케팅 자문: 외국계 B2B 컨슈머 리서치 및 마케팅 팀장 10년+ 경력\r\n\r\n주요 관심 인력은 아래와 같습니다\r\n\r\n지분 참여형 프론트엔드 1분 - 웹어플리케이션 SaaS 제품이나 서비스 개발 경력 연관성이 많습니다. UI/UX 경험도 환영합니다.\r\n\r\nUI/UX 경력 및 전문가 계시면 또한 연락 주세요 (1분)\r\n\r\n현재 일주일에 한번 서로 주로 역삼동에서 오프라인으로 만나보며 편하게 진행하고 있으며 온라인으로는 Confluence 와 슬랙 그리고 Jira 플랫폼을 이용합니다.\r\n\r\n나이/성별/타이틀/회사소중대무/국립사립/대졸고졸/대학회사브랜드인지도 상관없이 이 과정에서 좋은 분들을 만나고 뜻있게 만들고자 하시는 분들은 많은 성원 주시길 바랍니다.', 42, 0, 178, '2024-11-21 07:05:58'),
(30, 25, '모집중', '같이 포트폴리오용 프로젝트 하실 취준생(대학생) 구해요.', '2024-12-02', '온라인', '로스트아크 API \r\n닉네임 텍스트 추출(Tesseract.js, Clova OCR, OpenCV) 블랙리스트 데이터베이스 구축 및 실시간 연동\r\nAWS배포', '장기(6개월이상)', ' https://forms.gle/Mv7z12345', 7, '프로젝트 주제 : 로스트아크의 파티 신청 화면을 실시간으로 공유받아, 컴퓨터 비전을 통해 닉네임 텍스트를 읽어오고, 이를 바탕으로 로스트아크 API를 호출해 정보를 제공하는 웹사이트 개발 프로젝트입니다.추가로, 블랙리스트 데이터베이스를 이용해 사용자들끼리 불량 플레이어 정보를 공유하여, 파티 가입 전에 예방할 수 있는 시스템을 구현합니다\r\n \r\n\r\n프로젝트 목표 : 기획, 개발, 배포까지의 전 과정을 직접 경험하며 실무 역량을 키우고 포트폴리오 제작\r\n예상 프로젝트 일정(횟수) : 약 1개월 (MVP 완성까지, 중도 하차 가능)\r\n\r\n프로젝트 소개와 개설 이유 : 개발 전 과정을 경험하고, 실무에 필요한 기술 스택을 익히기 위해포트폴리오로 활용 가능한 프로젝트를 완성하기 위해취업/창업을 목표로, 실무 환경에서의 협업 경험을 쌓기 위해\r\n \r\n\r\n프로젝트 관련 주의사항 : Git 및 협업 도구에 익숙하지 않아도 괜찮습니다.로컬 환경 개발만 해봤거나, 외부 배포 경험이 없어도 지원 가능합니다.이 프로젝트는 수익 창출이 목적이 아니며, 서버/API 비용 발생 시 제가 지불할 예정입니다.기본 API 연동 및 URL 처리 부분은 개발이 완료된 상태이며, 필요 시 다시 설계해도 무방합니다.\r\n', 22, 0, 175, '2024-11-21 07:05:58'),
(31, 3, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', '피그마, 리액트 혹은 뷰, AWS, Docker, Nestjs, 노션, 디스코드', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-11-21 07:06:12'),
(32, 3, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', '피그마, ios / andriod 앱 개발', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-11-21 07:09:19'),
(33, 3, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', '피그마, ios / andriod 앱 개발', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-11-21 07:06:28'),
(34, 3, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', '뷰, 타입스크립트', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-11-20 19:33:41'),
(35, 5, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', '피그마', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '[개발 프로젝트 모집 내용 예시]\r\n\r\n프로젝트 주제 : 책 평점 등록 사이트 \r\n예상 모집인원 : 1명\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, 디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!. 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n사이트 링크\r\nhttps://book-rating-123456\r\n카카오 오픈채팅방으로 연락주세요!\r\n', 10, 0, 135, '2024-11-21 06:56:39');

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
(1, 'code_even', '이븐관리자', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 12345, '서울특별시 강남구', '101호', NULL, '2024-11-01', '2024-11-20 15:04:29', 100, 0),
(2, 'even_teacher', '이븐선생', '이븐하게', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'eventeacher@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', NULL, '2024-11-01', '2024-11-18 00:34:45', 10, 0),
(3, 'even_student', '이븐학생', '이도령', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5600', '2doryung@even.co.kr', 1, 11000, '서울시 영등포구', '여의도 한강공원', NULL, '2024-11-02', '2024-11-17 08:01:44', 1, 0),
(4, 'my_teacher', '김동주', '멋진선생님', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'rocks@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '', '2024-11-03', '2024-11-19 04:16:54', 10, 0),
(5, 'user_kdhj_5', '이서윤', '학생A', '12345', '010-2345-6789', '', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-11-15', '2024-11-19 10:15:30', 1, 0),
(6, 'user_abcd_6', '최민준', '유저B', '12345', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12', '2024-11-18 09:45:20', 1, 0),
(7, 'user_efgh_7', '김하늘', '모범생', '12345', '010-9876-5432', '', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14', '2024-11-19 14:12:45', 1, 0),
(8, 'user_ijkl_8', '박서준', '친구C', '12345', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-11-10', '2024-11-17 07:55:10', 1, 0),
(9, 'user_mnop_9', '정예린', '참여자', '12345', '010-4682-7351', '', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15', '2024-11-18 15:30:22', 1, 0),
(10, 'user_qrst_10', '오지훈', '신입생', '12345', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-13', '2024-11-19 08:47:59', 1, 0),
(11, 'user_uvwx_11', '김은정', '회원Z', '12345', '010-6543-2109', '', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-11-14', '2024-11-18 16:40:15', 1, 0),
(12, 'user_yzab_12', '황민서', '동아리장', '12345', '010-3698-1472', '', NULL, 12345, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12', '2024-11-19 11:20:33', 1, 0),
(13, 'user_cdef_13', '이정호', '감독관', '12345', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-11', '2024-11-17 12:30:15', 1, 0),
(14, 'user_ghij_14', '박미라', '조직원', '12345', '010-4729-3851', '', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-11-14', '2024-11-18 13:22:08', 1, 0),
(15, 'user_klmn_15', '서진우', '시민D', '12345', '010-8147-9263', '', NULL, NULL, NULL, NULL, NULL, '2024-11-15', '2024-11-19 17:09:43', 1, 0),
(16, 'user_opqr_16', '조예린', '연구자', '12345', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-11-16', '2024-11-18 09:18:29', 1, 0),
(17, 'user_stuv_17', '강서윤', '관리자', '12345', '010-2391-8465', '', NULL, NULL, NULL, NULL, '참고 항목', '2024-11-17', '2024-11-19 16:27:14', 1, 0),
(18, 'user_wxyz_18', '홍민기', '팀장A', '12345', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-18', '2024-11-19 14:52:38', 1, 0),
(19, 'user_abcd_19', '이주영', '회원F', '12345', '010-3421-8674', '', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-11-19', '2024-11-20 08:12:23', 1, 0),
(20, 'user_efgh_20', '김재현', '회원G', '12345', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-11', '2024-11-18 07:25:39', 1, 0),
(21, 'user_ijkl_21', '윤예지', '회원H', '12345', '010-1482-7395', '', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-11-12', '2024-11-19 15:45:16', 1, 0),
(22, 'user_mnop_22', '박지호', '시민E', '12345', '010-2874-5632', '', NULL, NULL, NULL, NULL, NULL, '2024-11-13', '2024-11-18 11:20:50', 1, 0),
(23, 'user_qrst_23', '전현민', '지원자', '12345', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-11-14', '2024-11-19 17:35:40', 1, 0),
(24, 'user_uvwx_24', '송민지', '참가자', '12345', '010-4758-9210', '', NULL, 11900, NULL, NULL, NULL, '2024-11-15', '2024-11-17 12:47:39', 1, 0),
(25, 'user_yzab_25', '이세훈', '대표자', '12345', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-11-16', '2024-11-19 18:19:54', 1, 0),
(26, 'user_cdef_26', '서민수', '부대표', '12345', '010-9374-6581', '', 1, NULL, NULL, NULL, NULL, '2024-11-17', '2024-11-19 14:30:10', 1, 0),
(27, 'user_ghij_27', '조윤호', '기술팀', '12345', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-11-18', '2024-11-20 10:35:48', 1, 0),
(28, 'user_klmn_28', '한예림', '행정팀', '12345', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-11-17', '2024-11-19 09:45:30', 1, 0),
(29, 'user_opqr_29', '이준혁', '재정팀', '12345', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15', '2024-11-20 14:15:40', 1, 0),
(30, 'user_stuv_30', '정수빈', '기획부', '12345', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-11-12', '2024-11-18 17:25:55', 1, 0),
(31, 'user_wxyz_31', '박진서', '개발팀', '12345', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-11-14', '2024-11-19 16:45:50', 1, 0),
(32, 'user_abcd_32', '조예원', '회계팀', '12345', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18', '2024-11-20 13:50:25', 1, 0),
(33, 'user_efgh_33', '김동현', '홍보팀', '12345', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-11-11', '2024-11-19 10:15:10', 1, 0),
(34, 'user_ijkl_34', '서윤아', '영업팀', '12345', '010-6471-8935', 'user34@example.com', NULL, NULL, '경상북도 구미시', NULL, NULL, '2024-11-15', '2024-11-18 12:00:00', 1, 0),
(35, 'user_mnop_35', '최서현', '연구팀', '12345', '010-1938-4756', 'user35@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16', '2024-11-19 18:10:00', 1, 0),
(36, 'user_qrst_36', '윤지호', '특별팀', '12345', '010-9381-2647', 'user36@example.com', 1, NULL, '울산광역시 울주군', '별관 1층', NULL, '2024-11-17', '2024-11-20 08:25:15', 1, 0),
(37, 'user_uvwx_37', '이예림', '개발자A', '12345', '010-3751-9824', 'user37@example.com', NULL, 11300, '충청북도 청주시', '빌딩 2층', NULL, '2024-11-18', '2024-11-20 09:50:32', 1, 0),
(38, 'user_yzab_38', '정하윤', '디자이너', '12345', '010-1983-6475', 'user38@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-14', '2024-11-19 11:25:50', 1, 0),
(39, 'user_cdef_39', '박지민', '운영자', '12345', '010-2871-9456', 'user39@example.com', 1, 12345, '강원도 강릉시', '건물 B동', '기타 참고 사항', '2024-11-13', '2024-11-19 14:00:25', 1, 0),
(40, 'user_ghij_40', '김수호', '회원H', '12345', '010-8346-1274', 'user40@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-19', '2024-11-20 10:30:45', 1, 0),
(41, 'user_klmn_41', '이하늘', '프로젝트매니저', '12345', '010-6478-1328', 'user41@example.com', 1, NULL, '서울특별시 동작구', '아파트 C동', NULL, '2024-11-16', '2024-11-19 17:15:20', 1, 0),
(42, 'user_opqr_42', '서영준', '기술지원', '12345', '010-9328-4157', 'user42@example.com', 0, 15234, '인천광역시 남동구', NULL, NULL, '2024-11-15', '2024-11-18 16:35:48', 1, 0),
(43, 'user_stuv_43', '홍세영', '인사팀', '12345', '010-3461-7829', 'user43@example.com', 1, 13300, NULL, NULL, NULL, '2024-11-14', '2024-11-17 18:45:10', 1, 0),
(44, 'user_wxyz_44', '김태희', 'IT부서', '12345', '010-8293-6174', 'user44@example.com', NULL, NULL, NULL, NULL, '특별참조', '2024-11-12', '2024-11-20 15:20:05', 1, 0),
(45, 'user_abcd_45', '이정석', '회원I', '12345', '010-9234-8172', 'user45@example.com', NULL, 11123, '광주광역시 동구', '기타 건물', NULL, '2024-11-18', '2024-11-19 16:45:00', 1, 0),
(46, 'user_efgh_46', '박소정', '팀리더', '12345', '010-7452-8936', 'user46@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-14', '2024-11-18 13:25:30', 1, 0),
(47, 'user_ijkl_47', '최승민', '운영자B', '12345', '010-3784-2591', 'user47@example.com', NULL, 12300, '경기도 안산시', '지하 1층', NULL, '2024-11-17', '2024-11-19 14:30:45', 1, 0),
(48, 'user_mnop_48', '김현아', '회원J', '12345', '010-9234-5617', 'user48@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-19', '2024-11-20 08:40:20', 1, 0),
(49, 'user_qrst_49', '정민재', '프로모션팀', '12345', '010-1482-9635', 'user49@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-15', '2024-11-20 12:45:35', 1, 0),
(50, 'user_efgh_50', '이채영', '졸림핑', '12345', '010-8239-6517', 'user50@example.com', NULL, 13245, '경기도 파주시', '별관 2층', NULL, '2024-11-18', '2024-11-20 12:50:20', 1, 0),
(51, 'user_ijkl_51', '박준혁', '코딩핑', '12345', '010-9283-4561', 'user51@example.com', 1, 14200, '전라북도 군산시', '빌라 A동', NULL, '2024-11-17', '2024-11-19 15:20:35', 1, 0),
(52, 'user_mnop_52', '정은채', '달빛냥', '12345', '010-7381-9642', 'user52@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-16', '2024-11-19 11:30:00', 1, 0),
(53, 'user_qrst_53', '최하늘', '별빛스톰', '12345', '010-9182-6437', 'user53@example.com', 0, 12450, NULL, NULL, NULL, '2024-11-15', '2024-11-20 14:35:10', 1, 0),
(54, 'user_uvwx_54', '윤도영', '청춘깡', '12345', '010-3741-2584', 'user54@example.com', 1, NULL, '경상북도 포항시', NULL, NULL, '2024-11-18', '2024-11-19 12:40:15', 1, 0),
(55, 'user_yzab_55', '이현수', '햇살쿨', '12345', '010-2983-7651', 'user55@example.com', NULL, 13210, '부산광역시 해운대구', '건물 C동', NULL, '2024-11-12', '2024-11-19 09:15:45', 1, 0),
(56, 'user_cdef_56', '김민정', '달려라거북', '12345', '010-9371-4629', 'user56@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-11', '2024-11-20 13:25:30', 1, 0),
(57, 'user_ghij_57', '박서윤', '미소캣', '12345', '010-4672-1584', 'user57@example.com', NULL, NULL, NULL, NULL, '메모사항', '2024-11-14', '2024-11-19 18:40:20', 1, 0),
(58, 'user_klmn_58', '최승호', '노을빛', '12345', '010-3485-7391', 'user58@example.com', NULL, 11235, '서울특별시 강동구', NULL, NULL, '2024-11-13', '2024-11-18 11:15:30', 1, 0),
(59, 'user_opqr_59', '강진우2', '꿈꾸는별', '12345', '010-7584-1937', 'user59@example.com', 0, NULL, '', '', '', '2024-11-15', '2024-11-19 17:25:50', 1, 0),
(60, 'user_stuv_60', '서지민', '비상하는매', '12345', '010-8193-2547', 'user60@example.com', NULL, 13321, '대전광역시 서구', NULL, NULL, '2024-11-14', '2024-11-20 14:40:35', 1, 0),
(61, 'user_wxyz_61', '조윤호', '강한바람', '12345', '010-7483-9165', 'user61@example.com', 1, NULL, NULL, NULL, '특별 메모', '2024-11-17', '2024-11-19 10:05:25', 1, 0),
(62, 'user_abcd_62', '김민수', '별빛반짝', '12345', '010-8453-2198', 'user62@example.com', NULL, 13400, '경기도 의정부시', '지하 3층', NULL, '2024-11-18', '2024-11-20 12:35:40', 1, 0),
(63, 'user_efgh_63', '이정민', '구름산책', '12345', '010-4923-5718', 'user63@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16', '2024-11-20 08:45:10', 1, 0),
(64, 'user_ijkl_64', '박진영', '햇빛추적', '12345', '010-9385-7216', 'user64@example.com', NULL, NULL, NULL, NULL, NULL, '2024-11-12', '2024-11-18 16:20:55', 1, 0),
(65, 'user_mnop_65', '최서영', '사랑가득', '12345', '010-2384-7512', 'user65@example.com', 1, NULL, '', '', '', '2024-11-19', '2024-11-20 09:00:10', 1, -1),
(66, 'user_qrst_66', '정은호', '도전왕', '12345', '010-1934-8527', 'user66@example.com', NULL, NULL, NULL, NULL, '중요 참고 사항', '2024-11-18', '2024-11-19 19:20:05', 1, 0),
(67, 'user_uvwx_67', '윤지수2', '꽃바람', '12345', '010-8934-2158', 'user67@example.com', 0, NULL, '', '', '', '2024-11-17', '2024-11-20 12:50:40', 1, 0),
(68, 'user_yzab_68', '이상민', '눈꽃결', '12345', '010-9482-1365', 'user68@example.com', 1, NULL, '제주특별자치도 서귀포시', '1층 사무실', NULL, '2024-11-16', '2024-11-19 17:15:30', 1, 0),
(69, 'user_cdef_69', '한유진2', '바다별', '12345', '010-3492-1758', 'user69@example.com', 0, 13100, '', '', '', '2024-11-15', '2024-11-19 14:25:20', 1, -1),
(70, 'user_ghij_70', '조한결', '불꽃의꿈', '12345', '010-8723-4519', 'user70@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12', '2024-11-20 11:45:05', 10, 0),
(71, 'user_klmn_71', '정민아', '그린스톰', '12345', '010-2394-1765', 'user71@example.com', 0, NULL, '경상남도 김해시', '빌딩 A동', '참고사항', '2024-11-14', '2024-11-19 16:40:25', 1, 1);

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
  ADD KEY `oddt_odid_IDX` (`odid`) USING BTREE;

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
  ADD KEY `sqid` (`sqid`);

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
  MODIFY `aaid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유번호', AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `admin_question`
--
ALTER TABLE `admin_question`
  MODIFY `aqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호', AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT COMMENT '장바구니고유번호';

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `class_data`
--
ALTER TABLE `class_data`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID', AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `company_info`
--
ALTER TABLE `company_info`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT COMMENT '상점정보 고유번호(자동)', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `counsel`
--
ALTER TABLE `counsel`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=13;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호', AUTO_INCREMENT=29;

--
-- 테이블의 AUTO_INCREMENT `lecture`
--
ALTER TABLE `lecture`
  MODIFY `leid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=20;

--
-- 테이블의 AUTO_INCREMENT `lecture_detail`
--
ALTER TABLE `lecture_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '강의 ID';

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
  MODIFY `ntid` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항고유번호', AUTO_INCREMENT=21;

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
  MODIFY `oddtid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문상세고유번호', AUTO_INCREMENT=26;

--
-- 테이블의 AUTO_INCREMENT `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `commid` int(11) NOT NULL AUTO_INCREMENT COMMENT '댓글id', AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT COMMENT '환불고유번호';

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `rvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강후기ID', AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `send_email`
--
ALTER TABLE `send_email`
  MODIFY `emid` int(11) NOT NULL AUTO_INCREMENT COMMENT '이메일발송고유번호', AUTO_INCREMENT=11;

--
-- 테이블의 AUTO_INCREMENT `student_qna`
--
ALTER TABLE `student_qna`
  MODIFY `sqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호', AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `stuscores`
--
ALTER TABLE `stuscores`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

--
-- 테이블의 AUTO_INCREMENT `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '강사고유번호', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `teacher_qna`
--
ALTER TABLE `teacher_qna`
  MODIFY `asid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유ID', AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `teamproject`
--
ALTER TABLE `teamproject`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id(자동)', AUTO_INCREMENT=36;

--
-- 테이블의 AUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=72;

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
  ADD CONSTRAINT `teacher_qna_ibfk_1` FOREIGN KEY (`sqid`) REFERENCES `student_qna` (`sqid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
