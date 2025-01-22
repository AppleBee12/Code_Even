<?php
$title = '팀 프로젝트';
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

$uid = $_SESSION['UID'];

$sql = "SELECT uid, usernick 
        FROM user 
        WHERE uid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $uid);  // "i"는 정수 타입
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();

?>


<div class="container teamprj_wrapper teamproject_wrapper">
  <div class="community_title d-flex flex-column gap-5">
    <h3 class="headt3"><?= $title ?></h3>
    <div class="d-flex justify-content-center align-items-center">
      <div class="content d-flex flex-column gap-3 mx-auto">
        <div class="title">
          <div class="headt3">프로젝트 팀원을 모집해보세요</div>
          <div class="headt6">차근차근 쌓아나가는 협업 노하우, 이븐인들과 같이 성장해보세요!</div>
        </div>
      </div>
    </div>
  </div>

  <div class="community_contents_wrapper">
    <form action="teamproject_write_ok.php" id="teamprojectWrite" method="POST">
      <input type="hidden" name="uid" value="<?= $_SESSION['UID'] ?>">
      <input type="hidden" name="contents" id="teamproject_content">
      <table class="table info_table">
        <colgroup>
          <col class="col-1">
          <col class="col-5">
          <col class="col-1">
          <col class="col-5">
        </colgroup> 

        <tbody>
          <tr>
            <th scope="row">
              <label for="titles">글 제목 <b>*</b></label>
            </th>
            <td colspan="3">
              <input type="text" id="titles" name="titles" class="form-control" placeholder="제목을 입력해주세요." required>
            </td>
          </tr>

          <tr>
            <th scope="row">
              <label for="start_date">시작 예정일 <b>*</b></label>
            </th>
            <td>
              <input type="date" id="start_date" name="start_date" class="form-control w_512" required>
            </td>
            <th scope="row">
              <label for="mode">진행 방식 <b>*</b></label>
            </th>
            <td class="d-flex gap-3">
              <div class="form-check d-flex align-items-center radio">
                <input class="form-check-input" type="radio" name="mode" id="mode" value="온라인" checked required>
                <label class="form-check-label" for="mode">
                  온라인
                </label>
              </div>
              <div class="form-check d-flex align-items-center radio">
                <input class=" form-check-input" type="radio" name="mode" id="mode" value="온/오프라인">
                <label class="form-check-label" for="mode">
                온/오프라인
                </label>
              </div>
              <div class="form-check d-flex align-items-center radio">
                <input class=" form-check-input" type="radio" name="mode" id="mode" value="오프라인">
                <label class="form-check-label" for="mode">
                오프라인
                </label>
              </div>
            </td>
          </tr>

          <tr>
              <th scope="row">
                <label for="dev_env">개발 환경 <b>*</b></label>
              </th>
              <td class="d-flex justify-content-between">
                <p class="select_item">선택: </p>
                <div id="dev_env" name="dev_env" class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    개발 환경을 골라주세요 (최대5개)
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="react" value="react">
                        <label class="form-check-label" for="react">React</label>
                      </div>
                    </li>
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="vue" value="vue">
                        <label class="form-check-label" for="vue">Vue</label>
                      </div>
                    </li>
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="angular" value="angular">
                        <label class="form-check-label" for="angular">angular</label>
                      </div>
                    </li>
                  </ul>
                </div>  

                <!-- <select id="dev_env" name="dev_env" multiple required>
                  <option value="react">
                    react  
                  </option>
                  <option value="vue">vue</option>
                  <option value="angular">angular</option>
                  <option value="typescript">typescript</option>
                  <option value="HTML5">HTML5</option>
                  <option value="CSS3">CSS3</option>
                  <option value="javascript">javascript</option>
                  <option value="j-query">j-query</option>
                  <option value="android">android</option>
                  <option value="ios">ios</option>
                  <option value="swift">swift</option>
                  <option value="wordpress">wordpress</option>
                  <option value="docker">docker</option>
                  <option value="python">python</option>
                  <option value="oracle">oracle</option>
                  <option value="mongodb">mongodb</option>
                  <option value="AWS">AWS</option>
                  <option value="firebase">firebase</option>
                  <option value="git">git</option>
                  <option value="googlecloud">googlecloud</option>
                </select> -->
                  <!-- <input type="text" class="form-control" aria-label="Text input with dropdown button" name="tags" id="tags" required> -->
                
                  <!-- <select class="form-select" id="tags" name="dev_env[]" multiple="multiple" size="2" style="width: 100%;" required>
                    <option value="1">react</option>
                    <option value="2">vue</option>
                    <option value="3">angular</option>
                    <option value="4">typescript</option>
                  </select> -->
                
                  <!-- <ul class="dropdown-menu dropdown-menu-end">
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">mongodb</a></li>
                    <li><a class="dropdown-item" href="#">AWS</a></li>
                    <li><a class="dropdown-item" href="#">firebase</a></li>
                    <li><a class="dropdown-item" href="#">git</a></li>
                    <li><a class="dropdown-item" href="#">googlecloud</a></li>
                  </ul> -->

                <!-- 
                android angular AWS CSS3 docker figma firebase git googlecloud HTML5
                ios javascript j-query laravel mongodb oracle python react swift 
                typescript vue wordpress 
                -->
              </td>
              <th scope="row">
                <label for="durations">예상 기간 <b>*</b></label>
              </th>
              <td class="d-flex gap-3">
                <div class="form-check d-flex align-items-center radio">
                  <input class="form-check-input" type="radio" name="durations" id="durations" value="단기(1~2개월)" checked required>
                  <label class="form-check-label" for="durations">
                  단기(1~2개월)
                  </label>
                </div>
                <div class="form-check d-flex align-items-center radio">
                  <input class=" form-check-input" type="radio" name="durations" id="durations" value="중기(3~6개월)">
                  <label class="form-check-label" for="durations">
                  중기(3~6개월)
                  </label>
                </div>
                <div class="form-check d-flex align-items-center radio">
                  <input class=" form-check-input" type="radio" name="durations" id="durations" value="장기(6개월이상)">
                  <label class="form-check-label" for="durations">
                  장기(6개월이상)
                  </label>
                </div>
              </td>
            </tr>

            <tr>
              <th scope="row">
                <label for="contact_url" class="form-label">지원 방법 <b>*</b></label>
              </th>
              <td class="input-group">
                <span class="input-group-text" id="contact_url">https://example.co.kr</span>
                <input type="text" id="contact_url" name="contact_url" class="form-control" placeholder="https로 시작하는 오픈카톡, 구글폼 주소" required>
              </td>
              <th scope="row">
                <label for="roles">모집 분야 <b>*</b></label>
              </th>
              <td class="d-flex gap-3">
                <!-- 모집분야(비트플래그 방식),기획자,디자이너,프론트엔드,백엔드,기타 -->
                
                <div class="form-check d-flex align-items-center">
                  <input class="form-check-input" type="checkbox" name="roles" id="roles" value="기획자" required>
                  <label class="form-check-label" for="roles">
                  기획자
                  </label>
                </div>
                <div class="form-check d-flex align-items-center">
                  <input class=" form-check-input" type="checkbox" name="roles" id="roles" value="디자이너">
                  <label class="form-check-label" for="roles">
                  디자이너
                  </label>
                </div>
                <div class="form-check d-flex align-items-center">
                  <input class=" form-check-input" type="checkbox" name="roles" id="roles" value="프론트엔드">
                  <label class="form-check-label" for="roles">
                  프론트엔드
                  </label>
                </div>
                <div class="form-check d-flex align-items-center">
                  <input class=" form-check-input" type="checkbox" name="roles" id="roles" value="백엔드">
                  <label class="form-check-label" for="roles">
                  백엔드
                  </label>
                </div>
                <div class="form-check d-flex align-items-center">
                  <input class=" form-check-input" type="checkbox" name="roles" id="roles" value="기타">
                  <label class="form-check-label" for="roles">
                  기타
                  </label>
                </div>
              </td>
            </tr>

            <tr>
              <th scope="row">글 내용 <b>*</b></th>
              <td colspan="3" class="editor">
                <div id="summernote"></div>
              </td>
            </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-outline-danger" onClick="cancle()">취소</button>
        <button class="btn btn-secondary">등록</button>
      </div>
    </form>
  </div>
