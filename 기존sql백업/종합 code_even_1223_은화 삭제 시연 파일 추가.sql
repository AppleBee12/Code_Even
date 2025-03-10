-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-23 02:09
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
(1, 1, '강의 결제 실패 메시지가 뜨는 경우, 결제 시스템 오류나 카드 승인 문제일 수 있습니다. 고객센터로 문의하여 결제 상태를 확인하시고, 필요시 재시도 또는 다른 결제 방법을 사용해보세요.', 'done', NULL),
(2, 2, '영상 재생 문제는 브라우저 캐시 문제나 인터넷 속도와 관련이 있을 수 있습니다. 브라우저를 새로 고침하고, 다른 브라우저나 기기에서 시도해 보세요. 문제가 지속되면 고객센터로 문의해주세요.', 'done', NULL),
(3, 3, '쿠폰이 적용되지 않는 경우, 쿠폰 유효 기간을 확인해 보세요. 또한, 결제 시 쿠폰 코드를 정확히 입력했는지 확인하고, 조건에 맞는 강의를 선택해야 적용됩니다.', 'done', NULL),
(4, 4, '회원 탈퇴는 계정 설정 메뉴에서 가능하지만, 탈퇴 전에 모든 데이터를 백업해 두는 것을 권장합니다. 탈퇴 후 복구가 불가능하므로 신중하게 결정해 주세요.', 'done', NULL),
(5, 5, '학생과의 소통 방법은 Q&A 외에도 강의별 댓글, 이메일 등을 통해 이루어집니다. 강의 진행 중 실시간 질문이 필요한 경우, 실시간 채팅 기능을 활용할 수 있습니다.', 'done', NULL),
(6, 6, '수강이수증은 강의를 모두 수료한 후에 수료증 발급 버튼이 활성화됩니다. 만약 수료증 발급에 문제가 있다면 고객센터로 문의해주세요.', 'done', NULL),
(7, 7, '정산 지연은 시스템 처리나 결제 확인 문제일 수 있습니다. 정산 일정에 대한 확인은 강사 대시보드에서 할 수 있으며, 정확한 정산 내역은 매월 업데이트됩니다.', 'done', NULL),
(8, 8, '강사의 이력 정보는 강사 페이지에서 확인할 수 있습니다. 이력 정보가 업데이트되지 않은 경우, 계정 설정에서 프로필을 수정하여 반영되도록 하세요.', 'done', NULL),
(9, 9, '강의 개설 절차는 강의 신청서를 제출하고, 강의 내용 및 계획서를 검토 후 승인됩니다. 필요한 서류를 준비하여 신청서를 제출해 주세요.', 'done', NULL),
(10, 10, '강의를 이미 들었을 경우 환불이 불가능합니다.', 'done', NULL),
(11, 11, '홈페이지에서 확인하실 수 있습니다.', 'done', NULL),
(12, 12, '다시 한 번 결제 부탁드립니다.\r\n실패시 고객센터에 문의해주세요.', 'done', NULL),
(13, 13, '확인 후 처리해드리겠습니다.\r\n불편을 끼쳐드려 죄송합니다.', 'done', NULL),
(14, 14, '삭제를 원하시면 관리자가 직접 삭제 해드리겠습니다.', 'done', NULL),
(15, 15, '오류 확인 후 다시 한 번 더 오류가 날 시 쿠폰 적용 시켜드리겠습니다. 감사합니다.', 'done', NULL);

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
  `regdate` date NOT NULL DEFAULT current_timestamp() COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='1:1 문의 (사용자질문)';

--
-- 테이블의 덤프 데이터 `admin_question`
--

INSERT INTO `admin_question` (`aqid`, `uid`, `category`, `qtitle`, `qcontent`, `regdate`) VALUES
(1, 2, 1, '강의 결제 관련 문의', '강의 결제 시 결제 실패 메시지가 뜨는데 어떻게 해결하나요?', '2024-11-18'),
(2, 3, 2, '강의 수강 관련 문의', '강의를 수강 중에 영상이 제대로 재생되지 않아요. 해결 방법이 있을까요?', '2024-11-18'),
(3, 2, 3, '쿠폰 발급 관련 문의', '강의 쿠폰을 발급받았는데 적용이 되지 않아요. 어떻게 해야 하나요?', '2024-11-18'),
(4, 3, 4, '회원 탈퇴 문의', '회원 탈퇴를 하려고 하는데 절차가 잘 안 나옵니다. 어떻게 해야 하나요?', '2024-11-18'),
(5, 2, 5, '강의 소통 방법 문의', '학생과의 소통에 대해 Q&A 외에 다른 방법은 없나요?', '2024-11-18'),
(6, 3, 6, '수강이수증 발급 문의', '수강이수증을 발급받으려면 어떻게 해야 하나요? 강의를 완료했는데 아직 수강이수증이 안 나왔어요.', '2024-11-18'),
(7, 2, 7, '정산 관련 문의', '강의 수익 정산이 지연되고 있는데 확인 부탁드립니다.', '2024-11-18'),
(8, 3, 8, '강사 이력 확인 문의', '강사의 이력 정보가 업데이트되지 않은 것 같습니다. 어떻게 해야 하나요?', '2024-11-18'),
(9, 2, 2, '강의 개설 관련 문의', '새로운 강의를 개설하려고 하는데, 등록 절차에 대해 안내받고 싶습니다.', '2024-11-18'),
(10, 3, 1, '결제 환불 관련 문의', '강의를 구매했는데, 환불이 불가능한 경우는 무엇인가요?', '2024-11-18'),
(11, 5, 2, '강의 업데이트 관련 문의', '강의 내용이 업데이트된 것 같은데 변경된 내용을 어디에서 확인할 수 있나요?', '2024-11-19'),
(12, 7, 1, '결제 실패 문의', '카드 결제 시 계속 실패 메시지가 나옵니다. 해결 방법이 있을까요?', '2024-11-19'),
(13, 2, 7, '정산 지연 문의', '이번 달 강의 수익 정산이 지연되고 있습니다. 확인 부탁드립니다.', '2024-11-19'),
(14, 8, 4, '계정 삭제 관련 문의', '계정을 삭제하려고 했는데 삭제 버튼이 작동하지 않습니다. 도움을 받을 수 있을까요?', '2024-11-19'),
(15, 6, 3, '쿠폰 코드 사용 문의', '강의 쿠폰 코드를 입력했는데 적용이 되지 않습니다. 확인 부탁드립니다.', '2024-11-19'),
(16, 2, 8, '강의 평가 관련 문의', '수강생들이 남긴 강의 평가를 확인하고 싶은데 어디서 볼 수 있나요?', '2024-11-19'),
(17, 10, 5, '강의 추천 문의', '수강생에게 적합한 강의를 추천받고 싶은데 어떤 절차를 거쳐야 하나요?', '2024-11-19'),
(18, 12, 6, '수료증 발급 지연 문의', '수료증 발급이 지연되고 있습니다. 언제 받을 수 있을까요?', '2024-11-19'),
(19, 2, 2, '강의 등록 관련 문의', '새로운 강의를 등록하려고 하는데 필요한 서류가 무엇인지 궁금합니다.', '2024-11-19'),
(20, 13, 1, '결제 정보 수정 문의', '결제 정보를 수정하고 싶은데 어떻게 해야 하나요?', '2024-11-19'),
(21, 15, 6, '수강 이력 확인 문의', '완료한 강의의 수강 이력을 확인하고 싶습니다. 어디에서 확인할 수 있나요?', '2024-11-19'),
(22, 18, 3, '쿠폰 사용 기한 문의', '발급받은 쿠폰의 사용 기한이 지났습니다. 다시 사용할 수 있는 방법이 있을까요?', '2024-11-19'),
(23, 2, 5, '강의 콘텐츠 수정 문의', '강의 자료를 수정하고 싶은데 관리 화면에서 방법을 찾지 못했습니다.', '2024-11-19'),
(24, 20, 4, '이메일 변경 후 로그인 문제', '이메일을 변경한 이후 로그인할 수 없습니다. 확인 부탁드립니다.', '2024-11-19'),
(25, 2, 8, '강사 프로필 수정 문의', '강사 프로필 정보 수정 요청을 어디로 해야 하나요?', '2024-11-19'),
(26, 22, 7, '정산 금액 문의', '정산 금액이 예상보다 적습니다. 상세 내역을 확인할 수 있나요?', '2024-11-19'),
(27, 25, 2, '강의 화면 오류 문의', '강의를 재생할 때 화면이 멈추는 문제가 발생합니다. 도움을 받을 수 있을까요?', '2024-11-19'),
(28, 30, 1, '결제 영수증 발급 문의', '결제 영수증을 발급받으려면 어디에서 신청해야 하나요?', '2024-11-19'),
(29, 2, 7, '정산 내역 수정 요청', '정산 내역 중 잘못 기재된 항목이 있어 수정 요청드립니다.', '2024-11-19'),
(30, 35, 5, '강의 피드백 관련 문의', '강의에 대한 피드백을 어디에 남길 수 있나요?', '2024-11-19');

-- --------------------------------------------------------

--
-- 테이블 구조 `attendance_data`
--

CREATE TABLE `attendance_data` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `check_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `attendance_data`
--

INSERT INTO `attendance_data` (`id`, `uid`, `check_date`, `created_at`) VALUES
(1, 3, '2024-12-21', '2024-12-20 21:37:22'),
(4, 1, '2024-12-22', '2024-12-22 22:37:08'),
(6, 3, '2024-12-22', '2024-12-22 22:00:57'),
(13, 4, '2024-12-22', '2024-12-22 06:54:11'),
(14, 2, '2024-12-22', '2024-12-22 08:06:38'),
(23, 3, '2024-12-23', '2024-12-22 23:13:36');

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
(1, 1, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/code_even/admin/upload/blog/co_20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 13, 1, 312, '2024-12-19 11:47:51'),
(2, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-10-14 02:58:59'),
(3, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 03:29:22'),
(4, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-19 03:29:36'),
(5, 1, '코드이븐에서 쿠폰 기능이 오픈 되었습니다!', '/code_even/admin/upload/blog/co_20241112grandopen.png\r\n', '코드이븐 쿠폰 기능이 오픈 되었습니다!\r\n회원 가입시 모든 회원에게 적용되는 쿠폰을 받으실 수 있습니다.', 20, 0, 530, '2024-12-19 21:30:44'),
(7, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-19 03:29:36'),
(8, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 03:29:22'),
(9, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-10-14 02:58:59'),
(10, 3, '[쿠폰이벤트] 코드이븐 가을세일전쟁 : BEST 강사 전 강좌 최대 50%쿠폰', '/code_even/admin/upload/blog/co_20241101fallsalewar001.png', '다가오는 연말, 연초에 계획한 목표를 이룰 마지막 소중한 2달!\r\n다시 도전 할 수 있도록  코드이븐이 이~븐하게 챙겨드립니다.\r\n\r\n대상: 연초 작성해뒀던 목표 리스트가 생각나 ‘앗차!’ 외치신 분\r\n기간: 11.01 ~ 11.11\r\n연초 생각했던 리스트와 다짐을 댓글로 남겨주시면\r\n“30일 강좌 할인 쿠폰” x  2장  /  “60일 강좌 할인 쿠폰” x 1장  이 발급됩니다!', 13, 2, 312, '2024-10-11 02:58:40'),
(12, 1, '코딩테스트 준비 Final 개발자 취업하려면 클릭', '/code_even/admin/upload/blog/co_20241125codinglecture.png\r\n', '네카라쿠배 합격자 배출의 코드이븐! 코딩테스트 No 1 강좌를 엄선했어요. 기출 문제 심층 분석부터 최신 트렌드 기술 소개, 취업 전 모의 대면 면접 테스트 준비 Final 해주세요', 13, 0, 512, '2024-11-19 10:26:42'),
(13, 1, '네카라쿠배 선배의 직무 인터뷰 모음 .zip', '/code_even/admin/upload/blog/co_20241105beforehireling001.png\r\n', '눈 떠보니 개발자가 되어있었다! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 13, 0, 512, '2024-11-19 20:26:42'),
(14, 1, 'Ver2.네카라쿠배 선배의 직무 인터뷰 모음.zip', '/code_even/admin/upload/blog/co_20241105beforehireling002.png\r\n', '너무나 사랑해주신 눈 떠보니 개발자가 되어있었다에 이은 추가 인터뷰! 코드이븐을 통해 네카라쿠배에 탑승하기까지 무조건 궁금해 할 10가지 응답시간을 가져봤습니다!', 35, 0, 685, '2024-11-20 02:26:42'),
(15, 1, '코드이븐에서 쿠폰 기능이 오픈 되었습니다!', '/code_even/admin/upload/blog/co_20241112grandopen.png\r\n', '코드이븐 쿠폰 기능이 오픈 되었습니다!\r\n회원 가입시 모든 회원에게 적용되는 쿠폰을 받으실 수 있습니다.', 20, 0, 530, '2024-12-19 21:30:44');

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
(3, 'A0002', 'B0004', 'C0018', '/code_even/admin/upload/lecture/cat-5270323_1280.jpg', '데이터베이스, 나도 한다면 한다! MySQL 사용기', 'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이븐관리자', 20000, '2023-11-01 00:00:00', 'MySQL 지식 쌓기\', \'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이도령', '도령사'),
(4, 'A0002', 'B0004', 'C0018', '/code_even/admin/upload/lecture/cat-4123233_1280.jpg', '이제 당당히 말할 수 있다! 나도 MySLQ 중급 사용자', '이제 당당히 MySQL 좀 안다라고 말할 수 있는 당신을 위한 책', '이븐관리자', 30000, '2024-06-18 00:00:00', 'MySQL도 즐길 수 있다', '이도령', '도령사'),
(5, 'A0002', 'B0004', 'C0018', '/code_even/admin/upload/lecture/mikhail-vasilyev-IFxjDdqK_0U-unsplash.jpg', '데이터베이스, 나도 한다면 한다! MySQL 사용기', 'MySQL을 사용하고 싶으신 분들이라면 꼭 들어 보세요!', '이븐선생', 20000, '2023-11-01 00:00:00', 'MySQL 지식 쌓기', '홍길동', '길동사'),
(6, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/js_book1.png', '순수 자바스크립트 기초에서 실무까지', '바닐라 자바스크립트의 기초부터 최근 고급 문법까지 다뤘습니다. 여러분이 직접 라이브러리를 개발할 수 있습니다', '개발자의 품격', 26000, '2024-05-09 00:00:00', '바닐라 자바스크립트', '고승원', '길동사'),
(7, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/js_book2.png', '자바스크립트 비기너: 튼튼한 기본 만들기', '이 책은 머신러닝 개념서가 아니다. 자바스크립트와 TensorFlow.js 환경에서 머신러닝 구현을 위한 책이다. 기초부터 하나씩 다져가면서 점진적으로 머신러닝을 구현하는 시나리오를 갖고 있다. 소스 코드 한 줄마다 목적과 기능이 상세하게 설명되어 있다. 책을 따라가면 어렵지 않게 머신러닝을 단계적으로 이해하게 된다. 어렵고 멀게만 느껴졌던 머신러닝을 내 것으로 만들 수 있다.', '김영보', 28800, '2024-03-29 00:00:00', '머신 러닝', '김영보', '생각나눔'),
(8, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book1.png', 'HTML/CSS 베이스캠프', 'HTML5와 CSS Level 3 표준을 따르는 최신 실전 코드를 배울 수 있도록 꼼꼼한 설명이 덧붙여진 예제 코드를 담고 있는 학습서입니다. 실무에서 구현해서 사용하는 실제 코드를 기초로 설명하기 때문에 학습한 내용에서 끝나는 것이 아니라 실제로 사용할 수 있는 코드를 작성할 수 있는 실력을 키울 수 있습니다.', '제주코딩베이스캠프', 22000, '2023-11-16 00:00:00', 'HTML&CSS 마스터북', '어포스트', 'apost'),
(9, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book3.png', 'HTML 배워서 뉴스 기사 조작하는 방법', '이 책은 HTML이나 자바스크립트로 구글 메인 화면을 똑같이 만들어 보거나 스타크래프트 게임 기능을 구현해 보면서 코딩의 기초를 배우고, 마지막에는 실제로 배포할 수 있는 동물상 테스트 만드는 과정을 실습한다.', '조코딩', 16200, '2024-03-22 00:00:00', '조코딩의 프로그래밍 입문', '조동근', '이지스퍼블리싱'),
(10, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book4.png', '제대로 파는 HTML CSS', '명쾌한 설명과 전달력 높은 강의로 입문자들의 찬사를 받고 있는 얄코(얄팍한코딩사전)의 「제대로 파는 HTML+CSS」와 「뉴비를 위한 자바스크립트」 온라인 강의를 한 권의 책으로 담아냈습니다.', '얄코', 28800, '2024-02-01 00:00:00', '얄코의 Too Much 친절한 HTML+CSS+자바스크립트', '고현민', '리코멘드'),
(11, 'A0001', 'B0001', 'C0006', '/code_even/admin/upload/lecture/vue_book.jpg', 'Vue.js 설치부터 포트폴리오 제작까지', '실무자 3일 완성! 입문자 7일 완성! 바쁜 개발자의 시간 절약 입문서! 실무의 정글 속에서 살아남기 위한 실전 예제형 Vue.js 입문서! 이 책은 Vue.js 실무 개발 경험을 바탕으로 입문자 대상 강의를 수차례 진행해 온 현업 Vue.js 능력자가 집필했습니다.', '장기효(캡틴판교)', 13500, '2018-01-27 00:00:00', 'Do it! Vue.js 입문', '장기효', '이지스퍼블리싱'),
(12, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/book3.png', '코딩은 처음이라 with 웹 퍼블리싱', '이 책은 HTML, CSS, javascript 크게 3파트로 구성되어 있습니다. 각 파트는 기본 문법을 설명하는 부분과 기초 부분에서 학습한 내용을 복습할 수 있는 실전 프로젝트로 구성되어 있습니다.', '김동주', 27000, '2022-08-25 00:00:00', '코딩은 처음이라 with 웹 퍼블리싱', '김동주', '영진닷컴'),
(13, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book3.png', 'HTML 배워서 뉴스 기사 조작하는 방법', '이 책은 HTML이나 자바스크립트로 구글 메인 화면을 똑같이 만들어 보거나 스타크래프트 게임 기능을 구현해 보면서 코딩의 기초를 배우고, 마지막에는 실제로 배포할 수 있는 〈동물상 테스트〉 만드는 과정을 실습한다. 책에 담긴 웹 서비스, 스마트폰 앱, 인공지능 앱 개발을 모두 실습하고 나면 IT 시대의 진정한 지식인이 된다.', '조코딩', 16200, '2024-03-22 00:00:00', '조코딩의 프로그래밍 입문', '조동근', '이지스퍼블리싱'),
(14, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book3.png', 'HTML 배워서 뉴스 기사 조작하는 방법', '이 책은 HTML이나 자바스크립트로 구글 메인 화면을 똑같이 만들어 보거나 스타크래프트 게임 기능을 구현해 보면서 코딩의 기초를 배우고, 마지막에는 실제로 배포할 수 있는 〈동물상 테스트〉 만드는 과정을 실습한다. 책에 담긴 웹 서비스, 스마트폰 앱, 인공지능 앱 개발을 모두 실습하고 나면 IT 시대의 진정한 지식인이 된다.', '조코딩', 16200, '2024-03-22 00:00:00', '조코딩의 프로그래밍 입문', '조동근', '이지스퍼블리싱'),
(15, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/html_book3.png', 'HTML 배워서 뉴스 기사 조작하는 방법', '이 책은 HTML이나 자바스크립트로 구글 메인 화면을 똑같이 만들어 보거나 스타크래프트 게임 기능을 구현해 보면서 코딩의 기초를 배우고, 마지막에는 실제로 배포할 수 있는 〈동물상 테스트〉 만드는 과정을 실습한다.', '조코딩', 16200, '2024-03-22 00:00:00', '조코딩의 프로그래밍 입문', '조동근', '이지스퍼블리싱'),
(16, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/book_images/20241223020537127351.png', 'test', '교재 설명 test', '이븐관리자', 20000, '2024-12-03 00:00:00', '교재 수정 삭제 test', '저자 ', '출판사'),
(17, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/book_images/20241223020616173169.png', 'test 1', '교재 설명 test 1', '이븐관리자', 30000, '2024-12-05 00:00:00', '교재 일괄 삭제 test 1', '저자 ', '출판사'),
(18, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/book_images/20241223020701145877.png', 'test 2', '교재 설명 test 3', '이븐관리자', 20000, '2024-12-11 00:00:00', '교재 일괄 삭제 test 2', '저자 ', '출판사');

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
  `progress_rate` decimal(10,0) DEFAULT NULL COMMENT '진도율',
  `regdate` datetime NOT NULL DEFAULT current_timestamp() COMMENT '수강시작일자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강데이터';

--
-- 테이블의 덤프 데이터 `class_data`
--

INSERT INTO `class_data` (`cdid`, `uid`, `leid`, `exid`, `progress_rate`, `regdate`) VALUES
(1, 5, 21, NULL, NULL, '2024-12-22 21:24:34'),
(2, 6, 22, NULL, NULL, '2024-12-22 21:24:34'),
(3, 7, 23, NULL, NULL, '2024-12-22 21:24:34'),
(4, 8, 24, NULL, NULL, '2024-12-22 21:24:34'),
(5, 9, 25, NULL, NULL, '2024-12-22 21:24:34'),
(6, 10, 26, NULL, NULL, '2024-12-22 21:24:34'),
(7, 11, 27, NULL, NULL, '2024-12-22 21:24:34'),
(8, 11, 27, NULL, NULL, '2024-12-22 21:24:34'),
(9, 12, 28, NULL, NULL, '2024-12-22 21:24:34'),
(10, 13, 29, NULL, NULL, '2024-12-22 21:24:34'),
(11, 14, 21, NULL, NULL, '2024-12-22 21:24:34'),
(12, 15, 22, NULL, NULL, '2024-12-22 21:24:34'),
(13, 16, 23, NULL, NULL, '2024-12-22 21:24:34'),
(14, 17, 24, NULL, NULL, '2024-12-22 21:24:34'),
(15, 18, 25, NULL, NULL, '2024-12-22 21:24:34'),
(16, 19, 26, NULL, NULL, '2024-12-22 21:24:34'),
(17, 20, 27, NULL, NULL, '2024-12-22 21:24:34'),
(18, 21, 28, NULL, NULL, '2024-12-22 21:24:34'),
(19, 22, 29, NULL, NULL, '2024-12-22 21:24:34'),
(20, 23, 30, NULL, NULL, '2024-12-22 21:24:34'),
(21, 21, 56, NULL, NULL, '2024-12-22 21:24:34'),
(22, 3, 55, NULL, NULL, '2024-12-19 22:44:01'),
(23, 22, 56, NULL, NULL, '2024-12-22 21:24:34'),
(24, 23, 56, NULL, NULL, '2024-12-22 21:24:34'),
(25, 24, 56, NULL, NULL, '2024-12-22 21:24:34'),
(26, 25, 56, NULL, NULL, '2024-12-22 21:24:34'),
(27, 26, 56, NULL, NULL, '2024-12-22 21:24:34'),
(28, 3, 56, NULL, NULL, '2024-12-20 16:04:01'),
(29, 3, 54, NULL, NULL, '2024-12-21 19:07:44'),
(30, 3, 57, NULL, NULL, '2024-12-22 21:24:34'),
(31, 3, 51, NULL, NULL, '2024-12-23 08:06:48'),
(32, 3, 52, NULL, NULL, '2024-12-23 08:06:48');

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
  `tax_bill_email` varchar(50) NOT NULL COMMENT '세금계산서 발급 이메일',
  `tax_manager_phone` varchar(20) NOT NULL COMMENT '세무 담당자 전화번호',
  `privacy_manager_department` varchar(20) DEFAULT NULL COMMENT '개인정보\r\n  담당자 부서',
  `privacy_manager_name` varchar(20) NOT NULL COMMENT '개인정보  담당자 ',
  `privacy_manager_email` varchar(50) NOT NULL COMMENT '개인정보\r\n  담당자 이메일',
  `privacy_manager_phone` varchar(20) DEFAULT NULL COMMENT '개인정보\r\n  담당자 전화번호'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='상점 정보';

--
-- 테이블의 덤프 데이터 `company_info`
--

INSERT INTO `company_info` (`comid`, `company`, `ceo_name`, `post_code`, `address_one`, `address_two`, `address_three`, `bussiness_registration_num`, `commerce_registration_num`, `cs_number`, `email`, `created_at`, `tax_manager_department`, `tax_manager_name`, `tax_bill_email`, `tax_manager_phone`, `privacy_manager_department`, `privacy_manager_name`, `privacy_manager_email`, `privacy_manager_phone`) VALUES
(1, '주식회사 디제이컴퍼니', '김동주', 12345, '03192 서울 종로구 수표로 96 드림팰리스', '드림팰리스2층 종로캠퍼스', '(관수동, 국일관드림펠리스)', '192-01-23456', '2024-서울종로-1234', '1544-1234', 'djcompany@djcompany.com', '2024-12-22 07:59:33', '회계과', '홍길동 주임', 'gildong1234@djcompany.com', '010-1234-6589', '총무과', '이도령 대리', 'djcompany@djcompany.com', '010-4567-8900');

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
(1, 5, 0, '실무에 바로 적용해야 하는데 NODEjs 기초 수업 추천해주세요', '<p>지금 프론트엔드 현직자입니다.\r\n</p><p>Angular는 잘 모르는데 이번에 클라이언트가 Angular로 진행을 원해서 급하게 준비해야하게 되었습니다.\r\n</p><p>기간이 너무 촉박하기도 하고 강의 들으면서 바로 쓸 수 있는 레시피 강좌 있을까요?</p><p>\r\n추천 부탁드립니다!</p>', 0, 1, 20, '2024-12-19 11:48:03'),
(2, 6, 0, 'find함수 사용해서 다수의 데이터 가져오기', '<p>post맨으로\r\n\r\nhttp://localhost:3000/posts\r\n\r\n조회 했더니\r\n</p><p>\r\n[ ]로 안뜨고</p><p> \r\n\r\nasync getAllPosts() {\r\nreturn this.postsRepository.find();\r\n}\r\n로 뜹니다.</p><p> 왜그러죠?</p>', 0, 0, 135, '2024-12-18 14:49:48'),
(3, 7, 0, 'c++,c# wpf 프로젝트 어떤강의듣으면되죠?', '<p>콘솔 앱을 만들고 싶은데</p><p>\r\n제작언어를 물어보니\r\nC++, C# WPF를 사용했다고 합니다<span style=\"background-color: var(--bs-table-bg); text-align: var(--bs-body-text-align);\">.</span></p><p><span style=\"background-color: var(--bs-table-bg); text-align: var(--bs-body-text-align);\">\r\n어떤강의를 들으면 될까요?</span></p>', 2, 0, 241, '2024-12-18 19:56:41'),
(4, 8, 0, '선생님은 학습을 어떻게 하시나요??', '<p>도커를 몰라서 </p><p>강의를 들으면 빠르긴 한데 </p><p>선생님은 aws에서 객체 라이터를 선택을 해야되는 둥 </p><p>이런 부가적인 옵션 또는 지식들을 어떻게 습득하신걸까요 </p><p>궁금합니다</p>', 5, 0, 53, '2024-12-18 14:49:48'),
(5, 9, 0, '안녕하세요 혼자 열심히 공부하고 있는데 질문이 있습니다.', '<p>RTOS코드를 짰습니다. </p><p>문제는 UltraSoundTask에 if문을 추가하면, </p><p>distance가 6혹은7로 고정이 되면서, </p><p>바로 시스템이 맛이 가게 됩니다. 이유가 뭘까요?</p>', 1, 0, 152, '2024-12-18 14:49:48'),
(6, 10, 0, '메모리 누수에 대해서 질문드립니다.', '<p>강의에서 SkillSystem의 Unregister함수를 보면</p><p>\r\n\r\nDestroy(skill);을 통해 Skill 객체를 지우는데\r\n이때 메모리 누수가 발생하지 않는지 궁금합니다.\r\n</p><p>예를 들어 Skill은 SetUpStateMachine() 메소드에서\r\nStateMachine.onStateChanged 이벤트에 익명메소드로 구독을 하는데</p><p>\r\n\r\nStateMachine.onStateChanged += (_, newState, prevState, layer)\r\n\r\n=&gt; onStateChanged?.Invoke(this, newState, prevState, layer);</p><p>\r\n\r\n \r\n\r\n구독을 해제하는 부분은 따로 찾지 못해서\r\n이런 경우 메모리 누수가 없이 이벤트도 Skill 객체와 함께 정상적으로 삭제가 되는지 궁금합니다.\r\n</p><p>아직 메모리 관리에 대한 지식이 부족해 이러한 경우</p><p> 메모리 누수가 발생하는지 아닌지를 어떻게 찾아봐야 할지 모르겠어서 질문드립니다.</p>', 1, 0, 186, '2024-12-18 19:42:18'),
(7, 11, 0, '스프링 공부 시기 + 자바', '<p>현재 백엔드를 공부해보고 싶어 JAVA를 공부중인 1학년 학생입니다!\r\n</p><p>\r\n김영한 강사님 강의 듣고 있는데 중급편 2까지 듣고 스프링 로드맵 들으면 되는 걸까요?</p><p>\r\n\r\n강의 자료에 나오는 문제 말고도 클래스,상속 같은 것에 익숙해질 수 있는 문제 사이트나?</p><p> 예시들이 있는 곳도 궁금합니다!!</p>', 15, 0, 253, '2024-12-18 14:49:48'),
(8, 12, 0, '까먹더라도 이해하는 시간을 가져야 할까요 ?', '<p>강의를 봐도 심도 있게 이해하려고 하면 진도가 안 나가고 시간이 너무 걸려요</p><p> 그렇게 해도 까먹고요 ㅠㅠ 까먹더라도 이해하는 시간을 가져야 할까요 ?</p>', 20, 0, 345, '2024-12-18 14:49:48'),
(9, 13, 0, '구글 코랩 대신 사용할 환경은 없을까요?', '<p>구글 코랩등 이런 접속 제한이 있는 환경에서 공부를 하려 합니다.\r\n</p><p>\r\n대체 환경없나요?</p>', 25, 0, 329, '2024-12-19 13:02:31'),
(10, 14, 0, '강의 수강 관련', '<p>강의를 새로 구매하기에는 비용이 부담되어 </p><p>현재 수강 중인 것 기간만료 후 연장하고 싶은데, 방법이 있을까요?</p><p>\r\n\r\n비용을 조금 추가하는 방법이라도 좋으니, 2주정도만 연장하고 싶습니다.&nbsp;</p>', 35, 0, 333, '2024-12-18 19:38:56'),
(11, 15, 0, '일단 기초적인 것부터 시작을 하려고 하는데요', '<p>일단 레시피 강좌를 따라가면서 백엔드를 공부하고자 합니다</p><p>그래서 예전에는 아무것도 모르는 상태로 웹사이트에 도전했는데이해가 잘안가서 철수를 했습니다.</p><p>그러나 이번에는 차곡차곡 어떤순서로 접해야 기초를 잡고 java백엔드쪽을 배울 수 있는지 여쭙고자 합니다.</p><p>기초란 어떤 순서를 통해야 프로그래밍세계에 입문할 수 있는지 정도요!</p>', 45, 2, 455, '2024-12-19 12:35:09');

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
  `use_max_date` date DEFAULT NULL COMMENT '사용기한',
  `cp_desc` varchar(100) DEFAULT NULL COMMENT '쿠폰내용'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`cpid`, `couponid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `userid`, `max_value`, `use_min_price`, `use_max_date`, `cp_desc`) VALUES
