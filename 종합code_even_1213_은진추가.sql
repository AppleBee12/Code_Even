-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-13 09:02
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
  `progress_rate` decimal(10,0) DEFAULT NULL COMMENT '진도율'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강데이터';

--
-- 테이블의 덤프 데이터 `class_data`
--

INSERT INTO `class_data` (`cdid`, `uid`, `leid`, `exid`, `progress_rate`) VALUES
(1, 3, 1, NULL, 40),
(2, 35, 1, NULL, NULL),
(3, 42, 2, NULL, NULL),
(4, 27, 2, NULL, NULL),
(5, 53, 1, NULL, NULL),
(6, 18, 1, NULL, NULL),
(7, 61, 2, NULL, NULL),
(8, 39, 1, NULL, NULL),
(9, 12, 2, NULL, NULL),
(10, 25, 1, NULL, NULL),
(11, 44, 2, NULL, NULL),
(12, 67, 1, NULL, NULL),
(13, 30, 1, NULL, NULL),
(14, 55, 2, NULL, NULL),
(15, 8, 1, NULL, NULL),
(16, 49, 2, NULL, NULL),
(17, 14, 1, NULL, NULL),
(18, 66, 2, NULL, NULL),
(19, 28, 1, NULL, NULL),
(20, 34, 3, NULL, NULL),
(21, 39, 3, NULL, NULL),
(22, 49, 3, NULL, NULL),
(23, 42, 3, NULL, NULL),
(24, 20, 3, NULL, NULL),
(25, 19, 1, NULL, NULL),
(26, 3, 2, NULL, 20),
(27, 3, 3, NULL, 80);

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
(2, NULL, 0, 2, 'A0001', 'B0001', 'C0001', '', 'HTML/CSS : 기초부터 실전까지 올인원', 'HTML/CSS : 예제와 함께하는 기초부터 실전까지 html, css 올인원 과정', '이븐선생', 'https://youtu.be/oHTr2fEkmGA?si=fNAGT0cPExpzwXDM', NULL, 30, 'general', '', '', 1, 1, 90000, 50, '2024-11-19 09:49:25'),
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
  `status` enum('on','off') NOT NULL DEFAULT 'off' COMMENT '상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `notice`
--

