<?php

$title = "강좌 수정";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

// 강좌 ID 가져오기
$leid = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$leid) {
echo "<script>alert('잘못된 접근입니다.'); location.href = 'lecture/lecture_list.php';</script>";
exit;
}

// 강좌 데이터 가져오기
$sql_lecture = "
SELECT l.*, b.title AS book_title, b.boid AS book_id
FROM lecture l
LEFT JOIN book b ON l.boid = b.boid
WHERE l.leid = $leid
";
$result_lecture = $mysqli->query($sql_lecture);
$lecture = $result_lecture->fetch_object();

if (!$lecture) {
echo "<script>alert('강좌 정보를 찾을 수 없습니다.'); location.href = 'lecture_list.php';</script>";
exit;
}

// 카테고리 데이터 가져오기
$sql_cate = "SELECT * FROM category ORDER BY step, pcode";
$result_cate = $mysqli->query($sql_cate);

$categories = [];
while ($row = $result_cate->fetch_object()) {
$categories[] = $row;
}

// 관련 교재 데이터 가져오기
$sql_books = "
SELECT boid, book 
FROM book 
WHERE cate1 = '{$lecture->cate1}' 
AND cate2 = '{$lecture->cate2}' 
AND cate3 = '{$lecture->cate3}'
";
$result_books = $mysqli->query($sql_books);

$relatedBooks = [];
while ($row = $result_books->fetch_object()) {
$relatedBooks[] = $row;
}

// 강좌에 연결된 동영상 정보 가져오기
$sql_videos = "SELECT * FROM lecture_detail WHERE lecture_id = $leid";
$result_videos = $mysqli->query($sql_videos);

$lecture_videos = [];
while ($row = $result_videos->fetch_object()) {
$lecture_videos[] = $row;
}

$sql_videos = "
SELECT ld.*, lf.fname AS file_name, lf.fpath AS file_path
FROM lecture_detail ld
LEFT JOIN lefile lf ON ld.file_id = lf.fileid
WHERE ld.lecture_id = $leid
";
$result_videos = $mysqli->query($sql_videos);

$lecture_videos = [];
while ($row = $result_videos->fetch_object()) {
$lecture_videos[] = $row;
}

?>

