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
              <td>
                
                <select id="dev_env" name="dev_env" multiple required>
                  <option value="react">react</option>
                  <option value="vue">vue</option>
                  <option value="angular">angular</option>
                  <option value="typescript">typescript</option>
                </select>
                <p class="select_item">선택: react</p>
                 <!-- <select id="dev_env" multiple="multiple" tabindex="-1">
                    <option value="cheese" data-multiselectid="multiselect_jwyrv5g1r1b_0_0">Cheese</option>
                    <option value="tomatoes" data-multiselectid="multiselect_jwyrv5g1r1b_0_1">Tomatoes</option>
                    <option value="Mozzarella" data-multiselectid="multiselect_jwyrv5g1r1b_0_2">Mozzarella</option>
                    <option value="Mushrooms" data-multiselectid="multiselect_jwyrv5g1r1b_0_3">Mushrooms</option>
                    <option value="Pepperoni" data-multiselectid="multiselect_jwyrv5g1r1b_0_4">Pepperoni</option>
                    <option value="Onions" data-multiselectid="multiselect_jwyrv5g1r1b_0_5">Onions</option>
                  </select>
                <div class="btn-group show">
                  <button type="button" class="multiselect dropdown-toggle custom-select text-center" data-toggle="dropdown" title="None selected" aria-expanded="true">
                    <span class="multiselect-selected-text">None selected</span>
                  </button>
                <div class="multiselect-container dropdown-menu show" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-start">
                  <button type="button" class="multiselect-option dropdown-item" title="Cheese">
                    <span class="form-check">
                      <input class="form-check-input" type="checkbox" value="cheese" id="multiselect_jwyrv5g1r1b_0_0">
                      <label class="form-check-label" for="multiselect_jwyrv5g1r1b_0_0">Cheese</label>
                    </span>
                  </button>
                  <button type="button" class="multiselect-option dropdown-item" title="Pepperoni"><span class="form-check"><input class="form-check-input" type="checkbox" value="Pepperoni" id="multiselect_jwyrv5g1r1b_0_4"><label class="form-check-label" for="multiselect_jwyrv5g1r1b_0_4">Pepperoni</label></span></button><button type="button" class="multiselect-option dropdown-item" title="Onions"><span class="form-check"><input class="form-check-input" type="checkbox" value="Onions" id="multiselect_jwyrv5g1r1b_0_5"><label class="form-check-label" for="multiselect_jwyrv5g1r1b_0_5">Onions</label></span></button></div></div> -->
                  <!-- <input type="text" class="form-control" aria-label="Text input with dropdown button" name="tags" id="tags" required> -->
                
                  <!-- <select class="form-select" id="tags" name="dev_env[]" multiple="multiple" size="2" style="width: 100%;" required>
                    <option value="1">react</option>
                    <option value="2">vue</option>
                    <option value="3">angular</option>
                    <option value="4">typescript</option>
                  </select> -->
                
                  <!-- <ul class="dropdown-menu dropdown-menu-end">
                    
                    <li><a class="dropdown-item" href="#">react</a></li>
                    <li><a class="dropdown-item" href="#">vue</a></li>
                    <li><a class="dropdown-item" href="#">angular</a></li>                 
                    <li><a class="dropdown-item" href="#">typescript</a></li>                 
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">HTML5</a></li>
                    <li><a class="dropdown-item" href="#">CSS3</a></li>
                    <li><a class="dropdown-item" href="#">javascript</a></li>
                    <li><a class="dropdown-item" href="#">j-query</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">android</a></li>
                    <li><a class="dropdown-item" href="#">ios</a></li>
                    <li><a class="dropdown-item" href="#">swift</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">wordpress</a></li>
                    <li><a class="dropdown-item" href="#">docker</a></li>
                    <li><a class="dropdown-item" href="#">docker</a></li>
                    <li><a class="dropdown-item" href="#">python</a></li>
                    <li><a class="dropdown-item" href="#">oracle</a></li>
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

<script type="text/javascript">
    
  //$('#example-getting-started').multiselect();
  const devEnv = () => document.querySelector('#dev_env');
  const devEnvSelectItem = () => document.querySelector('.select_item');
  devEnv.addEventListener('change', (e)=>{
    const options = e.currentTarget.options
    const index = options.selectedIndex
    p.textContent = `선택: ${options[index].textContent}`

    console.log(options);
    console.log(index);
  })

    
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');
?>

