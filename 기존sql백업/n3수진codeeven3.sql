-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-19 22:52
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
(11, 15, 0, '일단 기초적인 것부터 시작을 하려고 하는데요', '<p>일단 레시피 강좌를 따라가면서 백엔드를 공부하고자 합니다</p><p>그래서 예전에는 아무것도 모르는 상태로 웹사이트에 도전했는데&nbsp;<span style=\"background-color: var(--bs-table-bg); text-align: var(--bs-body-text-align);\">이해가 잘안가서 철수를 했습니다.</span></p><p>그러나 이번에는 차곡차곡 어떤순서로 접해야 기초를 잡고 java백엔드쪽을 배울 수 있는지 여쭙고자 합니다.</p><p>기초란 어떤 순서를 통해야 프로그래밍세계에 입문할 수 있는지 정도요!</p>', 45, 0, 455, '2024-12-19 12:35:09');

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
(3, 9, 'C', 12, '어느 분야든 첫 술에 배부를 수는 없다고 생각해요.\r\n취업이 목표이시라면 목표로 하는 기업을 정하시거나\r\n조금 더 나아가서는 본인에게 맞는 언어를 정해서 공부를 하시고 그 언어에 맞는 회사를 찾아보시는게 좋다고 생각해요', '2024-12-18 16:29:40'),
(4, 28, 'C', 12, '\'연구자\'님이 어떤 쪽에 더 관심 있으신지 모르지만\r\n사람인이나 잡코리아 등에서 나온 회사공고를 확인해보시면\r\n어떤 언어를 엮어서 공부하면 좋을 지 좀 더 감이 오실 것 같습니다.', '2024-12-18 16:29:27'),
(12, 3, 'C', 24, 'test', '2024-12-19 13:04:33'),
(13, 3, 'C', 24, 'thanks', '2024-12-19 13:04:51'),
(14, 1, 'T', 24, '오픈카톡으로 챗 드렸습니다!', '2024-12-19 21:49:57');

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
(25, 4, '모집중', '[디자이너 모집] 사이드 프로젝트 디자이너분 모십니다!', '2024-12-02', '온라인', 'figma, firebase', '단기(1~2개월)', 'https://open.kakao.com/o/s123456', 2, '<p>[개발 프로젝트 모집 내용 예시]</p>\r\n<p>프로젝트 주제 : 책</p>\r\n<p> 평점 등록 사이트 \r\n예상 모집인원 : 1명</p><p>\r\n프로젝트 소개와 개설 이유 :\r\n포폴용으로 혼자 개발한 사이트(아래 참고)인데, </p><p>디자인을 개선하고 싶어 디자이너분의 도움을 구합니다. 🙏</p><p>\r\n함께 사이트를 더 멋지게 만들어주실 분을 기다리고 있어요!.</p><p> 관심 있으신 분은 언제든지 연락 부탁드려요!!\r\n</p><p>사이트 링크\r\nhttps://book-rating-123456</p><p>\r\n카카오 오픈채팅방으로 연락주세요!\r\n</p>', 10, 0, 135, '2024-12-19 21:43:51');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`post_id`);

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
-- 테이블의 인덱스 `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`commid`);

--
-- 테이블의 인덱스 `teamproject`
--
ALTER TABLE `teamproject`
  ADD PRIMARY KEY (`post_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `company_info`
--
ALTER TABLE `company_info`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT COMMENT '상점정보 고유번호(자동)', AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `counsel`
--
ALTER TABLE `counsel`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id', AUTO_INCREMENT=26;

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
-- 테이블의 AUTO_INCREMENT `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `commid` int(11) NOT NULL AUTO_INCREMENT COMMENT '댓글id', AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `teamproject`
--
ALTER TABLE `teamproject`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '게시물id(자동)', AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