<div class="container">
<h2>강좌 수정</h2>
<form method="POST" action="lecture_update_ok.php" enctype="multipart/form-data">
<input type="hidden" name="leid" value="<?= $leid ?>">
<table class="table">
<tbody>
<tr>
<th>분류 설정 <b>*</b></th>
<td>
<select name="cate1" id="cate1" class="form-select">
<option value="">대분류</option>
<?php foreach ($categories as $category): ?>
<?php if ($category->step == 1): ?>
<option value="<?= $category->code ?>" <?= $lecture->cate1 === $category->code ? 'selected' : '' ?>>
<?= $category->name ?>
</option>
<?php endif; ?>
<?php endforeach; ?>
</select>
</td>
<td>
<select name="cate2" id="cate2" class="form-select">
<option value="">중분류</option>
<?php foreach ($categories as $category): ?>
<?php if ($category->step == 2 && $category->pcode === $lecture->cate1): ?>
<option value="<?= $category->code ?>" <?= $lecture->cate2 === $category->code ? 'selected' : '' ?>>
<?= $category->name ?>
</option>
<?php endif; ?>
<?php endforeach; ?>
</select>
</td>
<td>
<select name="cate3" id="cate3" class="form-select">
<option value="">소분류</option>
<?php foreach ($categories as $category): ?>
<?php if ($category->step == 3 && $category->pcode === $lecture->cate2): ?>
<option value="<?= $category->code ?>" <?= $lecture->cate3 === $category->code ? 'selected' : '' ?>>
<?= $category->name ?>
</option>
<?php endif; ?>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr>
<th>강좌명 <b>*</b></th>
<td colspan="3">
<input type="text" name="title" class="form-control" value="<?= $lecture->title ?>" required>
</td>
</tr>
<tr>
<th>강사명</th>
<td colspan="3">
<input type="text" class="form-control" value="<?= $lecture->name ?>" disabled>
</td>
</tr>
<tr>
<th>썸네일 이미지</th>
<td colspan="3">
<div class="mb-2 editImg">
<?php if ($lecture->image): ?>
<img src="<?= $lecture->image ?>" alt="썸네일">
<?php endif; ?>
</div>
<input type="file" name="image" class="form-control">
</td>
</tr>
<tr>
<th>수강료 <b>*</b></th>
<td colspan="3">
<input type="number" name="price" class="form-control" value="<?= $lecture->price ?>" required>
</td>
</tr>
<tr>
<th>교재 선택 <b>*</b></th>
<td colspan="3">
<select name="book" class="form-select">
<option value="">-- 교재를 선택하세요 --</option>
<?php foreach ($relatedBooks as $book): ?>
<option value="<?= $book->boid ?>" <?= $lecture->book_id === $book->boid ? 'selected' : '' ?>>
<?= $book->book ?>
</option>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr>
<th>교육 기간 <b>*</b></th>
<td colspan="3">
<select name="period" class="form-select">
<option value="30" <?= isset($lecture) && $lecture->period == 30 ? 'selected' : '' ?>>30일</option>
<option value="60" <?= isset($lecture) && $lecture->period == 60 ? 'selected' : '' ?>>60일</option>
<option value="90" <?= isset($lecture) && $lecture->period == 90 ? 'selected' : '' ?>>90일</option>
<option value="120" <?= isset($lecture) && $lecture->period == 120 ? 'selected' : '' ?>>120일</option>
</select>
<small class="text-muted">* 교육 기간은 30일 단위로 설정 가능합니다.</small>
</td>
</tr>
<tr>
<th>강좌 유형 <b>*</b></th>
<td colspan="3">
<div class="d-flex gap-4">
<div class="form-check">
<input class="form-check-input" type="radio" name="course_type" value="recipe" <?= $lecture->course_type === 'recipe' ? 'checked' : '' ?>>
<label class="form-check-label">레시피 강좌</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="course_type" value="general" <?= $lecture->course_type === 'general' ? 'checked' : '' ?>>
<label class="form-check-label">일반 강좌</label>
</div>
</div>
</td>
</tr>
</tbody>
</table>
<h2>강의 수정</h2>
<input type="hidden" name="lecture_id" value="<?= $leid; ?>">
<div>
<?php if (!empty($lecture_videos)): ?>
<?php foreach ($lecture_videos as $index => $lecture): ?>
<div class="lecture-section">
<div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
<h5 class="mb-0"><?= ($index + 1); ?>강</h5>
<i class="bi bi-x" onclick="removeLecture(this, <?= $lecture->id; ?>)"></i>
</div>
<table class="table">
<tbody>
<tr>
<th scope="row">강의명</th>
<td colspan="3">
<input name="lecture_name[<?= $lecture->id; ?>]" type="text" class="form-control" value="<?= htmlspecialchars($lecture->title); ?>" required>
</td>
</tr>
<tr>
<th scope="row">강의 설명</th>
<td colspan="3">
<textarea name="lecture_description[<?= $lecture->id; ?>]" class="form-control"><?= htmlspecialchars($lecture->description); ?></textarea>
</td>
</tr>
<tr>
<th scope="row">퀴즈 선택</th>
<td>
<select name="lecture_quiz_id[]" class="form-select">
<option value="">퀴즈를 선택해 주세요.</option>
</select>
</td>
<th scope="row">시험 선택</th>
<td>
<select name="lecture_test_id[]" class="form-select">
<option value="">시험을 선택해 주세요.</option>
</select>
</td>
</tr>
<tr>
<th scope="row">실습 파일 등록</th>
<td>
<div class="input-group">
<!-- 파일 선택 버튼 -->
<label class="file-label">
<input 
type="file" 
name="lecture_file_id[<?= $lecture->id; ?>]" 
class="file-input" 
data-target="file-name-<?= $lecture->id; ?>">
<span 
id="file-name-<?= $lecture->id; ?>" 
class="file-placeholder">
<?= !empty($lecture->file_name) ? htmlspecialchars($lecture->file_name) : '선택된 파일 없음'; ?>
</span>
</label>
</div>
</td>
<th scope="row">동영상 주소 <b>*</b></th>
<td>
<div class="input-group">
<span class="input-group-text">https://</span>
<input name="lecture_video_url[<?= $lecture->id; ?>]" type="text" class="form-control" value="<?= htmlspecialchars($lecture->video_url); ?>" required>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>등록된 강의가 없습니다.</p>
<?php endif; ?>
<div class="leplus add-lecture btn d-flex justify-content-center align-items-center bg-white border rounded-3 boder-secondary cursor-pointer">
<i class="bi bi-plus"></i>
</div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4 mb-5">
<button type="submit" class="btn btn-secondary">수정 완료</button>
<button type="button" class="btn btn-danger" onclick="window.location.href='/lecture_list.php'">취소</button>
</div>
</form>
</div>
<script>
// 카테고리 연동 스크립트
document.getElementById('cate1').addEventListener('change', function () {
updateCategories(this.value, 'cate2');
});

