
--
-- 테이블의 덤프 데이터 `teachers`
--

INSERT INTO `teachers` (`tcid`, `uid`, `cgid`, `tc_userid`, `tc_name`, `tc_userphone`, `tc_email`, `tc_cate`, `tc_url`, `tc_thumbnail`, `tc_intro`, `tc_bank`, `tc_account`, `tc_ok`, `isrecom`, `isnew`) VALUES
(1, 2, 1, 'even_teacher', '이븐선생', '010-4567-8910', 'eventeacher@even.co.kr', '1', '', '/code_even/admin/upload/teacher/20241120094509359854.jpg', '안녕하세요 익힘의 정도가 적절한 이븐선생입니다~', '', '', 1, 1, 0),
(2, 4, 1, 'my_teacher', '김동주', '010-4567-8910', 'rocks@even.co.kr', '1', 'https://www.youtube.com/@Ezweb', '/code_even/admin/upload/teacher/20241120172340324741.jpg', '반갑습니다. 바위처럼, 이지웹입니다.', '', '', 1, 1, 0),
(3, 70, 2, 'teacher2', '조한결', '010-8723-4519', 'user70@example.com', '2', 'https://www.youtube.com/@jocode-official', '/code_even/admin/upload/teacher/20241120175857212464.png', 'JoCODE 조한결 입니다.', '', '', 1, 0, 0),
(4, 68, 3, 'teacher3', '이상민', '010-9482-1365', 'user68@example.com', '3', '', '/code_even/admin/upload/teacher/20241120181520409651.png', '새로운 기술을 학습하고 전달하는 것을 좋아합니다.', '', '', 1, 0, 1);