INSERT INTO `notice` (`ntid`, `uid`, `title`, `content`, `view`, `regdate`, `status`) VALUES
(1, 1, '[공지] 서비스 점검 안내', '안녕하세요. 서비스 점검이 예정되어 있습니다. 점검 시간은 11월 18일부터 11월 19일까지입니다. 양해 부탁드립니다.', 87, '2024-11-16', 'off'),
(2, 1, '[공지] 개인정보 처리방침 변경', '개인정보 처리방침이 일부 수정되었습니다. 변경된 내용은 홈페이지에서 확인할 수 있습니다.', 14, '2024-11-16', 'on'),
(3, 1, '[공지] 신규 강의 추가 안내', '새로운 강의가 추가되었습니다. \"프로그래밍 입문\" 강의를 확인해보세요!', 9, '2024-11-16', 'on'),
(4, 1, '[공지] 사이트 보안 업데이트', '사이트 보안 강화를 위한 업데이트가 진행됩니다. 업데이트 기간 동안 일부 기능이 제한될 수 있습니다.', 3, '2024-11-17', 'on'),
(5, 1, '[공지] 서버 점검 안내', '서버 점검 작업이 예정되어 있습니다. 점검 시간은 11월 20일 오후 3시부터 5시까지입니다.', 88, '2024-11-17', 'on'),
(6, 1, '[공지] 이메일 인증 시스템 변경', '이메일 인증 방식이 변경되었습니다. 새 시스템에 따라 인증을 진행해주세요.', 31, '2024-11-18', 'on'),
(7, 1, '[공지] 로그인 오류 수정', '일부 사용자에서 발생한 로그인 오류가 수정되었습니다. 이제 정상적으로 로그인하실 수 있습니다.', 88, '2024-11-18', 'on'),
(8, 1, '[공지] 강의 자료 다운로드 오류', '강의 자료 다운로드에 오류가 발생했습니다. 빠른 시일 내에 해결할 예정입니다.', 48, '2024-11-19', 'on'),
(9, 1, '[공지] 모바일 앱 업데이트 안내', '모바일 앱의 새로운 버전이 출시되었습니다. 최신 버전으로 업데이트하여 더 나은 서비스를 이용해 주세요.', 74, '2024-11-19', 'on'),
(10, 1, '[공지] 강의 일정 변경 안내', '일부 강의 일정이 변경되었습니다. 변경된 강의 일정을 확인해주세요.', 28, '2024-11-19', 'on'),
(11, 1, '[공지] 회원가입 절차 변경', '회원가입 절차가 일부 변경되었습니다. 신규 회원은 변경된 절차에 따라 가입을 진행해주세요.', 17, '2024-11-20', 'on'),
(12, 1, '[공지] 과제 제출 마감일 연장', '과제 제출 마감일이 11월 25일로 연장되었습니다. 기한 내에 제출해 주세요.', 100, '2024-11-20', 'on'),
(13, 1, '[공지] 사이트 이용 약관 변경', '사이트 이용 약관이 업데이트되었습니다. 변경된 사항을 확인하시기 바랍니다.', 49, '2024-11-21', 'on'),
(14, 1, '[공지] 결제 시스템 점검 안내', '결제 시스템 점검이 예정되어 있습니다. 점검 시간 동안 결제가 불가능할 수 있습니다.', 46, '2024-11-21', 'on'),
(15, 1, '[공지] 신규 기능 추가 안내', '새로운 기능이 추가되었습니다. \"자동 과제 제출\" 기능을 확인해보세요.', 79, '2024-11-22', 'on'),
(16, 1, '[공지] 개인정보 보호 정책 업데이트', '개인정보 보호 정책이 업데이트되었습니다. 정책 변경 사항을 확인해 주세요.', 60, '2024-11-22', 'on'),
(17, 1, '[공지] 로그인 인증 강화', '로그인 인증 절차가 강화되었습니다. 이제 2단계 인증을 사용하여 보안을 강화해주세요.', 60, '2024-11-23', 'on'),
(18, 1, '[공지] 강의 리뷰 기능 추가', '강의 리뷰 기능이 추가되었습니다. 강의를 수강한 후 리뷰를 남겨주세요!', 21, '2024-11-23', 'on'),
(19, 1, '[공지] 사이트 장애 발생 안내', '사이트에서 장애가 발생하여 일부 기능이 불안정합니다. 빠르게 복구 중이니 양해 부탁드립니다.', 22, '2024-11-24', 'on'),
(20, 1, '[공지] 설문 조사 참여 요청', '회원님들의 의견을 듣기 위해 설문 조사를 진행합니다. 참여 부탁드립니다!', 48, '2024-11-24', 'on'),
(21, 1, '[공지] 시스템 긴급 점검 완료', '긴급 점검 작업이 완료되었습니다. 불편을 끼쳐드려 죄송합니다.', 73, '2024-11-24', 'on'),
(22, 1, '[공지] 새로운 강의 커리큘럼 소개', '강의 커리큘럼이 업데이트되었습니다. 신규 커리큘럼을 확인해보세요.', 22, '2024-11-25', 'on'),
(23, 1, '[공지] 다크 모드 기능 추가', '사용자 편의를 위해 다크 모드 기능이 추가되었습니다. 설정에서 활성화해보세요.', 90, '2024-11-25', 'on'),
(24, 1, '[공지] 강의 취소 규정 변경', '강의 취소 관련 규정이 변경되었습니다. 자세한 내용은 공지사항을 참고해 주세요.', 84, '2024-11-25', 'on'),
(25, 1, '[공지] 주말 고객센터 운영시간 변경', '주말 고객센터 운영시간이 변경되었습니다. 새로운 운영시간은 오전 10시부터 오후 4시입니다.', 48, '2024-11-26', 'on'),
(26, 1, '[공지] 회원 등급 제도 도입', '회원 등급 제도가 새롭게 도입되었습니다. 자세한 등급별 혜택은 홈페이지에서 확인해 주세요.', 86, '2024-11-26', 'on'),
(27, 1, '[공지] 사이트 정기 점검 안내', '사이트 정기 점검이 예정되어 있습니다. 점검 시간 동안 서비스 이용이 제한될 수 있습니다.', 88, '2024-11-27', 'on'),
(28, 1, '[공지] 쿠폰 발급 이벤트', '모든 회원님께 특별 쿠폰을 발급해드립니다. 자세한 내용은 이벤트 페이지를 참고하세요.', 80, '2024-11-27', 'on'),
(29, 1, '[공지] 강의 평점 제도 도입', '강의 평점 제도가 추가되었습니다. 수강 완료 후 강의에 평점을 남겨주세요.', 37, '2024-11-28', 'on'),
(30, 1, '[공지] 연말 맞이 감사 이벤트', '연말을 맞아 감사 이벤트를 진행합니다. 풍성한 혜택을 놓치지 마세요!', 45, '2024-11-28', 'on'),
(31, 1, '[공지] 연말 서버 점검 안내', '연말 서버 점검이 예정되어 있습니다. 이용에 참고해 주세요.', 11, '2024-11-28', 'on'),
(32, 1, '[공지] 강의 할인 프로모션', '한정 기간 동안 강의 할인 프로모션을 진행합니다. 자세한 내용은 공지사항을 확인하세요.', 23, '2024-11-29', 'on'),
(33, 1, '[공지] 회원 정보 업데이트 요청', '회원님의 정보가 오래되었습니다. 업데이트 부탁드립니다.', 78, '2024-11-29', 'on'),
(34, 1, '[공지] 사이트 새 기능 미리보기', '새롭게 도입될 기능을 미리 확인하세요. 테스트 참여 환영합니다.', 24, '2024-11-30', 'on'),
(35, 1, '[공지] 강의 퀴즈 도입 안내', '강의 퀴즈 기능이 추가되었습니다. 학습 후 퀴즈를 통해 실력을 확인해 보세요.', 84, '2024-11-30', 'on'),
(36, 1, '[공지] 사이트 접근 제한 안내', '일부 국가에서 사이트 접근이 제한될 수 있습니다. 양해 부탁드립니다.', 46, '2024-12-01', 'on'),
(37, 1, '[공지] 연말 강의 결산 이벤트', '2024년 한 해 동안 인기 있었던 강의를 확인하고 할인받으세요.', 80, '2024-12-01', 'on'),
(38, 1, '[공지] 실시간 채팅 지원 시작', '강의 관련 질문을 실시간으로 문의할 수 있는 채팅 기능이 추가되었습니다.', 59, '2024-12-02', 'on'),
(39, 1, '[공지] 강의 종료 일정 공지', '일부 강의의 종료 일정이 발표되었습니다. 마감 전에 수강해 주세요.', 57, '2024-12-02', 'on'),
(40, 1, '[공지] 멘토링 프로그램 신청 안내', '강사와 1:1 멘토링 프로그램을 이용해 보세요. 신청은 한정되어 있습니다.', 7, '2024-12-03', 'on'),
(41, 1, '[공지] 데이터베이스 유지보수 공지', '데이터베이스 유지보수 작업으로 인해 일시적으로 서비스가 중단될 수 있습니다.', 63, '2024-12-03', 'on'),
(42, 1, '[공지] 학습 성취도 분석 서비스', '학습 성취도를 분석하여 맞춤형 강의를 추천해 드립니다.', 92, '2024-12-04', 'on'),
(43, 1, '[공지] 모바일 앱 오류 수정', '모바일 앱에서 발생한 오류가 수정되었습니다. 최신 버전을 다운로드하세요.', 70, '2024-12-04', 'on'),
(44, 1, '[공지] 신규 회원 혜택 안내', '신규 회원 가입 시 특별 혜택을 제공합니다. 지금 바로 가입하세요.', 76, '2024-12-05', 'on'),
(45, 1, '[공지] 시스템 최적화 작업', '더 나은 서비스를 위해 시스템 최적화 작업이 진행됩니다.', 70, '2024-12-05', 'on'),
(46, 1, '[공지] 강의 자료 업데이트', '강의 자료가 최신 내용으로 업데이트되었습니다. 확인 부탁드립니다.', 20, '2024-12-06', 'on'),
(47, 1, '[공지] 강사 채용 공고', '새로운 강사를 모집 중입니다. 지원을 희망하시는 분은 홈페이지를 확인하세요.', 90, '2024-12-06', 'on'),
(48, 1, '[공지] 강의 Q&A 게시판 추가', '강의와 관련된 질문을 올릴 수 있는 Q&A 게시판이 새로 추가되었습니다.', 91, '2024-12-07', 'on'),
(49, 1, '[공지] 학습 기록 다운로드 제공', '이제 학습 기록을 PDF로 다운로드할 수 있습니다. 학습 진도를 관리해 보세요.', 84, '2024-12-07', 'on'),
(50, 1, '[공지] VIP 회원 초대 이벤트', 'VIP 회원 전용 초대 이벤트가 진행 중입니다. 초대장을 확인해 주세요.', 45, '2024-12-08', 'on'),
(51, 1, '[공지] 강의 영상 화질 개선', '강의 영상 화질이 개선되었습니다. 더욱 선명한 화질로 학습하세요.', 75, '2024-12-08', 'on'),
(52, 1, '[공지] 사용자 피드백 요청', '서비스 개선을 위해 사용자 피드백을 수집하고 있습니다. 참여 부탁드립니다.', 39, '2024-12-09', 'on'),
(53, 1, '[공지] 출석 체크 이벤트', '매일 출석 체크하고 포인트를 받으세요!', 71, '2024-12-09', 'on'),
(54, 1, '[공지] 새해맞이 프로모션', '새해를 맞아 전 강의 30% 할인 이벤트를 진행합니다.', 36, '2024-12-10', 'on'),
(55, 1, '[공지] 강의 평가 시스템 업데이트', '강의 평가 시스템이 개선되었습니다. 보다 쉽게 의견을 남겨보세요.', 64, '2024-12-10', 'on'),
(56, 1, '[공지] 비밀번호 보안 강화 요청', '회원님의 계정 보안을 위해 비밀번호를 업데이트해 주세요.', 15, '2024-12-11', 'on'),
(57, 1, '[공지] 강의 추천 알고리즘 개선', '강의 추천 시스템이 개선되었습니다. 개인 맞춤형 추천을 확인하세요.', 82, '2024-12-11', 'on'),
(58, 1, '[공지] 학습 목표 설정 기능', '이제 학습 목표를 설정하고 달성도를 확인할 수 있습니다.', 63, '2024-12-12', 'on'),
(59, 1, '[공지] 연말 강사 감사 이벤트', '올해를 빛낸 강사님들께 감사의 인사를 전하세요!', 71, '2024-12-12', 'on'),
(60, 1, '[공지] 서비스 약관 변경 안내', '서비스 약관이 업데이트되었습니다. 변경된 내용은 공지사항에서 확인하세요.', 66, '2024-12-13', 'on');

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
  `tc_uid` int(11) DEFAULT NULL COMMENT '강사의 회원고유번호',
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

