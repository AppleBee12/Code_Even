-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-11-15 18:28
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
(9, 9, '강의 개설 절차는 강의 신청서를 제출하고, 강의 내용 및 계획서를 검토 후 승인됩니다. 필요한 서류를 준비하여 신청서를 제출해 주세요.', 'done', NULL);

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
(1, 2, '1', '강의 결제 관련 문의', '강의 결제 시 결제 실패 메시지가 뜨는데 어떻게 해결하나요?', '2024-11-18', NULL),
(2, 3, '2', '강의 수강 관련 문의', '강의를 수강 중에 영상이 제대로 재생되지 않아요. 해결 방법이 있을까요?', '2024-11-18', NULL),
(3, 2, '3', '쿠폰 발급 관련 문의', '강의 쿠폰을 발급받았는데 적용이 되지 않아요. 어떻게 해야 하나요?', '2024-11-18', NULL),
(4, 3, '4', '회원 탈퇴 문의', '회원 탈퇴를 하려고 하는데 절차가 잘 안 나옵니다. 어떻게 해야 하나요?', '2024-11-18', NULL),
(5, 2, '5', '강의 소통 방법 문의', '학생과의 소통에 대해 Q&A 외에 다른 방법은 없나요?', '2024-11-18', NULL),
(6, 3, '6', '수강이수증 발급 문의', '수강이수증을 발급받으려면 어떻게 해야 하나요? 강의를 완료했는데 아직 수강이수증이 안 나왔어요.', '2024-11-18', NULL),
(7, 2, '7', '정산 관련 문의', '강의 수익 정산이 지연되고 있는데 확인 부탁드립니다.', '2024-11-18', NULL),
(8, 3, '8', '강사 이력 확인 문의', '강사의 이력 정보가 업데이트되지 않은 것 같습니다. 어떻게 해야 하나요?', '2024-11-18', NULL),
(9, 2, '2', '강의 개설 관련 문의', '새로운 강의를 개설하려고 하는데, 등록 절차에 대해 안내받고 싶습니다.', '2024-11-18', NULL),
(10, 3, '1', '결제 환불 관련 문의', '강의를 구매했는데, 환불이 불가능한 경우는 무엇인가요?', '2024-11-18', NULL);

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
(1, 1, '1', 'teacher', '학생의 환불 요청을 어떻게 처리하나요?', '학생의 환불 요청은 고객센터를 통해 접수된 후, 환불 정책에 따라 처리됩니다. 세부 절차를 확인하고 환불을 진행하세요.', 0, '2024-11-16 17:24:50', 'off'),
(2, 1, '2', 'student', '강의는 어떻게 수강하나요?', '강의를 수강하려면, 회원 가입 후 로그인하고 원하는 강의를 선택하여 수강 신청을 하시면 됩니다.', 0, '2024-11-16 17:25:50', 'off'),
(3, 1, '3', 'teacher', '학생이 사용하는 쿠폰을 어떻게 관리하나요?', '쿠폰 관리는 사이트 관리자의 권한에 따라 이루어집니다. 학생에게 제공할 쿠폰을 생성하고, 관리 시스템을 통해 발급할 수 있습니다.', 0, '2024-11-16 17:26:30', 'off'),
(4, 1, '4', 'student', '회원 탈퇴는 어떻게 하나요?', '회원 탈퇴를 원하시면, 계정 설정에서 탈퇴 버튼을 클릭하여 진행하실 수 있습니다. 탈퇴 후에는 데이터 복구가 불가능하므로 주의해 주세요.', 0, '2024-11-16 17:27:15', 'on'),
(5, 1, '5', 'teacher', '강의에 대해 학생과의 소통 방법은 어떻게 되나요?', '학생과의 소통은 주로 강의 댓글 기능, 이메일, 실시간 Q&A 등을 통해 이루어집니다. 각 강의에 맞는 소통 방법을 활용하세요.', 0, '2024-11-16 17:28:05', 'off'),
(6, 1, '6', 'student', '수강 이수증은 어떻게 발급하나요?', '강의를 모두 수료한 후, 강의 내용 확인 후 수료증을 발급 받을 수 있습니다. 수료증은 PDF 형태로 제공됩니다.', 0, '2024-11-16 17:29:00', 'on'),
(7, 1, '7', 'teacher', '강사 정산은 언제 이루어지나요?', '강사의 정산은 월별로 이루어지며, 정산 금액은 수업 완료 후 약 15일 이내에 지급됩니다. 정산 내역은 강사 페이지에서 확인할 수 있습니다.', 0, '2024-11-16 17:29:45', 'off'),
(8, 1, '8', 'student', '강사의 이력은 어떻게 확인하나요?', '강사의 이력은 강의 설명 페이지에서 확인할 수 있습니다. 강사 이름을 클릭하면, 자세한 정보를 볼 수 있습니다.', 0, '2024-11-16 17:30:30', 'off'),
(9, 1, '2', 'student', '강의 자료는 어떻게 다운로드 하나요?', '강의 자료는 강의 수업 페이지에서 다운로드 가능합니다. 각 강의 페이지에 제공된 다운로드 링크를 통해 파일을 받으실 수 있습니다.', 0, '2024-11-16 17:31:15', 'on'),
(10, 1, '1', 'teacher', '강의 수익은 어떻게 확인하나요?', '강의 수익은 강사 대시보드에서 확인할 수 있으며, 판매된 강의의 수익 내역과 정산 상태를 표시합니다.', 0, '2024-11-16 17:32:00', 'off'),
(11, 1, '1', 'student', '강의 결제는 어떻게 하나요?', '강의 결제는 사이트 내 결제 시스템을 통해 가능합니다. 결제 방법을 선택하고, 결제 정보를 입력하시면 완료됩니다.', 0, '2024-11-16 17:24:50', 'on'),
(12, 1, '2', 'teacher', '강의를 어떻게 개설하나요?', '강의를 개설하려면 강의 개설 신청서를 작성하고, 강의 내용 및 계획을 제출해야 합니다. 승인 후 강의가 등록됩니다.', 0, '2024-11-16 17:25:50', 'off'),
(13, 1, '3', 'student', '쿠폰은 어떻게 사용하나요?', '쿠폰은 결제 시, 쿠폰 코드 입력란에 코드를 입력하여 사용하실 수 있습니다. 쿠폰은 특정 조건에 따라 제공됩니다.', 0, '2024-11-16 17:26:30', 'off'),
(14, 1, '4', 'teacher', '강사 계정 탈퇴는 어떻게 하나요?', '강사 계정 탈퇴는 계정 설정에서 탈퇴 요청을 통해 진행할 수 있습니다. 탈퇴 후에는 다시 복구할 수 없으므로 신중히 결정하세요.', 0, '2024-11-16 17:27:15', 'off'),
(15, 1, '5', 'student', '사이트 이용 중 오류가 발생했어요, 어떻게 해야 하나요?', '사이트 이용 중 발생한 오류는 고객센터로 문의해 주시면, 빠르게 해결해드리겠습니다.', 0, '2024-11-16 17:28:05', 'off'),
(16, 1, '6', 'teacher', '강의 수료 조건은 무엇인가요?', '강의 수료 조건은 강의 수강과 특정 과제나 시험을 완료하는 것입니다. 수료 기준은 강의 페이지에서 확인할 수 있습니다.', 0, '2024-11-16 17:29:00', 'off'),
(17, 1, '7', 'student', '결제 금액의 세금 계산서는 언제 발급되나요?', '세금 계산서는 결제 완료 후 7일 이내에 이메일로 발급됩니다. 이메일 확인을 부탁드립니다.', 0, '2024-11-16 17:29:45', 'off'),
(18, 1, '8', 'teacher', '강사 프로필은 어떻게 수정하나요?', '강사 프로필 수정은 계정 설정에서 가능합니다. 강사 프로필 사진, 자기소개 등을 업데이트할 수 있습니다.', 0, '2024-11-16 17:30:30', 'off'),
(19, 1, '2', 'student', '학생의 질문에 어떻게 답변하나요?', '학생의 질문은 강의 내 Q&A나 댓글 시스템을 통해 답변할 수 있습니다. 학습 자료를 추가하거나 설명을 덧붙여 주세요.', 0, '2024-11-16 17:31:15', 'off'),
(20, 1, '1', 'student', '환불은 어떻게 받나요?', '강의를 구매한 후 환불을 원하시면, 고객센터를 통해 환불 절차를 진행할 수 있습니다. 환불 정책에 따라 일부 제한이 있을 수 있습니다.', 0, '2024-11-16 17:32:00', 'off');



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
-- 테이블 구조 `teacher_qna`
--