document.getElementById('cate2').addEventListener('change', function () {
updateCategories(this.value, 'cate3');
});

function updateCategories(parentCode, childId) {
const categories = <?= json_encode($categories) ?>;
const filtered = categories.filter(cat => cat.pcode === parentCode);
const childSelect = document.getElementById(childId);

childSelect.innerHTML = '<option value="">-- 선택 --</option>';
filtered.forEach(cat => {
childSelect.innerHTML += `<option value="${cat.code}">${cat.name}</option>`;
});
}

$(document).ready(function () {
$('.file-input').on('change', function () {
const targetId = $(this).data('target'); // 연결된 ID 가져오기
const fileName = this.files[0] ? this.files[0].name : '선택된 파일 없음'; // 선택한 파일명 가져오기
$('#' + targetId).text(fileName); // 파일명 업데이트
});
});





let lectureCount = <?= count($lecture_videos); ?>; // 기존 강의 개수

document.querySelector('.add-lecture').addEventListener('click', function () {
lectureCount++;
const lectureTemplate = `
<div class="lecture-section">
<div class="video d-flex justify-content-between align-items-center bg-light border rounded-3">
<h5 class="mb-0">${lectureCount}강</h5>
<i class="bi bi-x" onclick="removeLecture(this)"></i>
</div>
<table class="table">
<tbody>
<tr>
<th scope="row">강의명</th>
<td colspan="3">
<input name="new_lecture_name[]" type="text" class="form-control" placeholder="강의명을 입력해 주세요." required>
</td>
</tr>
<tr>
<th scope="row">강의 설명</th>
<td colspan="3">
<textarea name="new_lecture_description[]" class="form-control" placeholder="강의 설명을 입력해 주세요."></textarea>
</td>
</tr>
<tr>
<th scope="row">동영상 주소</th>
<td colspan="3">
<div class="input-group">
<span class="input-group-text">https://</span>
<input name="new_lecture_video_url[]" type="text" class="form-control" placeholder="동영상 URL을 입력해 주세요." required>
</div>
</td>
</tr>
<tr>
<th scope="row">퀴즈 선택</th>
<td>
<select name="new_lecture_quiz_id[]" class="form-select">
<option value="">퀴즈를 선택해 주세요.</option>
</select>
</td>
<th scope="row">시험 선택</th>
<td>
<select name="new_lecture_test_id[]" class="form-select">
<option value="">시험을 선택해 주세요.</option>
</select>
</td>
</tr>
<tr>
<th scope="row">실습 파일 등록</th>
<td>
<input name="new_lecture_file_id[]" class="form-control" type="file">
</td>
<th scope="row">동영상 주소 <b>*</b></th>
<td>
<div class="input-group">
<span class="input-group-text">https://</span>
<input type="text" name="new_lecture_video_url[]" class="form-control" placeholder="www.code_even.com">
</div>
</td>
</tr>
</tbody>
</table>
</div>
`;
document.querySelector('form > div').insertAdjacentHTML('beforeend', lectureTemplate);
});

function removeLecture(element, lectureId = null) {
if (lectureId) {
if (!confirm('정말로 삭제하시겠습니까?')) return;
// 서버로 삭제 요청 전송
fetch(`delete_lecture.php?id=${lectureId}`, { method: 'GET' })
.then(response => response.json())
.then(data => {
if (data.success) {
element.closest('.lecture-section').remove();
reorderLectures();
} else {
alert('삭제에 실패했습니다.');
}
})
.catch(error => console.error('Error:', error));
} else {
element.closest('.lecture-section').remove();
reorderLectures();
}
}

function reorderLectures() {
const lectures = document.querySelectorAll('.lecture-section h5');
lectures.forEach((lecture, index) => {
lecture.textContent = `${index + 1}강`;
});
}
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>