(1, 1001, '리뷰쿠폰', '/code_even/admin/upload/coupons/20241120014236135047.png', 1, 5000, 0, 1, '2024-11-18 01:09:49', 'admin', 5000, 30000, '2024-12-31', NULL),
(2, 1002, '10% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042304161737.png', 2, 0, 0, 1, '2024-11-18 01:09:49', 'admin', 10000, 50000, '2024-12-31', '수강 10% 할인 쿠폰'),
(3, 1003, '수강 환승쿠폰', '/code_even/admin/upload/coupons/20241120042250105391.png', 1, 10000, 0, 1, '2024-11-18 01:09:49', 'user123', 10000, 25000, '2025-01-31', '수강 환승쿠폰'),
(4, 1004, '신규 회원 15% 할인 쿠폰', '/code_even/admin/upload/coupons/20241120042237197337.png', 2, 0, 15, 1, '2024-11-18 01:09:49', 'newuser', 15000, 20000, '2024-12-31', '신규 회원 15% 할인 쿠폰 바로증정!');

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
(28, 1, 8, 'teacher', '강의 평가에 대한 피드백은 어떻게 제공하나요?', '강의 평가에 대한 피드백은 평가 후 제공되는 설문지를 통해 작성할 수 있습니다. 강사와 학생 간의 건설적인 피드백을 주고받을 수 있습니다.', 0, '2024-11-16 17:40:00', 'off'),
(29, 1, 2, 'student', '수업 중 녹화된 강의는 어디에서 볼 수 있나요?', '녹화된 강의는 내 강의실에서 확인하실 수 있습니다. 각 강의별로 녹화된 영상을 제공하고 있습니다.', 0, '2024-11-22 10:00:00', 'on'),
(30, 1, 2, 'student', '강의 중 퀴즈는 어떻게 참여하나요?', '강의 중 퀴즈는 수업 진행 중 강의 페이지에서 참여 가능합니다. 퀴즈 완료 후 점수를 바로 확인할 수 있습니다.', 0, '2024-11-22 10:10:00', 'off'),
(31, 1, 2, 'student', '수강 신청 후 강의 시작 일정은 어떻게 확인하나요?', '수강 신청 후 강의 시작 일정은 강의 페이지 또는 수강 신청 확인 메일에서 확인 가능합니다.', 0, '2024-11-22 10:20:00', 'on'),
(32, 1, 2, 'student', '강의 중 과제를 제출하려면 어떻게 하나요?', '강의 중 과제는 강의 페이지의 과제 제출 섹션에서 제출할 수 있습니다. 파일 업로드 옵션도 제공됩니다.', 0, '2024-11-22 10:30:00', 'off'),
(33, 1, 2, 'student', '강의 중 실시간 채팅은 어떻게 이용하나요?', '강의 중 실시간 채팅은 강의 화면 하단에 제공되는 채팅창에서 이용 가능합니다.', 0, '2024-11-22 10:40:00', 'on'),
(34, 1, 2, 'student', '강의 후 복습 자료는 어디에서 받을 수 있나요?', '복습 자료는 강의 완료 후 강의 페이지의 복습 섹션에서 다운로드할 수 있습니다.', 0, '2024-11-22 10:50:00', 'off'),
(35, 1, 2, 'student', '강의 평가 후 피드백은 어디서 확인하나요?', '강의 평가 후 피드백은 강의 완료 후 강의 페이지에서 확인 가능합니다. 평가 내용은 익명으로 처리됩니다.', 0, '2024-11-22 11:00:00', 'on'),
(36, 1, 2, 'student', '강의 중 연결이 끊겼을 때는 어떻게 하나요?', '강의 중 연결이 끊겼다면 다시 로그인하여 강의실로 재접속하세요. 이어보기 기능이 지원됩니다.', 0, '2024-11-22 11:10:00', 'off'),
(37, 1, 2, 'student', '강의 관련 공지사항은 어디서 확인하나요?', '강의 관련 공지사항은 강의 페이지 상단의 공지사항 탭에서 확인 가능합니다.', 0, '2024-11-22 11:20:00', 'on'),
(38, 1, 2, 'student', '강의 자료를 공유할 수 있나요?', '강의 자료는 저작권 문제로 공유가 제한됩니다. 본인 학습 목적으로만 사용해주세요.', 0, '2024-11-22 11:30:00', 'off');

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
  `period` int(11) NOT NULL COMMENT '학습 기간',
  `course_type` varchar(30) NOT NULL COMMENT '레시피/일반',
  `isbest` varchar(10) NOT NULL COMMENT '베스트',
  `isnew` varchar(10) NOT NULL COMMENT '신규',
  `state` tinyint(4) NOT NULL COMMENT '상태',
  `approval` tinyint(4) NOT NULL COMMENT '승인',
  `price` int(11) NOT NULL COMMENT '수강료',
  `level` int(11) NOT NULL COMMENT '레벨',
  `date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '날짜'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `lecture`
--

INSERT INTO `lecture` (`leid`, `cgid`, `boid`, `lecid`, `cate1`, `cate2`, `cate3`, `image`, `title`, `des`, `name`, `period`, `course_type`, `isbest`, `isnew`, `state`, `approval`, `price`, `level`, `date`) VALUES
(21, NULL, NULL, 2, 'A0003', 'B0006', 'C0028', '/code_even/admin/upload/lecture/20241214181847127821.png', 'Wazuh+ELK(SIEM)를 활용한 위협헌팅(Threat Hunting) 시스템 구축 및 운영실습', '[보안 전문가를 위한 교육] Wazuh와 ELK 스택을 결합하여 최적의 위협헌팅 시스템을 직접 구축하고 운영하는 방법을 마스터하세요. 현장에서 바로 적용 가능한 전략과 실습을 통해 보안 능력을 한 단계 업그레이드합니다!', '이븐선생', 90, 'general', '1', '0', 1, 0, 77000, 0, '2024-12-15 02:18:47'),
(22, NULL, NULL, 2, 'A0003', 'B0006', 'C0027', '/code_even/admin/upload/lecture/20241214201453147703.png', 'CPPG 개인정보관리사 자격증 취득하기', '최신 법 개정안을 반영하고 최근 출제 경향을 반영하여 제작하였습니다. 개인정보에 대한 이해가 없으셔도 가장 쉽게 이해할 수 있도록 알려드릴 예정입니다. 믿고 따라오세요!', '이븐선생', 60, 'general', '0', '1', 1, 0, 77000, 0, '2024-12-15 04:14:53'),
(23, NULL, NULL, 2, 'A0003', 'B0005', 'C0026', '/code_even/admin/upload/lecture/20241215063502127452.png', 'C개발자를 위한 최소한의 C++', 'C언어를 독하게 제대로 공부하고 선형 자료구조까지 공부했다면 이제는 C++로 객체지향의 세계를 경험 할 시간입니다!', '이븐선생', 180, 'recipe', '1', '0', 1, 0, 99000, 0, '2024-12-15 14:35:02'),
(24, NULL, NULL, 98, 'A0003', 'B0005', 'C0025', '/code_even/admin/upload/lecture/20241215070345841512.png', 'C# TCP/IP 소켓 프로그래밍', 'TCP 소켓의 기초 이론과 특징을 배울 수 있습니다. 소켓의 다양한 옵션과 Task 기반 비동기 프로그래밍을 할 수 있습니다.', '에릭권', 60, 'general', '1', '0', 1, 0, 33000, 0, '2024-12-15 15:03:45'),
(25, NULL, NULL, 2, 'A0002', 'B0004', 'C0024', '/code_even/admin/upload/lecture/20241215071614394361.png', 'Couchbase 알아보기', 'Couchbase Server는 원래 Membase로 알려졌으며, 대화형 애플리케이션에 최적화된 오픈 소스 분산(공유 없음 아키텍처) 다중 모델 NoSQL 문서 지향 데이터베이스 소프트웨어 패키지입니다.', '이븐선생', 30, 'general', '1', '0', 1, 0, 44000, 0, '2024-12-15 15:16:14'),
(26, NULL, NULL, 96, 'A0002', 'B0004', 'C0023', '/code_even/admin/upload/lecture/20241215073437332828.png', 'Amazon Keyspaces를 통한 고성능 Cassandra DB 운영하기', 'Amazon Keyspaces는 고가용성의 확장 가능한 완전 관리형 Apache Cassandra 호환 데이터베이스 서비스입니다. 기존에 Cassandra 기반 애플리케이션을 사용하시는 분들에게 자동으로 테이블 규모의 확장/축소 등 서버리스(Serverless) 관리 경험을 드립니다. 본 세션에서는 Amazon Keyspaces를 소개하고 Cassandra 테이블을 구성 및 운영하는 방법을 알아봅니다.', '윤석찬', 90, 'general', '0', '1', 1, 0, 66000, 0, '2024-12-15 15:34:37'),
(27, NULL, NULL, 95, 'A0002', 'B0004', 'C0022', '/code_even/admin/upload/lecture/20241215075249192991.png', 'mongoDB 기초부터 실무까지(feat. Node.js)', 'mongoDB, NoSQL 요즘 많이 들리지만 아직은 낯선 데이터베이스인가요? 관계형 데이터베이스(RDS/SQL)처럼 사용하고 계시지는 않으신가요? 아무리 좋은 기술도 올바르게 사용하지 않으면 역효과가 발생합니다. 그래서 몽고디비 사용 실패 사례도 종종 보이는데요. 이 강의는 mongoDB를 최대한 mongoDB스럽게 사용할 수 있도록 기본 개념부터 실무 노하우까지 가르쳐드려요.', '김시훈', 30, 'general', '1', '0', 1, 0, 77000, 0, '2024-12-15 15:52:49'),
(28, NULL, NULL, 94, 'A0002', 'B0004', 'C0021', '/code_even/admin/upload/lecture/20241215080129159538.png', '처음하는 MongoDB(몽고DB) 와 NoSQL(빅데이터) 데이터베이스 부트캠프 [입문부터 활용까지]', '최신 스타트업에서 활용하는 풀스택과 데이터과학 기술의 기본 기술 중 하나인 빅데이터를 다룰 수 있는 NoSQL 기술을 익힙니다. 몽고DB는 NoSQL 중에서도 가장 쉬우면서 빠르게 활용할 수 있는 기술입니다. 본 강의에서는 짧은 시간 안에 몽고DB 기초를 익히고, 파이썬으로 몽고DB를 다루고 활용할 수 있는 기술까지 학습해 봅니다.', '잔재미코딩', 30, 'general', '0', '1', 1, 0, 66000, 0, '2024-12-15 16:01:29'),
(29, NULL, NULL, 2, 'A0002', 'B0004', 'C0020', '/code_even/admin/upload/lecture/20241215081100131306.png', '오라클 성능 분석과 인스턴스 튜닝 핵심 가이드', '오라클 DB 아키텍처의 내부 메커니즘을 이해하고 성능 튜닝과 성능 분석 전문가로 성장할 수 있는 핵심 가이드를 제공합니다.', '이븐선생', 90, 'general', '1', '0', 1, 0, 77000, 0, '2024-12-15 16:11:00'),
(30, NULL, NULL, 93, 'A0002', 'B0004', 'C0019', '/code_even/admin/upload/lecture/20241215082240797607.png', '다양한 사례로 익히는 SQL 데이터 분석', '다양한 실전 데이터 분석 사례를 SQL을 통해 구현해 나가면서 데이터 분석 능력과 SQL 활용 능력을 동시에 향상 시킬 수 있습니다.', '권철민', 30, 'general', '1', '0', 1, 0, 88000, 0, '2024-12-15 16:22:40'),
(31, NULL, NULL, 92, 'A0002', 'B0004', 'C0018', '/code_even/admin/upload/lecture/20241215083121150568.png', 'Real MySQL 시즌 1 - Part 1', 'MySQL의 핵심적인 기능들을 살펴보고, 실무에 효과적으로 활용하는 방법을 배울 수 있습니다. 또한, 오랫동안 관성적으로 사용하며 무심코 지나쳤던 중요한 부분들을 새롭게 이해하고, 깊이 있는 데이터베이스 지식을 얻을 수 있습니다.', '이성욱', 180, 'recipe', '0', '1', 1, 0, 44000, 0, '2024-12-15 16:31:21'),
(32, NULL, NULL, 91, 'A0002', 'B0004', 'C0017', '/code_even/admin/upload/lecture/20241215084501923054.png', '백문이불여일타-데이터 분석을 위한 기초 SQL', '누적 수강생 10,000명 이상, 풍부한 온/오프라인 강의 경험을 가진 데이터리안의 SQL 기초 강의. SQL 기초 이론을 배우고, 해커랭크 문제 10개를 함께 풀어봅니다.', '데이터리안', 30, 'general', '0', '1', 1, 0, 16500, 0, '2024-12-15 16:45:01'),
(33, NULL, NULL, 90, 'A0002', 'B0003', 'C0016', '/code_even/admin/upload/lecture/20241215090054133566.png', '대세는 쿠버네티스', '쿠버네티스는 앞으로 어플리케이션 배포/운영에 주류가 될 기술 입니다. 이 강좌를 통해 여러분도 대세에 쉽게 편승할 수 있게 됩니다.', '일프로', 30, 'general', '0', '1', 1, 0, 55000, 0, '2024-12-15 17:00:54'),
(34, NULL, NULL, 89, 'A0002', 'B0003', 'C0015', '/code_even/admin/upload/lecture/20241215152611153132.png', 'DevOps의 정석 - DevOps의 시작부터 끝까지 모두 짚어 드립니다!', '서버 없이 쓰는 서버, 구글의 Serverless BaaS(Backend as a Service) 대표 솔루션인 Cloud Functions를 이용해서 프로젝트에 사용할 수 있는 예제를 실습과 같이 배우는 과정입니다.', 'JeongSuk Lee', 180, 'recipe', '1', '0', 1, 0, 55000, 0, '2024-12-15 23:26:11'),
(35, NULL, NULL, 84, 'A0002', 'B0003', 'C0014', '/code_even/admin/upload/lecture/20241215154139175533.png', '서버 없이 쓰는 서버, 구글 Cloud Functions', '서버 없이 쓰는 서버, 구글의 Serverless BaaS(Backend as a Service) 대표 솔루션인 Cloud Functions를 이용해서 프로젝트에 사용할 수 있는 예제를 실습과 같이 배우는 과정입니다.', '노마드크리에이터', 120, 'general', '0', '1', 1, 0, 55000, 0, '2024-12-15 23:41:39'),
(36, NULL, NULL, 88, 'A0002', 'B0003', 'C0013', '/code_even/admin/upload/lecture/20241215155355784991.png', 'IT 활용자를 위한 MS Azure 2023 클라우드 서비스 입문과 실습', '마이크로소프트에서 운영하는 공용 클라우드 플랫폼인 Azure 클라우드 서비스를 학습하는 과정입니다. 클라우드 관련 기본적인 개념과 용어를 강의를 오랜 경력의 검증된 강사를 통해 수강하고 핵심 기술에 대한 강사의 시연을 최신 버전으로 전달함으로써 영상과 동일한 결과를 확인할 수 있도록 정리하였습니다.', '이상희', 60, 'general', '1', '0', 1, 0, 22000, 0, '2024-12-15 23:53:55'),
(37, NULL, NULL, 87, 'A0002', 'B0003', 'C0012', '/code_even/admin/upload/lecture/20241215160343320897.png', '쉽게 설명하는 AWS 기초 강의', 'AWS 여정을 시작하기 위해 가장 필요한 내용을 담았습니다.', 'AWS강의실', 90, 'general', '1', '0', 1, 0, 88000, 0, '2024-12-16 00:03:43'),
(38, NULL, NULL, 86, 'A0001', 'B0002', 'C0011', '/code_even/admin/upload/lecture/20241215161739199707.png', 'Node.js 교과서 - 기본부터 프로젝트 실습까지', '노드가 무엇인지부터, 자바스크립트 최신 문법, 노드의 API, npm, 모듈 시스템, 데이터베이스, 테스팅 등을 배우고 5가지 실전 예제로 프로젝트를 만들어 나갑니다. 클라우드에 서비스를 배포해보기도 하고 노드 프로젝트를 타입스크립트로 전환해도 봅니다.', '제로초', 30, 'general', '0', '1', 1, 0, 49500, 0, '2024-12-16 00:17:39'),
(39, NULL, NULL, 70, 'A0001', 'B0002', 'C0010', '/code_even/admin/upload/lecture/20241215163651215370.png', '한 입 크기로 잘라먹는 Next.js', '한입 시리즈의 3번째 작품! 세상에서 가장 친절하고 디테일 한 Next.js강의 입니다. App Router 뿐만 아니라 Page Router까지 프로젝트를 통해 살펴봅니다.', '조한결', 60, 'general', '1', '0', 1, 0, 36300, 0, '2024-12-16 00:36:51'),
(40, NULL, NULL, 76, 'A0001', 'B0002', 'C0008', '/code_even/admin/upload/lecture/20241215165253835831.png', '제대로 파는 자바 (Java)', '적당히 배워서는 살아남을 수 없는 시대. 자바, 한 번에 제대로 파서 마스터하세요!', '얄코', 180, 'recipe', '0', '1', 1, 0, 66000, 0, '2024-12-16 00:52:53'),
(41, NULL, NULL, 70, 'A0001', 'B0001', 'C0007', '/code_even/admin/upload/lecture/20241215171224171959.png', '한 입 크기로 잘라먹는 타입스크립트(TypeScript)', '문법을 넘어 동작 원리와 개념 이해까지 배워도 배워도 헷갈리는 타입스크립트 이제 제대로 배워보세요! 여러분을 타입스크립트 마법사🧙🏻‍♀️로 만들어드립니다.', '조한결', 60, 'general', '1', '0', 1, 0, 36300, 0, '2024-12-16 01:12:24'),
(43, NULL, NULL, 82, 'A0001', 'B0001', 'C0005', '/code_even/admin/upload/lecture/20241215173950214468.png', '윤재성의 Start Google Angular.js 앵귤러 과정', '본 강좌에서 Angular JS를 통해 웹 애플리케이션 Front End 개발 방법을 학습할 수 있습니다. 현재 Angular JS는 React JS와 더불어 차세대 웹 애플리케이션 개발방식으로 주목받고 있습니다.', '윤재성', 30, 'general', '1', '0', 1, 0, 22000, 0, '2024-12-16 01:39:50'),
(44, NULL, NULL, 84, 'A0001', 'B0001', 'C0005', '/code_even/admin/upload/lecture/20241215175320166135.png', 'Angular, 앵귤러 100분 핵심강의', '이 강좌는 Angular를 기반으로 간단하지만 유용한 petlist 프로젝트를 100분 핵심강의로 축약하여 짧은 시간에 실전에 활용할 수 있는 모바일 웹앱 개발역량을 키울 수 있습니다.', '노마드크리에이터', 90, 'general', '0', '1', 1, 0, 27500, 0, '2024-12-16 01:53:20'),
(45, NULL, NULL, 70, 'A0001', 'B0001', 'C0004', '/code_even/admin/upload/lecture/20241215181037931358.png', '[2024] 한입 크기로 잘라 먹는 리액트(React.js) : 기초부터 실전까지', '개념부터 독특한 프로젝트까지 함께 다뤄보며 자바스크립트와 리액트를 이 강의로 한 번에 끝내요. 학습은 짧게, 응용은 길게', '조한결', 180, 'recipe', '0', '1', 1, 0, 36300, 0, '2024-12-16 02:10:37'),
(46, NULL, NULL, 83, 'A0001', 'B0001', 'C0004', '/code_even/admin/upload/lecture/20241215182748504932.png', 'React 완벽 마스터: 기초 개념부터 린캔버스 프로젝트까지', 'React를 처음 배우시나요? 이 강의로 하나로 리액트 기초를 다지고, 린캔버스 프로젝트를 통해 실무 경험을 쌓아보세요. 그러면 자신있게 프론트엔드 개발자로 취업할 수 있어요!', '짐코딩', 30, 'general', '0', '1', 1, 0, 19800, 0, '2024-12-16 02:27:48'),
(47, NULL, NULL, 63, 'A0001', 'B0001', 'C0003', '/code_even/admin/upload/lecture/20241215194742334686.png', '퍼블리싱 핵심 이론(HTML+CSS+FLEX+JQUERY)', '코딩웍스가 다년간의 강의 노하우를 집대성한 자체제작 HTML+CSS+FLEX+JQUERY 퍼블리싱 핵심 이론서 교재. 불필요한 내용없이 딱! 필요한 핵심 내용만 정리된 최고의 퍼블리싱 이론교재. 퍼블리싱 입문을 위한 핵심 이론서 PDF 교재와 예제파일 다운로드 컨텐츠입니다.', '이정민', 30, 'general', '1', '0', 1, 0, 17600, 0, '2024-12-16 03:47:42'),
(48, NULL, NULL, 82, 'A0001', 'B0001', 'C0003', '/code_even/admin/upload/lecture/20241216200716213818.png', '윤재성의 처음 시작하는 jQuery Programming', 'JavaScript를 보다 쉽고 강력하게 사용할 수 있는 jQuery를 본 강의로 완성 할수 있습니다.', '윤재성', 60, 'general', '1', '0', 1, 0, 11000, 0, '2024-12-17 03:51:24'),
(49, NULL, 6, 81, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/20241216201632167731.png', '순수 자바스크립트 기초에서 실무까지', '이 강의는 지식공유자의 저서 <바닐라 자바스크립트>의 내용을 바탕으로 만들어진 강의입니다.', '개발자의 품격', 30, 'recipe', '0', '1', 1, 0, 52000, 0, '2024-12-17 04:16:32'),
(50, NULL, 7, 80, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/20241216203825213233.png', '자바스크립트 비기너: 튼튼한 기본 만들기', ' 자바스크립트의 근본을 이해하는데 중점을 두었습니다. 자바스크립트 스펙의 95% 이상을 다룹니다.', '김영보', 120, 'recipe', '0', '1', 1, 0, 30000, 0, '2024-12-17 04:38:25'),
(51, NULL, NULL, 79, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/20241216211045475105.png', '그림으로 배우는 HTML/CSS, 입문!', '웹 개발, 프론트엔드 첫 입문! 그림으로 쉽고 빠르게 배울 수 있어요.', '홍팍', 30, 'general', '1', '0', 1, 0, 19800, 0, '2024-12-17 05:10:45'),
(52, NULL, 8, 78, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/20241216214338103140.png', 'HTML/CSS 베이스캠프', '웹 페이지를 만들고 싶다면, HTML/CSS를 배워보세요. 웹 페이지의 구조를 정의하는 HTML과 웹 페이지의 스타일을 정의하는 CSS로 다양한 콘텐츠와 디자인을 구현할 수 있습니다.', '제주코딩베이스캠프', 90, 'general', '1', '0', 1, 0, 22000, 0, '2024-12-17 05:43:38'),
(53, NULL, 9, 77, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/20241216215849274061.png', 'HTML 배워서 뉴스 기사 조작하는 방법', ' HTML에 대해서 환경 설정부터 기초 개념, 활용, 공부 방법까지 모두 배우는 강의입니다.', '조코딩', 60, 'general', '0', '1', 1, 0, 22000, 0, '2024-12-17 05:58:49'),
(54, NULL, 10, 76, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/20241216221423214496.png', '제대로 파는 HTML CSS', 'HTML과 CSS를 쌩초보를 위한 기초부터 현업 개발자를 위한 고급 활용법과 실전 팁, 이해하기 어려웠던 이론들까지 쉽게 알아봅니다.', '얄코', 30, 'general', '1', '0', 1, 0, 44000, 0, '2024-12-17 06:14:23'),
(55, NULL, 11, 102, 'A0001', 'B0001', 'C0006', '/code_even/admin/upload/lecture/20241216222546174541.png', 'Vue.js 설치부터 포트폴리오 제작까지', '<p>🍖 레시피 강좌 🍽️</p>\r\n<p>필요한 언어재료 : HTML, CSS, javascript중급</p>\r\n<p>익힐 재료 : Vue.js</p>\r\n<p>사용할 환경: VScode</p>\r\n<br>\r\n<p>Vue.js를 모르는 초보자를 대상으로 한 강좌입니다!</p>\r\n<br>\r\n<p>기본재료 : 개발 환경설정</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; html,css와 비교한 Vue.js소개</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>인스턴스</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>컴포넌트 통신방법 (props, event emit)</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>뷰 라우터 router-view, router-link</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>axios</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>템플릿 문법1(데이터 바인딩v-bind, computed속성)</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>템플릿 문법2(method, v-on(키보드 마우스이벤트), v-if, v-show )</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>VUE CLI</p>\r\n<br>\r\n<p>고급 재료: 같은 컴포넌트 레벨간의 통신</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>템플릿 문법 - 공식문서 보고 해결하는 방법</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>watch속성 vs computed속성</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>싱글 파일 컴포넌트(SPC)개발 시작하기</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>프로젝트 구현</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>애플리케이션 구조 개선하기</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>ES6란? (const&amp;let, Enhanced Object Literals, Modules)</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>Vuex란? (metations&amp;commit, actions, 헬퍼함수)</p>', '장기효(캡틴판교)', 180, 'recipe', '0', '1', 1, 0, 44000, 0, '2024-12-17 06:25:46'),
(56, NULL, NULL, 103, 'A0001', 'B0002', 'C0009', '/code_even/admin/upload/lecture/20241216234835105060.png', '쩡원의 PHP 게시판 무작정 만들기', '<p>🍖 레시피 강좌 🍽️</p>\r\n<p>필요한 언어재료 : HTML, CSS, javascript중급</p>\r\n<p>익힐 재료 : PHP, mySQL</p>\r\n<p>사용할 환경: VScode, xampp</p>\r\n<br>\r\n<p>php를 모르는 초보자를 대상으로 한 강좌입니다!</p>\r\n\r\n<p>HTML,CSS,PHP,aphachi,MYSQL 등 게시판 홈페이지를 만드는데 필요한 사전 지식들 없이 배울수 있는 레시피 강좌입니다.</p>\r\n<p>따라하는 과정에서 전체적인 개념과 PHP에 대해서 집중적으로 학습하기 때문에</p>\r\n<p>PHP의 전반적인 흐름과 중요한 지점들을 이븐하게 익히게 됩니다.</p>\r\n<br>\r\n<p>기본재료 : 개발 환경설정 xampp</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mysql과 utf-8 소개</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>php 기초 문법</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>php 변수, 데이터타입</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>php 조건문, 반복문, 연산자, 함수</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>폼 데이터 처리</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>세션과 쿠키</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>데이터 베이스 연결</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>데이터 삽입, 조회, 수정, 삭제</p>\r\n<br>\r\n<p>고급 재료: 보안, 입력 검증</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>보안, SQL 인젝션 방지</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>보안, XSS 방지</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>보안, 고급 주제: 파일 처리</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>보안, 고급 주제: 예외 처리</p>\r\n<p><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>객체 지향 프로그래밍</p>\r\n', '쩡원', 180, 'recipe', '1', '0', 1, 0, 10000, 0, '2024-12-17 07:48:35'),
(57, NULL, 12, 4, 'A0001', 'B0001', 'C0002', '/code_even/admin/upload/lecture/20241217014353203953.png', '코딩은 처음이라 with 웹 퍼블리싱', '[코딩은 처음이라 with 웹 퍼블리싱] 책을 기반으로 제작된 강의 영상입니다. 4장 자바스크립트기초 파트입니다.', '김동주', 180, 'recipe', '0', '1', 1, 0, 50000, 0, '2024-12-17 09:06:18'),
(58, NULL, 16, 1, 'A0001', 'B0001', 'C0001', '/code_even/admin/upload/lecture/20241223020826111678.png', 'test', '강좌 설명 test', '이븐관리자', 30, 'general', '', '', 1, 0, 50000, 0, '2024-12-23 10:08:26');

-- --------------------------------------------------------

--
-- 테이블 구조 `lecture_detail`
--

CREATE TABLE `lecture_detail` (
  `id` int(11) NOT NULL COMMENT '강의 ID',
  `lecture_id` int(11) NOT NULL COMMENT '강좌 ID (외래키)',
  `title` varchar(255) NOT NULL COMMENT '강의명',
  `quiz_id` int(11) DEFAULT NULL COMMENT '퀴즈 ID (외래키)',
  `test_id` int(11) DEFAULT NULL COMMENT '시험 ID (외래키)',
  `file_id` int(11) DEFAULT NULL COMMENT '실습 파일 ID (외래키)',
  `video_url` varchar(255) DEFAULT NULL COMMENT '동영상 URL',
  `video_order` int(11) DEFAULT NULL COMMENT '강의 순서',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '생성 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `lecture_detail`
--

INSERT INTO `lecture_detail` (`id`, `lecture_id`, `title`, `quiz_id`, `test_id`, `file_id`, `video_url`, `video_order`, `created_at`) VALUES
(1, 21, '위협헌팅의 정의 및 중요성1', 5, 3, 4, 'https://youtu.be/2WH_C9SmDw0?si=Pn0VDxePyReCL3kQ', 1, '2024-12-14 17:18:47'),
(2, 21, '위협헌팅의 정의 및 중요성2', 5, 3, 5, 'https://youtu.be/4j_DxHVecr0?si=ACUsDrJN_DDtKmzv', 2, '2024-12-14 17:33:56'),
(3, 21, '위협헌팅의 정의 및 중요성3', 5, 3, 6, 'https://youtu.be/_cyzpiZJ51c?si=MNaQ128P3N2sYwvd', 3, '2024-12-14 17:42:37'),
(4, 22, '개인정보보호란?', 6, 6, 7, 'https://youtu.be/tEtelVgP628?si=VOafDrXZXgESiPYa', 1, '2024-12-14 19:14:53'),
(5, 23, 'C++가 C언어와 다른 점1', 7, 11, 8, 'https://youtu.be/JoAdRwJi-GI?si=rMrdubK85seCBbhN', 1, '2024-12-15 05:35:02'),
(6, 24, 'TCP의 특징과 옵션', 8, 14, 9, 'https://youtu.be/BWOJc7K9Jw8?si=50Y10UO8f7gdIAjl', 1, '2024-12-15 06:03:45'),
(7, 25, 'Couchbase란 무엇인가요?', 9, 17, 10, 'https://youtu.be/uBIJBmc9FWA?si=ubBwfJhLgUwZQ6lp', 1, '2024-12-15 06:16:14'),
(8, 26, '요구 사항 별 데이터 스토어(Datastore) 활용', 10, 20, 11, 'https://youtu.be/4ZnlZCbbN_A?si=mYaSD2zC3cnVnwlV', 1, '2024-12-15 06:34:37'),
(9, 27, 'MongoDB 맛보기', 11, 23, 12, 'https://youtu.be/bluQwqMgTsw?si=gyoGPPwoVea0-Z2z', 1, '2024-12-15 06:52:49'),
(10, 28, 'NoSQL 이해 ', 12, 26, 13, 'https://youtu.be/vsoAyh4D-zw?si=USkHNPCAHPHEqm6y', 1, '2024-12-15 07:01:29'),
(11, 29, '오라클 DB 관리툴과 SwingBench 소개', 13, 29, 14, 'https://youtu.be/nE7cpiJljN0?si=APzJ9KGXDtwzugjM', 1, '2024-12-15 07:11:00'),
(12, 30, '시각화 - PostgreSQL과 Pandas 연계하기', 14, 32, 15, 'https://youtu.be/dKuLA5BGPTY?si=5EbJvrD7to4i3g-m', 1, '2024-12-15 07:22:40'),
(13, 31, 'Ep.01 CHAR vs VARCHAR', 15, 35, 16, 'https://youtu.be/KLZWDOK8kZM?si=4JuWxlgVmHOtppHO', 1, '2024-12-15 07:31:21'),
(14, 32, '보고싶은 데이터 꺼내오기', 16, 38, 17, 'https://youtu.be/27IOUaUTN04?si=s6f6JlIej-HgxxuR', 1, '2024-12-15 07:45:01'),
(15, 33, '대세는 쿠버네티스 - 왜 HTML을 써야 할까?', 17, 41, 18, 'https://youtu.be/7CPFJZZF60E?si=KYBThLrFt6dTSDkU', 1, '2024-12-15 08:00:54'),
(16, 34, 'DevOps의 시작부터 끝까지! 실제 구현을 위한 핵심', 18, 44, 19, 'https://youtu.be/QAj3fsttKM4?si=5LaX0rWFEKZ_OuKv', 1, '2024-12-15 14:26:11'),
(17, 35, 'google cloud platform 완벽 정복', 19, 47, 20, 'https://youtu.be/dn9cSRImmVA?si=knh4W5D_iPGh8bf3', 1, '2024-12-15 14:41:39'),
(18, 36, 'Azure 기초 강의', 20, 50, 21, 'https://youtu.be/ouukg_TPqO8?si=wOlTu3tcELiJeA8h', 1, '2024-12-15 14:53:55'),
(19, 37, '클라우드 컴퓨팅이란?', 21, 53, 22, 'https://youtu.be/JjiYqBl2328?si=Ghy95UOKpBcS6Oox', 1, '2024-12-15 15:03:43'),
(20, 37, '클라우드 컴퓨팅의 종류', 21, 53, 23, 'https://youtu.be/s75iONF6XFw?si=7d9B1YqFaO32Vks_', 2, '2024-12-15 15:10:09'),
(21, 37, 'AWS의 구조 - 리전, 가용 영역, 엣지, 로케이션 등', 21, 53, 24, 'https://youtu.be/tvwDDM-Y-qE?si=-59lipd6lW6BPM8O', 3, '2024-12-15 15:10:09'),
(22, 38, '호출 스택 알아보기', 22, 56, 25, 'https://youtu.be/-oGCpA7pxxs?si=CsQxdoyJJJxtZOqO', 1, '2024-12-15 15:17:39'),
(23, 38, '이벤트 루프 알아보기', 22, 56, 26, 'https://youtu.be/wRPcxR1M7Uc?si=XLNA8Q8eCkBb8MiV', 2, '2024-12-15 15:24:19'),
(24, 38, 'var, const, let', 22, 56, 27, 'https://youtu.be/k3v8k520gRo?si=mGbln8Ev-RqhRdXN', 3, '2024-12-15 15:24:19'),
(25, 39, '한 입 크기로 잘라먹는 Next.js', 23, 59, 28, 'https://youtu.be/Zu4-dRywtvk?si=TImnSGX_4chWJ7w4', 1, '2024-12-15 15:36:51'),
(26, 40, '제대로 파는 자바 - Java 끝.장.내.기', 24, 62, 29, 'https://youtu.be/iN22AgS_Chk?si=jgRET3XNHXUNRiFB', 1, '2024-12-15 15:52:53'),
(27, 41, '강의 소개', 25, 65, 31, 'https://youtu.be/rkezT_AiEQM?si=_Q2B9hG7P3YbNxbF', 1, '2024-12-15 16:12:24'),
(28, 41, '타입스크립트를 소개합니다', 25, 65, 32, 'https://youtu.be/Q3cck-BRijA?si=dr9Sde2bL6hizxFi', 2, '2024-12-15 16:22:33'),
(29, 41, '타입스크립트의 동작 원리', 25, 65, 33, 'https://youtu.be/0hHHvVrS344?si=AVaNGx3rPo54rN_f', 3, '2024-12-15 16:22:33'),
(30, 41, '타입스크립트 컴파일러 옵션 설정하기', 25, 65, 34, 'https://youtu.be/D3lXa16LST4?si=JNqDhJ4vgv8BvMrC', 4, '2024-12-15 16:22:33'),
(32, 43, 'Angular js into', 26, 68, 35, 'https://youtu.be/tPCZPC3rKX0?si=MXAe5Gh2cP9u-MjP', 1, '2024-12-15 16:39:50'),
(33, 43, 'Angular js 기본 웹 서비스 개발 환경 구축', 26, 68, 36, 'https://youtu.be/ZLgGpgeyflg?si=4SGnAavFqKCv6Qrp', 2, '2024-12-15 16:46:45'),
(34, 43, 'Angular js 기본 예제 및 탬플릿 만들기', 26, 68, 37, 'https://youtu.be/fXTzokgwxm4?si=24oM2zA8LelL-poz', 3, '2024-12-15 16:46:45'),
(35, 44, 'Angular, 앵귤러 100분 핵심 강의', 27, 71, 38, 'https://youtu.be/vvJYgbXZ8kY?si=zFvyhZ27J3OujzD9', 1, '2024-12-15 16:53:20'),
(36, 45, 'React.js 감성 일기장 만들기', 28, 74, 39, 'https://youtu.be/gHb-mR7-Gh4?si=k7vaaBO3FK2HTfQM', 1, '2024-12-15 17:10:37'),
(38, 46, 'React 완벽 마스터 : 기초 개념부터 린캔버스 프로젝트까지', 29, 77, 40, 'https://youtu.be/j3wWaZYDPUc?si=m8r9BfbxiAH3FUzg', 1, '2024-12-15 17:27:48'),
(39, 46, '리엑트와 컴포넌트: 입문자를 위한 초간단 설명', 29, 77, 41, 'https://youtu.be/_8z6E17S0ok?si=p2K1hqGpQ20UK3GV', 2, '2024-12-15 18:29:46'),
(40, 47, '신박한 버튼 이펙트 만들기 01', 30, 80, 42, 'https://youtu.be/XjlRSPmr8zo?si=aH-oQv_aRYX8mVS3', 1, '2024-12-15 18:47:42'),
(41, 47, '신박한 버튼 이펙트 만들기 02', 30, 80, 43, 'https://youtu.be/gb5LQD5-KSA?si=9OCdVVnY3aQvrCqv', 2, '2024-12-15 19:03:06'),
(42, 47, '프리로더 애니메이션', 30, 80, 44, 'https://youtu.be/xcp2rffL7pk?si=Nvq00yKejp7k1FAY', 3, '2024-12-15 19:03:06'),
(43, 47, '전체화면 네비게이션 만들기', 30, 80, 45, 'https://youtu.be/eFj-Io-dc98?si=JfVqMzS-5qoLp51f', 4, '2024-12-15 19:03:06'),
(44, 48, 'jQuery 개요(jQuery summary)', 31, 83, 46, 'https://youtu.be/bwa6CP-d-UI?si=PGB5Wpn0BTrCkF4m', 1, '2024-12-16 18:51:24'),
(45, 48, '기본 선택자 조합(jQuery Default selector)', 31, 83, 47, 'https://youtu.be/JZQ7il8yZvw?si=58DNaxxl8w9Kzvch', 2, '2024-12-16 19:07:16'),
(46, 48, 'jQuery 맛보기(jQuery gustation)', 31, 83, 48, 'https://youtu.be/1G63GUEn7c8?si=LpTVr6KmZD-tZvj1', 3, '2024-12-16 19:07:16'),
(47, 49, '자바스크립트 기초 구문', 32, 87, 49, 'https://youtu.be/9kRY3APdgl0?si=9BSL7iugvMoZRfkL', 1, '2024-12-16 19:16:32'),
(48, 49, '내장 함수', 32, 87, 50, 'https://youtu.be/xNYkm1UP0x4?si=kbi7Y9RE9ctI_iXA', 2, '2024-12-16 19:30:57'),
(49, 49, '자바스크립트 고급 구문', 32, 87, 51, 'https://youtu.be/aDatP_rAbNc?si=J8QThohgPD3v3nLz', 3, '2024-12-16 19:30:57'),
(50, 49, 'DOM', 32, 87, 52, 'https://youtu.be/nmLwQyWzkXU?si=DYs4FkpDxVnq9ZZj', 4, '2024-12-16 19:30:57'),
(51, 50, 'javascript 베이스 빌드업 스텍의 변수 구분', 33, 91, 53, 'https://youtu.be/GG-ZVdIQIVc?si=CDYeSAy0D25zDQ9u', 1, '2024-12-16 19:38:25'),
(52, 50, 'javascript 베이스 빌드업 실행 콘텍트 개요', 34, 95, 54, 'https://youtu.be/u1rqJy7udJY?si=ZwfXwLPoWkOSGhVs', 2, '2024-12-16 19:59:02'),
(53, 50, 'javascript 베이스 빌드업 실행 콘텍스트의 컴포넌트 구성', 35, 99, 55, 'https://youtu.be/goiGbRzFtU0?si=w-zl4NVpfzVKc_kn', 3, '2024-12-16 19:59:02'),
(54, 51, '웹 개발, 시작하기! HTML에 대하여', 36, 103, 56, 'https://youtu.be/29UZkxe3nZU?si=iLJ7qg0fRfz1waUw', 1, '2024-12-16 20:10:45'),
(55, 51, 'CSS 기초의 모든 것', 36, 103, 57, 'https://youtu.be/H0mfQZeZTug?si=m_FzBVSTXAghk-t0', 2, '2024-12-16 20:28:30'),
(56, 52, 'HTML로 뼈대를!', 37, 107, 58, 'https://youtu.be/S1tvXn_7iq4?si=agXb9jVq_O_sXYSe', 1, '2024-12-16 20:43:38'),
(57, 52, 'CSS로 생기를!', 37, 107, 59, 'https://youtu.be/H0mfQZeZTug?si=m_FzBVSTXAghk-t0', 2, '2024-12-16 20:49:05'),
(58, 52, 'CSS를 더 깊게 파헤쳐 보자! ', 37, 107, 60, 'https://youtu.be/OCCcswzsr64?si=XsYBMN_jpmCzao08', 3, '2024-12-16 20:49:05'),
(59, 53, '개발 환경 세팅 및 HTML 기초', 38, 111, 61, 'https://youtu.be/Q9q1TyY_5k8?si=YYkfpZFRltxmyYRf', 1, '2024-12-16 20:58:49'),
(60, 53, 'HTML 태그에 대하여', 38, 111, 62, 'https://youtu.be/Q9q1TyY_5k8?si=YYkfpZFRltxmyYRf', 2, '2024-12-16 21:05:10'),
(61, 53, '활용! 뉴스 조작하기', 38, 111, 63, 'https://youtu.be/1t9nKrsdkdw?si=LxTcvsDHnB-_V_j2', 3, '2024-12-16 21:05:10'),
(62, 54, 'HTML, CSS, JavaScript가 뭔가요?', 39, 115, NULL, 'https://youtu.be/TrC2x4N0XqY?si=uxp7csx-4ewsXEvg', 1, '2024-12-16 21:14:23'),
(63, 54, '갖다 놓는 HTML', 39, 115, NULL, 'https://youtu.be/TrC2x4N0XqY?si=uxp7csx-4ewsXEvg', 2, '2024-12-16 21:19:38'),
(64, 54, '꾸미는 CSS', 39, 115, NULL, 'https://youtu.be/TrC2x4N0XqY?si=uxp7csx-4ewsXEvg', 3, '2024-12-16 21:19:38'),
(65, 55, '개발환경 설정', 40, 119, 64, 'https://youtu.be/NSeVeLLSW4w?si=u62guccsc4ei4Oxk', 1, '2024-12-16 21:25:46'),
(66, 55, 'Vue.js 소개, 인스턴스, 컴포넌트', 41, 123, 65, 'https://youtu.be/0mC7K2wOuJA?si=lroniJLep0Uxd9Yl', 2, '2024-12-16 22:36:53'),
(67, 55, '컴포넌트 통신 방법', 42, 127, 66, 'https://youtu.be/z0h-eN6Xb4o?si=7Tt85f3x02ScZ4Ir', 3, '2024-12-16 22:36:53'),
(68, 55, '라우터, 통신라이브러리', 43, 131, 67, 'https://youtu.be/2AK-UOKOSR8?si=TJe24a6sn7ethODF', 4, '2024-12-16 22:36:53'),
(69, 55, '템플릿 문법', 44, 135, 68, 'https://youtu.be/uThARZo8lKY?si=OTCswRFhLiD5GcvN', 5, '2024-12-16 22:36:53'),
(70, 55, '프로젝트 생성도구 VUE CLI', 45, 139, 69, 'https://youtu.be/YQwPII7u3jY?si=YX1epEeBkFmIsZNn', 6, '2024-12-16 22:36:53'),
(71, 55, 'SPA 예제', 46, 143, 70, 'https://youtu.be/_JZNF1z7lRk?si=U-KV2UGfW81CvbBY', 7, '2024-12-16 22:36:53'),
(72, 55, '프로젝트 소개 및 구현시작', 47, 147, 71, 'https://youtu.be/ZjCsNZ6wbsY?si=buMTkD6Xaf8Gced7', 8, '2024-12-16 22:36:53'),
(73, 55, '프로젝트 구조 개선', 48, 151, 72, 'https://youtu.be/xAIKnmmKJ8E?si=1ruEFH2LHfU5sYR4', 9, '2024-12-16 22:36:53'),
(74, 55, 'ES6란? (const&let, Enhanced Object Literals, Modules)', 49, 155, 73, 'https://youtu.be/36HrZHzPeuY?si=10RJlwjpGf7o13ZH', 10, '2024-12-16 22:36:53'),
(75, 55, 'Vuex란? (metations&commit, actions, 헬퍼함수)', 50, 159, 74, 'https://youtu.be/A3vmGPdXlyA?si=wODG5TDz63GnPmul', 11, '2024-12-16 22:36:53'),
(76, 56, '환경설정 - APM설치하기', 51, 163, NULL, 'https://youtu.be/cMHno3fykWc?si=eQmIHOiISmwqIHG2', 1, '2024-12-16 22:48:35'),
(77, 56, 'Mysql과 utf-8 소개', 52, 167, NULL, 'https://youtu.be/dzo6Zj3Zm-Q?si=qpzdAYEuYCN6B8rt', 2, '2024-12-16 23:30:45'),
(78, 56, 'PHP 기초', 53, 171, 75, 'https://youtu.be/n1DU4JiCVGY?si=FPRe2YooOybtODrc', 3, '2024-12-16 23:30:45'),
(79, 56, '회원가입 페이지', 54, 175, 76, 'https://youtu.be/J1Xr7mLL4NY?si=WIlHwBdTvU6l6_QM', 4, '2024-12-16 23:30:45'),
(80, 56, 'set cookie md-5암호화', 55, 179, 77, 'https://youtu.be/931WZXtWdJA?si=my-fUfmURSiECvqJ', 5, '2024-12-16 23:30:45'),
(81, 56, 'CSS Style Sheet작성', 56, 183, 78, 'https://youtu.be/hte5N5I9hyQ?si=w6HWbKC6JHi0-DnO', 6, '2024-12-16 23:30:45'),
(82, 56, 'PHP 심화', 57, 187, 79, 'https://youtu.be/k89VwWUqBzo?si=-3WIwbxndIW85DzJ', 7, '2024-12-16 23:30:45'),
(83, 56, '게시판 만들기 - 리스트 생성, 글쓰기, 페이지 처리', 58, 191, 80, 'https://youtu.be/gAwKiClVcpo?si=7stync21ZJAG38bp', 8, '2024-12-16 23:30:45'),
(84, 56, '게시판 만들기 - 이미지 업로드', 59, 195, 81, 'https://youtu.be/Ww1lvV_djwc?si=h8bc4t4KcziSX74t', 9, '2024-12-16 23:30:45'),
(85, 56, '게시판 만들기 - 프로그래밍 set cook', 60, 199, 82, 'https://youtu.be/OVbn43aC9s0?si=4pwPuAjJMsIn4EX8', 10, '2024-12-16 23:30:45'),
(86, 56, '게시판 만들기 - 마무리', 61, 203, NULL, 'https://youtu.be/kprea_GsKzE?si=i2ED4DTjyn0Ltfcs', 11, '2024-12-16 23:30:45'),
(87, 57, '자바스크립트 실행 방법', 62, 207, NULL, 'https://youtu.be/UALtgO5aI8Y?si=nVzGVvkgXYRwIF1j', 1, '2024-12-17 00:06:18'),
(88, 57, 'JavaScript 변수 생성 방법', 63, 211, 83, 'https://youtu.be/zxhA_272NxE?si=2nyprQDGw0inPb_a', 2, '2024-12-17 00:25:42'),
(89, 57, 'JavaScript 변수 타입, 산술 연산자', 64, 215, 84, 'https://youtu.be/QKoqf0VnAYg?si=lEO_IFK34LvtI0zp', 3, '2024-12-17 00:25:42'),
(90, 57, 'JavaScript 함수 생성, 구조, 지역 변수, 전역 변수', 65, 219, 85, 'https://youtu.be/fSHYn5OBems?si=PffXL2GrWRoPylFm', 4, '2024-12-17 00:25:42'),
(91, 57, 'JavaScript 함수 종류, 즉시 실행 함수', 66, 223, 86, 'https://youtu.be/dAnT4TOPIJs?si=LzsVVgs5N-LjTarb', 5, '2024-12-17 00:25:42'),
(92, 58, '', NULL, NULL, NULL, '', 1, '2024-12-23 01:08:26');

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
(3, 17, 1, 'lecture_detail.sql', '/uploads/files/lecture_detail.sql', '', '2024-11-19 16:14:24'),
(4, 1, 101, '1734198157_675dc38d5c4fc_security.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_security.php', 'application/octet-stream', '2024-12-14 17:33:56'),
(5, 2, 101, '1734198157_675dc38d5c4fc_security.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_security.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(6, 3, 101, '1734198157_675dc38d5c4fc_security.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_security.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(7, 4, 100, '1734197636_675dc184edafd_CPPG.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_CPPG.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(8, 5, 99, '1734197636_675dc184edafd_C,C++.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_C,C++.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(9, 6, 98, '1734197636_675dc184edafd_TCP,IP.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_TCP,IP.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(10, 7, 97, '1734197636_675dc184edafd_Cou chbase.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Cou chbase.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(11, 8, 96, '1734197636_675dc184edafd_Cassandra.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Cassandra.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(12, 9, 95, '1734197636_675dc184edafd_MongoDB.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_MongoDB.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(13, 10, 94, '1734197636_675dc184edafd_NoSQL.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_NoSQL.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(14, 11, 93, '1734197636_675dc184edafd_Oracle.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Oracle.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(15, 12, 93, '1734197636_675dc184edafd_PostgreSQL.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_PostgreSQL.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(16, 13, 92, '1734197636_675dc184edafd_MySQL.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_MySQL.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(17, 14, 91, '1734197636_675dc184edafd_SQL.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_SQL.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(18, 15, 90, '1734197636_675dc184edafd_Kubernetes.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Kubernetes.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(19, 16, 89, '1734197636_675dc184edafd_Devops.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Devops.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(20, 17, 84, '1734197636_675dc184edafd_Google_cloud_platform.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Google_cloud_platform.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(21, 18, 88, '1734197636_675dc184edafd_Azure.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Azure.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(22, 19, 87, '1734197636_675dc184edafd_AWS.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_AWS.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(23, 20, 87, '1734197636_675dc184edafd_AWS2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_AWS2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(24, 21, 87, '1734197636_675dc184edafd_AWS3.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_AWS3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(25, 22, 86, '1734197636_675dc184edafd_Node_js.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Node_js.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(26, 23, 86, '1734197636_675dc184edafd_Node_js2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Node_js2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(27, 24, 86, '1734197636_675dc184edafd_Node_js3.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Node_js3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(28, 25, 70, '1734197636_675dc184edafd_Next_js.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Next_js.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(29, 26, 76, '1734197636_675dc184edafd_Java.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Java.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(31, 27, 70, '1734197636_675dc184edafd_Typescript.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Typescript.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(32, 28, 70, '1734197636_675dc184edafd_Typescript2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Typescript2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(33, 29, 70, '1734197636_675dc184edafd_Typescript3.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Typescript3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(34, 30, 70, '1734197636_675dc184edafd_Typescript4.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Typescript4.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(35, 32, 82, '1734197636_675dc184edafd_Angular.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Angular.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(36, 33, 82, '1734197636_675dc184edafd_Angular2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Angular2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(37, 34, 82, '1734197636_675dc184edafd_Angular3.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Angular3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(38, 35, 84, '1734197636_675dc184edafd_Angular4.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Angular4.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(39, 36, 70, '1734197636_675dc184edafd_React1.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_React1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(40, 38, 83, '1734197636_675dc184edafd_React2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_React2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(41, 39, 83, '1734197636_675dc184edafd_React3.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_React3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(42, 40, 75, '1734197636_675dc184edafd_Jquery_button_effect1.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Jquery_button_effect1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(43, 41, 75, '1734197636_675dc184edafd_Jquery_button_effect2.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Jquery_button_effect2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(44, 42, 75, '1734197636_675dc184edafd_Jquery_loader.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Jquery_Jquery_loader.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(45, 43, 75, '1734197636_675dc184edafd_Jquery_full.php', '/code_even/admin/upload/lecture/files/1734197636_675dc184edafd_Jquery_Jquery_full.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(46, 44, 82, '1734198157_675dc38d5c4fc_Jquery1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_Jquery1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(47, 45, 82, '1734198157_675dc38d5c4fc_Jquery1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_Jquery1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(48, 46, 82, '1734198157_675dc38d5c4fc_Jquery1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_Jquery1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(49, 47, 81, '1734198157_675dc38d5c4fc_js1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_js1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(50, 48, 81, '1734198157_675dc38d5c4fc_js2.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_js2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(51, 49, 81, '1734198157_675dc38d5c4fc_js3.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_js3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(52, 50, 81, '1734198157_675dc38d5c4fc_js4.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_js4.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(53, 51, 80, '1734198157_675dc38d5c4fc_1-js-variable-scope.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_1-js-variable-scope.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(54, 52, 80, '1734198157_675dc38d5c4fc_2-js-execution-context.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_2-js-execution-context.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(55, 53, 80, '1734198157_675dc38d5c4fc_3-js-context-components.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_3-js-context-components.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(56, 54, 79, '1734198157_675dc38d5c4fc_HTML1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_HTML1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(57, 55, 79, '1734198157_675dc38d5c4fc_CSS1.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_CSS1.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(58, 56, 78, '1734198157_675dc38d5c4fc_HTML2.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_HTML2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(59, 57, 78, '1734198157_675dc38d5c4fc_CSS2.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_CSS2.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(60, 58, 78, '1734198157_675dc38d5c4fc_CSS3.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_CSS3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(61, 59, 77, '1734198157_675dc38d5c4fc_HTML3.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_HTML3.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(62, 60, 77, '1734198157_675dc38d5c4fc_HTML4.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_HTML4.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(63, 61, 77, '1734198157_675dc38d5c4fc_CSS4.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_CSS4.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(64, 65, 102, '1734198157_675dc38d5c4fc_1-vue-setup.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_1-vue-setup.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(65, 66, 102, '1734198157_675dc38d5c4fc_2-vue-intro.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_2-vue-intro.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(66, 67, 102, '1734198157_675dc38d5c4fc_3-vue-communication.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_3-vue-communication.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(67, 68, 102, '1734198157_675dc38d5c4fc_4-vue-router.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_4-vue-router.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(68, 69, 102, '1734198157_675dc38d5c4fc_5-vue-template.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_5-vue-template.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(69, 70, 102, '1734198157_675dc38d5c4fc_6-vue-cli.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_6-vue-cli.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(70, 71, 102, '1734198157_675dc38d5c4fc_7-spa-example.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_7-spa-example.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(71, 72, 102, '1734198157_675dc38d5c4fc_8-project-introduction.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_8-project-introduction.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(72, 73, 102, '1734198157_675dc38d5c4fc_9-project-structure.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_9-project-structure.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(73, 74, 102, '1734198157_675dc38d5c4fc_10-es6.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_10-es6.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(74, 75, 102, '1734198157_675dc38d5c4fc_11-vuex.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_11-vuex.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(75, 78, 103, '1734198157_675dc38d5c4fc_3-php-basics.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_3-php-basics.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(76, 79, 103, '1734198157_675dc38d5c4fc_4-registration.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_4-registration.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(77, 80, 103, '1734198157_675dc38d5c4fc_5-set-cookie.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_5-set-cookie.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(78, 81, 103, '1734198157_675dc38d5c4fc_6-css-stylesheet.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_6-css-stylesheet.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(79, 82, 103, '1734198157_675dc38d5c4fc_7-php-advanced.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_7-php-advanced.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(80, 83, 103, '1734198157_675dc38d5c4fc_8-bulletin-board.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_8-bulletin-board.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(81, 84, 103, '1734198157_675dc38d5c4fc_9-image-upload.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_9-image-upload.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(82, 85, 103, '1734198157_675dc38d5c4fc_10-set-cookie-example.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_10-set-cookie-example.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(83, 88, 4, '1734198157_675dc38d5c4fc_2-variable-creation.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_2-variable-creation.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(84, 89, 4, '1734198157_675dc38d5c4fc_3-variable-type-operators.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_3-variable-type-operators.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(85, 90, 4, '1734198157_675dc38d5c4fc_4-function-scope.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_4-function-scope.php', 'application/octet-stream', '2024-12-14 17:42:37'),
(86, 91, 4, '1734198157_675dc38d5c4fc_5-function-types.php', '/code_even/admin/upload/lecture/files/1734198157_675dc38d5c4fc_5-function-types.php', 'application/octet-stream', '2024-12-14 17:42:37');

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
(1, 1, 1, 'txt', '대시보드', NULL),
(2, 1, 1, 'img', NULL, 'manual1_1_dashboard.png'),
(3, 20, 1, 'txt', '1번 대쉬보드좌측메뉴에서 모든걸 보실 수 있습니다.', NULL),
(4, 20, 1, 'img', NULL, 'manual_t1_1_dashboard.png'),
(5, 1, 2, 'img', NULL, 'manual2_1_category.png'),
(6, 1, 3, 'img', NULL, 'manual3_1_lecture.png'),
(7, 1, 4, 'img', NULL, 'manual4_1_book.png'),
(8, 1, 5, 'img', NULL, 'manual5_1_users.png'),
(9, 1, 6, 'img', NULL, 'manual6_1_teachers.png'),
(10, 1, 7, 'img', NULL, 'manual7_1_students.png'),
(11, 1, 8, 'img', NULL, 'manual8_1_orders.png'),
(12, 1, 9, 'img', NULL, 'manual9_1_coupons.png'),
(13, 1, 10, 'img', NULL, 'manual10_1_sales.png'),
(14, 1, 11, 'img', NULL, 'manual11_1_notice.png'),
(15, 1, 12, 'img', NULL, 'manual12_1_community.png'),
(16, 1, 13, 'img', NULL, 'manual13_1_setting.png'),
(17, 1, 14, 'img', NULL, 'manual14_1_profile.png'),
(18, 1, 1, 'txt', '<p>LMS(Learning Management System)는 학습의 전반적 과정을 통합적으로 운영 관리 할 수 있는 학습관리 시스템 입니다.</p>\r\n\r\n<p>CODE EVEN은 강사와 학생을 관리, 강의 업로드 및 수강생의 진행 상황을 추적할 수 있는 기능을 포함하고 있습니다.</p>', NULL),
(19, 1, 1, 'img', '', 'manual1_2_dashboard.png'),
(20, 1, 1, 'txt', '<p>Dashboard 주요 기능 설명</p>\r\n<p>1.현재 운영되고 있는 모든 강좌와 교재, 매출 및 통계 등 LMS 이용에 필요한 모든 카테고리 메뉴입니다.</p>\r\n<p>2.종모양아이콘은 중요 알림의 갯수를 알려줍니다. 클릭해서 현재 확인해야할 긴급한 알림의 리스트를 확인할 수 있습니다. </p>\r\n<p>3.프로필 사진을 클릭하면 프로필 수정으로 이동합니다. 혹은 프로필사진 옆의 아래 삼각형을 눌러서 프로필로 이동합니다.</p>\r\n<p>\r\n4,5,6,7,8. 운영하면서 필요한 주요사항을 상단 알림으로 안내해드립니다.\r\n</p>\r\n<p>\r\n4. 그 달의 수익 금액을 확인 할 수 있습니다.\r\n</p>', NULL);

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
  `fix` tinyint(4) DEFAULT 0 COMMENT '상단고정 (고정=1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `notice`
--

INSERT INTO `notice` (`ntid`, `uid`, `title`, `content`, `view`, `regdate`, `fix`) VALUES
(1, 1, '[공지] 서비스 점검 안내', '안녕하세요. 서비스 점검이 예정되어 있습니다. 점검 시간은 11월 18일부터 11월 19일까지입니다. 양해 부탁드립니다.', 87, '2024-11-16', 0),
(2, 1, '[공지] 개인정보 처리방침 변경', '개인정보 처리방침이 일부 수정되었습니다. 변경된 내용은 홈페이지에서 확인할 수 있습니다.', 14, '2024-11-16', 1),
(3, 1, '[공지] 신규 강의 추가 안내', '새로운 강의가 추가되었습니다. \"프로그래밍 입문\" 강의를 확인해보세요!', 9, '2024-11-16', 0),
(4, 1, '[공지] 사이트 보안 업데이트', '사이트 보안 강화를 위한 업데이트가 진행됩니다. 업데이트 기간 동안 일부 기능이 제한될 수 있습니다.', 3, '2024-11-17', 0),
(5, 1, '[공지] 서버 점검 안내', '서버 점검 작업이 예정되어 있습니다. 점검 시간은 11월 20일 오후 3시부터 5시까지입니다.', 88, '2024-11-17', 0),
(6, 1, '[공지] 이메일 인증 시스템 변경', '이메일 인증 방식이 변경되었습니다. 새 시스템에 따라 인증을 진행해주세요.', 31, '2024-11-18', 0),
(7, 1, '[공지] 로그인 오류 수정', '일부 사용자에서 발생한 로그인 오류가 수정되었습니다. 이제 정상적으로 로그인하실 수 있습니다.', 88, '2024-11-18', 1),
(8, 1, '[공지] 강의 자료 다운로드 오류', '강의 자료 다운로드에 오류가 발생했습니다. 빠른 시일 내에 해결할 예정입니다.', 48, '2024-11-19', 0),
(9, 1, '[공지] 모바일 앱 업데이트 안내', '모바일 앱의 새로운 버전이 출시되었습니다. 최신 버전으로 업데이트하여 더 나은 서비스를 이용해 주세요.', 74, '2024-11-19', 0),
(10, 1, '[공지] 강의 일정 변경 안내', '일부 강의 일정이 변경되었습니다. 변경된 강의 일정을 확인해주세요.', 28, '2024-11-19', 0),
(11, 1, '[공지] 회원가입 절차 변경', '회원가입 절차가 일부 변경되었습니다. 신규 회원은 변경된 절차에 따라 가입을 진행해주세요.', 17, '2024-11-20', 0),
(12, 1, '[공지] 과제 제출 마감일 연장', '과제 제출 마감일이 11월 25일로 연장되었습니다. 기한 내에 제출해 주세요.', 100, '2024-11-20', 0),
(13, 1, '[공지] 사이트 이용 약관 변경', '사이트 이용 약관이 업데이트되었습니다. 변경된 사항을 확인하시기 바랍니다.', 49, '2024-11-21', 0),
(14, 1, '[공지] 결제 시스템 점검 안내', '결제 시스템 점검이 예정되어 있습니다. 점검 시간 동안 결제가 불가능할 수 있습니다.', 46, '2024-11-21', 0),
(15, 1, '[공지] 신규 기능 추가 안내', '새로운 기능이 추가되었습니다. \"자동 과제 제출\" 기능을 확인해보세요.', 79, '2024-11-22', 0),
(16, 1, '[공지] 개인정보 보호 정책 업데이트', '개인정보 보호 정책이 업데이트되었습니다. 정책 변경 사항을 확인해 주세요.', 60, '2024-11-22', 0),
(17, 1, '[공지] 로그인 인증 강화', '로그인 인증 절차가 강화되었습니다. 이제 2단계 인증을 사용하여 보안을 강화해주세요.', 60, '2024-11-23', 0),
(18, 1, '[공지] 강의 리뷰 기능 추가', '강의 리뷰 기능이 추가되었습니다. 강의를 수강한 후 리뷰를 남겨주세요!', 21, '2024-11-23', 0),
(19, 1, '[공지] 사이트 장애 발생 안내', '사이트에서 장애가 발생하여 일부 기능이 불안정합니다. 빠르게 복구 중이니 양해 부탁드립니다.', 22, '2024-11-24', 0),
(20, 1, '[공지] 설문 조사 참여 요청', '회원님들의 의견을 듣기 위해 설문 조사를 진행합니다. 참여 부탁드립니다!', 48, '2024-11-24', 0),
(21, 1, '[공지] 시스템 긴급 점검 완료', '긴급 점검 작업이 완료되었습니다. 불편을 끼쳐드려 죄송합니다.', 73, '2024-11-24', 0),
(22, 1, '[공지] 새로운 강의 커리큘럼 소개', '강의 커리큘럼이 업데이트되었습니다. 신규 커리큘럼을 확인해보세요.', 22, '2024-11-25', 0),
(23, 1, '[공지] 다크 모드 기능 추가', '사용자 편의를 위해 다크 모드 기능이 추가되었습니다. 설정에서 활성화해보세요.', 90, '2024-11-25', 0),
(24, 1, '[공지] 강의 취소 규정 변경', '강의 취소 관련 규정이 변경되었습니다. 자세한 내용은 공지사항을 참고해 주세요.', 84, '2024-11-25', 0),
(25, 1, '[공지] 주말 고객센터 운영시간 변경', '주말 고객센터 운영시간이 변경되었습니다. 새로운 운영시간은 오전 10시부터 오후 4시입니다.', 48, '2024-11-26', 0),
(26, 1, '[공지] 회원 등급 제도 도입', '회원 등급 제도가 새롭게 도입되었습니다. 자세한 등급별 혜택은 홈페이지에서 확인해 주세요.', 86, '2024-11-26', 0),
(27, 1, '[공지] 사이트 정기 점검 안내', '사이트 정기 점검이 예정되어 있습니다. 점검 시간 동안 서비스 이용이 제한될 수 있습니다.', 88, '2024-11-27', 0),
(28, 1, '[공지] 쿠폰 발급 이벤트', '모든 회원님께 특별 쿠폰을 발급해드립니다. 자세한 내용은 이벤트 페이지를 참고하세요.', 80, '2024-11-27', 0),
(29, 1, '[공지] 강의 평점 제도 도입', '강의 평점 제도가 추가되었습니다. 수강 완료 후 강의에 평점을 남겨주세요.', 37, '2024-11-28', 1),
(30, 1, '[공지] 연말 맞이 감사 이벤트', '연말을 맞아 감사 이벤트를 진행합니다. 풍성한 혜택을 놓치지 마세요!', 45, '2024-11-28', 0),
(31, 1, '[공지] 연말 서버 점검 안내', '연말 서버 점검이 예정되어 있습니다. 이용에 참고해 주세요.', 11, '2024-11-28', 0),
(32, 1, '[공지] 강의 할인 프로모션', '한정 기간 동안 강의 할인 프로모션을 진행합니다. 자세한 내용은 공지사항을 확인하세요.', 23, '2024-11-29', 0),
(33, 1, '[공지] 회원 정보 업데이트 요청', '회원님의 정보가 오래되었습니다. 업데이트 부탁드립니다.', 78, '2024-11-29', 0),
(34, 1, '[공지] 사이트 새 기능 미리보기', '새롭게 도입될 기능을 미리 확인하세요. 테스트 참여 환영합니다.', 24, '2024-11-30', 0),
(35, 1, '[공지] 강의 퀴즈 도입 안내', '강의 퀴즈 기능이 추가되었습니다. 학습 후 퀴즈를 통해 실력을 확인해 보세요.', 84, '2024-11-30', 0),
(36, 1, '[공지] 사이트 접근 제한 안내', '일부 국가에서 사이트 접근이 제한될 수 있습니다. 양해 부탁드립니다.', 46, '2024-12-01', 0),
(37, 1, '[공지] 연말 강의 결산 이벤트', '2024년 한 해 동안 인기 있었던 강의를 확인하고 할인받으세요.', 80, '2024-12-01', 0),
(38, 1, '[공지] 실시간 채팅 지원 시작', '강의 관련 질문을 실시간으로 문의할 수 있는 채팅 기능이 추가되었습니다.', 59, '2024-12-02', 0),
(39, 1, '[공지] 강의 종료 일정 공지', '일부 강의의 종료 일정이 발표되었습니다. 마감 전에 수강해 주세요.', 57, '2024-12-02', 0),
(40, 1, '[공지] 멘토링 프로그램 신청 안내', '강사와 1:1 멘토링 프로그램을 이용해 보세요. 신청은 한정되어 있습니다.', 7, '2024-12-03', 0),
(41, 1, '[공지] 데이터베이스 유지보수 공지', '데이터베이스 유지보수 작업으로 인해 일시적으로 서비스가 중단될 수 있습니다.', 63, '2024-12-03', 0),
(42, 1, '[공지] 학습 성취도 분석 서비스', '학습 성취도를 분석하여 맞춤형 강의를 추천해 드립니다.', 92, '2024-12-04', 0),
(43, 1, '[공지] 모바일 앱 오류 수정', '모바일 앱에서 발생한 오류가 수정되었습니다. 최신 버전을 다운로드하세요.', 70, '2024-12-04', 0),
(44, 1, '[공지] 신규 회원 혜택 안내', '신규 회원 가입 시 특별 혜택을 제공합니다. 지금 바로 가입하세요.', 76, '2024-12-05', 0),
(45, 1, '[공지] 시스템 최적화 작업', '더 나은 서비스를 위해 시스템 최적화 작업이 진행됩니다.', 70, '2024-12-05', 0),
(46, 1, '[공지] 강의 자료 업데이트', '강의 자료가 최신 내용으로 업데이트되었습니다. 확인 부탁드립니다.', 20, '2024-12-06', 0),
(47, 1, '[공지] 강사 채용 공고', '새로운 강사를 모집 중입니다. 지원을 희망하시는 분은 홈페이지를 확인하세요.', 90, '2024-12-06', 0),
(48, 1, '[공지] 강의 Q&A 게시판 추가', '강의와 관련된 질문을 올릴 수 있는 Q&A 게시판이 새로 추가되었습니다.', 91, '2024-12-07', 0),
(49, 1, '[공지] 학습 기록 다운로드 제공', '이제 학습 기록을 PDF로 다운로드할 수 있습니다. 학습 진도를 관리해 보세요.', 84, '2024-12-07', 0),
(50, 1, '[공지] VIP 회원 초대 이벤트', 'VIP 회원 전용 초대 이벤트가 진행 중입니다. 초대장을 확인해 주세요.', 45, '2024-12-08', 0),
(51, 1, '[공지] 강의 영상 화질 개선', '강의 영상 화질이 개선되었습니다. 더욱 선명한 화질로 학습하세요.', 75, '2024-12-08', 0),
(52, 1, '[공지] 사용자 피드백 요청', '서비스 개선을 위해 사용자 피드백을 수집하고 있습니다. 참여 부탁드립니다.', 39, '2024-12-09', 0),
(53, 1, '[공지] 출석 체크 이벤트', '매일 출석 체크하고 포인트를 받으세요!', 71, '2024-12-09', 0),
(54, 1, '[공지] 새해맞이 프로모션', '새해를 맞아 전 강의 30% 할인 이벤트를 진행합니다.', 36, '2024-12-10', 0),
(55, 1, '[공지] 강의 평가 시스템 업데이트', '강의 평가 시스템이 개선되었습니다. 보다 쉽게 의견을 남겨보세요.', 64, '2024-12-10', 0),
(56, 1, '[공지] 비밀번호 보안 강화 요청', '회원님의 계정 보안을 위해 비밀번호를 업데이트해 주세요.', 15, '2024-12-11', 0),
(57, 1, '[공지] 강의 추천 알고리즘 개선', '강의 추천 시스템이 개선되었습니다. 개인 맞춤형 추천을 확인하세요.', 82, '2024-12-11', 0),
(58, 1, '[공지] 학습 목표 설정 기능', '이제 학습 목표를 설정하고 달성도를 확인할 수 있습니다.', 63, '2024-12-12', 0),
(59, 1, '[공지] 연말 강사 감사 이벤트', '올해를 빛낸 강사님들께 감사의 인사를 전하세요!', 71, '2024-12-12', 0),
(60, 1, '[공지] 서비스 약관 변경 안내', '서비스 약관이 업데이트되었습니다. 변경된 내용은 공지사항에서 확인하세요.', 66, '2024-12-13', 0);

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
(21, 3, 63800.00, 2970.00, 60830.00, '그림으로 배우는 HTML/CSS, 입문!', '2024-12-23 08:06:48', -1, 0, '이븐학생', 11000, '서울시 영등포구', '여의도 한강공원', '', '010-1234-56', NULL);

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
(38, 21, NULL, 52, 'HTML/CSS 베이스캠프', 22000.00, NULL, 8, 'HTML&CSS 마스터북', 22000.00, 0);

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
(2, 3, 'B', 1, '앗싸 세일~', '2024-11-11 19:18:06'),
(3, 9, 'C', 11, '어느 분야든 첫 술에 배부를 수는 없다고 생각해요.\r\n취업이 목표이시라면 목표로 하는 기업을 정하시거나\r\n조금 더 나아가서는 본인에게 맞는 언어를 정해서 공부를 하시고 그 언어에 맞는 회사를 찾아보시는게 좋다고 생각해요', '2024-12-18 16:29:40'),
(4, 28, 'C', 11, '\'연구자\'님이 어떤 쪽에 더 관심 있으신지 모르지만\r\n사람인이나 잡코리아 등에서 나온 회사공고를 확인해보시면\r\n어떤 언어를 엮어서 공부하면 좋을 지 좀 더 감이 오실 것 같습니다.', '2024-12-18 16:29:27'),
(5, 18, 'T', 25, '오픈카톡으로 챗 드렸습니다!', '2024-12-19 21:49:57');

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
(5, 101, 'A0003', 'B0006', 'C0028', 'Wazuh+ELK(SIEM)를 활용한 위협헌팅(Threat Hunting) 시스템 구축 및 운영실습', 'security 퀴즈', '1', 'OTP(One Time Password)와 HSM(Hardware Security Module)에 대한 설명으로 틀린 것은?', '[\"OTP는 공개키를 사용한다.\",\"OTP는 PKI를 개변 연동한다.\",\"HSM의 안정성 인증 적용 표준은 FIPS 140-2 이다.\",\"HSM은 공개키를 사용한다.\"]', 'otp : 해시,대칭키 암호를 사용한다.', 0),
(6, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 퀴즈', '4', '전통적으로 사회복지의 개념형성에 영향을 끼친 것으로서 거리가 먼 것은?', '[\"사회 문제\",\"사회적 욕구\",\"사회적 위험\",\"사회적 투자\"]', '없음', 0),
(7, 99, 'A0003', 'B0005', 'C0026', 'C개발자를 위한 최소한의 C++', 'C/C++ 퀴즈', '3', 'C++에서 main( ) 함수에 대한 설명 중 틀린 것은?', '[\"C++ 표준에서 정한 main( ) 함수의 리턴 타입은 int이다\",\"void main( )으로 작성해도 대부분의 컴파일러에서는 처리된다.\",\"main( ) 함수는 반드시 return 문을 가지고 있어야 한다.\",\"main( ) 함수는 반드시 정수 0을 리턴할 필요가 없다.\"]', 'int main( ) 함수는 정수를 리턴하는 return 문이 필요합니다 그러나 개발자의 편의를 위해 C++ 표준에서 main( ) 함수에 대해서만 예외적으로 return 문을 생략할 수 있습니다,', 0),
(8, 98, 'A0003', 'B0005', 'C0025', 'C# TCP/IP 소켓 프로그래밍', 'TCP/IP 퀴즈', '2', '고정 IP방식에 의한 TCP/IP 설정 시 반드시 지정해야 할 정보가 아닌 것은?', '[\"DNS 서버\",\"WINS 서버\",\"설치된 게이트웨이(Gateway)\",\"IP 주소\"]', 'WINS 서버란 윈도우 운영체제에서 각각의 컴퓨터 이름을 나타내는 것으로써 윈도우 운영체제가 아닐경우 설정하지 않기 때문에 반드시 지정해야 할 필요는 없습니다.', 0),
(9, 97, 'A0002', 'B0004', 'C0024', 'Couchbase 알아보기', 'Couchbase 퀴즈', '2', '고정 IP방식에 의한 TCP/IP 설정 시 반드시 지정해야 할 정보가 아닌 것은?', '[\"DNS 서버\",\"WINS 서버\",\"설치된 게이트웨이(Gateway)\",\"IP 주소\"]', 'WINS 서버란 윈도우 운영체제에서 각각의 컴퓨터 이름을 나타내는 것으로써 윈도우 운영체제가 아닐경우 설정하지 않기 때문에 반드시 지정해야 할 필요는 없습니다.', 0),
(10, 96, 'A0002', 'B0004', 'C0023', 'Amazon Keyspaces를 통한 고성능 Cassandra DB 운영하기', 'Cassandra 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(11, 95, 'A0002', 'B0004', 'C0022', 'mongoDB 기초부터 실무까지(feat. Node.js)', 'MongoDB 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(12, 94, 'A0002', 'B0004', 'C0021', '처음하는 MongoDB(몽고DB) 와 NoSQL(빅데이터) 데이터베이스 부트캠프 [입문부터 활용까지]', 'NoSQL 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(13, 93, 'A0002', 'B0004', 'C0020', '오라클 성능 분석과 인스턴스 튜닝 핵심 가이드', 'Oracle 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(14, 93, 'A0002', 'B0004', 'C0019', '다양한 사례로 익히는 SQL 데이터 분석', 'PostgreSQL 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(15, 92, 'A0002', 'B0004', 'C0018', 'Real MySQL 시즌 1 - Part 1', 'MySQL 퀴즈', '2', '특정 테이블에서 사원칼럼, 부서칼럼만 추출하는 경우에 DISK I/O를 경감할 수 있는 반정규화 방법은 무엇인가?', '[\"수평 분할\",\"수직 분할\",\"중복 테이블 추가\",\"수직 및 수평 분할 수행\"]', '수직 분할은 특정 칼럼 단위로 테이블을 분할하여 디스크 I/O(Input/Output)을 줄일 수 있는 방법이다.', 0),
(16, 91, 'A0002', 'B0004', 'C0017', '백문이불여일타-데이터 분석을 위한 기초 SQL', 'SQL 퀴즈', '4', '다음 보기 중 ERD에서 Relationship(관계)에 표시되지 않는 것은 무엇인가?', '[\"관계 명 (Relationship Membership)\",\"관계 차수 (Relationship Degree\\/Cardinality)\",\"관계 선택 사양 (Relationship Optionality)\",\"관계 분류 (Relationship Classification)\"]', '없음', 0),
(17, 90, 'A0002', 'B0003', 'C0016', '대세는 쿠버네티스', 'Kubernetes 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(18, 89, 'A0002', 'B0003', 'C0015', 'DevOps의 정석 - DevOps의 시작부터 끝까지 모두 짚어 드립니다!', 'Devops 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(19, 84, 'A0002', 'B0003', 'C0014', '서버 없이 쓰는 서버, 구글 Cloud Functions', 'Google cloud platform 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(20, 88, 'A0002', 'B0003', 'C0013', 'IT 활용자를 위한 MS Azure 2023 클라우드 서비스 입문과 실습', 'Azure 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(21, 87, 'A0002', 'B0003', 'C0012', '쉽게 설명하는 AWS 기초 강의', 'AWS 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(22, 86, 'A0001', 'B0002', 'C0011', 'Node.js 교과서 - 기본부터 프로젝트 실습까지', 'Node.js 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(23, 70, 'A0001', 'B0002', 'C0010', '한 입 크기로 잘라먹는 Next.js', 'Next.js 퀴즈', '2', 'Next.js에서 getStaticProps 함수의 주요 목적은 무엇인가요?', '[\"클라이언트 측에서 데이터를 가져오기 위해\",\"빌드 시에 정적인 페이지를 생성하기 위해\",\"서버 측에서 실시간으로 데이터를 가져오기 위해\",\"라우팅을 처리하기 위해\"]', 'getStaticProps는 빌드 시에 데이터를 가져와 정적 페이지를 생성하는 데 사용됩니다. 이 함수는 페이지를 미리 렌더링하여 빠른 로딩 속도를 제공합니다.', 0),
(24, 76, 'A0001', 'B0002', 'C0008', '제대로 파는 자바 (Java)', 'Java 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(25, 70, 'A0001', 'B0001', 'C0007', '한 입 크기로 잘라먹는 타입스크립트(TypeScript)', 'Typescript 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(26, 82, 'A0001', 'B0001', 'C0005', '윤재성의 Start Google Angular.js 앵귤러 과정', 'Angular 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(27, 84, 'A0001', 'B0001', 'C0005', 'Angular, 앵귤러 100분 핵심강의', 'Angular 퀴즈2', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(28, 70, 'A0001', 'B0001', 'C0004', '[2024] 한입 크기로 잘라 먹는 리액트(React.js) : 기초부터 실전까지', 'React 퀴즈1', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(29, 83, 'A0001', 'B0001', 'C0004', 'React 완벽 마스터: 기초 개념부터 린캔버스 프로젝트까지', 'React 퀴즈2', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(30, 63, 'A0001', 'B0001', 'C0003', '퍼블리싱 핵심 이론(HTML+CSS+FLEX+JQUERY)', 'Jquery 퀴즈1', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(31, 82, 'A0001', 'B0001', 'C0003', '윤재성의 처음 시작하는 jQuery Programming', 'Jquery2 퀴즈', '4', 'jQuery의 주요 특징이 아닌 것은 무엇인가요?', '[\"크로스 브라우저 호환성\",\"HTML 문서 탐색\",\"HTML 태그를 수정할 수 있는 기능\",\"JavaScript를 사용하지 않는다\"]', ' jQuery는 JavaScript를 기반으로 하는 라이브러리로, JavaScript 코드를 쉽게 작성할 수 있도록 돕는 도구입니다. JavaScript 없이 jQuery를 사용할 수 없습니다.', 0),
(32, 81, 'A0001', 'B0001', 'C0002', '순수 자바스크립트 기초에서 실무까지', 'js 퀴즈', '4', '자바스크립트에서 변수 선언 시 올바른 방법은 무엇인가요?', '[\"var x = 10;\",\"let x = 10;\",\"const x = 10;\",\"모든 선택지\"]', '자바스크립트에서는 var, let, const 키워드를 사용하여 변수를 선언할 수 있습니다. var는 오래된 방식, let과 const는 ES6에서 추가되었으며, const는 상수 값을 선언할 때 사용됩니다.', 0),
(33, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 스택의 변수 구분 퀴즈', '3', 'var, let, const의 주요 차이점 중 올바르지 않은 것은 무엇인가요?', '[\"var는 함수 스코프를 가지며, let과 const는 블록 스코프를 가진다.\",\"const로 선언된 변수는 재할당이 불가능하다.\",\"let과 const는 변수의 재선언이 가능하다.\",\"var는 변수 호이스팅(hoisting)이 발생한다.\"]', 'let과 const는 변수의 재선언이 불가능하며, var는 가능하다.', 0),
(34, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트 개요 퀴즈', '2', '실행 컨텍스트는 언제 생성되나요?', '[\"변수 선언 시\",\"함수 호출 시\",\"이벤트 처리 시\",\"코드 실행 시\"]', '실행 컨텍스트는 함수 호출 시 생성되며, 이를 통해 실행에 필요한 환경이 구성된다.', 0),
(35, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트의 컴포넌트 구성 퀴즈', '1', 'Lexical Environment는 어떤 역할을 하나요?', '[\"외부 함수의 변수 접근을 허용한다.\",\"변수 선언과 초기화를 수행한다.\",\"함수 호출을 관리한다.\",\"비동기 작업의 실행 순서를 관리한다.\"]', 'Lexical Environment는 외부 변수와 함수에 대한 참조를 제공한다.', 0),
(36, 79, 'A0001', 'B0001', 'C0001', '그림으로 배우는 HTML/CSS, 입문!', 'HTML1 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(37, 78, 'A0001', 'B0001', 'C0001', 'HTML/CSS 베이스캠프', 'HTML2 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(38, 77, 'A0001', 'B0001', 'C0001', 'HTML 배워서 뉴스 기사 조작하는 방법', 'HTML3 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(39, 76, 'A0001', 'B0001', 'C0001', '제대로 파는 HTML CSS', 'HTML4 퀴즈', '4', 'HTML의 특징으로 맞지 않는 것은?', '[\"웹 문서의 표준으로 지정\",\"마크업 언어\",\"ASCII 코드로 구성된 일반적인 텍스트 파일\",\"컴퓨터 시스템이나 운영체제에 종속적\"]', 'HTML은 컴퓨터 시스템이나 운영체제에 독립적이다.', 0),
(40, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '개발환경 설정 퀴즈', '3', 'Vue.js 개발을 시작하기 위해 필요한 기본 도구가 아닌 것은 무엇인가요?', '[\"Node.js\",\"npm 또는 yarn\",\"MySQL\",\"코드 편집기 (예: VS Code)\"]', 'Vue.js는 MySQL과 같은 데이터베이스 없이도 시작할 수 있습니다.', 0),
(41, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vue.js 소개, 인스턴스, 컴포넌트 퀴즈', '3', 'Vue.js의 핵심 구성 요소가 아닌 것은 무엇인가요?', '[\"컴포넌트\",\"인스턴스\",\"데이터베이스\",\"템플릿\"]', 'Vue.js는 데이터베이스 없이 작동합니다.\r\n\r\n', 0),
(42, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '컴포넌트 통신방법 퀴즈', '1', '부모에서 자식 컴포넌트로 데이터를 전달하는 기본 방법은 무엇인가요?', '[\"props\",\"events\",\"methods\",\"state\"]', 'props를 사용하여 부모에서 자식으로 데이터를 전달합니다.\r\n\r\n', 0),
(43, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '라우터, 통신 라이브러리 퀴즈', '2', 'Vue Router의 기본 역할은 무엇인가요?', '[\"데이터 상태 관리\",\"페이지 간 탐색 관리\",\"HTTP 요청 처리\",\"CSS 스타일 관리\"]', 'Vue Router는 페이지 간 탐색을 관리합니다.', 0),
(44, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '템플릿 문법 퀴즈', '2', 'Vue 템플릿 문법에서 데이터를 표시하기 위해 사용하는 구문은 무엇인가요?', '[\"<% %>\",\"{{ }}\",\"<< >>\",\"(** **)\"]', 'Vue 템플릿 문법에서 데이터 바인딩을 위해 {{ }}를 사용합니다.', 0),
(45, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 생성도구 VUE CLI 퀴즈', '3', 'Vue CLI로 프로젝트를 생성할 때 사용하는 명령어는 무엇인가요?', '[\"vue new\",\"vue start\",\"vue create\",\"npm init vue\"]', 'vue create는 Vue CLI를 통해 새 프로젝트를 생성하는 명령어입니다.', 0),
(46, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'SPA 예제 퀴즈', '1', 'SPA의 주요 특징은 무엇인가요?', '[\"하나의 HTML 페이지에서 동작한다.\",\"서버 사이드 렌더링을 사용한다.\",\"페이지 간 전환 시 전체 페이지를 새로 고친다.\",\"데이터베이스와 직접 통신한다.\"]', 'SPA는 하나의 HTML 페이지에서 동작하며, 동적 렌더링을 통해 화면을 갱신합니다.', 0),
(47, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 소개 및 구현 시작 퀴즈', '2', '프로젝트를 시작하기 전에 가장 먼저 해야 할 일은 무엇인가요?', '[\"UI 디자인\",\"요구사항 분석\",\"데이터베이스 설정\",\"코드 작성\"]', '프로젝트를 시작하기 전에 요구사항을 분석하여 무엇을 구현할지 명확히 해야 합니다.', 0),
(48, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 구조 개선 퀴즈', '2', '프로젝트 구조 개선의 주요 목적은 무엇인가요?', '[\"코드를 더 빠르게 실행하기 위해\",\"코드의 가독성과 유지보수를 높이기 위해\",\"더 많은 기능을 추가하기 위해\",\"파일의 크기를 줄이기 위해\"]', '프로젝트 구조 개선은 코드 가독성과 유지보수성을 높이는 데 중점을 둡니다.', 0),
(49, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'ES6란? 퀴즈', '3', 'ES6의 주요 특징이 아닌 것은 무엇인가요?', '[\"const와 let\",\"클래스 문법\",\"새로운 데이터베이스 기능\",\"화살표 함수\"]', 'ES6는 데이터베이스 기능이 아니라 JavaScript 문법 개선에 초점을 둡니다.\r\n\r\n', 0),
(50, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vuex란? 퀴즈', '2', 'Vuex의 역할로 적절한 것은 무엇인가요?', '[\"라우팅 관리\",\"상태(State) 관리\",\"스타일 관리\",\"템플릿 렌더링\"]', 'Vuex는 상태 관리를 위해 사용됩니다.', 0),
(51, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'APM 설치하기 퀴즈', '4', 'APM의 구성 요소가 아닌 것은 무엇인가요?', '[\"Apache\",\"PHP\",\"MySQL\",\"Python\"]', 'APM은 Apache, PHP, MySQL로 구성된 웹 개발 환경이며 Python은 포함되지 않습니다.', 0),
(52, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'MySQL과 UTF-8 소개 퀴즈', '3', 'MySQL에서 데이터를 저장하기 위한 가장 작은 단위는 무엇인가요?', '[\"테이블\",\"데이터베이스\",\"필\",\"행(Row)\"]', '데이터베이스는 테이블로 구성되고, 테이블은 필드와 행으로 나뉩니다.', 0),
(53, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 기초 퀴즈', '3', 'PHP의 주석 문법으로 적절하지 않은 것은 무엇인가요?', '[\"\\/\\/ Single line comment\",\"\\/* Multi-line comment *\\/\",\"<!-- HTML style comment -->\",\"# Single line comment\"]', 'HTML 주석은 PHP에서 인식되지 않습니다.', 0),
(54, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '회원가입 페이지 퀴즈', '2', '회원가입 폼에서 입력 데이터를 전송하기 위해 주로 사용하는 HTML 메서드는 무엇인가요?', '[\"GET\",\"POST\",\"PUT\",\"DELETE\"]', 'POST 메서드는 데이터를 안전하게 서버로 전송합니다.', 0),
(55, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'Set Cookie, MD5 암호화 퀴', '3', 'PHP에서 쿠키를 설정하기 위한 함수는 무엇인가요?', '[\"set_cookie()\",\"cookie_set()\",\"setcookie()\",\"make_cookie()\"]', 'setcookie()는 PHP에서 쿠키를 설정하는 함수입니다.', 0),
(56, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'CSS Style Sheet 작성 퀴즈', '4', 'CSS를 HTML 문서에 포함시키는 방법으로 적절하지 않은 것은 무엇인가요?', '[\"Inline Style\",\"Internal Style Sheet\",\"External Style Sheet\",\"Direct JavaScript Call\"]', 'CSS는 HTML 문서에 포함될 수 있지만, JavaScript 호출은 CSS 적용 방법이 아닙니다.', 0),
(57, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 심화 퀴즈', '1', 'PHP에서 세션(Session)을 시작하기 위한 함수는 무엇인가요?', '[\"session_start()\",\"start_session()\",\"session_create()\",\"session_init()\"]', 'session_start()는 PHP에서 세션을 시작하는 함수입니다.', 0),
(58, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '리스트 생성, 글쓰기, 페이지 처리 퀴즈', '1', '게시판에서 페이지 처리를 위해 가장 먼저 해야 할 작업은 무엇인가요?', '[\"데이터베이스 설계\",\"페이지 나누기 로직 구현\",\"HTML 폼 작성\",\"사용자 인증 구현\"]', '게시판은 데이터를 저장할 데이터베이스 설계가 먼저 필요합니다.', 0),
(59, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '이미지 업로드 퀴즈', '2', 'PHP에서 이미지 업로드 시 파일 크기를 제한하기 위해 설정하는 값은 무엇인가요?', '[\"post_max_size\",\"upload_max_filesize\",\"max_image_size\",\"file_size_limit\"]', 'upload_max_filesize는 PHP에서 업로드 파일 크기 제한을 설정합니다.\r\n\r\n', 0),
(60, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '프로그래밍 set cook 퀴즈', '1', 'PHP에서 쿠키를 설정하기 위한 기본 함수는 무엇인가요?', '[\"setcookie()\",\"make_cookie()\",\"create_cookie()\",\"save_cookie()\"]', 'PHP에서 쿠키는 setcookie() 함수로 설정합니다.', 0),
(61, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '마무리 퀴즈', '2', '게시판 기능의 최종 검증 과정에서 가장 중요한 것은 무엇인가요?', '[\"UI 디자인\",\"보안 점검\",\"데이터베이스 최적화\",\"코드 주석 작성\"]', '게시판의 보안을 점검하여 SQL 인젝션 및 XSS와 같은 취약점을 방지해야 합니다.', 0),
(62, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '자바스크립트 실행 방법 퀴즈', '1', '브라우저에서 자바스크립트를 실행하는 기본적인 방법은 무엇인가요?', '[\"HTML <script> 태그 안에 작성\",\"CSS 파일에 포함\",\"PHP 파일에 포함\",\"데이터베이스에서 실행\"]', '자바스크립트는 HTML 파일의 <script> 태그 안에 작성하거나 외부 스크립트 파일로 연결합니다.', 0),
(63, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 생성 퀴즈', '1', 'JavaScript에서 변수를 선언하기 위해 사용되는 키워드는 무엇인가요?', '[\"var, let, const\",\"int, float, string\",\"new, this, typeof\",\"make, define, declare\"]', 'JavaScript에서 변수를 선언할 때 var, let, const를 사용합니다.', 0),
(64, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 타입, 산술 연산자 퀴즈', '4', 'JavaScript의 기본 데이터 타입이 아닌 것은 무엇인가요?', '[\"Number\",\"String\",\"Boolean\",\"Character\"]', 'JavaScript에는 Character 타입이 없으며 문자열은 String 타입으로 처리됩니다.', 0),
(65, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 생성, 구조, 지역 변수, 전역 변수 퀴즈', '1', '함수 선언 방식 중 올바른 것은 무엇인가요?', '[\"function myFunc() {}\",\"declare myFunc() {}\",\"create function myFunc() {}\",\"make myFunc() {}\"]', '함수 선언은 function 함수명() {} 형태로 작성합니다.', 0),
(66, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 종류, 즉시 실행 함수 퀴즈', '1', '일반 함수와 즉시 실행 함수의 차이점은 무엇인가요?', '[\"즉시 실행 함수는 호출 없이 실행된다.\",\"즉시 실행 함수는 값을 반환하지 않는다.\",\"일반 함수는 선언할 수 없다.\",\"즉시 실행 함수는 전역 변수를 사용할 수 없다.\"]', '즉시 실행 함수는 선언과 동시에 실행됩니다.', 0);

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
(1, 1, 5, 'Wazuh와 ELK 스택을 활용한 위협 헌팅 시스템 구축 교육 후기', 'Wazuh와 ELK 스택을 결합하여 최적의 위협 헌팅 시스템을 구축하는 방법을 배우는 과정이 매우 유익했습니다. 이 교육에서는 이론뿐만 아니라 실습을 통해 실제 환경에서 적용 가능한 보안 전략을 익힐 수 있었습니다.\r\n\r\nWazuh의 로그 관리 및 ELK 스택을 활용한 실시간 모니터링과 분석 능력을 키울 수 있었고, 보안 전문가로서 실전에서 바로 활용할 수 있는 기술을 습득할 수 있었습니다.\r\n\r\n이 과정 덕분에 보안 능력이 한 단계 업그레이드된 느낌입니다.', '2024-12-20 02:21:41'),
(2, 2, 5, '최신 법 개정안과 출제 경향을 반영한 교육 후기', '이 교육은 최신 법 개정안과 최근 출제 경향을 철저히 반영하여 제작된 과정이었습니다.\r\n\r\n개인정보에 대한 깊은 이해가 없더라도, 누구나 쉽게 이해할 수 있도록 체계적으로 설명해 주셔서 매우 유익했습니다.\r\n\r\n각 개정사항을 실용적으로 풀어주셔서 실제 적용 방법을 명확히 알 수 있었고, 자신감을 가지고 학습을 이어갈 수 있었습니다.\r\n믿고 따라가면 좋은 결과를 얻을 수 있을 것입니다.', '2024-12-20 02:23:20'),
(3, 3, 5, 'C++로 객체지향 프로그래밍의 세계를 경험한 후기', 'C언어를 충분히 공부하고 선형 자료구조까지 마스터한 후, C++로 객체지향 프로그래밍의 세계에 입문할 수 있는 좋은 기회였습니다.\r\n\r\n객체지향의 기본 개념을 C++에서 어떻게 적용하는지 구체적으로 배우면서, 실제로 프로젝트에 적용할 수 있는 능력을 키울 수 있었습니다.\r\n\r\n이 교육 덕분에 객체지향 설계와 코드 구조에 대한 이해가 깊어졌고, C++의 강력한 기능들을 활용할 자신감도 생겼습니다.', '2024-12-20 02:26:34'),
(4, 4, 5, 'TCP 소켓 프로그래밍과 비동기 처리 학습 후기', 'TCP 소켓의 기초 이론과 특징을 깊이 있게 배울 수 있었습니다.\r\n\r\n특히 소켓의 다양한 옵션을 활용하는 방법과, Task 기반 비동기 프로그래밍에 대해 실습을 통해 이해할 수 있어 매우 유익했습니다.\r\n\r\n비동기 처리 방식을 적용함으로써 프로그램의 성능을 향상시키는 방법을 배웠고, 실제 현업에서 바로 활용할 수 있는 기술을 익혔습니다.\r\n\r\n이 과정 덕분에 네트워크 프로그래밍에 대한 자신감이 생겼습니다.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '2024-12-20 02:27:22'),
(5, 5, 4, 'Couchbase Server 학습 후기', 'Couchbase Server는 원래 Membase로 알려졌으며, 대화형 애플리케이션에 최적화된 강력한 NoSQL 데이터베이스라는 점에서 매우 인상 깊었습니다.\r\n\r\n특히, 공유 없음 아키텍처와 다중 모델을 지원하는 문서 지향 데이터베이스라는 특성이 실시간 데이터 처리에 어떻게 유리한지에 대해 깊이 이해할 수 있었습니다.\r\n\r\n이 과정을 통해 Couchbase의 성능과 확장성, 다양한 활용 사례를 배울 수 있었고, 실제 프로젝트에 어떻게 적용할 수 있을지에 대한 통찰을 얻었습니다.\r\n\r\nCouchbase의 핵심 개념을 잘 이해하고, 그 가능성을 제대로 활용할 수 있는 자신감이 생겼습니다.', '2024-12-20 02:28:15'),
(6, 6, 4, 'Amazon Keyspaces와 Cassandra 활용 학습 후기', 'Amazon Keyspaces의 고가용성 및 확장 가능한 완전 관리형 서비스에 대해 배우는 매우 유익한 시간이었습니다.\r\n\r\n특히, Cassandra 기반 애플리케이션을 사용하는 경우 자동으로 테이블 규모 확장과 축소가 가능하며, 서버리스 관리 경험을 제공하는 점이 인상적이었습니다.\r\n\r\n세션을 통해 Amazon Keyspaces의 특징과 Cassandra 테이블 구성 및 운영 방법에 대해 실습을 통해 쉽게 이해할 수 있었고, 실제 환경에서 어떻게 활용할 수 있을지에 대한 실용적인 지식을 얻었습니다.\r\n\r\n이 교육 덕분에 클라우드 환경에서의 데이터베이스 관리에 자신감이 생겼습니다.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '2024-12-20 02:29:11'),
(7, 7, 4, 'MongoDB 활용법과 실무 노하우 학습 후기', 'MongoDB와 NoSQL 데이터베이스에 대해 많은 것을 배울 수 있었던 유익한 강의였습니다.\r\n\r\n특히 관계형 데이터베이스와는 다른 MongoDB의 특성을 잘 이해하고, MongoDB를 제대로 활용하기 위한 기본 개념부터 실무에서 자주 마주치는 문제까지 심도 깊게 다루어 주셔서 많은 도움이 되었습니다.\r\n\r\n실패 사례를 통해 잘못된 사용법을 피하고, MongoDB를 최대한 효율적으로 활용할 수 있는 방법을 알게 되어 실전에서 바로 적용할 수 있을 것 같습니다.\r\n\r\n이 강의를 통해 MongoDB에 대한 이해가 깊어졌고, 실제 프로젝트에서 활용할 자신감이 생겼습니다.', '2024-12-20 02:29:44'),
(8, 8, 5, '처음하는 MongoDB와 NoSQL 데이터베이스 부트캠프 후기', 'MongoDB와 NoSQL 데이터베이스를 처음 접하는 입문자로서 이 부트캠프는 정말 유익한 시간이었습니다.\r\n\r\n기본 개념부터 시작하여 MongoDB를 어떻게 효과적으로 활용할 수 있는지, 그리고 빅데이터와 관련된 NoSQL 데이터베이스의 장점과 활용 방안까지 깊이 있게 배울 수 있었습니다.\r\n\r\n실습 위주의 학습 덕분에 개념을 쉽게 이해할 수 있었고, MongoDB를 실제 프로젝트에 어떻게 적용할 수 있을지에 대한 구체적인 전략도 얻을 수 있었습니다.\r\n\r\n입문자도 충분히 따라갈 수 있도록 잘 구성된 강의였고, NoSQL에 대한 자신감이 크게 향상되었습니다.', '2024-12-20 02:30:35'),
(9, 9, 5, '오라클 DB 아키텍처와 성능 튜닝 학습 후기', '오라클 DB의 내부 아키텍처와 성능 분석을 심도 깊게 배울 수 있는 매우 유익한 강의였습니다.\r\n\r\n아키텍처의 세부적인 메커니즘을 이해하고, 성능 튜닝 및 분석 전문가로 성장할 수 있는 핵심적인 지식들을 배웠습니다.\r\n\r\n특히, 실무에서 바로 활용할 수 있는 성능 개선 전략과 도구들을 소개해주셔서 매우 실용적이었고, 오라클 DB를 효율적으로 다룰 수 있는 자신감이 생겼습니다.\r\n\r\n이 강의를 통해 오라클 DB의 성능 최적화 및 분석에 대한 능력을 크게 향상시킬 수 있었습니다.', '2024-12-20 02:31:36'),
(10, 10, 4, '실전 사례로 배우는 SQL 데이터 분석 후기', '이 과정에서는 다양한 실전 데이터 분석 사례를 SQL을 통해 구현하면서 데이터 분석 능력과 SQL 활용 능력을 동시에 향상시킬 수 있었습니다.\r\n\r\n복잡한 데이터를 다루는 방법부터, 실무에서 유용하게 쓸 수 있는 SQL 쿼리 작성법까지 자세히 배울 수 있었습니다.\r\n\r\n특히, 실제 업무에서 겪을 수 있는 문제들을 해결하는 데 도움이 되는 유용한 팁을 많이 얻었고, SQL을 더 능숙하게 활용할 수 있게 되었습니다.\r\n\r\n이 강의를 통해 데이터 분석 역량을 크게 향상시킬 수 있었습니다.', '2024-12-20 02:32:33'),
(11, 30, 5, 'HTML과 CSS 기초부터 고급 활용까지 완벽한 강의 후기', 'HTML과 CSS의 기초부터 현업 개발자를 위한 고급 활용법까지 다룬 강의는 정말 유익했습니다.\r\n\r\n쌩초보자도 쉽게 따라할 수 있도록 기초부터 차근차근 설명해주셔서 웹 개발에 대한 두려움이 사라졌고, 실전에서 바로 활용할 수 있는 고급 팁들도 배울 수 있었습니다.\r\n\r\n특히, 이해하기 어려운 이론들을 쉽게 풀어주셔서 복잡한 개념들이 명확하게 이해되었습니다.\r\n\r\n이 강의를 통해 HTML과 CSS에 대한 자신감이 생겼고, 웹 개발 능력을 한 단계 업그레이드할 수 있었습니다.', '2024-12-20 02:43:23'),
(12, 29, 4, 'HTML 기초부터 활용까지 완벽하게 배우는 강의 후기', '이 강의는 HTML에 대한 환경 설정부터 기초 개념, 활용법까지 모두 배울 수 있어 매우 유익했습니다.\r\n\r\nHTML의 기본적인 구조와 태그 사용법을 확실히 이해할 수 있었고, 실전에서 어떻게 적용하는지에 대한 실용적인 팁도 배웠습니다.\r\n\r\n또한, 효과적인 공부 방법까지 소개해 주셔서 HTML을 더 잘 활용할 수 있는 자신감을 얻었습니다.\r\n\r\n이 강의를 통해 HTML에 대한 전반적인 이해를 높일 수 있었고, 웹 개발의 첫 단추를 잘 꿰어갈 수 있게 되었습니다.', '2024-12-20 02:44:27'),
(13, 22, 5, '코딩은 처음이라 with 웹 퍼블리싱\" 자바스크립트 기초 강의 후기', '코딩은 처음이라 with 웹 퍼블리싱\" 책을 기반으로 한 자바스크립트 기초 강의는 초보자가 이해하기 쉽게 구성되어 매우 유익했습니다.\r\n\r\n자바스크립트의 기본 개념부터 차근차근 설명해주셔서, 코드 작성에 대한 두려움이 사라졌고 실습을 통해 바로 적용할 수 있었습니다.\r\n\r\n특히, 웹 퍼블리싱과 자바스크립트의 연결을 쉽게 이해할 수 있도록 실전 예제 중심으로 진행되어 매우 유익했습니다.\r\n\r\n이 강의를 통해 자바스크립트의 기초부터 확실히 다지게 되었고, 웹 개발에 자신감을 가지게 되었습니다.', '2024-12-20 02:45:26');

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
  `regdate` datetime NOT NULL COMMENT '등록일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 질문';

--
-- 테이블의 덤프 데이터 `student_qna`
--

INSERT INTO `student_qna` (`sqid`, `cdid`, `qtitle`, `qcontent`, `regdate`) VALUES
(1, 1, 'ELK 스택과 Wazuh를 통합한 위협 헌팅 시스템 구축, 초보자가 따라할 수 있을까요?', '안녕하세요, 이번에 Wazuh와 ELK 스택을 활용하여 위협 헌팅 시스템을 구축하는 방법에 대해 배우고 싶어 이 강의를 검토 중입니다.\r\n그런데 제가 보안 전문가 초보라서 이런 시스템을 처음 다뤄보는데, 강의 내용이 초보자도 따라가기 쉬운 수준인지 궁금합니다.\r\n또한, 실습에서 제공되는 자료나 환경은 얼마나 상세하고 체계적으로 구성되어 있는지 알고 싶습니다.\r\n이 강의를 통해 실제로 현장에서 활용 가능한 수준까지 역량을 끌어올릴 수 있을까요?', '2024-12-20 01:59:08'),
(2, 2, 'CPPG 자격증 준비, 비전공자도 따라갈 수 있을까요?', '안녕하세요! CPPG 개인정보관리사 자격증 취득을 목표로 강의를 고려 중입니다.\r\n제가 IT나 법률에 대한 전공 지식이 전혀 없는 상태라, 비전공자도 이 강의로 CPPG 시험 준비가 충분히 가능한지 궁금합니다.\r\n\r\n강의에서 다루는 내용이 CPPG 시험 범위를 얼마나 충실히 반영하고 있나요?\r\n비전공자를 위해 기초적인 개념부터 차근차근 설명이 이루어지나요?\r\n강의를 활용한 공부 방법이나 자격증 취득을 위한 추가적인 팁이 있다면 알려주시면 감사하겠습니다!\r\n답변 부탁드립니다. 😊', '2024-12-20 02:05:05'),
(3, 3, 'C 개발자로서 이 강의로 C++ 핵심만 제대로 배울 수 있을까요?', '안녕하세요! 저는 C 언어로 개발 경험이 많은 개발자입니다. 이번에 C++의 기초와 중요한 개념들만 빠르게 익혀야 할 필요가 있어서 이 강의가 적합할지 궁금합니다.\r\n\r\n이 강의는 C 개발자들이 C++을 학습할 때 불필요한 이론보다는 실무에 바로 적용 가능한 핵심 개념에 집중되어 있나요?\r\nC와 C++의 차이점이나 변환 과정에서 특히 중점적으로 다뤄지는 내용이 무엇인지 궁금합니다.\r\n학습 후 실제로 C++ 기반 프로젝트를 진행할 때 활용 가능한 실무적인 예제나 팁도 포함되어 있나요?', '2024-12-20 02:07:04'),
(4, 4, 'Task 기반 비동기 프로그래밍에서 배우는 구체적인 내용은 무엇인가요?', '강의에서 다루는 비동기 프로그래밍의 내용을 좀 더 자세히 알고 싶습니다! 😊', '2024-12-20 02:08:55'),
(5, 5, 'Couchbase의 Membase에서 Couchbase로의 전환과 그에 따른 장점', '안녕하세요, 강사님. Couchbase가 원래 Membase로 알려졌다고 들었습니다. Membase에서 Couchbase로의 전환이 어떤 이유로 이루어졌고, 그 과정에서 어떤 주요한 기술적 변화나 개선 사항이 있었는지 궁금합니다. 특히, 대화형 애플리케이션에서 Couchbase의 성능이나 기능이 어떻게 최적화되었는지에 대한 설명을 듣고 싶습니다. 감사합니다.', '2024-12-20 02:12:02'),
(6, 6, 'Amazon Keyspaces와 Cassandra 기반 애플리케이션의 호환성 및 관리 기능', '안녕하세요, 강사님. Amazon Keyspaces가 Apache Cassandra와 호환되는 완전 관리형 데이터베이스 서비스라고 들었습니다.\r\n기존에 Cassandra 기반 애플리케이션을 사용 중인 경우, Amazon Keyspaces로 전환할 때 어떤 장점이 있을까요?\r\n특히, 서버리스 환경에서 자동으로 테이블 규모를 확장하거나 축소하는 기능이 어떻게 작동하는지, 그리고 이로 인해 얻을 수 있는 관리적 이점에 대해 더 알고 싶습니다. \r\n\r\nCassandra 테이블을 구성하고 운영하는 데 있어 Amazon Keyspaces가 제공하는 특별한 기능이나 고려할 점이 있으면 설명 부탁드립니다. 감사합니다.', '2024-12-20 02:13:26'),
(7, 7, 'MongoDB의 올바른 사용법과 실패 사례', '안녕하세요, 강사님. MongoDB와 NoSQL 데이터베이스가 많이 사용되고 있다고 들었는데, 관계형 데이터베이스와의 차이점이나 MongoDB를 올바르게 활용하기 위한 주요 포인트가 궁금합니다. 특히 MongoDB 사용 시 실패할 수 있는 사례와 이를 피하는 방법에 대해서도 알고 싶습니다. 감사합니다.', '2024-12-20 02:17:40'),
(8, 8, 'MongoDB의 특징과 잘못된 사용으로 인한 문제점', '안녕하세요, 강사님. MongoDB는 문서 지향적인 데이터베이스로 JSON 형태로 데이터를 저장하고 스키마가 유연하다고 들었습니다. 이러한 특성 덕분에 대규모 데이터 처리에 강점을 가지지만, 잘못 사용하면 성능 저하나 데이터 불일치 같은 문제가 발생할 수 있다고 하셨습니다. MongoDB의 유용한 특성과 함께, 이러한 문제를 피하기 위한 사용법에 대해 더 알고 싶습니다. 감사합니다.', '2024-12-20 02:18:43'),
(9, 9, '오라클 DB 아키텍처 이해와 성능 튜닝 가이드', '안녕하세요, 강사님. 오라클 DB의 내부 아키텍처를 이해하는 것이 성능 튜닝과 분석에 중요한 역할을 한다고 들었습니다. 오라클 DB의 주요 아키텍처 구성 요소와 성능 튜닝을 위한 핵심 방법에 대해 알고 싶습니다. 또한 성능 분석 전문가로 성장하기 위한 필수 지식이나 접근 방식에 대해서도 설명해 주시면 감사하겠습니다.', '2024-12-20 02:19:20'),
(10, 10, 'SQL을 활용한 실전 데이터 분석 사례 학습', '안녕하세요, 강사님. 다양한 실전 데이터 분석 사례를 SQL을 통해 구현한다고 하셨는데, 실제로 SQL을 사용하여 데이터 분석 능력과 SQL 활용 능력을 동시에 향상시킬 수 있는 구체적인 방법이나 학습 전략이 궁금합니다. 또한, 실전에서 자주 마주치는 데이터 분석 문제와 이를 해결하기 위한 SQL 쿼리 작성 방법에 대해서도 설명 부탁드립니다.', '2024-12-20 02:19:50'),
(11, 22, 'HTML 태그의 역할과 사용법에 대해 궁금합니다', 'HTML에서 각각의 태그는 어떤 역할을 하나요? 예를 들어, <div>, <span>, <a> 같은 태그들의 차이점과 사용 시 유의할 점이 궁금합니다.', '2024-12-20 02:47:04'),
(12, 29, 'HTML 문서 내 링크 연결 문제', '웹페이지 내에서 링크를 연결하려고 하는데, 상대 경로와 절대 경로 사용법에 대해 혼동이 옵니다.\r\n\r\nhref 속성에 경로를 작성할 때 주의할 점과 올바르게 사용하는 방법을 알려주세요.', '2024-12-20 02:52:20'),
(13, 28, 'PHP에서 변수의 데이터 타입을 변환하는 방법', '안녕하세요, PHP에서 변수의 데이터 타입을 변환하는 방법에 대해 궁금합니다. 예를 들어, 문자열을 정수로 변환하거나, 배열을 객체로 변환하는 방법이 있으면 알려주실 수 있나요? 또한, PHP에서 제공하는 타입 변환 함수에 대해서도 알고 싶습니다.', '2024-12-20 02:54:32'),
(14, 28, 'PHP에서 배열을 정렬하는 방법', 'PHP에서 배열을 오름차순 또는 내림차순으로 정렬하려고 하는데, 어떻게 하면 효율적으로 할 수 있는지 잘 모르겠습니다.\r\n\r\nsort()와 arsort() 함수의 차이점도 설명해 주실 수 있나요? 그리고 다차원 배열을 정렬하는 방법에 대해서도 알고 싶습니다.', '2024-12-20 02:55:53'),
(15, 28, 'PHP의 세션과 쿠키 차이점에 대해 설명해 주세요', 'PHP에서 세션(session)과 쿠키(cookie)의 차이점에 대해 헷갈리고 있습니다.\r\n\r\n세션은 서버에 저장되고 쿠키는 클라이언트에 저장된다고 들었는데, 실제로 언제 세션을 사용하고 언제 쿠키를 사용하는 게 좋은지, 각 방식의 장단점에 대해서도 설명 부탁드립니다.', '2024-12-20 02:56:32');

-- --------------------------------------------------------

--
-- 테이블 구조 `stuscores`
--

CREATE TABLE `stuscores` (
  `exid` int(11) NOT NULL COMMENT '번호',
  `leid` int(11) NOT NULL COMMENT '강좌 고유 번호',
  `detail_id` int(11) NOT NULL COMMENT '강의 고유 번호',
  `stu_id` int(11) NOT NULL COMMENT '수강생id',
  `quiz` int(11) DEFAULT NULL COMMENT '퀴즈 exid(외래키)',
  `quiz_score` int(11) DEFAULT NULL COMMENT '퀴즈 점수',
  `test` int(11) DEFAULT NULL COMMENT '시험 exid(외래키)',
  `test_score` int(11) DEFAULT NULL COMMENT '시험 점수',
  `answer` varchar(100) NOT NULL COMMENT '제출한 정답'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 점수 관리';

--
-- 테이블의 덤프 데이터 `stuscores`
--

INSERT INTO `stuscores` (`exid`, `leid`, `detail_id`, `stu_id`, `quiz`, `quiz_score`, `test`, `test_score`, `answer`) VALUES
(5, 55, 65, 3, 40, 100, 119, 100, ''),
(7, 55, 66, 3, 41, 100, 123, 100, ''),
(8, 55, 67, 3, 42, 100, 127, 75, '');

-- --------------------------------------------------------

--
-- 테이블 구조 `summer_images`
--

CREATE TABLE `summer_images` (
  `imgid` int(11) NOT NULL COMMENT '기본 pk',
  `table_name` varchar(255) NOT NULL COMMENT '테이블명(text)',
  `table_id` varchar(255) NOT NULL COMMENT '테이블id (fqid, ntid 등)',
  `file_name` varchar(500) NOT NULL COMMENT '이미지경로'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='썸머노트이미지들';

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

INSERT INTO `teachers` (`tcid`, `uid`, `cgid`, `tc_userid`, `tc_name`, `tc_userphone`, `tc_email`, `tc_cate`, `tc_url`, `tc_thumbnail`, `tc_main_intro`, `tc_intro`, `tc_bank`, `tc_account`, `tc_ok`, `isrecom`, `isnew`) VALUES
(1, 2, 1, 'even_teacher', '이븐선생', '010-4567-8910', 'eventeacher@even.co.kr', '1', '', '', '', '안녕하세요 익힘의 정도가 적절한 이븐선생입니다~', '', '', 1, 0, 0),
(2, 4, 1, 'my_teacher', '김동주', '010-4567-8910', 'rocks@even.co.kr', '1', 'https://www.youtube.com/@Ezweb', '/code_even/admin/upload/teacher/20241217071938198717.png', 'Rock’s Easyweb 차근차근 제대로 배워봅시다', '반갑습니다. 바위처럼, 이지웹입니다.', '', '', 1, 1, 0),
(3, 70, 2, 'teacher3', '조한결', '010-8723-4519', 'user70@example.com', '1', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241217063622106996.png', '웹 프론트엔드 한 입 크기로 잘라먹어 볼까요?', '웹 프론트엔드 한 입 크기로 잘라먹어 볼까요?! <br>\r\n\r\n안녕하세요 🙇‍♂ <br>\r\n\r\n저는 무엇이든 쉽고 재미있게 설명할 방법이 있다고 믿는 사람이자 <br>\r\n\r\n세상에서 가장 따뜻한 개발자 커뮤니티를 만들고자 하는 사람입니다. <br>\r\n\r\n \r\n\r\n도서) \"한 입 크기로 잘라먹는 리액트\" 출간 <br>\r\n강의) 한 입 크기로 잘라먹는 Next.js <br>\r\n강의) 한 입 크기로 잘라먹는 타입스크립트 <br>\r\n강의) 한 입 크기', '', '', 1, 1, 0),
(4, 68, 3, 'teacher4', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 1, 0, 0),
(5, 75, 1, 'teacher5', '코딩웍스', '010-2345-6789', 'randomuser1@example.com', '1', 'https://www.youtube.com/@CodingWorks', '/code_even/admin/upload/teacher/20241213083843819429.png', '', '<p><br></p>', '', '', 1, 0, 0),
(6, 76, 1, 'teacher6', '얄코', '010-8765-4321', 'user6@example.com', '1', 'https://www.youtube.com/@yalco-coding', '/code_even/admin/upload/teacher/20241213084239189335.png', '', '<p><br></p>', '', '', 1, 0, 0),
(7, 77, 1, 'teacher7', '조코딩', '010-9876-5432', 'lovelycat32@gmail.com', '1', 'https://www.youtube.com/@jocoding', '/code_even/admin/upload/teacher/20241213084539156010.png', '', '<p><br></p>', '', '', 1, 0, 0),
(8, 78, 1, 'teacher8', '제주코딩베이스캠프', '010-1357-2468', 'user8@example.com', '1', 'https://www.youtube.com/channel/UC4GnvNKtuJ4cqWsYjxNxAEQ', '/code_even/admin/upload/teacher/20241213084623102898.png', '', '<p><br></p>', '', '', 1, 0, 0),
(9, 79, 1, 'teacher9', '홍팍', '010-4682-7351', 'supernova_77@yahoo.com', '1', 'https://www.youtube.com/channel/UCpW1MaTjw4X-2Y6MwAVptcQ', '/code_even/admin/upload/teacher/20241213084649125650.png', '', '<p><br></p>', '', '', 1, 0, 0),
(10, 80, 1, 'teacher10', '김영보', '010-7890-1234', 'user10@example.com', '1', 'https://www.youtube.com/@tonextday', '/code_even/admin/upload/teacher/20241213084722188172.png', '', '<p><br></p>', '', '', 1, 0, 0),
(11, 81, 1, 'teacher11', '개발자의 품격', '010-6543-2109', 'fastcar45@outlook.com', '1', 'https://www.youtube.com/@thegreat-programmers', '/code_even/admin/upload/teacher/20241213084808153324.png', '', '<p><br></p>', '', '', 1, 0, 0),
(12, 82, 1, 'teacher12', '윤재성', '010-3698-1472', 'bluebird99@hotmail.com', '1', 'https://www.youtube.com/@isoftcampus/search', '/code_even/admin/upload/teacher/20241213084833932891.png', '', '<p><br></p>', '', '', 1, 0, 0),
(13, 83, 1, 'teacher13', '짐코딩', '010-1927-3648', 'user13@example.com', '1', 'https://www.youtube.com/@gymcoding', '/code_even/admin/upload/teacher/20241213084857119305.png', '', '<p><br></p>', '', '', 1, 0, 0),
(14, 84, 1, 'teacher14', '노마드크리에이터', '010-4729-3851', 'blud99@hotmail.com', '1', 'https://www.youtube.com/@creApplecom', '/code_even/admin/upload/teacher/20241213084921194839.png', '', '', '', '', 1, 0, 0),
(15, 85, 1, 'teacher15', '코지코더', '010-8147-9263', 'techgeek2024@gmail.com', '1', 'https://github.com/kossiecoder', '', '', '<p><br></p>', '', '', 1, 0, 0),
(16, 86, 1, 'teacher16', '제로초', '010-4758-2941', 'user16@example.com', '1', 'https://www.rallit.com/hub/resumes/1572/조현영', '/code_even/admin/upload/teacher/20241213085110178305.png', '', '<p><br></p>', '', '', 1, 0, 0),
(17, 87, 2, 'teacher17', 'AWS강의실', '010-2391-8465', 'unshine_day@naver.com', '2', 'https://www.rallit.com/hub/resumes/196278/박상운', '/code_even/admin/upload/teacher/20241213085139185754.png', '', '<p><br></p>', '', '', 1, 0, 0),
(18, 88, 2, 'teacher18', '이상희', '010-6874-9102', 'user18@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085200972435.png', '', '<p><br></p>', '', '', 1, 0, 0),
(19, 89, 2, 'teacher19', 'JeongSuk Lee', '010-3421-8674', 'happyworld2023@daum.net', '2', '', '', '', '', '', '', 1, 0, 0),
(20, 90, 2, 'teacher20', '일프로', '010-5647-2831', 'user20@example.com', '2', 'https://www.rallit.com/hub/resumes/23145/김태민', '/code_even/admin/upload/teacher/20241213085248149827.png', '', '<p><br></p>', '', '', 1, 0, 0),
(21, 91, 2, 'teacher21', '데이터리안', '010-1482-7395', 'nightowl88@live.com', '2', '', '/code_even/admin/upload/teacher/20241213085311158494.png', '', '<p><br></p>', '', '', 1, 0, 0),
(22, 92, 2, 'teacher22', '이성욱', '010-2874-5632', 'oceanview55@icloud.com', '2', '', '', '', '', '', '', 1, 0, 0),
(23, 93, 2, 'teacher23', '권철민', '010-9271-4638', 'user23@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085347197458.png', '', '<p><br></p>', '', '', 1, 0, 0),
(24, 94, 2, 'teacher24', '잔재미코딩', '010-4758-9210', 'user24@example.com', '2', 'https://www.youtube.com/@fun-coding', '/code_even/admin/upload/teacher/20241213085421100170.png', '', '<p><br></p>', '', '', 1, 0, 0),
(25, 95, 2, 'teacher25', '김시훈', '010-8465-1273', 'user25@example.com', '2', 'https://www.linkedin.com/in/sihoon-kim/', '', '', '<p><br></p>', '', '', 1, 0, 0),
(26, 96, 2, 'teacher26', '윤석찬', '010-9374-6581', 'user96@example.com', '2', 'https://www.youtube.com/watch?v=4ZnlZCbbN_A', '/code_even/admin/upload/teacher/20241213085514482122.png', '', '<p><br></p>', '', '', 1, 0, 0),
(27, 97, 2, 'teacher27', '쿠만', '010-2947-1365', 'user27@example.com', '2', '', '', '', '', '', '', 1, 0, 0),
(28, 98, 3, 'teacher28', '에릭권', '010-1284-9465', 'user28@example.com', '3', '', '', '', '', '', '', 1, 0, 0),
(29, 99, 3, 'teacher29', '널널한개발자', '010-5673-8492', 'user29@example.com', '3', 'https://www.youtube.com/@nullnull_not_eq_null', '/code_even/admin/upload/teacher/20241213085545212384.png', '차이를 만드는 첫걸음, 보안정복', '<p><br></p>', '', '', 1, 1, 0),
(30, 100, 3, 'teacher30', '컴공로드맵', '010-9483-1652', 'user30@example.com', '3', '', '/code_even/admin/upload/teacher/20241213085605345002.png', '', '<p><br></p>', '', '', 1, 0, 0),
(31, 101, 3, 'teacher31', '제로미니', '010-2354-7890', 'user31@example.com', '3', 'https://www.youtube.com/@z3romini', '/code_even/admin/upload/teacher/20241213085627483951.png', '', '<p><br></p>', '', '', 1, 0, 0),
(32, 102, 1, 'teacher32', '장기효(캡틴판교)', '010-3852-9471', 'user32@example.com', '1', 'https://www.rallit.com/hub/resumes/126/장기효', '/code_even/admin/upload/teacher/20241213085025163488.png', '', '<p><br></p>', '', '', 1, 0, 0),
(33, 103, 1, 'teacher33', '쩡원', '010-9823-7415', 'user33@example.com', '1', 'https://www.youtube.com/@PHP', '/code_even/admin/upload/teacher/20241213085046193501.png', '', '<p>소개</p>', '', '', 1, 0, 0);

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
(1, 1, '안녕하세요, 질문 주셔서 감사합니다! 😊\r\n\r\n이번 강의는 보안에 익숙하지 않은 초보자부터 중급 이상까지 폭넓게 학습할 수 있도록 설계되었습니다.\r\n특히, Wazuh와 ELK 스택 통합 과정을 단계별로 진행하며, 실습 중심으로 구성되어 초보자도 쉽게 따라올 수 있도록 상세한 가이드를 제공합니다.\r\n\r\n초보자를 위한 설명\r\n\r\n개념적인 부분은 기본부터 시작하여 실무에서 활용할 수 있는 수준까지 점진적으로 다루고 있습니다.\r\n각 단계에서 실습 자료와 스크립트를 함께 제공하므로 따라 하시기만 해도 시스템 구축과 운영이 가능합니다.\r\n실습 환경 구성\r\n\r\n실습은 로컬 머신 또는 클라우드 환경에서 바로 실행 가능하도록 설정 안내를 포함하고 있습니다.\r\n필요한 도구와 설정 파일도 함께 제공되어 복잡한 환경 구성 없이 실습에 집중할 수 있습니다.\r\n현장 적용 가능성\r\n\r\n강의에서는 구축한 시스템을 실제 환경에서 어떻게 활용하는지, 그리고 위협을 탐지하고 대응하는 전략까지 심화 내용을 다룹니다.\r\n이를 통해 강의 종료 후에도 실제 업무에 적용할 수 있는 자신감을 갖추실 수 있을 것입니다.'),
(2, 2, '안녕하세요! 질문 주셔서 감사합니다. 😊\r\n\r\nCPPG 자격증은 비전공자도 충분히 도전할 수 있는 자격증입니다. 이 강의는 특히 초보자와 비전공자를 고려해 설계되었기 때문에 걱정하지 않으셔도 됩니다.\r\n\r\n강의와 CPPG 시험 범위의 일치도\r\n\r\n강의는 CPPG 시험의 최신 출제 경향을 반영하여 구성되었습니다.\r\n개인정보 보호법, 정보보안, 실무 사례 등 시험 범위 전반을 체계적으로 다룹니다.\r\n비전공자를 위한 접근성\r\n\r\n강의는 기초 개념부터 출발해 점진적으로 심화 내용을 학습할 수 있도록 구성되어 있습니다.\r\n법률 용어나 IT 보안 개념도 쉽게 이해할 수 있도록 예제와 사례를 활용해 설명합니다.\r\n효율적인 공부 방법\r\n\r\n강의에서 제공하는 요약 자료와 문제 풀이를 적극 활용하세요.\r\n강의 내용을 복습하며 자주 출제되는 핵심 개념에 집중하면 합격 가능성을 높일 수 있습니다.\r\n시간이 허락된다면, 강의 외에도 기출 문제를 풀어보며 실전 감각을 익히는 것을 추천드립니다.\r\n이 강의를 성실히 따라오시면 CPPG 자격증 취득이 충분히 가능합니다. 함께 목표를 이루어 보아요! 강의에서 뵙겠습니다. 😊'),
(3, 3, '이 강의는 C 개발자를 위한 맞춤형 과정으로, 기존 C 언어 지식을 바탕으로 C++의 핵심 개념과 실무에 필요한 내용만 간결하게 학습할 수 있도록 설계되었습니다.\r\n\r\n핵심 개념에 집중\r\n\r\n불필요한 이론보다는 실무에서 자주 사용하는 기능과 개념(예: 클래스, 객체지향, STL 등)에 집중합니다.\r\nC와 C++의 공통점과 차이점을 명확히 구분하여 C 개발자가 쉽게 이해할 수 있도록 설명합니다.\r\nC와 C++의 차이점 중점 학습\r\n\r\n포인터와 참조, 메모리 관리의 차이\r\n구조체와 클래스의 차이 및 객체지향 프로그래밍의 기초\r\nC 스타일 코드와 C++ 스타일 코드의 변환 방법\r\n이러한 부분을 사례 중심으로 다룹니다.\r\n실무 활용 가능성\r\n\r\n강의에서 실무에서 자주 사용되는 C++ 문법과 패턴을 예제로 다룹니다.\r\nSTL(표준 템플릿 라이브러리) 활용법과 코드 최적화 팁도 포함되어 있어 학습 후 실제 프로젝트에 바로 적용이 가능합니다.\r\n기존에 C 언어를 잘 알고 계신다면, 이 강의를 통해 C++의 핵심만 빠르게 익히고 실무에 활용할 수 있을 것입니다. 강의에서 뵙길 기대합니다! 😊'),
(4, 4, '안녕하세요! 질문 주셔서 감사합니다. 😊\r\n\r\nTask 기반 비동기 프로그래밍은 비동기 작업을 효율적으로 처리하는 중요한 기술입니다. 이 강의에서는 아래와 같은 주요 개념들을 다룹니다:\r\n\r\n주요 개념\r\n\r\nTask 기반 비동기 프로그래밍에서는 작업을 Task라는 단위로 관리하며, 비동기 처리가 필요한 작업을 비동기 함수로 정의하고 이를 실행하는 방식에 대해 배웁니다.\r\n비동기 작업을 정의하고, 병렬 작업 처리와 작업 완료 후 콜백 처리를 어떻게 구현하는지에 대해 실습을 통해 익힐 수 있습니다.\r\n이벤트 루프와 콜백 함수\r\n\r\n이벤트 루프는 비동기 프로그래밍에서 중요한 개념으로, 비동기적으로 실행되는 작업들의 상태를 관리하며, 각 작업의 실행 순서를 조정합니다.\r\n또한 콜백 함수는 비동기 작업이 완료된 후 호출되는 함수로, 이를 통해 작업이 완료된 후의 처리를 어떻게 할지 배웁니다.\r\n실습을 통한 적용\r\n\r\n강의에서는 비동기 I/O 작업 처리를 예제로 다루며, 멀티태스킹을 구현하는 방법도 실습을 통해 익힙니다.\r\n실제 네트워크나 파일 입출력 작업에서 비동기 처리가 어떻게 적용될 수 있는지, Task를 사용하여 동시에 여러 작업을 효율적으로 처리하는 방법을 배우게 됩니다.\r\n프로젝트 적용\r\n\r\n강의에서는 실제 프로젝트를 통해 비동기 프로그래밍을 어떻게 활용할 수 있는지 보여줍니다. 예를 들어, HTTP 서버나 비동기 파일 다운로드와 같은 실습을 통해, 비동기 방식으로 멀티 작업을 처리하는 능력을 배울 수 있습니다.\r\n이 강의는 이론과 실습을 적절히 결합하여 비동기 프로그래밍의 핵심을 배우고, 이를 실제 환경에서 활용할 수 있는 실력을 키울 수 있도록 구성되어 있습니다. 강의에서 뵙기를 기대합니다! 😊'),
(5, 5, '안녕하세요, 좋은 질문 감사합니다.\r\n\r\nCouchbase는 원래 Membase라는 이름으로 시작되었습니다. Membase는 분산 캐시 및 저장소 솔루션으로, 빠른 읽기 성능을 제공하기 위해 메모리 중심의 구조를 가지고 있었습니다. 그러나 시간이 지나면서 개발자들은 더 많은 기능을 필요로 했고, Membase는 이러한 요구를 충족시키기 어려운 부분이 있었습니다. 그래서 Membase는 새로운 이름인 \"Couchbase\"로 변경되었고, 그에 따라 몇 가지 중요한 변화를 겪었습니다.\r\n\r\nMembase에서 Couchbase로의 전환은 기술적 성능 향상과 다양한 데이터 모델을 처리할 수 있는 능력의 확장을 의미했습니다. 이를 통해 Couchbase는 다양한 종류의 애플리케이션에서 더 널리 사용될 수 있게 되었습니다.\r\n\r\n다시 말해, 대화형 애플리케이션을 위한 최적화는 빠른 응답 시간을 제공하고, 대규모 데이터를 효율적으로 처리할 수 있게 해주는 중요한 요소입니다.\r\n\r\n이 답변이 도움이 되었기를 바랍니다. 추가적인 질문이 있으면 언제든지 물어보세요!'),
(6, 6, '<p>안녕하세요, 좋은 질문 감사합니다.</p>\r\n\r\n<p>Amazon Keyspaces는 Apache Cassandra와 완전히 호환되는 완전 관리형 데이터베이스 서비스로, 기존에 Cassandra를 사용하고 있는 애플리케이션에게 여러 가지 중요한 장점과 편리함을 제공합니다. 주요 장점과 기능은 다음과 같습니다.</p>\r\n\r\n<p>서버리스 환경에서 자동 확장/축소</p>\r\n<p>Amazon Keyspaces는 서버리스 방식으로 운영되므로, 별도의 인프라 관리 없이 자동으로 테이블 규모를 확장하거나 축소할 수 있습니다.</p>\r\n\r\n<p>고가용성 및 내구성</p>\r\n<p>Amazon Keyspaces는 AWS의 글로벌 인프라에서 운영되므로, 내구성 및 가용성이 매우 뛰어납니다.</p>\r\n\r\n<p>관리의 용이함</p>\r\n<p>Amazon Keyspaces는 완전 관리형 서비스이기 때문에, 하드웨어 관리나 소프트웨어 패치, 클러스터 관리와 같은 복잡한 작업을 AWS가 처리해 줍니다.</p>\r\n\r\n<p>Cassandra와의 호환성</p>\r\n<p>기존에 Cassandra를 사용 중인 경우, Amazon Keyspaces로의 마이그레이션은 매우 쉽습니다. Keyspaces는 Cassandra의 CQL(Cassandra Query Language)을 지원하므로, 기존 애플리케이션을 거의 변경 없이 그대로 사용할 수 있습니다.</p>\r\n\r\n<p>비용 효율성</p>\r\n<p>Keyspaces는 사용한 만큼만 비용을 지불하는 방식이므로, 테이블의 용량이나 처리량에 따라 비용이 자동으로 조정됩니다.</p>\r\n\r\n<p>결론적으로, Amazon Keyspaces는 기존의 Cassandra 기반 애플리케이션을 AWS의 관리형 서비스로 전환하는데 있어 많은 편의와 효율을 제공합니다. 서버리스 관리, 자동 확장/축소, 높은 가용성, 관리의 용이함 등 다양한 장점을 통해 운영 비용을 절감하고, 개발자는 더 중요한 업무에 집중할 수 있습니다.</p>'),
(7, 7, '안녕하세요, 좋은 질문 감사합니다!\r\n\r\nMongoDB와 같은 NoSQL 데이터베이스는 관계형 데이터베이스(RDBMS)와는 다른 방식으로 데이터를 저장하고 처리합니다. MongoDB는 문서 지향적인 데이터베이스로, JSON 형태로 데이터를 저장하고, 스키마가 유연하며, 대규모 데이터 처리에 강점을 가지고 있습니다. 하지만 이를 잘못 사용하면 성능 저하나 데이터 불일치와 같은 문제가 발생할 수 있습니다.'),
(8, 11, '<p>HTML에서 중요한 것은 태그뿐만 아니라, 문서 구조의 일관성과 의미를 제대로 전달하는 것입니다. 웹 페이지의 접근성을 향상시키기 위해 각 요소의 역할을 명확하게 이해하고 사용하는 것이 좋습니다.</p>\r\n\r\n<p>문서 구조의 일관성: 웹 페이지를 구성할 때, 적절한 순서로 요소를 배치하고 구조를 유지하는 것이 중요합니다. 헤드와 바디 섹션을 잘 활용하여 문서의 메타데이터와 콘텐츠를 분리하는 것이 필요합니다.</p>\r\n\r\n<p>스타일링과 JavaScript의 조화: HTML은 문서의 기본 구조를 정의하는 중요한 부분입니다. 그러나, 스타일링이나 기능 추가를 위해 CSS와 JavaScript도 함께 사용됩니다. 이 세 가지 기술을 잘 통합하여 웹 페이지를 더욱 직관적이고 사용자 친화적으로 만드는 것이 좋습니다.</p>\r\n\r\n<p>각 요소와 기술을 잘 이해하고 활용하면, 웹 페이지의 성능과 접근성을 향상시킬 수 있습니다.</p>'),
(9, 12, '<p>링크를 연결할 때는 두 가지 경로 유형이 있습니다: 상대 경로와 절대 경로입니다.</p> <p>- **상대 경로**: 현재 파일을 기준으로 다른 파일이나 페이지를 연결할 때 사용합니다. 예를 들어, `href=\"about.html\"`은 현재 폴더 내에 있는 `about.html` 파일을 링크하는 것입니다. 상대 경로는 사이트 내에서 페이지가 이동할 때 유용합니다.</p> <p>- **절대 경로**: 사이트의 전체 URL을 포함하는 경로로, 예를 들어 `href=\"https://www.example.com/about.html\"`처럼 작성됩니다. 절대 경로는 어떤 위치에서든 동일한 링크를 가리킬 수 있습니다.</p> <p>상대 경로는 웹사이트 내에서 여러 페이지 간에 링크를 설정할 때 유용하고, 절대 경로는 외부 사이트나 다른 도메인으로 이동할 때 사용됩니다. 두 가지 방법을 상황에 맞게 적절히 사용하세요!</p>'),
(10, 13, '<p>안녕하세요! PHP에서 변수의 데이터 타입을 변환하는 방법에 대해 설명드리겠습니다.</p> <p>PHP에서는 변수의 데이터 타입을 변환하는 여러 방법이 있습니다. 가장 기본적인 방법은 타입 캐스팅(type casting)입니다. 예를 들어, 문자열을 정수로 변환하고 싶다면 `(int)` 또는 `(float)`와 같은 형식으로 변수 앞에 타입을 명시할 수 있습니다. 예시:</p> <pre> $var = \"123\"; $intVar = (int) $var; // \"123\" 문자열을 정수 123으로 변환 </pre> <p>또한, PHP에는 타입을 변환하는 함수도 있습니다. 예를 들어, `intval()`, `floatval()`, `strval()` 함수는 각각 정수형, 실수형, 문자열형으로 변환할 수 있습니다.</p> <pre> $var = \"123.45\"; $intVar = intval($var); // 123 </pre> <p>배열을 객체로 변환하는 방법도 있으며, 이는 `(object)`로 형변환을 통해 이루어집니다. 예를 들어:</p> <pre> $array = array(\"name\" => \"John\", \"age\" => 30); $object = (object) $array; // 배열을 객체로 변환 </pre> <p>이처럼 PHP에서는 다양한 방법으로 데이터 타입을 변환할 수 있으며, 상황에 맞는 방법을 선택하여 사용하면 됩니다.</p>');

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
(1, 49, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', 'figma, react, AWS, docker', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-12-19 16:36:18'),
(2, 47, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', 'figma, ios, android', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-12-19 16:36:31'),
(3, 43, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', 'figma, ios, android', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-12-19 16:36:39'),
(4, 42, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', 'vue, typescript', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-12-19 16:36:49'),
(5, 40, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', 'figma', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '<p>[개발 프로젝트 모집 내용 예시]</p>\r\n<p> 프로젝트 주제 : 책</p><p> 평점 등록 사이트 \r\n예상 모집인원 : 1명</p><p>\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, </p><p>디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏</p><p>\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!.</p><p> 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n</p><p>사이트 링크\r\nhttps://book-rating-123456</p><p>\r\n카카오 오픈채팅방으로 연락주세요!\r\n</p>', 10, 0, 135, '2024-12-19 21:44:51'),
(6, 38, '모집완료', '프로젝트 함께하실 (디자인/앱) 모집합니다🍀', '2024-12-09', '온라인', 'figma, HTML5, CSS3, javascript, react', '단기(1~2개월)', 'https://open.kakao.com/87654321', 4, '안녕하세요 😃\r\n\r\n웹/앱 크로스플랫폼 기반의 수익 창출까지 진행해볼 프로젝트 멤버를 모집합니다! 🚗\r\n\r\n수익 창출이 되는 프로젝트 완성이 최종 목표이지만 프로젝트에 적용할 기술 스택도 같이 공부하면서\r\n\r\n아이디어부터 천천히 디벨롭 할 예정입니다.\r\n\r\n단순 이력서용이 아닌 팀 프로젝트를 통해 발전하고 싶으신 분들은 모두 환영입니다!\r\n\r\n관심 혹은 질문 있으신 분은 아래의 오픈카톡으로 문의 부탁드립니다!!!\r\n\r\n \r\n\r\n주제는 팀 빌딩 이후 같이 아이디어 회의를 진행할 예정입니다.\r\n\r\n \r\n\r\n모집 인원(우선 모집 후에 인원 추가 예정입니다.)⭐️ \r\n\r\n현재 인원\r\n\r\n- 백엔드(Spring Boot): 3명 \r\n\r\n - 프론트엔드(React): 3명\r\n\r\n \r\n\r\n지원 자격 ⭐\r\n- 앱개발자의 경우 취준생 및 주니어\r\n\r\n- 끝까지 함께 하실 분! ⭐ ⭐ ⭐\r\n\r\n- 평일 오후 9시 이후 디스코드 온라인 회의 가능하신 분\r\n\r\n- 서울 오프라인 회의 참석 가능하신 분(월 1회 예정)\r\n\r\n- 커뮤니케이션 원활하고 적극적이신 분! ⭐ ⭐ ⭐\r\n\r\n \r\n\r\n주의 사항 ⭐\r\n- 취업 및 이직용 포트폴리오가 목적이 아니에요 !\r\n\r\n- 수익 창출까지 진행하면서 과정 속에서 기술도 습득하고 역량을 키우는 것 또한 목적에 포함되어 있어요 !\r\n\r\n- 다 함께 편안한 분위기에서 개발하는 것을 지향해요 !\r\n\r\n- 물론 실력이 좋으신 분이면 좋지만, 그렇지 않아도 열심히 하실 분이면 모두 지원해주세요 !', 8, 0, 125, '2024-12-19 16:37:09'),
(7, 35, '모집중', '🕐 [iOS] 약속 관리 플랫폼 \'아이쿠\'에서 Swift 개발자를 찾습니다!', '2024-11-21', '온라인', 'ios, swift', '장기(6개월이상)', 'https://open.kakao.com/87654321', 4, '현재 개발이 80% 정도 진행된 상태이며, iOS 개발 팀 분들의 개인적인 사정으로 새로운 개발자 분을 찾게 되었습니다!\r\n\r\n기존 코드의 리팩토링과 기능 개발을 맡아주시게 될 것 같습니다.\r\n\r\n(이전 개발자 분들의 인계는 정상적으로 이루어질 예정입니다.)\r\n\r\n \r\n\r\n주제 : 약속 관리 어플리케이션 (합류 후 세부 내용 공유)\r\n\r\n일정 : 12월 중순 런칭 예정\r\n\r\n🌟 필수 조건 🌟\r\n\r\n서버와 통신 경험을 갖고 계신 분\r\n책임감을 갖고 런칭까지 열정적으로 완주 가능하신 분!\r\n \r\n\r\n🌟 우대 사항 🌟\r\n\r\n지도 API를 경험해 보신 분\r\n서비스 중심의 관점을 갖고 확장 및 아이디어 제시에 관심을 가지신 분 \r\n \r\n\r\n취준 중이신분, 대학생 모두 환영입니다.\r\n\r\n런칭 이후에도 해당 프로젝트가 스펙으로써 활용 될 수 있도록 유의미한 경험이 되셨으면 좋겠습니다.', 3, 0, 162, '2024-12-19 16:37:18'),
(8, 33, '모집중', '[교육 스타트업 - 창업 멤버 모집]', '2024-11-21', '온라인', 'figma, react, typescript, docker, android', '장기(6개월이상)', 'https://open.kakao.com/12345', 31, '[교육 스타트업 - 창업 멤버 모집]\r\n\r\n대입 수시 학생부종합전형 준비를 위한 ① Open AI를 활용한 탐구보고서 데이터 생성 판매 ②\'설탭 & 콴다\' 유형의 비교과 수업 강사 학생 매칭 플랫폼 사업을 준비중인 서울대학교 학생입니다.\r\n\r\n단순한 탐구주제 제시가 아니라, 10년동안 대치동 TOP 하이엔드 수시종합전형 전문학원의 연구진이 학교생활기록부 내신 / 비교과 진단평가 프로그램 SET + 개인 맞춤형 포트폴리오 생성 SET + 대학의 평가요소를 충족시키는 탐구보고서 작성을 위한 개인 키워드 맞춤형 탐구보고서 작성 자료 SET 2,000여편이 현재 70% 이상 준비, 개발되어 있는 상태입니다. 연내 의미있는 사이즈의 매출이 가능한 상태입니다.\r\n\r\n2028학년도 수능의 자격고사화, 현재 중3부터 고교학점제 시행 등으로 인한 빅 마켓사이즈 및 상장 경험이 많은 동업 경영진과 1년간 협업중입니다. 기존 브랜드, SNS, 마케팅 플랫폼, 오프라인 학원이 준비되어 있습니다. 로드맵 별로 설립/ 매출/ 엔젤투자/ 기관투자/ IPO 시나리오/ 강남 사무실 등이 준비되어 있습니다. 함께 창업을 통해 결실을 거둘 수 있는 멤버를 원합니다. 대학생 - 대학원생 - 초기창업자 - 관련 강사 등 미래를 위한 꿈과 실력을 갖출 수 있는 동료를 기다리겠습니다\r\n\r\n- 기획 마케팅 전문가\r\n\r\n- 프론트 백엔드 개발자\r\n\r\n- Devops 개발자\r\n\r\n- 디자이너\r\n\r\n- 웹 개발자\r\n\r\n- AI 개발자\r\n\r\n- 빅데이터 분석', 42, 0, 324, '2024-12-19 16:37:27'),
(9, 32, '모집중', '[엑셀러레이터선정] Corporate Analytics 마지막 모집', '2024-11-25', '온라인', 'mongodb, python', '장기(6개월이상)', ' https://forms.gle/MQgv7z12345', 4, '소개:\r\n\r\n런던, 뉴욕, 홍콩의 외국 금융사에 특화 된 대안 데이터 기반 기업 위험 산정 및 시그널 인텔리젼스 웹 어플리케이션 입니다.\r\n\r\n지식산업으로 30조원의 매출을 내는 다국적기업에서 일하며 체득한 경험을 살려\r\n\r\n알고 있는 문제점들을 보완 해 170조원의 수출 시장을 공략하고 있습니다.\r\n\r\n2024년 8월 사업계획을 잡아 8월 중순에 엑셀러레이팅 주관사로부터 선정 되었습니다.\r\n\r\n전반적인 사업 계획 및 타임라인은 아래와 같습니다\r\n\r\n타임라인:\r\n\r\n프로토타입 개발 중이며 25년 1월중 완성 후 지원 사업 및 VC 투자 받은 후 직접 직장을 만드는 자유도 높은 과정 입니다.\r\n\r\n고객군이 해외에 있는 서비스 특성상, 해외 본사 그리고 국내 연구 개발 지사 형태로 법인설립을 고려하고 있습니다.\r\n\r\n제가 처음에는 프로덕 개발과 구성 및 기능에 참여하고 나중에는 해외 B2B 세일즈 및 네트워크 홍보 그리고 국내외 지원 사업\r\n\r\nIR 및 연구개발 사업 모집에 다닐 것으로 예상하고 있습니다.\r\n\r\n금년\r\n\r\n8월 -12월 엑셀러레이팅 과정 진행 및 VC 멘토링\r\n\r\n2025년 1월 - 4월 지주회사 및 국내 법인 설립\r\n\r\n정예 인원으로 각 분야에서 경력 및 전문성이 유망하신 분들이 참여해 주시고 있습니다.\r\n\r\n현재 참여 인원은 아래와 같습니다\r\n\r\n사업 총괄: 다국적기업 글로벌 데이터과학부서 연구전문 (인텔리전스 특화)\r\n\r\n백엔드/클라우드: 10년차 엔지니어 GCP, BigQuery, Scala, Java, Python, MongoDB, Django, JS 등 \r\n\r\n데이터 엔지니어: 5년차 엔지니어 Azure, Confluent, Debezium, Hadoop, CDC Pipilines, Databricks\r\n\r\nAI: 1.5년차 AI 엔지니어 Word Vector, Keras, Tensorflow, GraphNLP, React, Deeplearning research\r\n\r\n마케팅 자문: 외국계 B2B 컨슈머 리서치 및 마케팅 팀장 10년+ 경력\r\n\r\n주요 관심 인력은 아래와 같습니다\r\n\r\n지분 참여형 프론트엔드 1분 - 웹어플리케이션 SaaS 제품이나 서비스 개발 경력 연관성이 많습니다. UI/UX 경험도 환영합니다.\r\n\r\nUI/UX 경력 및 전문가 계시면 또한 연락 주세요 (1분)\r\n\r\n현재 일주일에 한번 서로 주로 역삼동에서 오프라인으로 만나보며 편하게 진행하고 있으며 온라인으로는 Confluence 와 슬랙 그리고 Jira 플랫폼을 이용합니다.\r\n\r\n나이/성별/타이틀/회사소중대무/국립사립/대졸고졸/대학회사브랜드인지도 상관없이 이 과정에서 좋은 분들을 만나고 뜻있게 만들고자 하시는 분들은 많은 성원 주시길 바랍니다.', 42, 0, 178, '2024-12-19 16:37:40'),
(10, 25, '모집중', '같이 포트폴리오용 프로젝트 하실 취준생(대학생) 구해요.', '2024-12-02', '온라인', 'AWS', '장기(6개월이상)', ' https://forms.gle/Mv7z12345', 7, '프로젝트 주제 : 로스트아크의 파티 신청 화면을 실시간으로 공유받아, 컴퓨터 비전을 통해 닉네임 텍스트를 읽어오고, 이를 바탕으로 로스트아크 API를 호출해 정보를 제공하는 웹사이트 개발 프로젝트입니다.추가로, 블랙리스트 데이터베이스를 이용해 사용자들끼리 불량 플레이어 정보를 공유하여, 파티 가입 전에 예방할 수 있는 시스템을 구현합니다\r\n \r\n\r\n프로젝트 목표 : 기획, 개발, 배포까지의 전 과정을 직접 경험하며 실무 역량을 키우고 포트폴리오 제작\r\n예상 프로젝트 일정(횟수) : 약 1개월 (MVP 완성까지, 중도 하차 가능)\r\n\r\n프로젝트 소개와 개설 이유 : 개발 전 과정을 경험하고, 실무에 필요한 기술 스택을 익히기 위해포트폴리오로 활용 가능한 프로젝트를 완성하기 위해취업/창업을 목표로, 실무 환경에서의 협업 경험을 쌓기 위해\r\n \r\n\r\n프로젝트 관련 주의사항 : Git 및 협업 도구에 익숙하지 않아도 괜찮습니다.로컬 환경 개발만 해봤거나, 외부 배포 경험이 없어도 지원 가능합니다.이 프로젝트는 수익 창출이 목적이 아니며, 서버/API 비용 발생 시 제가 지불할 예정입니다.기본 API 연동 및 URL 처리 부분은 개발이 완료된 상태이며, 필요 시 다시 설계해도 무방합니다.\r\n', 22, 0, 175, '2024-12-19 16:00:45'),
(11, 30, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', 'figma, react, googlecloud', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-12-19 16:37:51'),
(12, 29, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', 'figma, ios, android', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-12-19 16:38:01'),
(13, 16, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', 'figma, ios, android', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-12-19 16:38:11'),
(14, 13, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', 'vue, typescript', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며, 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야합니다.\r\n\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -> 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, 고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n\r\n \r\n\r\n프로토타입 개발 (디자인X) -> 매장 전달 -> 피드백 수용 -> 최종본 개발 (디자인O) \r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것같습니다.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.', 15, 0, 85, '2024-12-19 16:38:21'),
(15, 12, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', 'figma', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 6, '[개발 프로젝트 모집 내용 예시]\r\n\r\n프로젝트 주제 : 책 평점 등록 사이트 \r\n예상 모집인원 : 1명\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, 디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!. 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n사이트 링크\r\nhttps://book-rating-123456\r\n카카오 오픈채팅방으로 연락주세요!\r\n', 10, 0, 135, '2024-12-19 17:11:03'),
(16, 11, '모집완료', '프로젝트 함께하실 (디자인/앱) 모집합니다🍀', '2024-12-09', '온라인', 'figma, HTML5, CSS3, javascript, react', '단기(1~2개월)', 'https://open.kakao.com/87654321', 4, '안녕하세요 😃\r\n\r\n웹/앱 크로스플랫폼 기반의 수익 창출까지 진행해볼 프로젝트 멤버를 모집합니다! 🚗\r\n\r\n수익 창출이 되는 프로젝트 완성이 최종 목표이지만 프로젝트에 적용할 기술 스택도 같이 공부하면서\r\n\r\n아이디어부터 천천히 디벨롭 할 예정입니다.\r\n\r\n단순 이력서용이 아닌 팀 프로젝트를 통해 발전하고 싶으신 분들은 모두 환영입니다!\r\n\r\n관심 혹은 질문 있으신 분은 아래의 오픈카톡으로 문의 부탁드립니다!!!\r\n\r\n \r\n\r\n주제는 팀 빌딩 이후 같이 아이디어 회의를 진행할 예정입니다.\r\n\r\n \r\n\r\n모집 인원(우선 모집 후에 인원 추가 예정입니다.)⭐️ \r\n\r\n현재 인원\r\n\r\n- 백엔드(Spring Boot): 3명 \r\n\r\n - 프론트엔드(React): 3명\r\n\r\n \r\n\r\n지원 자격 ⭐\r\n- 앱개발자의 경우 취준생 및 주니어\r\n\r\n- 끝까지 함께 하실 분! ⭐ ⭐ ⭐\r\n\r\n- 평일 오후 9시 이후 디스코드 온라인 회의 가능하신 분\r\n\r\n- 서울 오프라인 회의 참석 가능하신 분(월 1회 예정)\r\n\r\n- 커뮤니케이션 원활하고 적극적이신 분! ⭐ ⭐ ⭐\r\n\r\n \r\n\r\n주의 사항 ⭐\r\n- 취업 및 이직용 포트폴리오가 목적이 아니에요 !\r\n\r\n- 수익 창출까지 진행하면서 과정 속에서 기술도 습득하고 역량을 키우는 것 또한 목적에 포함되어 있어요 !\r\n\r\n- 다 함께 편안한 분위기에서 개발하는 것을 지향해요 !\r\n\r\n- 물론 실력이 좋으신 분이면 좋지만, 그렇지 않아도 열심히 하실 분이면 모두 지원해주세요 !', 8, 0, 125, '2024-12-19 16:38:45'),
(17, 10, '모집중', '🕐 [iOS] 약속 관리 플랫폼 \'아이쿠\'에서 Swift 개발자를 찾습니다!', '2024-11-21', '온라인', 'swift, ios', '장기(6개월이상)', 'https://open.kakao.com/87654321', 4, '현재 개발이 80% 정도 진행된 상태이며, iOS 개발 팀 분들의 개인적인 사정으로 새로운 개발자 분을 찾게 되었습니다!\r\n\r\n기존 코드의 리팩토링과 기능 개발을 맡아주시게 될 것 같습니다.\r\n\r\n(이전 개발자 분들의 인계는 정상적으로 이루어질 예정입니다.)\r\n\r\n \r\n\r\n주제 : 약속 관리 어플리케이션 (합류 후 세부 내용 공유)\r\n\r\n일정 : 12월 중순 런칭 예정\r\n\r\n🌟 필수 조건 🌟\r\n\r\n서버와 통신 경험을 갖고 계신 분\r\n책임감을 갖고 런칭까지 열정적으로 완주 가능하신 분!\r\n \r\n\r\n🌟 우대 사항 🌟\r\n\r\n지도 API를 경험해 보신 분\r\n서비스 중심의 관점을 갖고 확장 및 아이디어 제시에 관심을 가지신 분 \r\n \r\n\r\n취준 중이신분, 대학생 모두 환영입니다.\r\n\r\n런칭 이후에도 해당 프로젝트가 스펙으로써 활용 될 수 있도록 유의미한 경험이 되셨으면 좋겠습니다.', 3, 0, 162, '2024-12-19 16:39:10'),
(18, 9, '모집중', '[교육 스타트업 - 창업 멤버 모집]', '2024-11-21', '온라인', 'figma, android', '장기(6개월이상)', 'https://open.kakao.com/12345', 16, '[교육 스타트업 - 창업 멤버 모집]\r\n\r\n대입 수시 학생부종합전형 준비를 위한 ① Open AI를 활용한 탐구보고서 데이터 생성 판매 ②\'설탭 & 콴다\' 유형의 비교과 수업 강사 학생 매칭 플랫폼 사업을 준비중인 서울대학교 학생입니다.\r\n\r\n단순한 탐구주제 제시가 아니라, 10년동안 대치동 TOP 하이엔드 수시종합전형 전문학원의 연구진이 학교생활기록부 내신 / 비교과 진단평가 프로그램 SET + 개인 맞춤형 포트폴리오 생성 SET + 대학의 평가요소를 충족시키는 탐구보고서 작성을 위한 개인 키워드 맞춤형 탐구보고서 작성 자료 SET 2,000여편이 현재 70% 이상 준비, 개발되어 있는 상태입니다. 연내 의미있는 사이즈의 매출이 가능한 상태입니다.\r\n\r\n2028학년도 수능의 자격고사화, 현재 중3부터 고교학점제 시행 등으로 인한 빅 마켓사이즈 및 상장 경험이 많은 동업 경영진과 1년간 협업중입니다. 기존 브랜드, SNS, 마케팅 플랫폼, 오프라인 학원이 준비되어 있습니다. 로드맵 별로 설립/ 매출/ 엔젤투자/ 기관투자/ IPO 시나리오/ 강남 사무실 등이 준비되어 있습니다. 함께 창업을 통해 결실을 거둘 수 있는 멤버를 원합니다. 대학생 - 대학원생 - 초기창업자 - 관련 강사 등 미래를 위한 꿈과 실력을 갖출 수 있는 동료를 기다리겠습니다\r\n\r\n- 기획 마케팅 전문가\r\n\r\n- 프론트 백엔드 개발자\r\n\r\n- Devops 개발자\r\n\r\n- 디자이너\r\n\r\n- 웹 개발자\r\n\r\n- AI 개발자\r\n\r\n- 빅데이터 분석', 42, 0, 324, '2024-12-19 16:39:51'),
(19, 15, '모집중', '[엑셀러레이터선정] Corporate Analytics 마지막 모집', '2024-11-25', '온라인', 'python, googlecloud, mongodb', '장기(6개월이상)', ' https://forms.gle/MQgv7z12345', 4, '소개:\r\n\r\n런던, 뉴욕, 홍콩의 외국 금융사에 특화 된 대안 데이터 기반 기업 위험 산정 및 시그널 인텔리젼스 웹 어플리케이션 입니다.\r\n\r\n지식산업으로 30조원의 매출을 내는 다국적기업에서 일하며 체득한 경험을 살려\r\n\r\n알고 있는 문제점들을 보완 해 170조원의 수출 시장을 공략하고 있습니다.\r\n\r\n2024년 8월 사업계획을 잡아 8월 중순에 엑셀러레이팅 주관사로부터 선정 되었습니다.\r\n\r\n전반적인 사업 계획 및 타임라인은 아래와 같습니다\r\n\r\n타임라인:\r\n\r\n프로토타입 개발 중이며 25년 1월중 완성 후 지원 사업 및 VC 투자 받은 후 직접 직장을 만드는 자유도 높은 과정 입니다.\r\n\r\n고객군이 해외에 있는 서비스 특성상, 해외 본사 그리고 국내 연구 개발 지사 형태로 법인설립을 고려하고 있습니다.\r\n\r\n제가 처음에는 프로덕 개발과 구성 및 기능에 참여하고 나중에는 해외 B2B 세일즈 및 네트워크 홍보 그리고 국내외 지원 사업\r\n\r\nIR 및 연구개발 사업 모집에 다닐 것으로 예상하고 있습니다.\r\n\r\n금년\r\n\r\n8월 -12월 엑셀러레이팅 과정 진행 및 VC 멘토링\r\n\r\n2025년 1월 - 4월 지주회사 및 국내 법인 설립\r\n\r\n정예 인원으로 각 분야에서 경력 및 전문성이 유망하신 분들이 참여해 주시고 있습니다.\r\n\r\n현재 참여 인원은 아래와 같습니다\r\n\r\n사업 총괄: 다국적기업 글로벌 데이터과학부서 연구전문 (인텔리전스 특화)\r\n\r\n백엔드/클라우드: 10년차 엔지니어 GCP, BigQuery, Scala, Java, Python, MongoDB, Django, JS 등 \r\n\r\n데이터 엔지니어: 5년차 엔지니어 Azure, Confluent, Debezium, Hadoop, CDC Pipilines, Databricks\r\n\r\nAI: 1.5년차 AI 엔지니어 Word Vector, Keras, Tensorflow, GraphNLP, React, Deeplearning research\r\n\r\n마케팅 자문: 외국계 B2B 컨슈머 리서치 및 마케팅 팀장 10년+ 경력\r\n\r\n주요 관심 인력은 아래와 같습니다\r\n\r\n지분 참여형 프론트엔드 1분 - 웹어플리케이션 SaaS 제품이나 서비스 개발 경력 연관성이 많습니다. UI/UX 경험도 환영합니다.\r\n\r\nUI/UX 경력 및 전문가 계시면 또한 연락 주세요 (1분)\r\n\r\n현재 일주일에 한번 서로 주로 역삼동에서 오프라인으로 만나보며 편하게 진행하고 있으며 온라인으로는 Confluence 와 슬랙 그리고 Jira 플랫폼을 이용합니다.\r\n\r\n나이/성별/타이틀/회사소중대무/국립사립/대졸고졸/대학회사브랜드인지도 상관없이 이 과정에서 좋은 분들을 만나고 뜻있게 만들고자 하시는 분들은 많은 성원 주시길 바랍니다.', 42, 0, 178, '2024-12-19 16:41:10'),
(20, 14, '모집중', '같이 포트폴리오용 프로젝트 하실 취준생(대학생) 구해요.', '2024-12-02', '온라인', 'AWS', '장기(6개월이상)', ' https://forms.gle/Mv7z12345', 7, '프로젝트 주제 : 로스트아크의 파티 신청 화면을 실시간으로 공유받아, 컴퓨터 비전을 통해 닉네임 텍스트를 읽어오고, 이를 바탕으로 로스트아크 API를 호출해 정보를 제공하는 웹사이트 개발 프로젝트입니다.추가로, 블랙리스트 데이터베이스를 이용해 사용자들끼리 불량 플레이어 정보를 공유하여, 파티 가입 전에 예방할 수 있는 시스템을 구현합니다\r\n \r\n\r\n프로젝트 목표 : 기획, 개발, 배포까지의 전 과정을 직접 경험하며 실무 역량을 키우고 포트폴리오 제작\r\n예상 프로젝트 일정(횟수) : 약 1개월 (MVP 완성까지, 중도 하차 가능)\r\n\r\n프로젝트 소개와 개설 이유 : 개발 전 과정을 경험하고, 실무에 필요한 기술 스택을 익히기 위해포트폴리오로 활용 가능한 프로젝트를 완성하기 위해취업/창업을 목표로, 실무 환경에서의 협업 경험을 쌓기 위해\r\n \r\n\r\n프로젝트 관련 주의사항 : Git 및 협업 도구에 익숙하지 않아도 괜찮습니다.로컬 환경 개발만 해봤거나, 외부 배포 경험이 없어도 지원 가능합니다.이 프로젝트는 수익 창출이 목적이 아니며, 서버/API 비용 발생 시 제가 지불할 예정입니다.기본 API 연동 및 URL 처리 부분은 개발이 완료된 상태이며, 필요 시 다시 설계해도 무방합니다.\r\n', 22, 0, 175, '2024-12-19 16:41:28'),
(21, 8, '모집중', '[프론트엔드 모집] LMS 강의사이트 제작 프로젝트', '2024-11-30', '온라인', 'figma, HTML5, CSS3, javascript', '단기(1~2개월)', 'forms.gle/A1b2Cdef3gHijk', 10, '[프로젝트 주제] 온라인 강좌를 등록할 수 있는 LMS 사이트의 관리자, 강사, 수강생 버전 웹 개발\r\n[프로젝트 목표] 유저 레벨에 따라 차등 작동되는 관리자 페이지와 강사페이지와  수강생 페이지의 연계를 보여주는 LMS사이트의 개발\r\n\r\n[예상 프로젝트 일정]  매주 평일 하루 + 토요일, 토요일은 오전 9시부터 4시간정도 온라인 회의 / 목표 일정: 합류시작 ~ 12월 말 예정\r\n[개발환경] 리액트를 사용하시면 좋겠지만 뷰도 괜찮습니다\r\n[팀 구성]  디자이너 1명을 구인하고 있으며 현재 팀구성은 기획자 1명, 프론트엔드 2명, 백엔드 2명입니다.', 54, 0, 125, '2024-12-19 16:42:21'),
(22, 7, '모집완료', '지도 기반 운동 커뮤니티 플랫폼 사이드프로젝트 (마케팅/UIUX/앱개발자 구인)', '2024-11-25', '온라인', 'figma, ios, android', '장기(6개월이상)', 'forms.gle/A1b2Cdef3gHijk', 10, '사이드 프로젝트 모집 공고\r\n\r\n취준/이직자 7명 정도가 모여서 지도 기반 운동 커뮤니티 플랫폼을 개발 중입니다. 사용자가 운동 관련 정보를 공유하고, 온라인에서 오프라인으로 연결될 수 있는 소셜 플랫폼을 목표로 합니다.\r\n\r\n취준용 포트폴리오로 쓰일 예정입니다. 진지하게 사업화를 하거나 수익화를 하는 방향은 아직 생각하지 않았습니다.\r\n\r\n \r\n\r\n현재 진행 상황:\r\n\r\n서비스 컨셉 완료\r\n상세 기획 단계 \r\n목표:\r\n\r\n연내 MVP 앱 개발\r\n내년 운영 시작 \r\n기능 컨셉:\r\n\r\n지도 기반으로 운동 관련 정보를 공유하고, 원하는 위치에서 커뮤니티를 형성할 수 있는 기능 제공\r\n사용자가 직접 위치별 게시판을 생성하고 게시글 작성 및 소통 가능\r\n실시간 정보 업데이트와 관심사 기반 네트워킹 지원\r\n운동 메이트 찾기 및 오프라인 모임 연결 기능 ', 45, 0, 453, '2024-12-19 17:08:39'),
(23, 6, '모집중', '[웹 디자이너 모집] 취준/스터디용 프로젝트를 같이 진행하실 분 모집합니다!', '2024-12-02', '온라인', 'figma, HTML5, CSS3', '중기(3~6개월)', 'forms.gle/A1b2Cdef3gHijk', 2, '⭐취준/스터디용 프로젝트⭐를 함께 진행할 웹 디자이너 팀원 1명을 모집합니다!\r\n \r\n\r\n저희는 현재 백엔드 2명, 프론트엔드 2명으로 구성되어 있으며, 공공 데이터 API를 기반으로 여행 일정을 계획할 수 있는 여행 일정 프로젝트를 진행하고 있습니다. 자세한 정보는 아래 참고 부탁드립니다!\r\n\r\n \r\n\r\n현재 진행 상황\r\n프로젝트 초안 완료 \r\n와이어 프레임 존재🙆‍♀\r\n웹 디자이너 1명 모집중!\r\n \r\n\r\n회의 및 진행 방식\r\n주 1회 온라인 회의 (화요일 저녁 8시 반) -> Discord 사용중\r\n원하실 경우, 오프라인 회의도 가능합니다!\r\n \r\n\r\n함께하고 싶은 분\r\n웹 디자인 경험이 있으신 분\r\n온라인 회의 위에 써진 요일, 시간대에 참여 가능하신 분 ', 43, 0, 786, '2024-12-19 16:43:36'),
(24, 5, '모집중', '실제 매장에서 사용할 서비스 프론트엔드 모집!', '2024-11-25', '온/오프라인', 'vue, typescript', '단기(1~2개월)', 'https://open.kakao.com/o/A1b2Cdef3gHijk', 10, '<p>해당 서비스는 실제 매장에서 사용 예정인 만큼 개발 과정, 혹은 개발 후에도\r\n</p><p>\r\n의견을 전달 받고 수정해 가는 과정이 있을 것이라는 점 참고해주시길 바랍니다.\r\n</p><p><br></p><p>\r\n \r\n\r\n \r\n\r\n서비스는 크게 관리자용, 고객용 2가지로 나누어 개발이 진행될 것같으며,</p><p> 예약 및 회원 관리 서비스입니다.\r\n\r\n \r\n\r\n예약 과정에는 캘린더에 클릭 혹은 드래그를 활용하여 예약을 등록할 수 있어야 합니다.\r\n</p><p>\r\n \r\n\r\n고객용에서는 예약 가능한 시간을 확인하고, 채팅 등의 방법을 이용하여 예약할 수 있어야 합니다.\r\n</p><p>\r\n \r\n\r\n \r\n\r\n \r\n\r\n개발 순서는 관리자용 -&gt; 고객용 이며,\r\n\r\n \r\n\r\n관리자용의 구상은 마무리가 되어, 기본적인 API는 개발이 된 상황이고, </p><p>고객용 페이지는 참여하시는 분들의 의견을 전달 받고 기획을 진행할 예정입니다.\r\n</p><p><br></p><p>\r\n \r\n\r\n \r\n\r\n프로젝트 진행은\r\n</p><p>\r\n \r\n\r\n프로토타입 개발 (디자인X) -&gt; 매장 전달 -&gt; 피드백 수용 -&gt; 최종본 개발 (디자인O) </p><p>\r\n\r\n \r\n\r\n과 같은 순으로 진행하게 될 것 같습니다.\r\n</p><p>\r\n \r\n\r\n \r\n\r\n \r\n\r\n절대 큰 규모의 프로젝트가 아니기에 관리자용 전체 개발 기간은 1달 이내로 생각하고 있으며,\r\n</p><p>\r\n \r\n\r\n인원 선정은, 투자 가능한 시간과 기능 구현이 아닌, 어떻게 해야 더 효율적으로 작동할지를 </p><p>고민할 수 있는 분들을 우선으로 선정하게 될 것같습니다.</p>', 15, 1, 85, '2024-12-19 21:49:57'),
(25, 4, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', 'figma, firebase', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '<p>[개발 프로젝트 모집 내용 예시]</p>\r\n<p>프로젝트 주제 : 책</p>\r\n<p> 평점 등록 사이트 \r\n예상 모집인원 : 1명</p><p>\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, </p><p>디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏</p><p>\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!.</p><p> 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n</p><p>사이트 링크\r\nhttps://book-rating-123456</p><p>\r\n카카오 오픈채팅방으로 연락주세요!\r\n</p>', 10, 1, 135, '2024-12-19 21:43:51');

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
(3, 101, 'A0003', 'B0006', 'C0028', 'Wazuh+ELK(SIEM)를 활용한 위협헌팅(Threat Hunting) 시스템 구축 및 운영실습', 'security 시험', '4', '다음 중 SQL Injection의 공격 유형이 아닌 것은?', '[\"인증 우회\",\"데이터 노출\",\"원격 명령 실행\",\"서비스 거부\"]', '서비스 거부는 DOS공격유형의 목적', 0),
(4, 101, 'A0003', 'B0006', 'C0028', 'Wazuh+ELK(SIEM)를 활용한 위협헌팅(Threat Hunting) 시스템 구축 및 운영실습', 'security 시험', '4', '정찰공격(reconnaissance attack)을 위해 사용되는 도구가 아닌 것은?', '[\"핑 스윕(Ping sweep)\",\"포트 스캔(Port scan)\",\"패킷 스니퍼(Packet sniffer)\",\"포트 리다이렉션(Port redirection)\"]', '로트 리다이렉션(Port redirection) 로트가 아니 포트 입니다.', 0),
(5, 101, 'A0003', 'B0006', 'C0028', 'Wazuh+ELK(SIEM)를 활용한 위협헌팅(Threat Hunting) 시스템 구축 및 운영실습', 'security 시험', '2', '네트워크 공격 유형이 아닌 것은?', '[\"패킷 스니핑 공격\",\"포맷스트링 공격\",\"서비스거부 공격\",\"스푸핑 공격\"]', '포맷스트링 공격은 응용 계층의 공격 유형입니다.', 0),
(6, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 시험', '4', '사회복지실천이 추구하는 방향과 일치하는 것은?', '[\"사회복지사는 면담에서 시간제한을 하여서는 안 된다.\",\"사회복지사는 실천현장에서 폐쇄적 질문을 하여서는 안 된다.\",\"사회복지사는 실천현장에서 모든 문제의 정답을 클라이언트에게 말해 주어야 한다.\",\"사회복지사는 사회복지실천에서 종결 후에도 클라이언트에게 지속적인 관심을 가져야 한다.\"]', '없음', 0),
(7, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 시험', '4', '2009년 현재 우리나라의 장애인복지법 에서 규정한 장애인의 범주에 속하지 않는 것은?', '[\"뇌병변장애\",\"안면장애\",\"장루ㆍ요루장애\",\"만성통증장애\"]', '없음', 0),
(8, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 시험', '3', '사회복지실천에서 관찰의 대상으로 옳지 않은 것은?', '[\"클라이언트의 신체언어\",\"클라이언트의 반복적인 주제 제시\",\"클라이언트가 좋아하는 기호식품의 유형\",\"클라이언트가 처음 꺼낸 말과 종결하는 말의 내용\"]', '없음', 0),
(9, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 시험', '1', '자료수집방법 중 조사대상자의 나이가 어려 구두표현의 능력이 없는 경우에 적합한 방법은?', '[\"관찰법\",\"면접법\",\"표현법\",\"질문지법\"]', '없음', 0),
(10, 100, 'A0003', 'B0006', 'C0027', 'CPPG 개인정보관리사 자격증 취득하기', 'CPPG 시험', '3', '계획 및 기본설계 과정에서 표현되는 개념 다이어그램(diagram)의 특성이 아닌 것은?', '[\"계획 및 설계개념상의 주요 기능과 공간 등의 요소를 표현한다.\",\"버블(bubble)이나 윤곽선을 사용하여 표현한다.\",\"도면상의 축척(scale)과 방위가 일치하도록 표현한다.\",\"공간 간의 맥락과 상호관계를 이해하기 쉽게 표현한다.\"]', '없음', 0),
(11, 99, 'A0003', 'B0005', 'C0026', 'C개발자를 위한 최소한의 C++', 'C/C++ 시험', '1', '다음 중 원시 프로그램이 번역되어 실행될 때의 파일 확장자로서 올바른 것은?', '[\"example.exe\",\"example.obj\",\"example.doc\",\"example.c\"]', '원시 프로그램은 목적 프로그램을 거쳐 실행 프로그램이 된다. 4번이 원시 프로그램, 2번이 목적 프로그램, 1번이 실행 프로그램에 속한다. 3번은 MS Word의 확장자이다.', 0),
(12, 99, 'A0003', 'B0005', 'C0026', 'C개발자를 위한 최소한의 C++', 'C/C++ 시험', '4', '다음 중 상수에 대한 설명으로 올바르지 않은 것은?', '[\"8진 상수를 표현할 때는 숫자 앞에 0(영)을 붙인다.\",\"16진 상수를 표현할때는 숫자 앞에 0x를 붙인다.\",\"문자형 상수는 내부적으로 정수 값이 사용된다.\",\"실수형 상수는 지수 형식으로 표시할 수 없다.\"]', 'e를 사용하여 표시할 수 있다. 예를 들면, 52.1을 5.21e1, 0.13을 1.3e-1과 같이 표시할 수 있다.', 0),
(13, 99, 'A0003', 'B0005', 'C0026', 'C개발자를 위한 최소한의 C++', 'C/C++ 시험', '2', '다음 중 디지털 방송의 일반적인 특징이 아닌 것은?', '[\"디지털 신호의 압축이 가능하다.\",\"수신전파가 일정한 값 이하가 되어도 모든 수신이 가능하다.\",\"다수의 프로그램 전송이 가능하다.\",\"다양한 기능으로 방송시스템의 지능화가 가능하다.\"]', '포맷스트링 공격은 응용 계층의 공격 유형입니다.', 0),
(14, 98, 'A0003', 'B0005', 'C0025', 'C# TCP/IP 소켓 프로그래밍', 'TCP/IP 시험', '4', '인터넷의 기본적 통신 프로토콜인 TCP/IP의 응용 서비스 계층에 관련된 프로토콜로 가장 거리가 먼 것은?', '[\"TELNET\",\"FTP\",\"SMTP\",\"ICMP\"]', 'ICMP : 호스트와 게이트웨이 간의 통신용 프로토콜의 일종입니다. TCP/IP와는 무관 합니다.', 0),
(15, 98, 'A0003', 'B0005', 'C0025', 'C# TCP/IP 소켓 프로그래밍', 'TCP/IP 시험', '1', '다음 중 TCP/IP 구성 테스트에 대한 설명으로 옳지 않은 것은?', '[\"컴퓨터의 TCP\\/IP를 빠르게 구성하려면 명령 프롬프트를 연 다음 msconfig를 입력한다.\",\"명령 프롬프트에 ping 127.0.0.1을 입력하여 루프백 주소를 ping한다.\",\"기본 게이트웨이의 IP 주소를 ping한다.\",\"DNS 서버의 IP 주소를 ping한다.\"]', '컴퓨터의 TCP/IP를 빠르게 구성하려면 명령 프롬프트를 연 다음 ipconfig를 입력합니다.', 0),
(16, 98, 'A0003', 'B0005', 'C0025', 'C# TCP/IP 소켓 프로그래밍', 'TCP/IP 시험', '3', '다음 중 TCP/IP에 대한 설명으로 옳지 않은 것은?', '[\"인터넷 연결을 위한 프로토콜이다.\",\"TCP는 두 종단 간 연결을 설정 한 후 데이터를 패킷 단위로 교환하게 된다.\",\"IP는 발신지 호스트로부터 목적지 호스트까지 데이터 전송이 될 수 있도록 라우팅, 오류보고, 상황보고 등의 기능을 수행한다.\",\"IPv6는 IPv4의 한계로 인해 출현하였다.\"]', '3번 내용은 TCP에 대한 설명입니다.', 0),
(17, 97, 'A0002', 'B0004', 'C0024', 'Couchbase 알아보기', 'Couchbase 시험', '4', '인터넷의 기본적 통신 프로토콜인 TCP/IP의 응용 서비스 계층에 관련된 프로토콜로 가장 거리가 먼 것은?', '[\"TELNET\",\"FTP\",\"SMTP\",\"ICMP\"]', 'ICMP : 호스트와 게이트웨이 간의 통신용 프로토콜의 일종입니다. TCP/IP와는 무관 합니다.', 0),
(18, 97, 'A0002', 'B0004', 'C0024', 'Couchbase 알아보기', 'Couchbase 시험', '1', '다음 중 TCP/IP 구성 테스트에 대한 설명으로 옳지 않은 것은?', '[\"컴퓨터의 TCP\\/IP를 빠르게 구성하려면 명령 프롬프트를 연 다음 msconfig를 입력한다.\",\"명령 프롬프트에 ping 127.0.0.1을 입력하여 루프백 주소를 ping한다.\",\"기본 게이트웨이의 IP 주소를 ping한다.\",\"DNS 서버의 IP 주소를 ping한다.\"]', '컴퓨터의 TCP/IP를 빠르게 구성하려면 명령 프롬프트를 연 다음 ipconfig를 입력합니다.', 0),
(19, 97, 'A0002', 'B0004', 'C0024', 'Couchbase 알아보기', 'Couchbase 시험', '3', '다음 중 TCP/IP에 대한 설명으로 옳지 않은 것은?', '[\"인터넷 연결을 위한 프로토콜이다.\",\"TCP는 두 종단 간 연결을 설정 한 후 데이터를 패킷 단위로 교환하게 된다.\",\"IP는 발신지 호스트로부터 목적지 호스트까지 데이터 전송이 될 수 있도록 라우팅, 오류보고, 상황보고 등의 기능을 수행한다.\",\"IPv6는 IPv4의 한계로 인해 출현하였다.\"]', '3번 내용은 TCP에 대한 설명입니다.', 0),
(20, 96, 'A0002', 'B0004', 'C0023', 'Amazon Keyspaces를 통한 고성능 Cassandra DB 운영하기', 'Cassandra 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(21, 96, 'A0002', 'B0004', 'C0023', 'Amazon Keyspaces를 통한 고성능 Cassandra DB 운영하기', 'Cassandra 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(22, 96, 'A0002', 'B0004', 'C0023', 'Amazon Keyspaces를 통한 고성능 Cassandra DB 운영하기', 'Cassandra 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(23, 95, 'A0002', 'B0004', 'C0022', 'mongoDB 기초부터 실무까지(feat. Node.js)', 'MongoDB 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(24, 95, 'A0002', 'B0004', 'C0022', 'mongoDB 기초부터 실무까지(feat. Node.js)', 'MongoDB 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(25, 95, 'A0002', 'B0004', 'C0022', 'mongoDB 기초부터 실무까지(feat. Node.js)', 'NoSQL 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(26, 94, 'A0002', 'B0004', 'C0021', '처음하는 MongoDB(몽고DB) 와 NoSQL(빅데이터) 데이터베이스 부트캠프 [입문부터 활용까지]', 'NoSQL 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(27, 94, 'A0002', 'B0004', 'C0021', '처음하는 MongoDB(몽고DB) 와 NoSQL(빅데이터) 데이터베이스 부트캠프 [입문부터 활용까지]', 'NoSQL 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(28, 94, 'A0002', 'B0004', 'C0021', '처음하는 MongoDB(몽고DB) 와 NoSQL(빅데이터) 데이터베이스 부트캠프 [입문부터 활용까지]', 'MongoDB 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(29, 93, 'A0002', 'B0004', 'C0020', '오라클 성능 분석과 인스턴스 튜닝 핵심 가이드', 'Oracle 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(30, 93, 'A0002', 'B0004', 'C0020', '오라클 성능 분석과 인스턴스 튜닝 핵심 가이드', 'Oracle 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(31, 93, 'A0002', 'B0004', 'C0020', '오라클 성능 분석과 인스턴스 튜닝 핵심 가이드', 'Oracle 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(32, 93, 'A0002', 'B0004', 'C0019', '다양한 사례로 익히는 SQL 데이터 분석', 'PostgreSQL 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(33, 93, 'A0002', 'B0004', 'C0019', '다양한 사례로 익히는 SQL 데이터 분석', 'PostgreSQL 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(34, 93, 'A0002', 'B0004', 'C0019', '다양한 사례로 익히는 SQL 데이터 분석', 'PostgreSQL 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(35, 92, 'A0002', 'B0004', 'C0018', 'Real MySQL 시즌 1 - Part 1', 'MySQL 시험', '3', '다음 보기 중 3차 정규화에 대한 설명으로 올바른 것은?', '[\"해당 릴레이션에 기본키를 식별한다.\",\"기본키가 하나 이상의 키로 되어 있는 경우에 부분함수 종속성을 제거한다.\",\"조인으로 발생하는 종속성을 제거한다.\",\"이행함수 종속성을 제거한다.\"]', '제3정규화는 주식별자를 제외한 칼럼 간에 종속성을 확인해서 종속성이 있으면 분할하는 과정이다.', 0),
(36, 92, 'A0002', 'B0004', 'C0018', 'Real MySQL 시즌 1 - Part 1', 'MySQL 시험', '3', '다음의 정규화 단계에서 주식별자와 관련성이 가장 낮은 것은? 5', '[\"제1정규화\",\"제2정규화\",\"제3정규화\",\"BCNF\"]', ' 제3정규화는 주식별자를 제외한 칼럼 간에 종속성을 확인해서 종속성이 있으면 분할하는 과정이다.', 0),
(37, 92, 'A0002', 'B0004', 'C0018', 'Real MySQL 시즌 1 - Part 1', 'MySQL 시험', '3', '엔터티의 종류 중 다:다 관계를 해소하려는 목적으로 인위적으로 만들어진 엔터티는 무엇인가?', '[\"기본 엔터티\",\"행위 엔터티\",\"교차 엔터티\",\"종속 엔터티\"]', '교차 엔터티 는 M:N 관계를 해소하기 위해서 인위적으로 만들어진 엔터티이다.', 0),
(38, 91, 'A0002', 'B0004', 'C0017', '백문이불여일타-데이터 분석을 위한 기초 SQL', 'SQL 시험', '2', '다음 보기 중 테이블 설계 시 인덱스와 관련된 설명으로 부적절한 것은?', '[\"주로 B-Tree 인덱스로 되어 있다.\",\"외래키가 설계되어 있는데 인덱스가 없는 상태에서 입력\\/삭제\\/수정의 부하가 생긴다.\",\"테이블에 만들 수 있는 인덱스의 수는 제한이 없으나, 너무 많이 만들면 오히려 성능 부하가 발생한다.\",\"조회는 일반적으로 인덱스가 있는 것이 유리하다.\"]', '외래키가 설계되어 있지만 인덱스가 없는 상태라면 입력/삭제/수정의 부하가 덜 생긴다.', 0),
(39, 91, 'A0002', 'B0004', 'C0017', '백문이불여일타-데이터 분석을 위한 기초 SQL', 'SQL 시험', '4', '테이블 반정규화 기법 중 테이블 병합이 아닌 것은?', '[\"1:1 관계 테이블 병합\",\"1:M 관계 테이블 병합\",\"슈퍼\\/서브 타입 테이블 병합\",\"통계 테이블 추가\"]', '통계 테이블 추가는 테이블 추가에 해당한다.', 0),
(40, 91, 'A0002', 'B0004', 'C0017', '백문이불여일타-데이터 분석을 위한 기초 SQL', 'SQL 시험', '1', 'UNION에 대한 설명 중 바른 것은?', '[\"데이터의 중복 행을 제거한다.\",\"데이터의 중복 행을 포함한다.\",\"정렬 작업을 수행하지 않는다.\",\"두 테이블에 모두 포함된 행을 검색한다.\"]', 'UNION은 중복된 행을 제거하고 정렬한다. UNION ALL은 합집합', 0),
(41, 90, 'A0002', 'B0003', 'C0016', '대세는 쿠버네티스', 'Kubernetes 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(42, 90, 'A0002', 'B0003', 'C0016', '대세는 쿠버네티스', 'Kubernetes 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(43, 90, 'A0002', 'B0003', 'C0016', '대세는 쿠버네티스', 'Kubernetes 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(44, 89, 'A0002', 'B0003', 'C0015', 'DevOps의 정석 - DevOps의 시작부터 끝까지 모두 짚어 드립니다!', 'Devops 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(45, 89, 'A0002', 'B0003', 'C0015', 'DevOps의 정석 - DevOps의 시작부터 끝까지 모두 짚어 드립니다!', 'Devops 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(46, 89, 'A0002', 'B0003', 'C0015', 'DevOps의 정석 - DevOps의 시작부터 끝까지 모두 짚어 드립니다!', 'Devops 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(47, 84, 'A0002', 'B0003', 'C0014', '서버 없이 쓰는 서버, 구글 Cloud Functions', 'Google cloud platform 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(48, 84, 'A0002', 'B0003', 'C0014', '서버 없이 쓰는 서버, 구글 Cloud Functions', 'Google cloud platform 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(49, 84, 'A0002', 'B0003', 'C0014', '서버 없이 쓰는 서버, 구글 Cloud Functions', 'Google cloud platform 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(50, 88, 'A0002', 'B0003', 'C0013', 'IT 활용자를 위한 MS Azure 2023 클라우드 서비스 입문과 실습', 'Azure 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(51, 88, 'A0002', 'B0003', 'C0013', 'IT 활용자를 위한 MS Azure 2023 클라우드 서비스 입문과 실습', 'Azure 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(52, 88, 'A0002', 'B0003', 'C0013', 'IT 활용자를 위한 MS Azure 2023 클라우드 서비스 입문과 실습', 'Azure 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(53, 87, 'A0002', 'B0003', 'C0012', '쉽게 설명하는 AWS 기초 강의', 'AWS 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(54, 87, 'A0002', 'B0003', 'C0012', '쉽게 설명하는 AWS 기초 강의', 'AWS 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(55, 87, 'A0002', 'B0003', 'C0012', '쉽게 설명하는 AWS 기초 강의', 'AWS 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(56, 86, 'A0001', 'B0002', 'C0011', 'Node.js 교과서 - 기본부터 프로젝트 실습까지', 'Node.js 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(57, 86, 'A0001', 'B0002', 'C0011', 'Node.js 교과서 - 기본부터 프로젝트 실습까지', 'Node.js 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(58, 86, 'A0001', 'B0002', 'C0011', 'Node.js 교과서 - 기본부터 프로젝트 실습까지', 'Node.js 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(59, 70, 'A0001', 'B0002', 'C0010', '한 입 크기로 잘라먹는 Next.js', 'Next.js 시험', '2', 'Next.js에서 동적 라우팅을 구현하려면 파일 이름에 어떤 문법을 사용해야 하나요?', '[\"filename.js\",\"[parameter].js\",\"{parameter}.js\",\"parameter.js\"]', 'Next.js에서 동적 라우팅을 구현하려면, 파일 이름에 대괄호([])를 사용하여 변수명을 지정합니다. 예를 들어, [id].js는 /posts/1와 같은 경로를 처리할 수 있습니다.', 0),
(60, 70, 'A0001', 'B0002', 'C0010', '한 입 크기로 잘라먹는 Next.js', 'Next.js 시험', '1', 'Next.js에서 getServerSideProps는 언제 사용해야 하나요?', '[\"정적 생성이 불가능하고, 페이지가 요청될 때마다 데이터를 받아와야 할 때\",\"페이지가 빌드 시에 정적으로 생성될 때\",\"클라이언트 측에서 데이터를 가져와야 할 때\",\"페이지가 404 에러를 처리할 때\"]', 'getServerSideProps는 요청 시마다 데이터를 받아와야 하는 페이지에 사용되며, 서버 측에서 렌더링됩니다. 이는 매 요청마다 최신 데이터를 제공하는데 유용합니다.', 0),
(61, 70, 'A0001', 'B0002', 'C0010', '한 입 크기로 잘라먹는 Next.js', 'Next.js 시험', '2', 'Next.js에서 페이지 컴포넌트를 생성하기 위해 어떤 폴더에 파일을 생성해야 하나요?', '[\"components\",\"pages\",\"public\",\"styles\"]', 'Next.js에서는 pages 폴더에 파일을 생성하면, 해당 파일이 자동으로 라우팅되며 페이지로 사용할 수 있습니다.', 0),
(62, 76, 'A0001', 'B0002', 'C0008', '제대로 파는 자바 (Java)', 'Java 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(63, 76, 'A0001', 'B0002', 'C0008', '제대로 파는 자바 (Java)', 'Java 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(64, 76, 'A0001', 'B0002', 'C0008', '제대로 파는 자바 (Java)', 'Java 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(65, 70, 'A0001', 'B0001', 'C0007', '한 입 크기로 잘라먹는 타입스크립트(TypeScript)', 'Typescript 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(66, 70, 'A0001', 'B0001', 'C0007', '한 입 크기로 잘라먹는 타입스크립트(TypeScript)', 'Typescript 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(67, 70, 'A0001', 'B0001', 'C0007', '한 입 크기로 잘라먹는 타입스크립트(TypeScript)', 'Typescript 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(68, 82, 'A0001', 'B0001', 'C0005', '윤재성의 Start Google Angular.js 앵귤러 과정', 'Angular 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(69, 82, 'A0001', 'B0001', 'C0005', '윤재성의 Start Google Angular.js 앵귤러 과정', 'Angular 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(70, 82, 'A0001', 'B0001', 'C0005', '윤재성의 Start Google Angular.js 앵귤러 과정', 'Angular 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(71, 84, 'A0001', 'B0001', 'C0005', 'Angular, 앵귤러 100분 핵심강의', 'Angular 시험2', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(72, 84, 'A0001', 'B0001', 'C0005', 'Angular, 앵귤러 100분 핵심강의', 'Angular 시험2', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(73, 84, 'A0001', 'B0001', 'C0005', 'Angular, 앵귤러 100분 핵심강의', 'Angular 시험2', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(74, 70, 'A0001', 'B0001', 'C0004', '[2024] 한입 크기로 잘라 먹는 리액트(React.js) : 기초부터 실전까지', 'React 시험', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(75, 70, 'A0001', 'B0001', 'C0004', '[2024] 한입 크기로 잘라 먹는 리액트(React.js) : 기초부터 실전까지', 'React 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(76, 70, 'A0001', 'B0001', 'C0004', '[2024] 한입 크기로 잘라 먹는 리액트(React.js) : 기초부터 실전까지', 'React 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(77, 83, 'A0001', 'B0001', 'C0004', 'React 완벽 마스터: 기초 개념부터 린캔버스 프로젝트까지', 'React 시험2', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(78, 83, 'A0001', 'B0001', 'C0004', 'React 완벽 마스터: 기초 개념부터 린캔버스 프로젝트까지', 'React 시험2', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(79, 83, 'A0001', 'B0001', 'C0004', 'React 완벽 마스터: 기초 개념부터 린캔버스 프로젝트까지', 'React 시험2', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(80, 63, 'A0001', 'B0001', 'C0003', '퍼블리싱 핵심 이론(HTML+CSS+FLEX+JQUERY)', 'Jquery 시험1', '1', '다음 중 레이아웃을 위해 HTML5에 추가된 요소가 아닌 것은?', '[\"ul\",\"header\",\"nav\",\"section\"]', 'ul은 순서 없는 목록을 나타내기 위한 요소이며, header, nav, section, article, hgroup, aside, footer는 HTML5에 레이아웃을 위해 새롭게 추가된 요소이다', 0),
(81, 63, 'A0001', 'B0001', 'C0003', '퍼블리싱 핵심 이론(HTML+CSS+FLEX+JQUERY)', 'Jquery 시험1', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(82, 63, 'A0001', 'B0001', 'C0003', '퍼블리싱 핵심 이론(HTML+CSS+FLEX+JQUERY)', 'Jquery 시험1', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(83, 82, 'A0001', 'B0001', 'C0003', '윤재성의 처음 시작하는 jQuery Programming', 'Jquery2 시험', '2', 'jQuery를 사용하기 위한 기본적인 포함 방법은 무엇인가요?', '[\"<script src=\\\"jquery.js\\\"><\\/script>\",\"<script src=\\\"jquery.min.js\\\"><\\/script>\",\"<link href=\\\"jquery.css\\\">\",\"<script src=\\\"jquery-library.js\\\"><\\/script>\"]', ' jQuery를 사용하려면 jQuery 파일을 HTML 문서에 포함해야 합니다. 보통 jquery.min.js가 많이 사용되며, src 속성으로 포함됩니다.', 0),
(84, 82, 'A0001', 'B0001', 'C0003', '윤재성의 처음 시작하는 jQuery Programming', 'Jquery2 시험', '3', 'jQuery에서 DOM 요소를 선택하는 데 사용되는 메서드는 무엇인가요?', '[\"getElementById()\",\"querySelector()\",\"$()\",\"select()\"]', 'jQuery에서는 $()를 사용하여 DOM 요소를 선택할 수 있습니다. 이는 선택자(selector)를 인자로 받아 해당 요소를 찾고 조작할 수 있는 jQuery 객체를 반환합니다.', 0),
(85, 82, 'A0001', 'B0001', 'C0003', '윤재성의 처음 시작하는 jQuery Programming', 'Jquery2 시험', '2', 'jQuery에서 \'document ready\' 이벤트를 설정하는 올바른 방법은 무엇인가요?', '[\"$(window).ready()\",\"$(document).ready()\",\"$(document).load()\",\"$(window).load()\"]', ' jQuery에서 $(document).ready()는 문서가 완전히 로드되고 DOM 트리가 준비되었을 때 실행되는 함수를 설정하는 메서드입니다.', 0),
(86, 82, 'A0001', 'B0001', 'C0003', '윤재성의 처음 시작하는 jQuery Programming', 'Jquery2 시험', '2', 'jQuery에서 ID 선택자는 어떻게 작성하나요?', '[\".id\",\"#id\",\"*id*\",\"id()\"]', 'jQuery에서 ID 선택자는 # 기호 뒤에 선택할 ID 값을 지정하는 방식으로 작성합니다. 예: $(\'#elementId\')', 0),
(87, 81, 'A0001', 'B0001', 'C0002', '순수 자바스크립트 기초에서 실무까지', 'js 시험', '1', '자바스크립트에서 함수 선언의 올바른 문법은 무엇인가요?', '[\"function myFunction() {}\",\"def myFunction() {}\",\"func myFunction() {}\",\"function: myFunction() {}\"]', '자바스크립트에서 함수는 function 키워드를 사용하여 선언합니다. 예: function myFunction() {}', 0),
(88, 81, 'A0001', 'B0001', 'C0002', '순수 자바스크립트 기초에서 실무까지', 'js 시험', '2', '자바스크립트에서 문자열을 연결할 때 사용하는 연산자는 무엇인가요?', '[\"&\",\"+\",\"*\",\"=\"]', '자바스크립트에서 문자열을 연결할 때 + 연산자를 사용합니다. 예: \"Hello, \" + \"world!\"', 0),
(89, 81, 'A0001', 'B0001', 'C0002', '순수 자바스크립트 기초에서 실무까지', 'js 시험', '2', '다음 중 자바스크립트에서 if 문을 사용하는 올바른 방식은 무엇인가요?', '[\"if x > 10 {}\",\"if (x > 10)\",\"if x > 10 then\",\"if: x > 10\"]', '자바스크립트에서 if 문은 조건식을 괄호 안에 넣어 사용합니다. 예: if (x > 10) {}', 0),
(90, 81, 'A0001', 'B0001', 'C0002', '순수 자바스크립트 기초에서 실무까지', 'js 시험', '2', '자바스크립트에서 배열의 마지막 요소를 반환하는 함수는 무엇인가요?', '[\"last()\",\"pop()\",\"push()\",\"slice()\"]', 'pop() 함수는 배열의 마지막 요소를 제거하고 그 값을 반환합니다.', 0),
(91, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 스택의 변수 구분 시험', '1', 'let과 const로 선언한 변수의 공통점은 무엇인가요?', '[\"블록 스코프를 가진다.\",\"값이 반드시 초기화되어야 한다.\",\"재선언이 가능하다.\",\"함수 호출 시 실행 컨텍스트에 추가되지 않는다.\"]', 'let과 const는 블록 스코프를 가지며, 선언된 블록을 벗어나면 접근할 수 없다.', 0),
(92, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 스택의 변수 구분 시험', '2', 'var로 선언된 변수는 어디서든 접근 가능한데, 이것은 어떤 동작 때문인가요?', '[\"동적 스코프\",\"변수 호이스팅\",\"글로벌 바인딩\",\"값 초기화\"]', 'var는 변수 호이스팅으로 인해 선언이 스코프 상단으로 끌어올려진다.', 0),
(93, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 스택의 변수 구분 시험', '3', 'let과 const가 var와 다른 점으로 올바른 것은?', '[\"함수 스코프를 가진다.\",\"선언 후 값을 변경할 수 없다.\",\"선언 전에 사용하면 ReferenceError가 발생한다.\",\"모든 변수는 초기화되지 않고 선언만 가능하다.\"]', 'let과 const는 선언 전에 접근할 경우 ReferenceError가 발생한다.', 0),
(94, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 스택의 변수 구분 시험', '2', '변수 선언 방식에서 다음 중 올바르지 않은 것은?', '[\"var는 재선언 가능하다.\",\"const는 선언 후 재할당이 가능하다.\",\"let은 블록 스코프를 가진다.\",\"const는 상수로 선언 시 초기화가 필수적이다.\"]', 'const는 상수 선언으로 재할당이 불가능하다.', 0),
(95, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트 개요 시험', '4', '실행 컨텍스트의 역할로 적절하지 않은 것은?', '[\"변수 선언 및 초기화\",\"함수 호출 시 새로운 컨텍스트 생성\",\"코드 실행 순서 관리\",\"코드 컴파일 수행\"]', '실행 컨텍스트는 코드 실행을 관리하지만, 컴파일은 실행 전에 이루어진다.', 0),
(96, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트 개요 시험', '2', '실행 컨텍스트의 주요 구성 요소에 포함되지 않는 것은?', '[\"Lexical Environment\",\"Call Stack\",\"Variable Environment\",\"this 바인딩\"]', '실행 컨텍스트는 Lexical Environment, Variable Environment, this 바인딩으로 구성되며, Call Stack은 실행 컨텍스트를 추적하는 별도 구조이다.', 0),
(97, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트 개요 시험', '4', '실행 컨텍스트 생성 시 초기화되지 않는 것은?', '[\"변수 선언\",\"함수 선언\",\"this 바인딩\",\"변수의 값 할당\"]', '변수는 선언과 초기화가 이루어지지만, 값 할당은 실행 단계에서 수행된다.', 0),
(98, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트 개요 시험', '2', '실행 컨텍스트에서 this가 결정되는 시점은 언제인가요?', '[\"전역 컨텍스트 생성 시\",\"함수 호출 시\",\"변수 선언 시\",\"이벤트 처리 시\"]', 'this는 실행 컨텍스트가 활성화될 때 결정되며, 특히 함수 호출 시 결정된다.', 0),
(99, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트의 컴포넌트 구성 시험', '2', 'Scope Chain은 무엇을 관리하나요?', '[\"호출된 함수 스택\",\"변수와 함수 선언의 검색 순서\",\"이벤트 큐의 순서\",\"동적 스코프 처리\"]', 'Scope Chain은 변수와 함수 선언의 검색 순서를 관리하며, Lexical Environment를 기반으로 한다.\r\n\r\n', 0),
(100, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트의 컴포넌트 구성 시험', '2', '실행 컨텍스트에 포함되지 않는 개념은 무엇인가요?', '[\"Lexical Environment\",\"Call Stack\",\"Variable Environment\",\"Scope Chain\"]', 'Call Stack은 실행 컨텍스트를 추적하는 외부 구조이며, 실행 컨텍스트의 구성 요소는 아니다.', 0),
(101, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트의 컴포넌트 구성 시험', '1', '실행 컨텍스트의 Variable Environment는 어떤 역할을 하나요?', '[\"선언된 변수와 초기 값을 저장한다.\",\"this 바인딩 정보를 관리한다.\",\"외부 환경 정보를 제공한다.\",\"비동기 작업을 처리한다.\"]', 'Variable Environment는 선언된 변수와 초기 값을 저장하며, 실행 중 값을 업데이트한다.', 0),
(102, 80, 'A0001', 'B0001', 'C0002', '자바스크립트 비기너: 튼튼한 기본 만들기', 'JavaScript 베이스 빌드업 실행 컨텍스트의 컴포넌트 구성 시험', '4', 'Scope Chain에 포함되지 않는 항목은?', '[\"함수 내부 스코프\",\"외부 함수의 스코프\",\"전역 스코프\",\"이벤트 큐\"]', 'Scope Chain은 함수 내부, 외부 함수, 전역 스코프 순으로 연결되며, 이벤트 큐는 포함되지 않는다.', 0),
(103, 79, 'A0001', 'B0001', 'C0001', '그림으로 배우는 HTML/CSS, 입문!', 'HTML1 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(104, 79, 'A0001', 'B0001', 'C0001', '그림으로 배우는 HTML/CSS, 입문!', 'HTML1 시험', '2', 'HTML5에서 변경된 문법은?', '[\"대소문자 입력\",\"DOCTYPE 선언\",\"태그의 종료\",\"< head >< \\/head >에 포함되는 내용\"]', 'HTML5는 DTD를 참조하지 않기 때문에 DOCTYPE 선언이 다음과 같이 간단하게 변경되었다. < !DOCTYPE html >', 0),
(105, 79, 'A0001', 'B0001', 'C0001', '그림으로 배우는 HTML/CSS, 입문!', 'HTML1 시험', '1', '다음 설명 중 잘못된 것은?', '[\"HTML5를 위하여 Adobe Flash, Microsoft Silverlight등 다양한 Plug-in을 추가로 사용된다.\",\"HTML5는 HTML, XHTML과 거의 완벽하게 호환이 된다. \",\"HTML5에서는 문자 인코딩 선언을 위하여 간단하게 문자셋만 선언하면 되도록 바뀌었다.\",\"HTML5는 아직 완성되지 않았다. \"]', 'HTML5는 추가적인 플러그-인 없이 스크립트만으로도 다양한 기능들을 제공할 수 있다.', 0),
(106, 79, 'A0001', 'B0001', 'C0001', '그림으로 배우는 HTML/CSS, 입문!', 'HTML1 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(107, 78, 'A0001', 'B0001', 'C0001', 'HTML/CSS 베이스캠프', 'HTML2 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(108, 78, 'A0001', 'B0001', 'C0001', 'HTML/CSS 베이스캠프', 'HTML2 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(109, 78, 'A0001', 'B0001', 'C0001', 'HTML/CSS 베이스캠프', 'HTML2 시험', '2', 'HTML5에서 변경된 문법은?', '[\"대소문자 입력\",\"DOCTYPE 선언\",\"태그의 종료\",\"< head >< \\/head >에 포함되는 내용\"]', 'HTML5는 DTD를 참조하지 않기 때문에 DOCTYPE 선언이 다음과 같이 간단하게 변경되었다. < !DOCTYPE html >', 0),
(110, 78, 'A0001', 'B0001', 'C0001', 'HTML/CSS 베이스캠프', 'HTML2 시험', '1', '다음 설명 중 잘못된 것은?', '[\"HTML5를 위하여 Adobe Flash, Microsoft Silverlight등 다양한 Plug-in을 추가로 사용된다.\",\"HTML5는 HTML, XHTML과 거의 완벽하게 호환이 된다. \",\"HTML5에서는 문자 인코딩 선언을 위하여 간단하게 문자셋만 선언하면 되도록 바뀌었다.\",\"HTML5는 아직 완성되지 않았다. \"]', 'HTML5는 추가적인 플러그-인 없이 스크립트만으로도 다양한 기능들을 제공할 수 있다.', 0),
(111, 77, 'A0001', 'B0001', 'C0001', 'HTML 배워서 뉴스 기사 조작하는 방법', 'HTML3 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(112, 77, 'A0001', 'B0001', 'C0001', 'HTML 배워서 뉴스 기사 조작하는 방법', 'HTML3 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(113, 77, 'A0001', 'B0001', 'C0001', 'HTML 배워서 뉴스 기사 조작하는 방법', 'HTML3 시험', '2', 'HTML5에서 변경된 문법은?', '[\"대소문자 입력\",\"DOCTYPE 선언\",\"태그의 종료\",\"< head >< \\/head >에 포함되는 내용\"]', 'HTML5는 DTD를 참조하지 않기 때문에 DOCTYPE 선언이 다음과 같이 간단하게 변경되었다. < !DOCTYPE html >', 0),
(114, 77, 'A0001', 'B0001', 'C0001', 'HTML 배워서 뉴스 기사 조작하는 방법', 'HTML3 시험', '1', '다음 설명 중 잘못된 것은?', '[\"HTML5를 위하여 Adobe Flash, Microsoft Silverlight등 다양한 Plug-in을 추가로 사용된다.\",\"HTML5는 HTML, XHTML과 거의 완벽하게 호환이 된다. \",\"HTML5에서는 문자 인코딩 선언을 위하여 간단하게 문자셋만 선언하면 되도록 바뀌었다.\",\"HTML5는 아직 완성되지 않았다. \"]', 'HTML5는 추가적인 플러그-인 없이 스크립트만으로도 다양한 기능들을 제공할 수 있다.', 0),
(115, 76, 'A0001', 'B0001', 'C0001', '제대로 파는 HTML CSS', 'HTML4 시험', '1', '다음 중 레이아웃을 위해 추가된 요소에 대한 설명이 잘못된 것은?', '[\"hgroup - 제목과 부제목을 묶는 요소\",\"article - 개별 콘텐츠를 나타내는 요소\",\"footer - 제작자의 정보나 저작권의 정보를 나타내는 요소\",\"aside - 메뉴 부분을 나타내는 요소\"]', 'aside는 좌우측의 사이드 바를 나타내는 요소로서, 본문과 직접적인 관련이 없는 링크나 관련 정보를 나타내기 위해 사용된다.', 0),
(116, 76, 'A0001', 'B0001', 'C0001', '제대로 파는 HTML CSS', 'HTML4 시험', '3', 'HTML5에서 구현할 수 있는 주요 기능에 대한 설명이 잘못 연결된 것은?', '[\"캔버스 - 2차원 그래픽을 그리기 위한 API\",\"멀티미디어 - 동영상 및 음성 재생을 위한 비디오와 오디오 API\",\"오프라인 웹 - 웹 응용을 위한 스레드 기능에 대한 API\",\"웹 소켓 - 서버측의 프로세스와 양방향 통신을 위한 API\"]', '3은 웹 워커에 대한 설명이며, 오프라인 웹은 인터넷 연결이 되지 않은 상태에서도 정상적인 기능을 지원하는 애플리케이션 캐시 API를 제공한다.', 0),
(117, 76, 'A0001', 'B0001', 'C0001', '제대로 파는 HTML CSS', 'HTML4 시험', '2', 'HTML5에서 변경된 문법은?', '[\"c\",\"DOCTYPE 선언\",\"태그의 종료\",\"< head >< \\/head >에 포함되는 내용\"]', 'HTML5는 DTD를 참조하지 않기 때문에 DOCTYPE 선언이 다음과 같이 간단하게 변경되었다. < !DOCTYPE html >', 0),
(118, 76, 'A0001', 'B0001', 'C0001', '제대로 파는 HTML CSS', 'HTML4 시험', '1', '다음 설명 중 잘못된 것은?', '[\"HTML5를 위하여 Adobe Flash, Microsoft Silverlight등 다양한 Plug-in을 추가로 사용된다.\",\"HTML5는 HTML, XHTML과 거의 완벽하게 호환이 된다. \",\"HTML5에서는 문자 인코딩 선언을 위하여 간단하게 문자셋만 선언하면 되도록 바뀌었다.\",\"HTML5는 아직 완성되지 않았다. \"]', 'HTML5는 추가적인 플러그-인 없이 스크립트만으로도 다양한 기능들을 제공할 수 있다.', 0),
(119, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '개발환경 설정 시험', '2', 'Node.js를 설치하면 함께 제공되는 도구는 무엇인가요?', '[\"Git\",\"npm\",\"Webpack\",\"Babel\"]', 'Node.js를 설치하면 패키지 관리 도구인 npm이 함께 설치됩니다.', 0),
(120, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '개발환경 설정 시험', '2', 'Vue CLI를 사용하여 프로젝트를 생성하려면 어떤 명령어를 입력해야 하나요?', '[\"vue new project-name\",\"vue create project-name\",\"npm init vue\",\"vue start project-name\"]', 'Vue CLI는 vue create 명령어로 새 프로젝트를 생성합니다.', 0),
(121, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '개발환경 설정 시험', '2', ' Vue.js 개발 환경에서 hot-reload의 역할은 무엇인가요?', '[\"프로젝트의 오류를 자동으로 수정해준다.\",\"변경된 내용을 실시간으로 브라우저에 반영한다.\",\"소스 코드를 백업한다.\",\"실행 속도를 최적화한다.\"]', 'hot-reload는 변경 사항을 실시간으로 브라우저에 반영합니다.', 0),
(122, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '개발환경 설정 시험', '1', '다음 중 Vue CLI 설치를 위한 명령어로 적절한 것은?', '[\"npm install -g @vue\\/cli\",\"npm install vue-cli\",\"npm install vue\",\"npm install -g vue\"]', 'Vue CLI는 글로벌 설치를 위해 npm install -g @vue/cli를 사용합니다.', 0),
(123, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vue.js 소개, 인스턴스, 컴포넌트 시험', '2', 'Vue 인스턴스 생성 시 반드시 지정해야 하는 옵션은 무엇인가요?', '[\"methods\",\"el 또는 template\",\"router\",\"data\"]', 'Vue 인스턴스는 el(대상 요소) 또는 template이 필요합니다.', 0),
(124, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vue.js 소개, 인스턴스, 컴포넌트 시험', '3', 'Vue 컴포넌트에서 데이터는 어떤 속성에 정의되나요?', '[\"methods\",\"computed\",\"data\",\"template\"]', '데이터는 data 속성에 정의되며, 함수로 반환해야 합니다.', 0),
(125, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vue.js 소개, 인스턴스, 컴포넌트 시험', '1', 'Vue.js에서 템플릿에 데이터를 바인딩하기 위해 사용하는 방식은 무엇인가요?', '[\"{{ }}\",\"[[ ]]\",\"<< >>\",\"(())\"]', 'Vue.js는 데이터 바인딩을 위해 {{ }}를 사용합니다.', 0),
(126, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vue.js 소개, 인스턴스, 컴포넌트 시험', '3', 'Vue 컴포넌트는 다음 중 무엇을 반드시 포함해야 하나요?', '[\"style\",\"script\",\"template\",\"data\"]', 'Vue 컴포넌트는 UI를 렌더링하기 위해 template이 필수입니다.', 0),
(127, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '컴포넌트 통신방법 시험', '2', '자식 컴포넌트에서 부모로 데이터를 전달하는 방법은 무엇인가요?', '[\"props\",\"이벤트 emit\",\"computed\",\"template\"]', '자식은 emit 메서드를 사용하여 부모에게 이벤트를 전달합니다.', 0),
(128, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '컴포넌트 통신방법 시험', '3', '두 컴포넌트 간의 데이터를 공유하려면 어떤 방법을 사용하는 것이 좋나요?', '[\"props\",\"methods\",\"Vuex 또는 event bus\",\"computed\"]', 'Vuex 또는 event bus를 사용하여 두 컴포넌트 간에 데이터를 공유할 수 있습니다.', 0),
(129, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '컴포넌트 통신방법 시험', '3', '자식 컴포넌트에서 받은 props를 수정하려고 하면 어떤 오류가 발생하나요?', '[\"ReferenceError\",\"SyntaxError\",\"Warning\",\"TypeError\"]', 'Vue.js는 props를 직접 수정하는 것을 경고합니다.', 0),
(130, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '컴포넌트 통신방법 시험', '2', 'props의 데이터 유형을 지정할 때 사용하는 옵션은 무엇인가요?', '[\"dataType\",\"type\",\"propType\",\"kind\"]', 'props의 데이터 유형은 type 옵션으로 지정합니다.', 0),
(131, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '라우터, 통신 라이브러리 시험', '2', 'Vue Router에서 동적 라우트 매칭을 위해 사용하는 구문은 무엇인가요?', '[\"*\",\":\",\"#\",\"@\"]', '동적 라우트는 :를 사용하여 설정합니다.', 0),
(132, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '라우터, 통신 라이브러리 시험', '3', 'Axios는 Vue.js에서 어떤 목적으로 사용되나요?', '[\"라우팅\",\"CSS 관리\",\"HTTP 요청\",\"데이터 상태 관리\"]', 'Axios는 HTTP 요청을 보내고 응답을 받기 위해 사용됩니다.', 0),
(133, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '라우터, 통신 라이브러리 시험', '1', 'Vue Router에서 라우트 구성의 핵심 속성은 무엇인가요?', '[\"path, component\",\"method, data\",\"style, template\",\"event, emit\"]', '라우트는 path와 component로 정의됩니다.', 0),
(134, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '라우터, 통신 라이브러리 시험', '1', 'Vue Router에서 404 페이지를 처리하려면 어떤 구문을 사용하는 것이 일반적인가요?', '[\"*\",\":\",\"?\",\"404\"]', '*는 모든 경로를 매칭하여 404 페이지를 처리합니다.', 0),
(135, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '템플릿 문법 시험', '4', 'Vue 템플릿에서 조건부 렌더링을 위한 디렉티브는 무엇인가요?', '[\"v-for\",\"v-show\",\"v-bind\",\"v-if\"]', 'v-if 디렉티브는 조건에 따라 요소를 렌더링합니다.', 0),
(136, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '템플릿 문법 시험', '', 'Vue에서 반복 렌더링을 구현하기 위해 사용하는 디렉티브는 무엇인가요?', '[\"v-for\",\"v-if\",\"v-on\",\"v-model\"]', 'v-for는 배열이나 객체를 반복 렌더링하는 데 사용됩니다.', 0),
(137, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '템플릿 문법 시험', '2', 'v-bind 디렉티브의 주요 역할은 무엇인가요?', '[\"이벤트 바인딩\",\"클래스 및 속성 바인딩\",\"양방향 데이터 바인딩\",\"조건부 렌더링\"]', 'v-bind는 HTML 속성이나 클래스에 데이터를 바인딩할 때 사용됩니다.', 0),
(138, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '템플릿 문법 시험', '1', 'Vue 템플릿에서 기본적으로 HTML 코드를 출력하려면 어떤 디렉티브를 사용해야 하나요?', '[\"v-html\",\"v-text\",\"v-bind\",\"v-on\"]', 'v-html은 HTML 코드를 렌더링하기 위해 사용됩니다.', 0),
(139, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 생성도구 VUE CLI 시험', '2', 'Vue CLI로 생성된 프로젝트에서 메인 진입점 파일은 무엇인가요?', '[\"index.html\",\"main.js\",\"app.vue\",\"router.js\"]', 'Vue CLI로 생성된 프로젝트의 진입점은 main.js 파일입니다.', 0),
(140, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 생성도구 VUE CLI 시험', '2', 'Vue CLI에서 제공하는 기본 설정 파일은 무엇인가요?', '[\"package.json\",\"vue.config.js\",\"webpack.config.js\",\"babel.config.js\"]', 'vue.config.js는 Vue CLI에서 제공하는 기본 설정 파일입니다.', 0),
(141, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 생성도구 VUE CLI 시험', '2', 'Vue CLI에서 추가 플러그인을 설치하기 위해 사용하는 명령어는 무엇인가요?', '[\"npm install\",\"vue add\",\"vue plugin\",\"npm plugin add\"]', 'vue add 명령어는 Vue CLI 플러그인을 추가하는 데 사용됩니다.', 0),
(142, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 생성도구 VUE CLI 시험', '4', 'Vue CLI로 프로젝트를 생성할 때 기본 제공되지 않는 것은 무엇인가요?', '[\"Webpack 설정\",\"ESLint 설정\",\"Hot Reload 기능\",\"데이터베이스 연결\"]', 'Vue CLI는 데이터베이스와 같은 백엔드 설정을 제공하지 않습니다.\r\n\r\n', 0),
(143, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'SPA 예제 시험', '2', 'SPA에서 클라이언트 측 라우팅을 처리하기 위해 사용하는 도구는 무엇인가요?', '[\"Vuex\",\"Vue Router\",\"Axios\",\"Babel\"]', 'Vue Router는 SPA에서 클라이언트 측 라우팅을 처리합니다.', 0),
(144, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'SPA 예제 시험', '3', 'SPA의 단점으로 적절하지 않은 것은 무엇인가요?', '[\"초기 로딩 속도가 느릴 수 있다.\",\"SEO에 불리할 수 있다.\",\"서버 리소스 소비가 많다.\",\"자바스크립트 의존성이 높다.\"]', 'SPA는 서버 리소스를 적게 사용하지만, 클라이언트 자바스크립트 의존성이 높습니다.', 0),
(145, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'SPA 예제 시험', '3', 'SPA에서 데이터 통신을 위해 주로 사용하는 라이브러리는 무엇인가요?', '[\"Vue Router\",\"Vuex\",\"Axios\",\"ESLint\"]', 'Axios는 HTTP 요청과 데이터를 교환하기 위해 사용됩니다.', 0),
(146, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'SPA 예제 시험', '', 'SPA의 페이지 전환은 어떤 방식으로 이루어지나요?', '[\"브라우저 새로 고침\",\"서버 요청 후 전체 HTML 렌더링\",\"자바스크립트를 사용한 화면 업데이트\",\"CSS를 사용한 스타일 변경\"]', 'SPA는 자바스크립트를 통해 화면을 동적으로 업데이트합니다.', 0),
(147, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 소개 및 구현 시작 시험', '3', '프로젝트 디렉토리 구조를 설계할 때 중요한 고려 사항은 무엇인가요?', '[\"파일 이름의 길이\",\"파일의 색상 테마\",\"코드 유지보수와 확장성\",\"사용 언어의 난이도\"]', '디렉토리 구조는 코드 유지보수성과 확장성을 높이는 방향으로 설계해야 합니다.', 0),
(148, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 소개 및 구현 시작 시험', '2', 'Vue 프로젝트에서 데이터를 컴포넌트 간 공유할 때 사용하기 적합한 도구는 무엇인가요?', '[\"Vue Router\",\"Vuex\",\"ESLint\",\"Axios\"]', 'Vuex는 상태 관리를 통해 데이터를 여러 컴포넌트 간에 공유할 수 있습니다.', 0),
(149, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 소개 및 구현 시작 시험', '2', '컴포넌트를 설계할 때 가장 중요한 요소는 무엇인가요?', '[\"컴포넌트의 크기\",\"데이터와 이벤트의 명확한 인터페이스\",\"컴포넌트 파일의 위치\",\"컴포넌트의 이름 길이\"]', '컴포넌트는 명확한 데이터(props)와 이벤트(emit) 인터페이스를 제공해야 합니다.', 0),
(150, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 소개 및 구현 시작 시험', '4', '프로젝트를 Vue CLI로 생성한 경우 기본적으로 생성되지 않는 것은 무엇인가요?', '[\"src 디렉토리\",\"main.js\",\"App.vue\",\"README.md\"]', 'README.md는 프로젝트 설명을 위해 수동으로 작성해야 합니다.', 0),
(151, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 구조 개선 시험', '2', '컴포넌트 기반 개발에서 \"코드 중복 제거\"를 위한 가장 효과적인 방법은 무엇인가요?', '[\"Vuex 사용\",\"공통 컴포넌트로 분리\",\"HTML 코드 복사\",\"템플릿에만 집중\"]', '공통 기능은 컴포넌트로 분리하여 재사용할 수 있습니다.', 0),
(152, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 구조 개선 시험', '2', '프로젝트 구조 개선 시 서비스(API)와 뷰(View)를 분리하는 이유는 무엇인가요?', '[\"성능을 향상시키기 위해\",\"코드의 명확성과 유지보수성을 높이기 위해\",\"브라우저 호환성을 개선하기 위해\",\"Vuex와의 충돌을 방지하기 위해\"]', '서비스와 뷰를 분리하면 코드가 명확해지고 유지보수성이 높아집니다.', 0),
(153, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 구조 개선 시험', '2', 'Vue 프로젝트에서 CSS 관리를 효율적으로 하기 위해 사용하는 방법은 무엇인가요?', '[\"Vuex 사용\",\"컴포넌트별 스타일 정의\",\"CSS를 한 파일에 통합\",\"HTML에 인라인 스타일 적용\"]', 'Vue에서는 각 컴포넌트에 스타일을 정의하여 관리할 수 있습니다.', 0),
(154, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', '프로젝트 구조 개선 시험', '4', '프로젝트 구조 개선 과정에서 불필요한 파일을 제거하는 이유는 무엇인가요?', '[\"성능 최적화\",\"코드의 단순화\",\"유지보수 시간 단축\",\"위 모든 것\"]', '불필요한 파일 제거는 성능, 단순화, 유지보수에 모두 긍정적인 영향을 줍니다.', 0),
(155, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'ES6란? 시험', '1', 'let과 const의 공통점은 무엇인가요?', '[\"둘 다 블록 스코프를 가진다.\",\"둘 다 변수 재할당이 가능하다.\",\"둘 다 함수 스코프를 가진다.\",\"둘 다 호이스팅되지 않는다.\"]', 'let과 const는 블록 스코프를 가지며, 함수 스코프가 아닙니다.', 0),
(156, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'ES6란? 시험', '2', 'Enhanced Object Literals의 주요 특징은 무엇인가요?', '[\"더 빠른 실행 속도\",\"단축 속성 이름 및 메서드 정의\",\"객체의 크기 제한\",\"외부 라이브러리 의존성\"]', 'Enhanced Object Literals는 객체의 속성을 더 간결하게 정의할 수 있도록 돕습니다.', 0),
(157, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'ES6란? 시험', '3', 'ES6 모듈 시스템에서 export의 역할은 무엇인가요?', '[\"변수 선언\",\"함수 호출\",\"코드 공유\",\"CSS 파일 관리\"]', 'export는 다른 파일에서 코드를 재사용할 수 있도록 공유합니다.', 0),
(158, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'ES6란? 시험', '2', '화살표 함수의 주요 특징은 무엇인가요?', '[\"this를 호출 위치에 바인딩한다.\",\"this를 함수 선언 위치에 바인딩한다.\",\"일반 함수보다 느리다.\",\"인자 목록을 반드시 작성해야 한다.\"]', '화살표 함수는 선언 위치의 this를 바인딩합니다.', 0),
(159, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vuex란? 시험', '3', 'Vuex에서 상태를 변경하기 위해 호출하는 것은 무엇인가요?', '[\"actions\",\"getters\",\"mutations\",\"props\"]', '상태는 mutations를 통해서만 변경됩니다.', 0),
(160, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vuex란? 시험', '1', 'commit과 dispatch의 차이점은 무엇인가요?', '[\"commit은 mutations 호출, dispatch는 actions 호출\",\"commit은 actions 호출, dispatch는 mutations 호출\",\"둘 다 동일한 역할을 한다.\",\"commit은 비동기 처리, dispatch는 동기 처리\"]', 'commit은 mutations를 호출하고, dispatch는 actions를 호출합니다.', 0),
(161, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vuex란? 시험', '1', 'Vuex의 getters의 역할은 무엇인가요?', '[\"상태를 읽기 전용으로 접근하기 위해 사용된다.\",\"상태를 수정하기 위해 사용된다.\",\"비동기 작업을 처리한다.\",\"템플릿에 이벤트를 바인딩한다.\"]', 'getters는 상태를 읽기 전용으로 접근하는 데 사용됩니다.', 0),
(162, 102, 'A0001', 'B0001', 'C0006', 'Vue.js 설치부터 포트폴리오 제작까지', 'Vuex란? 시험', '4', 'Vuex의 헬퍼 함수로 상태를 템플릿에 쉽게 바인딩하는 방법은 무엇인가요?', '[\"mapState\",\"mapActions\",\"mapMutations\",\"위 모든 것\"]', 'mapState, mapActions, mapMutations는 Vuex 헬퍼 함수로 사용됩니다.', 0),
(163, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'APM 설치하기 시험', '4', 'APM 설치 시 사용하는 프로그램으로 적절하지 않은 것은 무엇인가요?', '[\"XAMPP\",\"WAMP\",\"LAMP\",\"Node.js\"]', 'Node.js는 자바스크립트 런타임 환경으로 APM과 무관합니다.', 0),
(164, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'APM 설치하기 시험', '1', 'APM 설치 후 PHP 코드를 실행하기 위해 필요한 디렉토리는 무엇인가요?', '[\"\\/htdocs\",\"\\/var\",\"\\/bin\",\"\\/config\"]', 'PHP 코드는 Apache의 기본 디렉토리인 /htdocs에 저장됩니다.', 0),
(165, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'APM 설치하기 시험', '3', 'APM 설치 과정에서 MySQL의 주요 역할은 무엇인가요?', '[\"HTML 렌더링\",\"웹 서버 제공\",\"데이터베이스 관리\",\"PHP 실행\"]', 'MySQL은 데이터베이스 관리 시스템으로 데이터를 저장하고 관리하는 데 사용됩니다.', 0),
(166, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'APM 설치하기 시험', '2', 'APM 설치 후 PHP 테스트를 위해 작성해야 할 기본 파일 이름은 무엇인가요?', '[\"test.html\",\"info.php\",\"config.php\",\"index.html\"]', 'PHP 환경이 제대로 설정되었는지 확인하려면 info.php 파일에 phpinfo()를 작성합니다.', 0),
(167, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'MySQL과 UTF-8 소개 시험', '2', 'MySQL에서 UTF-8의 주요 장점은 무엇인가요?', '[\"데이터 저장 용량을 줄인다.\",\"다국어 지원이 가능하다.\",\"쿼리 실행 속도가 빨라진다.\",\"데이터베이스 구조를 단순화한다.\"]', 'UTF-8은 다국어를 지원하며 대부분의 언어 문자를 저장할 수 있습니다.', 0),
(168, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'MySQL과 UTF-8 소개 시험', '3', 'MySQL에서 기본적으로 사용되는 쿼리 언어는 무엇인가요?', '[\"HTML\",\"CSS\",\"SQL\",\"JSON\"]', 'MySQL은 SQL(Structured Query Language)을 사용하여 데이터를 관리합니다.', 0),
(169, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'MySQL과 UTF-8 소개 시험', '1', 'MySQL에서 데이터베이스를 생성하는 명령어는 무엇인가요?', '[\"CREATE DATABASE\",\"MAKE DATABASE\",\"NEW DATABASE\",\"INSERT DATABASE\"]', '데이터베이스는 CREATE DATABASE 명령어로 생성합니다.', 0),
(170, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'MySQL과 UTF-8 소개 시험', '2', 'MySQL에서 UTF-8 설정을 적용하기 위해 사용하는 명령어는 무엇인가요?', '[\"SET CHARSET utf8;\",\"SET NAMES utf8;\",\"SET UTF8 CHARSET;\",\"SET DATABASE utf8;\"]', 'SET NAMES utf8은 클라이언트와 서버 간 통신에 UTF-8을 사용하도록 설정합니다.', 0),
(171, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 기초 시험', '3', 'PHP에서 문자열을 출력하기 위한 함수는 무엇인가요?', '[\"write()\",\"print()\",\"echo()\",\"output()\"]', 'PHP에서 문자열을 출력하기 위해 주로 echo()를 사용합니다.', 0),
(172, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 기초 시험', '1', 'PHP 변수 선언 시 반드시 포함되어야 하는 것은 무엇인가요?', '[\"$ 기호\",\"자료형\",\"값\",\"키워드\"]', 'PHP 변수는 $ 기호로 시작해야 합니다.', 0),
(173, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 기초 시험', '3', 'PHP에서 배열을 생성하기 위한 기본 함수는 무엇인가요?', '[\"array_create()\",\"new_array()\",\"array()\",\"list()\"]', 'array() 함수는 배열을 생성하는 데 사용됩니다.', 0),
(174, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 기초 시험', '1', 'PHP에서 연관 배열의 키와 값을 출력하기 위해 사용하는 함수는 무엇인가요?', '[\"foreach\",\"for\",\"while\",\"if\"]', 'foreach는 배열의 키와 값을 순회하며 출력합니다.', 0),
(175, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '회원가입 페이지 시험', '2', 'PHP에서 입력된 회원 정보를 서버로 처리하려면 어떤 글로벌 배열을 사용하나요?', '[\"$_REQUEST\",\"$_POST\",\"$_SESSION\",\"$_COOKIE\"]', 'POST 메서드로 전송된 데이터는 $_POST 배열에서 접근합니다.', 0),
(176, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '회원가입 페이지 시험', '2', '회원가입 시 비밀번호를 저장하기 전에 해야 할 가장 중요한 작업은 무엇인가요?', '[\"데이터 압축\",\"비밀번호 암호화\",\"데이터베이스 백업\",\"비밀번호 길이 확인\"]', '보안 강화를 위해 비밀번호를 암호화한 후 저장해야 합니다.', 0),
(177, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '회원가입 페이지 시험', '1', '회원가입 시 비밀번호 암호화를 위한 PHP 함수는 무엇인가요?', '[\"password_hash()\",\"hash_password()\",\"md5()\",\"encrypt_password()\"]', 'password_hash()는 PHP에서 안전한 비밀번호 암호화를 제공합니다.', 0),
(178, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '회원가입 페이지 시험', '3', '회원가입 페이지에서 데이터 유효성을 검사하는 이유는 무엇인가요?', '[\"데이터베이스를 최적화하기 위해\",\"사용자의 편의성을 높이기 위해\",\"보안 및 데이터 무결성을 유지하기 위해\",\"페이지 로딩 속도를 높이기 위해\"]', '유효성 검사는 보안과 데이터 무결성을 유지하기 위해 중요합니다.', 0);
INSERT INTO `test` (`exid`, `tid`, `cate1`, `cate2`, `cate3`, `title`, `tt`, `answer`, `pn`, `question`, `explan`, `pnlevel`) VALUES
(179, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'Set Cookie, MD5 암호화 시험', '2', 'PHP에서 MD5 암호화를 수행하기 위한 함수는 무엇인가요?', '[\"encrypt()\",\"md5()\",\"password_hash()\",\"sha1()\"]', 'md5() 함수는 문자열을 MD5 해시로 변환합니다.', 0),
(180, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'Set Cookie, MD5 암호화 시험', '1', '쿠키를 사용하는 주요 이유는 무엇인가요?', '[\"클라이언트의 세션 상태를 유지하기 위해\",\"데이터베이스 연결을 단순화하기 위해\",\"서버 응답 속도를 높이기 위해\",\"클라이언트에서 데이터를 암호화하기 위해\"]', '쿠키는 클라이언트의 세션 상태를 유지하기 위해 사용됩니다.', 0),
(181, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'Set Cookie, MD5 암호화 시험', '3', 'MD5 암호화의 단점으로 적절한 것은 무엇인가요?', '[\"암호화 속도가 느리다.\",\"복호화가 불가능하다.\",\"해시 충돌 가능성이 있다.\",\"데이터베이스에서 사용할 수 없다.\"]', 'MD5는 해시 충돌 가능성이 있어 보안성이 낮습니다.', 0),
(182, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'Set Cookie, MD5 암호화 시험', '1', 'PHP에서 쿠키를 삭제하려면 어떤 작업이 필요한가요?', '[\"setcookie() 함수로 만료 시간을 과거로 설정한다.\",\"쿠키 값을 null로 설정한다.\",\"unset() 함수를 사용한다.\",\"브라우저 캐시를 삭제한다.\"]', 'setcookie()를 사용해 쿠키의 만료 시간을 과거로 설정하면 쿠키가 삭제됩니다.', 0),
(183, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'CSS Style Sheet 작성 시험', '2', 'External Style Sheet의 파일 확장자는 무엇인가요?', '[\".html\",\".css\",\".js\",\".scss\"]', 'External Style Sheet는 .css 확장자를 사용합니다.', 0),
(184, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'CSS Style Sheet 작성 시험', '4', 'CSS에서 선택자가 없는 스타일 선언은 무엇에 적용되나요?', '[\"모든 HTML 요소\",\"특정 클래스\",\"특정 ID\",\"아무데도 적용되지 않는다.\"]', '선택자가 없으면 스타일 선언이 적용되지 않습니다.', 0),
(185, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'CSS Style Sheet 작성 시험', '2', 'CSS에서 ID 선택자는 어떻게 작성하나요?', '[\".\",\"#\",\"@\",\"$\"]', 'CSS에서 ID 선택자는 # 기호를 사용하여 선언합니다.', 0),
(186, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'CSS Style Sheet 작성 시험', '4', 'CSS에서 글자 색상을 설정하는 속성은 무엇인가요?', '[\"background-color\",\"font-color\",\"text-color\",\"color\"]', 'CSS에서 color 속성을 사용하여 텍스트 색상을 지정합니다.', 0),
(187, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 심화 시험', '', 'PHP에서 파일을 업로드할 때 사용하는 글로벌 배열은 무엇인가요?', '[\"$_FILES\",\"$_UPLOADS\",\"$_POST\",\"$_GET\"]', '$_FILES 배열은 파일 업로드 시 파일 정보를 저장합니다.', 0),
(188, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 심화 시험', '2', 'PHP에서 정규식을 사용하기 위한 함수는 무엇인가요?', '[\"regex_match()\",\"preg_match()\",\"match()\",\"find()\"]', 'preg_match()는 PHP에서 정규식을 매칭하는 함수입니다.', 0),
(189, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 심화 시험', '3', 'PHP에서 다차원 배열의 특정 요소에 접근하려면 어떤 표기법을 사용하나요?', '[\"array[index]\",\"array.index\",\"array[index][subindex]\",\"array->index\"]', '다차원 배열의 특정 요소는 [index][subindex] 형태로 접근합니다.', 0),
(190, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', 'PHP 심화 시험', '3', 'PHP에서 JSON 데이터를 생성하기 위한 함수는 무엇인가요?', '[\"json_create()\",\"json_write()\",\"json_encode()\",\"json_make()\"]', 'json_encode()는 PHP 배열 또는 객체를 JSON 형식으로 변환합니다.\r\n\r\n', 0),
(191, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '리스트 생성, 글쓰기, 페이지 처리 시험', '2', 'PHP에서 MySQL에 접속하기 위한 함수는 무엇인가요?', '[\"connect_mysql()\",\"mysqli_connect()\",\"db_connect()\",\"mysql_connection()\"]', 'mysqli_connect()는 PHP에서 MySQL에 연결하는 함수입니다.', 0),
(192, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '리스트 생성, 글쓰기, 페이지 처리 시험', '2', '글쓰기 폼 데이터를 서버에서 처리하기 위해 주로 사용하는 메서드는 무엇인가요?', '[\"GET\",\"POST\",\"PUT\",\"DELETE\"]', 'POST 메서드는 데이터를 안전하게 서버로 전송하는 데 사용됩니다.', 0),
(193, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '리스트 생성, 글쓰기, 페이지 처리 시험', '2', '게시판에서 각 페이지에 보여줄 항목 수를 제한하려면 무엇을 설정해야 하나요?', '[\"페이지 제한 변수\",\"LIMIT 쿼리\",\"OFFSET 쿼리\",\"사용자 세션\"]', 'MySQL의 LIMIT 쿼리를 사용하여 한 페이지에 표시할 항목 수를 제한합니다.', 0),
(194, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '리스트 생성, 글쓰기, 페이지 처리 시험', '3', '게시판에서 글 목록을 페이지로 나누는 데 사용하는 주요 PHP 기능은 무엇인가요?', '[\"문자열 분리\",\"배열 생성\",\"페이지네이션 (pagination)\",\"파일 분리\"]', '페이지네이션은 글 목록을 여러 페이지로 나누는 데 사용됩니다.', 0),
(195, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '이미지 업로드 시험', '2', '파일 업로드 시 서버에서 임시 저장되는 디렉토리는 무엇인가요?', '[\"\\/uploads\",\"\\/tmp\",\"\\/images\",\"\\/files\"]', '업로드된 파일은 서버의 /tmp 디렉토리에 임시 저장됩니다.', 0),
(196, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '이미지 업로드 시험', '3', 'PHP에서 업로드된 파일의 MIME 타입을 확인하기 위해 사용하는 함수는 무엇인가요?', '[\"file_type()\",\"get_mime()\",\"mime_content_type()\",\"type_of_file()\"]', 'mime_content_type() 함수는 파일의 MIME 타입을 확인합니다.', 0),
(197, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '이미지 업로드 시험', '3', '업로드된 파일을 실제 디렉토리로 이동시키는 PHP 함수는 무엇인가요?', '[\"move_file()\",\"file_upload()\",\"move_uploaded_file()\",\"save_file()\"]', 'move_uploaded_file() 함수는 업로드된 파일을 서버의 지정된 디렉토리로 이동시킵니다.', 0),
(198, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '이미지 업로드 시험', '2', 'PHP에서 파일 이름 충돌을 방지하기 위해 사용하는 방법은 무엇인가요?', '[\"파일 이름 하드 코딩\",\"랜덤 문자열 추가\",\"MIME 타입 확인\",\"파일 크기 확인\"]', '파일 이름 충돌을 방지하기 위해 랜덤 문자열을 추가합니다.\r\n\r\n', 0),
(199, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '프로그래밍 set cook 시험', '2', '쿠키의 만료 시간을 설정하려면 어떤 값을 사용해야 하나요?', '[\"현재 시간\",\"시간차(초 단위)\",\"날짜 형식 문자열\",\"임의의 숫자\"]', '만료 시간은 초 단위로 현재 시간에 더해 설정합니다.', 0),
(200, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '프로그래밍 set cook 시험', '2', '쿠키에 저장된 값을 읽기 위해 사용하는 PHP 글로벌 배열은 무엇인가요?', '[\"$_SESSION\",\"$_COOKIE\",\"$_FILES\",\"$_REQUEST\"]', '쿠키 데이터는 $_COOKIE 배열에서 접근할 수 있습니다.', 0),
(201, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '프로그래밍 set cook 시험', '4', '쿠키 데이터를 암호화하여 저장하려면 어떤 PHP 함수를 사용할 수 있나요?', '[\"encrypt()\",\"password_hash()\",\"md5()\",\"hash()\"]', 'hash() 함수는 데이터를 암호화하는 데 유용합니다.', 0),
(202, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '프로그래밍 set cook 시험', '1', '쿠키를 삭제하려면 어떻게 해야 하나요?', '[\"만료 시간을 현재보다 과거로 설정한다.\",\"쿠키 값을 빈 문자열로 설정한다.\",\"PHP 세션을 종료한다.\",\"서버 캐시를 초기화한다.\"]', '만료 시간을 과거로 설정하면 쿠키가 삭제됩니다.', 0),
(203, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '마무리 시험', '3', '게시판의 마무리 단계에서 필요한 작업으로 적절하지 않은 것은?', '[\"코드 최적화\",\"데이터 정리\",\"추가 기능 구현\",\"테스트 및 배포\"]', '마무리 단계에서는 추가 기능 구현보다는 안정성과 완성도를 높이는 작업이 중요합니다.', 0),
(204, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '마무리 시험', '3', 'PHP 게시판에서 CSRF 방지를 위해 사용할 수 있는 방법은 무엇인가요?', '[\"비밀번호 암호화\",\"쿠키 사용\",\"CSRF 토큰 생성\",\"세션 사용\"]', 'CSRF 방지를 위해 폼 제출 시 CSRF 토큰을 생성하고 검증합니다.', 0),
(205, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '마무리 시험', '4', '게시판 성능 최적화를 위해 사용할 수 있는 MySQL 기술은 무엇인가요?', '[\"트랜잭션\",\"인덱스\",\"쿼리 캐시\",\"모두 해당\"]', '트랜잭션, 인덱스, 쿼리 캐시는 모두 MySQL 성능 최적화에 유용합니다.', 0),
(206, 103, 'A0001', 'B0002', 'C0009', '쩡원의 PHP 게시판 무작정 만들기', '마무리 시험', '2', '게시판 배포 전에 마지막으로 확인해야 할 사항은 무엇인가요?', '[\"사용자 데이터 초기화\",\"디버그 모드 비활성화\",\"모든 쿠키 삭제\",\"PHP 버전 업데이트\"]', '디버그 모드는 배포 전에 비활성화하여 불필요한 정보 노출을 방지해야 합니다.', 0),
(207, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '자바스크립트 실행 방법 시험', '1', '외부 JavaScript 파일을 연결하기 위해 사용하는 태그 속성은 무엇인가요?', '[\"src\",\"href\",\"link\",\"include\"]', '<script> 태그의 src 속성을 사용해 외부 JavaScript 파일을 연결합니다.', 0),
(208, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '자바스크립트 실행 방법 시험', '2', '자바스크립트 코드를 HTML 파일 내에서 가장 마지막에 배치하는 이유는 무엇인가요?', '[\"코드 실행 속도를 높이기 위해\",\"문서 로딩 후 DOM을 조작하기 위해\",\"코드 작성이 더 쉽기 때문에\",\"스타일링 우선 적용을 위해\"]', '자바스크립트는 문서 로딩이 완료된 후 DOM을 조작해야 하므로 마지막에 배치합니다.', 0),
(209, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '자바스크립트 실행 방법 시험', '2', '브라우저의 개발자 도구에서 자바스크립트 오류를 확인할 수 있는 탭은 무엇인가요?', '[\"Elements\",\"Console\",\"Network\",\"Sources\"]', 'Console 탭에서 자바스크립트 오류와 로그 메시지를 확인할 수 있습니다.', 0),
(210, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '자바스크립트 실행 방법 시험', '1', 'Node.js 환경에서 자바스크립트를 실행하려면 어떤 명령어를 사용해야 하나요?', '[\"node filename.js\",\"run filename.js\",\"execute filename.js\",\"npm filename.js\"]', 'Node.js에서 자바스크립트를 실행하려면 node 명령어를 사용합니다.', 0),
(211, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 생성 시험', '2', '변수 선언 시 값이 없을 경우 기본 값은 무엇인가요?', '[\"null\",\"undefined\",\"0\",\"빈 문자열\"]', '값이 할당되지 않은 변수는 undefined를 기본 값으로 가집니다.', 0),
(212, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 생성 시험', '1', 'let과 const의 차이점은 무엇인가요?', '[\"let은 재할당이 가능하지만 const는 불가능하다.\",\"let은 블록 스코프를 가지지 않는다.\",\"const는 항상 전역 변수이다.\",\"const는 변수 선언이 불필요하다.\"]', 'let은 재할당이 가능하지만 const는 선언 후 값을 변경할 수 없습니다.', 0),
(213, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 생성 시험', '2', 'JavaScript에서 변수를 선언하지 않고 값을 할당하면 어떻게 되나요?', '[\"에러가 발생한다.\",\"전역 변수로 생성된다.\",\"로컬 변수로 생성된다.\",\"값이 무시된다.\"]', '변수 선언 없이 값을 할당하면 암묵적으로 전역 변수로 생성됩니다.', 0),
(214, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 생성 시험', '1', 'const로 선언된 변수에 대한 설명으로 올바른 것은?', '[\"값을 변경할 수 없다.\",\"데이터 타입이 정해져 있다.\",\"선언 시 초기화가 필요 없다.\",\"재선언이 가능하다.\"]', 'const 변수는 선언 후 값을 변경할 수 없습니다.', 0),
(215, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 타입, 산술 연산자 시험', '3', '산술 연산자 중 나머지를 구하는 연산자는 무엇인가요?', '[\"+\",\"-\",\"%\",\"\\/\"]', '% 연산자는 나눗셈의 나머지를 반환합니다.', 0),
(216, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 타입, 산술 연산자 시험', '1', '다음 중 JavaScript에서 문자열 결합에 사용되는 연산자는 무엇인가요?', '[\"+\",\"&\",\"*\",\"||\"]', '+ 연산자는 문자열 결합에 사용됩니다.', 0),
(217, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 타입, 산술 연산자 시험', '1', '자바스크립트에서 typeof 연산자의 역할은 무엇인가요?', '[\"데이터 타입 확인\",\"변수 값을 삭제\",\"변수 값을 비교\",\"변수 값을 초기화\"]', 'typeof 연산자는 변수의 데이터 타입을 확인합니다.', 0),
(218, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', 'JavaScript 변수 타입, 산술 연산자 시험', '2', '10 / 0의 결과는 무엇인가요?', '[\"0\",\"Infinity\",\"NaN\",\"에러 발생\"]', 'JavaScript에서 0으로 나누면 Infinity 값이 반환됩니다.\r\n\r\n', 0),
(219, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 생성, 구조, 지역 변수, 전역 변수 시험', '2', '함수 내부에서 선언된 변수는 어떤 스코프를 가지나요?', '[\"전역 스코프\",\"함수 스코프\",\"블록 스코프\",\"모듈 스코프\"]', '함수 내부에서 선언된 변수는 함수 스코프를 가집니다.', 0),
(220, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 생성, 구조, 지역 변수, 전역 변수 시험', '2', '함수가 값을 반환하지 않을 때 기본 반환 값은 무엇인가요?', '[\"null\",\"undefined\",\"0\",\"빈 문자열\"]', '함수에서 값을 반환하지 않으면 기본적으로 undefined를 반환합니다.', 0),
(221, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 생성, 구조, 지역 변수, 전역 변수 시험', '3', '전역 변수의 단점은 무엇인가요?', '[\"모든 함수에서 접근이 불가능하다.\",\"메모리를 많이 차지한다.\",\"스코프 충돌 위험이 있다.\",\"블록 스코프를 가진다.\"]', '전역 변수는 여러 함수에서 사용되기 때문에 스코프 충돌 위험이 있습니다.', 0),
(222, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 생성, 구조, 지역 변수, 전역 변수 시험', '2', '함수의 매개변수는 무엇을 의미하나요?', '[\"함수의 반환 값\",\"함수 호출 시 전달되는 값\",\"함수 이름\",\"함수 내부의 변수\"]', '매개변수는 함수 호출 시 함수에 전달되는 값을 의미합니다.', 0),
(223, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 종류, 즉시 실행 함수 시험', '1', '즉시 실행 함수의 형식으로 올바른 것은 무엇인가요?', '[\"(function() { ... })()\",\"function() { ... }\",\"run function() { ... }\",\"execute function() { ... }\"]', '즉시 실행 함수는 (function() { ... })() 형식으로 작성됩니다.', 0),
(224, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 종류, 즉시 실행 함수 시험', '1', '즉시 실행 함수를 사용하는 이유는 무엇인가요?', '[\"변수 충돌을 방지하기 위해\",\"함수를 재사용하기 위해\",\"전역 변수를 선언하기 위해\",\"코드 실행을 지연하기 위해\"]', '즉시 실행 함수는 스코프를 생성해 변수 충돌을 방지합니다.', 0),
(225, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 종류, 즉시 실행 함수 시험', '2', '함수 표현식으로 선언된 함수는 언제 호출할 수 있나요?', '[\"선언 이전\",\"선언 이후\",\"항상 호출 가능\",\"호출할 수 없다\"]', '함수 표현식으로 선언된 함수는 선언 이후에만 호출할 수 있습니다.', 0),
(226, 4, 'A0001', 'B0001', 'C0002', '코딩은 처음이라 with 웹 퍼블리싱', '함수 종류, 즉시 실행 함수 시험', '1', 'JavaScript에서 함수의 기본 기능은 무엇인가요?', '[\"코드를 모듈화하고 재사용한다.\",\"DOM을 수정한다\",\"변수 값을 저장한다.\",\"이벤트를 생성한다.\"]', '함수는 코드를 모듈화하고 재사용성을 높이는 데 사용됩니다.', 0);

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
(1, 'code_even', '이븐관리자', '이븐이', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@example.com', 1, 45617, '서울특별시 강남구', '101호', NULL, '2024-01-01', '2024-12-23 08:13:48', 100, 0),
(2, 'even_teacher', '이븐선생', '이븐하게', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'eventeacher@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', NULL, '2024-01-04', '2024-12-22 21:43:23', 10, 0),
(3, 'even_student', '이븐학생', '이븐학생', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'even_student@even.co.kr', 1, 11000, '서울시 영등포구', '여의도 한강공원', NULL, '2024-01-17', '2024-12-23 08:05:52', 1, 0),
(4, 'my_teacher', '김동주', '멋진선생님', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4567-8910', 'rocks@even.co.kr', 1, 11234, '서울특별시 종로구', '2층 그린컴퓨터 아트학원', '', '2024-01-20', '2024-12-17 08:51:00', 10, 0),
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
(63, 'teacher5', '이정민', '구름산책', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4923-5718', 'user63@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16', '2024-12-16 03:44:07', 10, 0),
(64, 'user_ijkl_64', '박진영', '햇빛추적', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9385-7216', 'user64@example.com', NULL, NULL, NULL, NULL, NULL, '2024-10-12', '2024-11-18 16:20:55', 1, 0),
(65, 'user_mnop_65', '최서영', '사랑가득', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2384-7512', 'user65@example.com', 1, NULL, '', '', '', '2024-10-19', '2024-11-20 09:00:10', 1, -1),
(66, 'user_qrst_66', '정은호', '도전왕', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1934-8527', 'user66@example.com', NULL, NULL, NULL, NULL, '중요 참고 사항', '2024-10-18', '2024-11-19 19:20:05', 1, 0),
(67, 'user_uvwx_67', '윤지수2', '꽃바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8934-2158', 'user67@example.com', 0, NULL, '', '', '', '2024-11-17', '2024-11-20 12:50:40', 1, 0),
(68, 'teacher4', '이상민', '이상민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9482-1365', 'user68@example.com', 1, NULL, '제주특별자치도 서귀포시', '1층 사무실', NULL, '2024-11-16', '2024-11-19 17:15:30', 10, 0),
(69, 'user_cdef_69', '한유진2', '바다별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3492-1758', 'user69@example.com', 0, 13100, '', '', '', '2024-11-15', '2024-11-19 14:25:20', 1, -1),
(70, 'teacher3', '조한결', '조한결', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8723-4519', 'user70@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12', '2024-12-16 02:03:59', 10, 0),
(71, 'user_klmn_71', '정민아', '그린스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2394-1765', 'user71@example.com', 0, NULL, '경상남도 김해시', '빌딩 A동', '참고사항', '2024-11-14', '2024-11-19 16:40:25', 1, 1),
(72, 'ctest', '내이름', '쿠폰테스트', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@hong.com', NULL, NULL, NULL, NULL, NULL, '2024-11-22', '2024-11-22 11:44:44', 1, 0),
(73, 'test1', '박이름', '박네임', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5555-6666', 'abc@abc.com', NULL, NULL, NULL, NULL, NULL, '2024-11-24', '2024-11-25 01:30:33', 1, 0),
(74, 'example_user', '예시용', '예시입니다', '12345', '010-0000-0000', '0627_b@naver.com', 1, NULL, '', '', '', '2024-11-25', '2024-11-25 11:17:16', 1, 0),
(75, 'teacher5', '코딩웍스', '코딩웍스', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2345-6789', 'randomuser1@example.com', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-01-21', '2024-12-11 15:05:59', 10, 0),
(76, 'teacher6', '얄코', '얄코', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-12', '2024-12-17 06:10:19', 10, 0),
(77, 'teacher7', '조코딩', '조코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9876-5432', 'lovelycat32@gmail.com', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14', '2024-12-17 05:55:39', 10, 0),
(78, 'teacher8', '제주코딩베이스캠프', '제주코딩베이스캠프', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-02-18', '2024-12-17 05:38:18', 10, 0),
(79, 'teacher9', '홍팍', '홍팍', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4682-7351', 'supernova_77@yahoo.com', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15', '2024-12-17 05:09:38', 10, 0),
(80, 'teacher10', '김영보', '김영보', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-20', '2024-12-17 04:34:13', 10, 0),
(81, 'teacher11', '개발자의 품격', '개발자의 품격', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6543-2109', 'fastcar45@outlook.com', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-02-28', '2024-12-17 04:11:56', 10, 0),
(82, 'teacher12', '윤재성', '윤재성', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3698-1472', 'bluebird99@hotmail.com', NULL, 78452, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12', '2024-12-17 03:50:25', 10, 0),
(83, 'teacher13', '짐코딩', '짐코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-01', '2024-12-16 02:22:18', 10, 0),
(84, 'teacher14', '노마드크리에이터', '노마드크리에이터', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4729-3851', 'blud99@hotmail.com', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-03-05', '2024-12-16 01:52:13', 10, 0),
(85, 'teacher15', '코지코더', '코지코더', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8147-9263', 'techgeek2024@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-03-15', '2024-12-16 01:36:34', 10, 0),
(86, 'teacher16', '제로초', '제로초', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-03-16', '2024-12-16 00:14:30', 10, 0),
(87, 'teacher17', 'AWS강의실', 'AWS강의실', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2391-8465', 'unshine_day@naver.com', NULL, NULL, NULL, NULL, '참고 항목', '2024-03-20', '2024-12-16 00:02:22', 10, 0),
(88, 'teacher18', '이상희', '이상희', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-29', '2024-12-15 23:52:07', 10, 0),
(89, 'teacher19', 'JeongSuk Lee', 'JeongSuk Lee', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3421-8674', 'happyworld2023@daum.net', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-03-30', '2024-12-15 23:24:25', 10, 0),
(90, 'teacher20', '일프로', '일프로', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-04-11', '2024-12-15 16:59:11', 10, 0),
(91, 'teacher21', '데이터리안', '데이터리안', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-7395', 'nightowl88@live.com', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-04-12', '2024-12-15 16:43:40', 10, 0),
(92, 'teacher22', '이성욱', '이성욱', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2874-5632', 'oceanview55@icloud.com', NULL, NULL, NULL, NULL, NULL, '2024-04-13', '2024-12-15 16:27:53', 10, 0),
(93, 'teacher23', '권철민', '권철민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-04-14', '2024-12-15 16:10:33', 10, 0),
(94, 'teacher24', '잔재미코딩', '잔재미코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-9210', 'user24@example.com', NULL, 11900, NULL, NULL, NULL, '2024-05-15', '2024-12-15 16:00:43', 10, 0),
(95, 'teacher25', '김시훈', '김시훈', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-05-16', '2024-12-15 15:51:32', 10, 0),
(96, 'teacher26', '윤석찬', '윤석찬', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9374-6581', 'user96@example.com', 1, NULL, NULL, NULL, NULL, '2024-05-17', '2024-12-15 15:33:21', 10, 0),
(97, 'teacher27', '쿠만', '쿠만', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-05-18', '2024-12-15 15:14:42', 10, 0),
(98, 'teacher28', '에릭권', '에릭권', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-06-17', '2024-12-15 15:02:01', 10, 0),
(99, 'teacher29', '널널한개발자', '널널한개발자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15', '2024-12-15 14:33:53', 10, 0),
(100, 'teacher30', '컴공로드맵', '컴공로드맵', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-06-12', '2024-12-15 04:13:11', 10, 0),
(101, 'teacher31', '제로미니', '제로미니', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-06-14', '2024-12-15 02:16:57', 10, 0),
(102, 'teacher32', '장기효(캡틴판교)', '장기효(캡틴판교)', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18', '2024-12-17 06:21:21', 10, 0),
(103, 'teacher33', '쩡원', '쩡원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-06-11', '2024-12-17 07:47:24', 10, 0);

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
(1, 4, 'test2', 1, '2024-12-24 23:59:59', '2024-11-24 09:10:02', '신규 회원 15% 할인 쿠폰'),
(2, 3, 'even_student', 1, '2024-12-31 08:17:01', '2024-12-22 23:17:40', '수강 환승쿠폰'),
(3, 4, 'even_student', 1, '2024-12-31 08:18:18', '2024-12-22 23:18:40', '신규 회원 15% 할인 쿠폰');

-- --------------------------------------------------------

--
-- 테이블 구조 `visitor_data`
--

CREATE TABLE `visitor_data` (
  `id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `visitors` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `visitor_data`
--

INSERT INTO `visitor_data` (`id`, `visit_date`, `visitors`, `created_at`) VALUES
(1, '2024-01-01', 3000, '2024-01-01 11:45:20'),
(3, '2024-02-01', 2800, '2024-02-01 03:00:09'),
(4, '2024-03-01', 1800, '2024-03-01 03:00:09'),
(5, '2024-04-01', 3800, '2024-04-01 03:00:09'),
(6, '2024-05-01', 6800, '2024-05-01 03:00:09'),
(7, '2024-06-01', 8000, '2024-06-01 03:00:09'),
(8, '2024-07-01', 6800, '2024-07-01 03:00:09'),
(9, '2024-08-01', 7000, '2024-08-01 03:00:09'),
(10, '2024-09-01', 8500, '2024-09-01 03:00:09'),
(11, '2024-10-01', 9100, '2024-10-01 03:00:09'),
(12, '2024-11-01', 7000, '2024-11-01 03:00:09'),
(13, '2024-11-21', 2, '2024-11-21 03:00:09'),
(14, '2024-11-22', 22, '2024-11-22 03:00:09'),
(15, '2024-11-23', 17, '2024-11-23 03:00:09'),
(16, '2024-11-24', 2, '2024-11-24 03:00:09'),
(17, '2024-11-25', 4, '2024-11-25 03:00:09'),
(18, '2024-11-26', 1, '2024-11-26 03:00:09'),
(19, '2024-11-28', 502, '2024-11-28 03:00:09'),
(20, '2024-11-29', 500, '2024-11-29 03:00:09'),
(21, '2024-11-30', 501, '2024-11-30 03:00:09'),
(22, '2024-12-01', 3081, '2024-12-01 03:00:09'),
(23, '2024-12-02', 1, '2024-12-02 03:00:09'),
(24, '2024-12-04', 3, '2024-12-04 03:00:09'),
(25, '2024-12-08', 3, '2024-12-08 03:00:09'),
(26, '2024-12-09', 205, '2024-12-09 03:00:09'),
(27, '2024-12-10', 9, '2024-12-10 03:00:09'),
(28, '2024-12-11', 3, '2024-12-11 03:00:09'),
(29, '2024-12-12', 1, '2024-12-12 03:00:09'),
(30, '2024-12-13', 1, '2024-12-13 03:00:09'),
(31, '2024-12-14', 5, '2024-12-14 03:00:09'),
(32, '2024-12-15', 2003, '2024-12-15 03:00:09'),
(33, '2024-12-16', 1300, '2024-12-16 03:00:09'),
(34, '2024-12-17', 5, '2024-12-17 03:00:09'),
(35, '2024-12-18', 6, '2024-12-18 03:00:09'),
(36, '2024-12-19', 3, '2024-12-19 03:00:09'),
(37, '2024-12-20', 23, '2024-12-20 03:00:09'),
(38, '2024-12-21', 5, '2024-12-21 03:00:09'),
(39, '2024-12-22', 5, '2024-12-22 00:10:45');

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
-- 테이블의 인덱스 `attendance_data`
--
ALTER TABLE `attendance_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`uid`,`check_date`);

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
  ADD KEY `oddtid` (`odid`);

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
-- 테이블의 인덱스 `summer_images`
--
ALTER TABLE `summer_images`
  ADD PRIMARY KEY (`imgid`);

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
-- 테이블의 인덱스 `visitor_data`
--
ALTER TABLE `visitor_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visit_date` (`visit_date`);

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
-- 테이블의 AUTO_INCREMENT `admin_answer`
--
ALTER TABLE `admin_answer`
  MODIFY `aaid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유번호', AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `admin_question`
--
ALTER TABLE `admin_question`
  MODIFY `aqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호', AUTO_INCREMENT=31;

--
-- 테이블의 AUTO_INCREMENT `attendance_data`
--
ALTER TABLE `attendance_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=19;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT COMMENT '장바구니고유번호', AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `class_data`
--
ALTER TABLE `class_data`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID', AUTO_INCREMENT=33;

--
-- 테이블의 AUTO_INCREMENT `company_info`
--
ALTER TABLE `company_info`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT COMMENT '상점정보 고유번호(자동)', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `counsel`
--
ALTER TABLE `counsel`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호', AUTO_INCREMENT=39;

--
-- 테이블의 AUTO_INCREMENT `lecture`
--
ALTER TABLE `lecture`
  MODIFY `leid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=59;

--
-- 테이블의 AUTO_INCREMENT `lecture_detail`
--
ALTER TABLE `lecture_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '강의 ID', AUTO_INCREMENT=93;

--
-- 테이블의 AUTO_INCREMENT `lefile`
--
ALTER TABLE `lefile`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT COMMENT '파일 ID', AUTO_INCREMENT=87;

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
  MODIFY `mcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `notice`
--
ALTER TABLE `notice`
  MODIFY `ntid` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항고유번호', AUTO_INCREMENT=61;

--
-- 테이블의 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `odid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문고유번호', AUTO_INCREMENT=22;

--
-- 테이블의 AUTO_INCREMENT `order_delivery`
--
ALTER TABLE `order_delivery`
  MODIFY `oddvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '배송고유번호', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `order_details`
--
ALTER TABLE `order_details`
  MODIFY `oddtid` int(11) NOT NULL AUTO_INCREMENT COMMENT '주문상세고유번호', AUTO_INCREMENT=39;

--
-- 테이블의 AUTO_INCREMENT `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `commid` int(11) NOT NULL AUTO_INCREMENT COMMENT '댓글id', AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=67;

--
-- 테이블의 AUTO_INCREMENT `refunds`
--
ALTER TABLE `refunds`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT COMMENT '환불고유번호';

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `rvid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강후기ID', AUTO_INCREMENT=14;

--
-- 테이블의 AUTO_INCREMENT `send_email`
--
ALTER TABLE `send_email`
  MODIFY `emid` int(11) NOT NULL AUTO_INCREMENT COMMENT '이메일발송고유번호', AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `student_qna`
--
ALTER TABLE `student_qna`
  MODIFY `sqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호', AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `stuscores`
--
ALTER TABLE `stuscores`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `summer_images`
--
ALTER TABLE `summer_images`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT COMMENT '기본 pk';

--
-- 테이블의 AUTO_INCREMENT `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '강사고유번호', AUTO_INCREMENT=34;

--
-- 테이블의 AUTO_INCREMENT `teacher_qna`
--
ALTER TABLE `teacher_qna`
  MODIFY `asid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유ID', AUTO_INCREMENT=14;

--
-- 테이블의 AUTO_INCREMENT `teamproject`
--
ALTER TABLE `teamproject`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id(자동)', AUTO_INCREMENT=26;

--
-- 테이블의 AUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=227;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=104;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `visitor_data`
--
ALTER TABLE `visitor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- 테이블의 AUTO_INCREMENT `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishid` int(11) NOT NULL AUTO_INCREMENT COMMENT '찜하기고유번호', AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`odid`) REFERENCES `orders` (`odid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- 테이블의 제약사항 `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_1_userid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_2_cateid` FOREIGN KEY (`cgid`) REFERENCES `category` (`cgid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `teacher_qna`
--
ALTER TABLE `teacher_qna`
  ADD CONSTRAINT `teacher_qna_ibfk_1` FOREIGN KEY (`sqid`) REFERENCES `student_qna` (`sqid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wish_leidfk_1` FOREIGN KEY (`leid`) REFERENCES `lecture` (`leid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wish_userfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