CREATE TABLE `teacher_qna` (
  `asid` int(11) NOT NULL COMMENT '답변고유ID',
  `sqid` int(11) DEFAULT NULL COMMENT '질문고유ID',
  `tcid` int(11) NOT NULL COMMENT '강사ID',
  `content` text NOT NULL COMMENT '답변내용',
  `file` varchar(255) DEFAULT NULL COMMENT '파일'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='강사 답변';

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
-- 테이블의 인덱스 `class_data`
--
ALTER TABLE `class_data`
  ADD PRIMARY KEY (`cdid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `leid` (`leid`),
  ADD KEY `exid` (`exid`);

--
-- 테이블의 인덱스 `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`fqid`),
  ADD KEY `uid` (`uid`);

--
-- 테이블의 인덱스 `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`ntid`),
  ADD KEY `uid` (`uid`);

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
-- 테이블의 인덱스 `teacher_qna`
--
ALTER TABLE `teacher_qna`
  ADD PRIMARY KEY (`asid`),
  ADD UNIQUE KEY `sqid` (`sqid`),
  ADD KEY `tcid` (`tcid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admin_answer`
--
ALTER TABLE `admin_answer`
  MODIFY `aaid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유번호';

--
-- 테이블의 AUTO_INCREMENT `admin_question`
--
ALTER TABLE `admin_question`
  MODIFY `aqid` int(11) NOT NULL AUTO_INCREMENT COMMENT '질문고유번호';

--
-- 테이블의 AUTO_INCREMENT `class_data`
--
ALTER TABLE `class_data`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT COMMENT '수강데이터ID';

--
-- 테이블의 AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `fqid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'FAQ고유번호';

--
-- 테이블의 AUTO_INCREMENT `notice`
--
ALTER TABLE `notice`
  MODIFY `ntid` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항고유번호';

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
-- 테이블의 AUTO_INCREMENT `teacher_qna`
--
ALTER TABLE `teacher_qna`
  MODIFY `asid` int(11) NOT NULL AUTO_INCREMENT COMMENT '답변고유ID';

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