INSERT INTO `order_details` (`oddtid`, `odid`, `tc_uid`, `product_id`, `product_type`, `product_title`, `price`, `cnt`, `pay_status`) VALUES
(1, 1, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(2, 2, NULL, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(3, 3, 2, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(4, 4, NULL, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(5, 5, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 3, 0),
(6, 6, NULL, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(7, 7, 2, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(8, 8, NULL, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(9, 9, 2, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(10, 10, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 2, 0),
(11, 11, NULL, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(12, 12, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(13, 13, NULL, 1, 2, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(14, 14, 2, 2, 1, 'HTML/CSS : 기초부터 실전까지 올인원', 35000.00, 1, 0),
(15, 15, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(16, 16, NULL, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(17, 17, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(18, 18, NULL, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(19, 19, NULL, 1, 1, '기초부터 확실하게! (페이지의 내용 전달을 위한 HTML, 스타일 설정을 위한 CSS 기초 학습)', 15000.00, 1, 0),
(20, 20, NULL, 2, 2, '실무자 JAVA 코스', 20000.00, 1, 0),
(21, 20, 2, 3, 1, '[레시피] CSS Flex와 Grid 제대로 익히기', 50000.00, 1, 0);

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
(1, 1, 5, 'Flexbox와 Grid의 차이점과 활용', 'Flexbox와 Grid의 차이점에 대해 명확하게 설명해주셔서 매우 도움이 되었습니다. 각각의 특성과 사용해야 하는 상황을 구체적인 예시를 들어 주셔서 이해하기 쉬웠고, 실습을 통해 두 기술을 어떻게 조합하여 사용할 수 있는지에 대한 팁도 유익했습니다. 실전에서 바로 활용 가능한 지식을 얻을 수 있어 좋았습니다.', '2024-11-24 19:38:00'),
(2, 2, 4, 'HTML 기초 강좌, 정말 기초부터 잘 설명됨', 'HTML의 기본적인 구조와 태그들에 대해 체계적으로 설명해주셔서 초보자도 쉽게 이해할 수 있었습니다. 각 태그의 역할과 사용법이 명확히 정리되어 있었고, 예제도 간단하고 실용적이었습니다. 이 강의를 통해 HTML을 자신 있게 사용할 수 있게 되었습니다. 특히 문서 구조에 대한 이해가 깊어졌습니다.', '2024-11-24 19:40:51'),
(3, 3, 5, 'HTML과 CSS를 동시에 배우는 최적의 방법', 'HTML과 CSS의 기본부터 고급 개념까지 병행해서 학습할 수 있어 좋았습니다. HTML로 구조를 잡고, CSS로 스타일을 입히는 과정이 실습과 함께 잘 연결되어 있어서 웹 페이지 제작에 대한 이해도가 확실히 높아졌습니다. 각 기술의 연계가 잘 되어 있어서 실제 프로젝트에서 바로 적용할 수 있을 것 같습니다.', '2024-11-24 19:41:04'),
(4, 4, 5, '실습 위주 강의, 매우 유익했습니다', '강의는 이론보다는 실습 위주로 진행되어 실제 웹 페이지를 만드는 느낌을 받을 수 있었습니다. 다양한 레이아웃을 만들면서 HTML과 CSS가 어떻게 적용되는지 자연스럽게 배웠고, 실제 웹 페이지에서 바로 써먹을 수 있는 기술들을 익힐 수 있었습니다. 기초부터 실전까지 제대로 배운 것 같아서 만족스럽습니다.', '2024-11-24 19:42:07'),
(5, 5, 4, '가독성 향상 팁, 유용한 정보가 많아요', '웹 페이지에서 가장 중요한 부분인 가독성 향상에 관한 팁이 매우 유용했습니다. 글자 크기, 색상, 배치 등 여러 요소를 고려하여 어떻게 하면 페이지가 더 읽기 쉽게 될 수 있는지 알게 되었습니다. 특히 CSS를 활용한 가독성 향상 팁은 실생활에서 매우 적용 가능하고, 당장 웹 페이지를 개선할 수 있을 것 같아요.', '2024-11-24 19:42:21'),
(6, 6, 5, 'HTML 구조 배치 이해하기', '웹 페이지를 만들 때 중요한 것이 바로 HTML 구조입니다. 이 강의를 통해 콘텐츠를 어떻게 효율적으로 배치할 수 있는지, 사용자의 흐름을 고려한 배치 방법에 대해 배웠습니다. 각 태그가 웹 페이지에서 어떤 역할을 하는지 정확히 이해할 수 있어, 더 나은 구조로 웹 페이지를 만들 수 있을 것 같습니다.', '2024-11-24 19:42:54'),
(7, 7, 4, '효과적인 레이아웃 구성법, 실습을 통한 학습', 'HTML과 CSS를 활용하여 레이아웃을 구성하는 방법에 대해 잘 설명해주셨습니다. 특히 실습을 통해 각 레이아웃을 어떻게 구성하고 스타일을 적용하는지 자세히 배웠습니다. 실제로 프로젝트를 만들면서 이를 실습할 수 있어서 좋았고, 다양한 레이아웃을 만드는 데 자신감을 얻었습니다.', '2024-11-24 19:43:11'),
(8, 8, 4, '기초부터 차근차근 배우기, 강추합니다', 'HTML과 CSS를 처음 배우는 사람으로서 어디서부터 시작해야 할지 막막했는데, 기초부터 차근차근 설명해주셔서 정말 좋았습니다. 간단한 예제부터 시작해서 실습을 통해 점점 복잡한 웹 페이지를 만들 수 있게 되었어요. 이렇게 기초부터 확실히 배우는 강의는 매우 유익했습니다.', '2024-11-24 19:43:27'),
(9, 9, 5, 'Flexbox와 Grid를 비교하며 배우기', 'Flexbox와 Grid의 차이를 실습을 통해 비교할 수 있어 매우 유익했습니다. 이 두 가지 기술을 언제, 어떻게 사용하는 것이 적합한지 실제 예제와 함께 설명해주셔서 매우 이해가 잘 됐습니다. 실무에서 이 두 가지 기술을 어떻게 활용할 수 있을지에 대한 실용적인 팁도 많이 얻을 수 있었습니다.', '2024-11-24 19:43:42'),
(10, 10, 5, 'HTML과 CSS 기초 확립, 매우 유용한 강좌', 'HTML과 CSS의 기본 개념을 확실히 다질 수 있었습니다. 웹 페이지를 만드는 데 필수적인 요소들이 무엇인지, 그리고 각 요소들이 어떻게 상호작용하는지 명확히 알게 되었습니다. 강의가 체계적으로 진행되어 기초부터 탄탄히 다질 수 있었고, 실제로 웹 페이지를 만드는 데 바로 적용할 수 있을 정도로 이해도가 높아졌습니다.', '2024-11-24 19:44:04'),
(11, 11, 5, 'HTML5에서 새롭게 추가된 태그들', 'HTML5에서 새롭게 추가된 태그들에 대해 배울 수 있어서 유익했습니다. <article>, <section>, <aside>와 같은 태그들이 어떻게 사용되는지 실제 예시를 통해 배웠고, 웹 페이지를 더욱 시맨틱하게 작성할 수 있게 되었습니다. HTML5의 강력한 기능을 제대로 활용할 수 있게 되어 매우 좋았습니다.', '2024-11-24 19:44:21'),
(12, 12, 5, 'CSS 단위의 차이점과 적용법', 'CSS에서 px, em, rem 단위의 차이점에 대해 잘 이해할 수 있었습니다. 각 단위의 사용 상황에 대한 설명과 실제 예시가 함께 있어 실제로 웹 페이지를 디자인할 때 유용하게 사용할 수 있을 것 같아요. 다양한 단위의 선택과 적용법을 명확하게 알려주셔서 매우 만족스럽습니다.', '2024-11-24 19:44:35'),
(13, 13, 5, 'HTML 태그 용도 차이점, 명확한 설명', '<div>와 <span> 태그의 용도에 대해 정확히 이해할 수 있었습니다. 둘 다 컨테이너 역할을 하지만, 어떤 상황에서 각 태그를 사용하는 것이 적절한지에 대한 설명이 아주 유익했습니다. HTML을 좀 더 체계적으로 작성할 수 있는 방법을 배울 수 있었고, 웹 페이지의 구조를 더욱 깔끔하게 만들 수 있을 것 같습니다.', '2024-11-24 19:44:49');

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
(1, 1, 'CSS Flex와 Grid 차이점과 올바른 활용법?', '최근에 웹 레이아웃을 만들 때 CSS Flexbox와 Grid를 사용해 보려고 공부 중인데, 두 기술의 차이점과 각각을 어떻게 활용해야 할지 명확히 구분이 잘 안 됩니다. 특히 두 가지 시스템을 어떤 상황에서 사용하는 것이 가장 효율적인지 궁금합니다.', '2024-11-24 19:08:54'),
(2, 2, 'HTML 기초에 대한 질문: 기본 태그와 구조', 'HTML을 처음 배우고 있는데, 기본적인 구조와 태그에 대해 아직 헷갈리는 부분이 많습니다. 웹 페이지를 만들 때 HTML 문서의 기본 구조와 주요 태그들의 역할을 정확히 이해하고 싶은데, 어떤 순서로 공부하면 좋을지, 그리고 각 태그의 용도에 대해 좀 더 구체적으로 알고 싶습니다.', '2024-11-24 19:11:26'),
(3, 3, 'HTML과 CSS를 처음 배울 때 어떤 순서로 공부하는 것이 가장 효율적인가요?', 'HTML과 CSS를 기초부터 실전까지 완벽하게 배우고 싶은데, 효율적으로 공부할 수 있는 방법을 찾고 있습니다. 웹 페이지를 제작하려면 HTML 구조와 CSS 스타일링을 어떻게 연결하고 활용해야 할지에 대해 명확히 알고 싶습니다. 초보자가 기초부터 시작해 점진적으로 실전 기술까지 배울 수 있는 로드맵이 필요합니다.', '2024-11-24 19:13:02'),
(4, 4, 'HTML과 CSS를 실습을 통해 자연스럽게 익히는 방법에는 어떤 것이 있을까요?', 'HTML과 CSS를 배우고는 있지만, 이론적인 부분은 어느 정도 익혔는데 실습을 통해 어떻게 실제 웹 페이지를 만들 수 있을지 감이 잘 잡히지 않습니다. HTML과 CSS를 처음 배우는 사람이 실전에서 사용할 수 있는 구체적인 예시나 프로젝트를 통해 기초부터 실전까지 배우는 방법에 대해 궁금합니다.', '2024-11-24 19:13:33'),
(5, 5, '콘텐츠의 가독성을 높이는 데 도움이 되는 HTML 태그나 CSS 스타일은 어떤 것이 있나요?', '웹 페이지를 만들 때 내용을 효과적으로 전달하는 것이 중요하다는 것을 알고 있습니다. 하지만, HTML과 CSS를 사용할 때 어떻게 하면 사용자의 관심을 끌고, 정보를 명확하게 전달할 수 있을지에 대한 전략이 잘 잡히지 않습니다. 기초부터 확실하게 배우면서, 페이지 내용이 효과적으로 전달되도록 하는 방법에 대해 질문드리고 싶습니다.', '2024-11-24 19:14:09'),
(6, 6, 'HTML 구조에서 콘텐츠를 효율적으로 배치하는 기본적인 규칙은 무엇인가요?', '웹 페이지를 디자인할 때, 콘텐츠를 어떻게 배치할지 고민이 많습니다. HTML과 CSS를 사용해 페이지를 구성하는 기초는 알고 있지만, 어떻게 하면 콘텐츠가 자연스럽게 흐르고, 사용자가 쉽게 이해할 수 있도록 배치할 수 있을지 확신이 없습니다. 페이지 내용의 전달을 효과적으로 할 수 있는 레이아웃 구성 방법에 대해 질문드립니다.', '2024-11-24 19:14:46'),
(7, 7, '실전에서 자주 사용하는 HTML 태그와 CSS 속성, 그리고 이들을 어떻게 결합해 효과적으로 레이아웃을 구성할 수 있는지에 대한 팁은 무엇인가요?', '웹 디자인을 처음 시작하려는 사람으로서, HTML과 CSS의 기초를 탄탄히 배우고 실전에서 어떻게 활용할 수 있을지에 대한 로드맵이 필요합니다. 다양한 기술이 섞여 있는 HTML과 CSS를 어떻게 학습해야 실무에 바로 적용할 수 있을지에 대해 궁금합니다. 기초부터 고급까지 단계적으로 배울 수 있는 방법을 알고 싶습니다.', '2024-11-24 19:15:12'),
(8, 8, '간단한 웹 페이지를 처음부터 끝까지 만들어볼 수 있는 쉬운 예제가 있을까요?', 'HTML과 CSS를 처음 배우고 있는 초보자입니다. 웹 페이지를 구성하고 스타일링하는 기본적인 방법을 익히고 싶지만, 어디서부터 시작해야 할지 막막합니다. 특히 HTML과 CSS의 역할을 명확히 이해하고, 이를 활용해 간단한 웹 페이지를 만들어 보고 싶습니다. 다음과 같은 질문들에 답변해 주시면 감사하겠습니다.', '2024-11-24 19:19:56'),
(9, 9, '학습 과정에서 혼동하기 쉬운 개념들(예: Flexbox와 Grid의 차이 등)을 쉽게 이해할 수 있는 팁이 있을까요?', 'HTML과 CSS를 처음부터 체계적으로 배우고 싶은데, 어디서부터 시작해서 실전까지 연결해야 할지 잘 모르겠습니다. 기초를 탄탄히 다지는 것뿐만 아니라, 실전에서 활용할 수 있는 방법까지 배우고 싶습니다. 아래 질문들에 답변을 부탁드립니다.', '2024-11-24 19:20:42'),
(10, 10, 'HTML과 CSS의 역할과 상호작용 방식을 쉽게 이해할 수 있는 설명이 있을까요?', 'HTML과 CSS를 처음 접하며 웹 페이지를 구성하고 스타일링하는 기본적인 기술을 배우고 싶습니다. 기초를 확실히 다지고, 이를 활용해 간단한 웹 페이지를 만들어 보고자 하는데, 질문이 있습니다.', '2024-11-24 19:21:38'),
(11, 11, 'HTML 태그 구조에 대한 질문입니다.', 'HTML 문서를 작성할 때 <header>, <main>, <footer> 태그를 사용하는 것이 필수인가요? 만약 필수가 아니라면, 이 태그들을 언제 사용하는 것이 적절한지 궁금합니다.', '2024-11-24 19:23:09'),
(12, 12, 'CSS로 글자 크기 조정을 할 때 단위 선택 질문', 'CSS에서 px와 em, 그리고 rem 단위의 차이가 무엇인지 궁금합니다. 각 단위를 사용하는 적절한 상황과 추천 사례를 알려주세요.', '2024-11-24 19:25:47'),
(13, 13, '<div>와 <span>의 차이에 대한 이해가 필요합니다.', 'HTML에서 <div>와 <span>을 모두 사용할 수 있는 상황에서 어떤 기준으로 선택해야 할지 혼란스럽습니다. 이 두 태그의 용도 차이를 설명해주실 수 있나요?', '2024-11-24 19:26:08'),
(14, 14, 'CSS로 중앙 정렬을 할 때 가장 좋은 방법은?', '텍스트나 이미지를 CSS로 부모 요소의 가운데에 위치시키는 방법이 여러 가지가 있는 것 같은데, 어떤 방법이 가장 실용적인지 궁금합니다. 특히 flexbox와 grid의 차이도 설명해 주실 수 있나요?', '2024-11-24 19:26:36'),
(15, 15, 'HTML5에서 새롭게 추가된 태그가 궁금합니다.', 'HTML5에서 새롭게 추가된 태그에는 어떤 것들이 있나요? 특히 <article>, <section>, <aside> 태그의 사용 사례와 차이를 알고 싶습니다.', '2024-11-24 19:27:17'),
(16, 16, 'CSS에서 색상을 지정하는 다양한 방법', 'CSS로 색상을 지정할 때 hex, rgb, hsl 등의 형식이 있는데, 각 형식의 차이점과 장단점이 무엇인지 알고 싶습니다. 실제 프로젝트에서 어떤 기준으로 선택하면 좋을까요?', '2024-11-24 19:27:29'),
(17, 17, 'HTML의 alt 속성은 반드시 필요한가요?', '이미지를 삽입할 때 항상 alt 속성을 추가하라는 권고를 들었는데, 이를 생략하면 어떤 문제가 발생할 수 있는지, 그리고 꼭 작성해야 하는 이유를 알고 싶습니다.', '2024-11-24 19:27:47');

-- --------------------------------------------------------

--
-- 테이블 구조 `stuscores`
--

CREATE TABLE `stuscores` (
  `exid` int(11) NOT NULL COMMENT '번호',
  `stu_id` int(11) NOT NULL COMMENT '수강생id',
  `quiz` int(11) DEFAULT NULL COMMENT '퀴즈 exid(외래키)',
  `quiz_answer` int(11) DEFAULT NULL COMMENT '퀴즈 정답(외래키)',
  `test` int(11) DEFAULT NULL COMMENT '시험 exid(외래키)',
  `test_answer` int(11) DEFAULT NULL COMMENT '시험 정답(외래키)',
  `score` int(11) NOT NULL COMMENT '점수',
  `answer` varchar(100) NOT NULL COMMENT '제출한 정답',
  `pnlevel` tinyint(4) NOT NULL COMMENT '수준당 점수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='수강생 점수 관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `summer_images`
--

CREATE TABLE `summer_images` (
  `imgid` int(11) NOT NULL COMMENT '기본 pk',
  `cateid` int(11) NOT NULL COMMENT '메뉴카테고리에따른분류(ntid-notice,sqid-stuq/a,post_id/counsel,teamproject,blog)',
  `pid` int(11) NOT NULL COMMENT '글번호(각 카테고리의pk)',
  `src` varchar(500) NOT NULL COMMENT '이미지경로'
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
(3, 70, 2, 'teacher3', '조한결', '010-8723-4519', 'user70@example.com', '2', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241120175857212464.png', 'JoCODE 조한결 입니다.', '', '', 1, 0, 1),
(4, 68, 3, 'teacher4', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 1, 0, 0),
(5, 75, 1, 'teacher5', '코딩웍스', '010-2345-6789', 'randomuser1@example.com', '1', 'https://www.youtube.com/@CodingWorks', '/code_even/admin/upload/teacher/20241213083843819429.png', '<p><br></p>', '', '', 1, 0, 0),
(6, 76, 1, 'teacher6', '얄코', '010-8765-4321', 'user6@example.com', '1', 'https://www.youtube.com/@yalco-coding', '/code_even/admin/upload/teacher/20241213084239189335.png', '<p><br></p>', '', '', 1, 0, 0),
(7, 77, 1, 'teacher7', '조코딩', '010-9876-5432', 'lovelycat32@gmail.com', '1', 'https://www.youtube.com/@jocoding', '/code_even/admin/upload/teacher/20241213084539156010.png', '<p><br></p>', '', '', 1, 0, 0),
(8, 78, 1, 'teacher8', '제주코딩베이스캠프', '010-1357-2468', 'user8@example.com', '1', 'https://www.youtube.com/channel/UC4GnvNKtuJ4cqWsYjxNxAEQ', '/code_even/admin/upload/teacher/20241213084623102898.png', '<p><br></p>', '', '', 1, 0, 0),
(9, 79, 1, 'teacher9', '홍팍', '010-4682-7351', 'supernova_77@yahoo.com', '1', 'https://www.youtube.com/channel/UCpW1MaTjw4X-2Y6MwAVptcQ', '/code_even/admin/upload/teacher/20241213084649125650.png', '<p><br></p>', '', '', 1, 0, 0),
(10, 80, 1, 'teacher10', '김영보', '010-7890-1234', 'user10@example.com', '1', 'https://www.youtube.com/@tonextday', '/code_even/admin/upload/teacher/20241213084722188172.png', '<p><br></p>', '', '', 1, 0, 0),
(11, 81, 1, 'teacher11', '개발자의 품격', '010-6543-2109', 'fastcar45@outlook.com', '1', 'https://www.youtube.com/@thegreat-programmers', '/code_even/admin/upload/teacher/20241213084808153324.png', '<p><br></p>', '', '', 1, 0, 0),
(12, 82, 1, 'teacher12', '윤재성', '010-3698-1472', 'bluebird99@hotmail.com', '1', 'https://www.youtube.com/@isoftcampus/search', '/code_even/admin/upload/teacher/20241213084833932891.png', '<p><br></p>', '', '', 1, 0, 0),
(13, 83, 1, 'teacher13', '짐코딩', '010-1927-3648', 'user13@example.com', '1', 'https://www.youtube.com/@gymcoding', '/code_even/admin/upload/teacher/20241213084857119305.png', '<p><br></p>', '', '', 1, 0, 0),
(14, 84, 1, 'teacher14', '노마드크리에이터', '010-4729-3851', 'blud99@hotmail.com', '1', 'https://www.youtube.com/@creApplecom', '/code_even/admin/upload/teacher/20241213084921194839.png', '<p><br></p>', '', '', 1, 0, 0),
(15, 85, 1, 'teacher15', '코지코더', '010-8147-9263', 'techgeek2024@gmail.com', '1', 'https://github.com/kossiecoder', '', '<p><br></p>', '', '', 1, 0, 0),
(16, 86, 1, 'teacher16', '제로초', '010-4758-2941', 'user16@example.com', '1', 'https://www.rallit.com/hub/resumes/1572/조현영', '/code_even/admin/upload/teacher/20241213085110178305.png', '<p><br></p>', '', '', 1, 0, 0),
(17, 87, 2, 'teacher17', 'AWS강의실', '010-2391-8465', 'unshine_day@naver.com', '2', 'https://www.rallit.com/hub/resumes/196278/박상운', '/code_even/admin/upload/teacher/20241213085139185754.png', '<p><br></p>', '', '', 1, 0, 0),
(18, 88, 2, 'teacher18', '이상희', '010-6874-9102', 'user18@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085200972435.png', '<p><br></p>', '', '', 1, 0, 0),
(19, 89, 2, 'teacher19', 'JeongSuk Lee', '010-3421-8674', 'happyworld2023@daum.net', '2', '', '', '', '', '', 1, 0, 0),
(20, 90, 2, 'teacher20', '일프로', '010-5647-2831', 'user20@example.com', '2', 'https://www.rallit.com/hub/resumes/23145/김태민', '/code_even/admin/upload/teacher/20241213085248149827.png', '<p><br></p>', '', '', 1, 0, 0),
(21, 91, 2, 'teacher21', '데이터리안', '010-1482-7395', 'nightowl88@live.com', '2', '', '/code_even/admin/upload/teacher/20241213085311158494.png', '<p><br></p>', '', '', 1, 0, 0),
(22, 92, 2, 'teacher22', '이성욱', '010-2874-5632', 'oceanview55@icloud.com', '2', '', '', '', '', '', 1, 0, 0),
(23, 93, 2, 'teacher23', '권철민', '010-9271-4638', 'user23@example.com', '2', '', '/code_even/admin/upload/teacher/20241213085347197458.png', '<p><br></p>', '', '', 1, 0, 0),
(24, 94, 2, 'teacher24', '잔재미코딩', '010-4758-9210', 'user24@example.com', '2', 'https://www.youtube.com/@fun-coding', '/code_even/admin/upload/teacher/20241213085421100170.png', '<p><br></p>', '', '', 1, 0, 0),
(25, 95, 2, 'teacher25', '김시훈', '010-8465-1273', 'user25@example.com', '2', 'https://www.linkedin.com/in/sihoon-kim/', '', '<p><br></p>', '', '', 1, 0, 0),
(26, 96, 2, 'teacher26', '윤석찬', '010-9374-6581', 'user96@example.com', '2', 'https://www.youtube.com/watch?v=4ZnlZCbbN_A', '/code_even/admin/upload/teacher/20241213085514482122.png', '<p><br></p>', '', '', 1, 0, 0),
(27, 97, 2, 'teacher27', '쿠만', '010-2947-1365', 'user27@example.com', '2', '', '', '', '', '', 1, 0, 0),
(28, 98, 3, 'teacher28', '에릭권', '010-1284-9465', 'user28@example.com', '3', '', '', '', '', '', 1, 0, 0),
(29, 99, 3, 'teacher29', '널널한개발자', '010-5673-8492', 'user29@example.com', '3', 'https://www.youtube.com/@nullnull_not_eq_null', '/code_even/admin/upload/teacher/20241213085545212384.png', '<p><br></p>', '', '', 1, 0, 0),
(30, 100, 3, 'teacher30', '컴공로드맵', '010-9483-1652', 'user30@example.com', '3', '', '/code_even/admin/upload/teacher/20241213085605345002.png', '<p><br></p>', '', '', 1, 0, 0),
(31, 101, 3, 'teacher31', '제로미니', '010-2354-7890', 'user31@example.com', '3', 'https://www.youtube.com/@z3romini', '/code_even/admin/upload/teacher/20241213085627483951.png', '<p><br></p>', '', '', 1, 0, 0),
(32, 102, 1, 'teacher32', '장기효(캡틴판교)', '010-3852-9471', 'user32@example.com', '1', 'https://www.rallit.com/hub/resumes/126/장기효', '/code_even/admin/upload/teacher/20241213085025163488.png', '<p><br></p>', '', '', 1, 0, 0),
(33, 103, 1, 'teacher33', '쩡원', '010-9823-7415', 'user33@example.com', '1', 'https://www.youtube.com/@PHP', '/code_even/admin/upload/teacher/20241213085046193501.png', '<p><br></p>', '', '', 1, 0, 0);

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
(1, 1, 'CSS Flexbox는 1차원 레이아웃으로 요소를 행이나 열 단위로 배치하는 데 적합합니다. 반면, CSS Grid는 2차원 레이아웃으로 행과 열을 동시에 구성할 수 있어 더 복잡한 레이아웃을 다룰 때 유용합니다. 예를 들어, 단순한 메뉴 바나 정렬된 리스트는 Flexbox를 사용하고, 전체 페이지 레이아웃처럼 복잡한 구성을 할 때는 Grid를 사용하는 것이 효율적입니다.'),
(2, 2, 'HTML 문서는 보통 <!DOCTYPE html> 선언으로 시작하며, <html>, <head>, <body> 태그를 포함합니다. <head>에는 메타데이터와 CSS/JS 파일 링크를 작성하고, <body>에는 페이지 콘텐츠를 배치합니다. 주요 태그로는 제목을 표시하는 <h1>~<h6>, 문단을 나타내는 <p>, 링크를 생성하는 <a>, 이미지 삽입용 <img> 등이 있습니다. 처음에는 기본 구조를 작성하는 연습을 해보세요.'),
(3, 3, 'HTML과 CSS를 배우는 데는 HTML 구조를 먼저 익히고, 그 위에 CSS를 적용해 스타일을 추가하는 방법이 효율적입니다. 초보자를 위한 학습 순서: (1) HTML 태그 익히기, (2) CSS 기본 문법 및 선택자 배우기, (3) 간단한 페이지를 만들어 HTML과 CSS를 결합하는 연습. 이후 프로젝트를 점점 복잡하게 확장하며 학습하세요.'),
(4, 4, 'HTML과 CSS를 실습하려면 간단한 프로젝트를 진행하는 것이 가장 좋습니다. 예를 들어, \"개인 소개 웹 페이지\"를 만들어 보세요. HTML로 제목, 문단, 리스트 등을 작성한 후, CSS로 색상, 글꼴, 배경 등을 스타일링합니다. 다양한 샘플을 보고 비슷하게 따라 하며 익히는 것도 좋습니다.'),
(5, 5, '콘텐츠의 가독성을 높이려면 HTML에서는 <h1>~<h6> 태그로 제목을 구분하고, <ul>, <ol>로 목록을 구성합니다. CSS에서는 적절한 글꼴 크기(font-size), 줄 간격(line-height), 색상 대비(color contrast)를 설정합니다. 사용자가 읽기 편한 간격과 색상을 유지하는 것이 중요합니다.'),
(6, 6, '효율적인 HTML 구조를 위해 <header>, <main>, <footer>와 같은 시맨틱 태그를 사용하세요. 페이지 상단에는 네비게이션을 배치하고, 본문에는 중요한 콘텐츠를 포함하며, 하단에는 저작권 정보를 배치합니다. CSS로 그리드 시스템을 사용하면 정돈된 레이아웃을 구성하기에 좋습니다.'),
(7, 7, '실전에서 자주 사용하는 태그로는 <div>, <section>, <header>, <footer> 등이 있으며, CSS에서는 margin, padding, display 속성을 자주 사용합니다. 예를 들어, Flexbox로 가로 정렬을 구성하고 Grid로 복잡한 레이아웃을 설계합니다. 간단한 페이지를 만들어 연습하며 실전 감각을 키워 보세요.'),
(8, 8, '간단한 예제로 \"개인 블로그\" 페이지를 만들어 보세요. HTML로 제목(<h1>), 문단(<p>), 이미지(<img>) 등을 작성하고, CSS로 글꼴 스타일, 레이아웃, 색상을 설정합니다. 시작은 간단하게 하고, 점점 스타일과 기능을 추가해 확장해 보세요.'),
(9, 9, 'Flexbox는 아이템 간 정렬과 공간 배분에 유리하고, Grid는 행과 열을 동시에 구성하는 데 적합합니다. 두 기술을 혼합해 사용해도 좋습니다. 학습 시에는 간단한 예제를 따라하며 차이를 이해하는 것이 중요합니다. 예를 들어, Flexbox로 메뉴를 정렬하고 Grid로 페이지 레이아웃을 설계해 보세요.'),
(10, 10, 'HTML은 페이지의 구조를 정의하고, CSS는 그 구조에 스타일을 추가합니다. 예를 들어, HTML로 제목과 문단을 작성한 후, CSS로 글꼴 색상과 크기를 설정할 수 있습니다. HTML과 CSS의 상호작용은 외부 CSS 파일을 HTML에서 <link> 태그로 연결하며 이루어집니다.'),
(11, 11, '<header>, <main>, <footer> 태그는 필수는 아니지만, 시맨틱 웹 구현에 적합합니다. <header>는 페이지 상단 정보를, <main>은 본문 콘텐츠를, <footer>는 하단 정보를 나타냅니다. 페이지 구조를 명확히 하기 위해 사용하는 것이 좋습니다.'),
(12, 12, 'CSS에서 px는 고정 크기를 설정하고, em과 rem은 상대적인 크기를 정의합니다. em은 부모 요소의 글꼴 크기를 기준으로 하고, rem은 최상위(html) 요소의 글꼴 크기를 기준으로 합니다. 반응형 디자인에서는 rem을 권장합니다.'),
(13, 13, '<div>는 블록 레벨 요소로 전체 줄을 차지하며, <span>은 인라인 요소로 텍스트 일부를 감쌉니다. 예를 들어, 페이지 레이아웃을 나누는 데는 <div>를, 텍스트 강조를 위해 특정 단어를 감쌀 때는 <span>을 사용합니다.');

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
(63, 'teacher5', '이정민', '구름산책', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4923-5718', 'user63@example.com', 0, NULL, NULL, NULL, NULL, '2024-11-16', '2024-11-21 12:12:33', 10, 0),
(64, 'user_ijkl_64', '박진영', '햇빛추적', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9385-7216', 'user64@example.com', NULL, NULL, NULL, NULL, NULL, '2024-10-12', '2024-11-18 16:20:55', 1, 0),
(65, 'user_mnop_65', '최서영', '사랑가득', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2384-7512', 'user65@example.com', 1, NULL, '', '', '', '2024-10-19', '2024-11-20 09:00:10', 1, -1),
(66, 'user_qrst_66', '정은호', '도전왕', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1934-8527', 'user66@example.com', NULL, NULL, NULL, NULL, '중요 참고 사항', '2024-10-18', '2024-11-19 19:20:05', 1, 0),
(67, 'user_uvwx_67', '윤지수2', '꽃바람', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8934-2158', 'user67@example.com', 0, NULL, '', '', '', '2024-11-17', '2024-11-20 12:50:40', 1, 0),
(68, 'teacher4', '이상민', '이상민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9482-1365', 'user68@example.com', 1, NULL, '제주특별자치도 서귀포시', '1층 사무실', NULL, '2024-11-16', '2024-11-19 17:15:30', 10, 0),
(69, 'user_cdef_69', '한유진2', '바다별', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3492-1758', 'user69@example.com', 0, 13100, '', '', '', '2024-11-15', '2024-11-19 14:25:20', 1, -1),
(70, 'teacher3', '조한결', '조한결', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8723-4519', 'user70@example.com', 1, NULL, NULL, NULL, NULL, '2024-11-12', '2024-11-20 11:45:05', 10, 0),
(71, 'user_klmn_71', '정민아', '그린스톰', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2394-1765', 'user71@example.com', 0, NULL, '경상남도 김해시', '빌딩 A동', '참고사항', '2024-11-14', '2024-11-19 16:40:25', 1, 1),
(72, 'ctest', '내이름', '쿠폰테스트', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1234-5678', 'hong@hong.com', NULL, NULL, NULL, NULL, NULL, '2024-11-22', '2024-11-22 11:44:44', 1, 0),
(73, 'test1', '박이름', '박네임', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5555-6666', 'abc@abc.com', NULL, NULL, NULL, NULL, NULL, '2024-11-24', '2024-11-25 01:30:33', 1, 0),
(74, 'example_user', '예시용', '예시입니다', '12345', '010-0000-0000', '0627_b@naver.com', 1, NULL, '', '', '', '2024-11-25', '2024-11-25 11:17:16', 1, 0),
(75, 'teacher5', '코딩웍스', '코딩웍스', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2345-6789', 'randomuser1@example.com', NULL, 12000, '경기도 성남시', '1층', NULL, '2024-01-21', '2024-12-11 15:05:59', 10, 0),
(76, 'teacher6', '얄코', '얄코', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8765-4321', 'user6@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-12', '2024-11-18 09:45:20', 10, 0),
(77, 'teacher7', '조코딩', '조코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9876-5432', 'lovelycat32@gmail.com', NULL, 13579, '부산광역시 해운대구', '3층', '해운대 아파트', '2024-11-14', '2024-11-19 14:12:45', 10, 0),
(78, 'teacher8', '제주코딩베이스캠프', '제주코딩베이스캠프', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1357-2468', 'user8@example.com', 0, 12300, NULL, NULL, NULL, '2024-02-18', '2024-11-17 07:55:10', 10, 0),
(79, 'teacher9', '홍팍', '홍팍', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4682-7351', 'supernova_77@yahoo.com', 1, NULL, '대전광역시 유성구', '빌딩 5층', NULL, '2024-11-15', '2024-11-18 15:30:22', 10, 0),
(80, 'teacher10', '김영보', '김영보', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-7890-1234', 'user10@example.com', 1, NULL, NULL, NULL, NULL, '2024-02-20', '2024-11-19 08:47:59', 10, 0),
(81, 'teacher11', '개발자의 품격', '개발자의 품격', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6543-2109', 'fastcar45@outlook.com', 0, 11300, '서울특별시 동대문구', '아파트 2동', NULL, '2024-02-28', '2024-11-18 16:40:15', 10, 0),
(82, 'teacher12', '윤재성', '윤재성', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3698-1472', 'bluebird99@hotmail.com', NULL, 78452, '전라남도 목포시', '해양타운', '참고 사항', '2024-11-12', '2024-11-19 11:20:33', 10, 0),
(83, 'teacher13', '짐코딩', '짐코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1927-3648', 'user13@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-01', '2024-11-17 12:30:15', 10, 0),
(84, 'teacher14', '노마드크리에이터', '노마드크리에이터', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4729-3851', 'blud99@hotmail.com', 1, 15000, '강원도 춘천시', NULL, NULL, '2024-03-05', '2024-11-18 13:22:08', 10, 0),
(85, 'teacher15', '코지코더', '코지코더', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8147-9263', 'techgeek2024@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-03-15', '2024-11-19 17:09:43', 10, 0),
(86, 'teacher16', '제로초', '제로초', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-2941', 'user16@example.com', 0, 15678, '인천광역시 미추홀구', '별관 6층', NULL, '2024-03-16', '2024-11-18 09:18:29', 10, 0),
(87, 'teacher17', 'AWS강의실', 'AWS강의실', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2391-8465', 'unshine_day@naver.com', NULL, NULL, NULL, NULL, '참고 항목', '2024-03-20', '2024-11-19 16:27:14', 10, 0),
(88, 'teacher18', '이상희', '이상희', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-6874-9102', 'user18@example.com', 1, NULL, NULL, NULL, NULL, '2024-03-29', '2024-11-19 14:52:38', 10, 0),
(89, 'teacher19', 'JeongSuk Lee', 'JeongSuk Lee', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3421-8674', 'happyworld2023@daum.net', NULL, NULL, '경상남도 창원시', '2층', NULL, '2024-03-30', '2024-11-20 08:12:23', 10, 0),
(90, 'teacher20', '일프로', '일프로', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5647-2831', 'user20@example.com', 1, NULL, NULL, NULL, NULL, '2024-04-11', '2024-11-18 07:25:39', 10, 0),
(91, 'teacher21', '데이터리안', '데이터리안', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1482-7395', 'nightowl88@live.com', 0, 14200, '울산광역시 남구', '빌라', NULL, '2024-04-12', '2024-11-19 15:45:16', 10, 0),
(92, 'teacher22', '이성욱', '이성욱', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2874-5632', 'oceanview55@icloud.com', NULL, NULL, NULL, NULL, NULL, '2024-04-13', '2024-11-18 11:20:50', 10, 0),
(93, 'teacher23', '권철민', '권철민', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9271-4638', 'user23@example.com', 1, NULL, '경기도 고양시', NULL, '기타 정보', '2024-04-14', '2024-11-19 17:35:40', 10, 0),
(94, 'teacher24', '잔재미코딩', '잔재미코딩', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-4758-9210', 'user24@example.com', NULL, 11900, NULL, NULL, NULL, '2024-05-15', '2024-11-17 12:47:39', 10, 0),
(95, 'teacher25', '김시훈', '김시훈', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-8465-1273', 'user25@example.com', 0, 13457, '충청남도 천안시', '사무실 1층', NULL, '2024-05-16', '2024-11-19 18:19:54', 10, 0),
(96, 'teacher26', '윤석찬', '윤석찬', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9374-6581', 'user96@example.com', 1, NULL, NULL, NULL, NULL, '2024-05-17', '2024-05-19 14:30:10', 10, 0),
(97, 'teacher27', '쿠만', '쿠만', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2947-1365', 'user27@example.com', NULL, NULL, '제주특별자치도', '건물 5층', '참고 항목2', '2024-05-18', '2024-11-20 10:35:48', 10, 0),
(98, 'teacher28', '에릭권', '에릭권', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-1284-9465', 'user28@example.com', 1, 11234, '대구광역시 수성구', '빌라 A동', NULL, '2024-06-17', '2024-11-19 09:45:30', 10, 0),
(99, 'teacher29', '널널한개발자', '널널한개발자', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-5673-8492', 'user29@example.com', 0, NULL, NULL, NULL, '참고 데이터', '2024-11-15', '2024-06-20 14:15:40', 10, 0),
(100, 'teacher30', '컴공로드맵', '컴공로드맵', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9483-1652', 'user30@example.com', NULL, 13500, '부산광역시 서구', '오피스텔', NULL, '2024-06-12', '2024-11-18 17:25:55', 10, 0),
(101, 'teacher31', '제로미니', '제로미니', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-2354-7890', 'user31@example.com', 1, 12780, '서울특별시 서대문구', '2층 201호', NULL, '2024-06-14', '2024-11-19 16:45:50', 10, 0),
(102, 'teacher32', '장기효(캡틴판교)', '장기효(캡틴판교)', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-3852-9471', 'user32@example.com', 0, NULL, NULL, NULL, '참고 항목', '2024-11-18', '2024-06-20 13:50:25', 10, 0),
(103, 'teacher33', '쩡원', '쩡원', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '010-9823-7415', 'user33@example.com', 1, 14500, '광주광역시 북구', '연립주택 3층', NULL, '2024-06-11', '2024-11-19 10:15:10', 10, 0);

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
  ADD PRIMARY KEY (`exid`),
  ADD KEY `quiz` (`quiz`,`test`),
  ADD KEY `test` (`test`),
  ADD KEY `quiz_answer` (`quiz_answer`,`test_answer`);

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
-- 테이블의 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `book`
--
ALTER TABLE `book`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호', AUTO_INCREMENT=6;

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
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID', AUTO_INCREMENT=29;

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
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호', AUTO_INCREMENT=39;

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
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호';

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원고유번호', AUTO_INCREMENT=104;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- 테이블의 제약사항 `stuscores`
--
ALTER TABLE `stuscores`
  ADD CONSTRAINT `stuscores_ibfk_1` FOREIGN KEY (`quiz`) REFERENCES `quiz` (`exid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stuscores_ibfk_2` FOREIGN KEY (`test`) REFERENCES `test` (`exid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