</div>

<script>
  function cancle() {
    if (confirm('취소하시겠습니까?')) {
      history.back(); //formdata가 넘어감, type:button 으로 해결
    }
  }
</script>

<script>
  // 폼 제출 시 Summernote 내용 hidden으로 넘기기
  $('#counselWrite').on('submit', function() {
    var counselContent = $('#summernote').summernote('code'); // Summernote 에디터에서 HTML 코드 가져오기
    $('#counsel_content').val(counselContent); // 숨겨진 input에 설정
  });
</script>

<script>    
// 옵션:개발 환경, 다중 선택가능한 드롭다운 옵션
  // const devEnv = document.querySelector('#dev_env');
  const devEnvSelectItem = document.querySelector('.select_item');
  const devCheckboxes = document.querySelectorAll('#dev_env .form-check-input')

  devCheckboxes.forEach((devcheckbox) => {
    devcheckbox.addEventListener('change', () => {
      const selected = Array.from(devCheckboxes)
        .filter((input) => input.checked)
        .map((input) => input.nextElementSibling.textContent.trim());
      devEnvSelectItem.textContent = `선택: ${selected.join(', ')}`;
    });
  });

  // devEnv.addEventListener('change', (e) => {
  //   const options = e.currentTarget.options
  //   const devEnvList = []
  
  //   for (const option of options){
  //     if (option.selected){
  //       devEnvList.push(option.textContent)
  //     }
  //   }
  //   // const index = options.selectedIndex
  //   devEnvSelectItem.textContent = `선택: ${devEnvList.join(', ')}`
  // })
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>

