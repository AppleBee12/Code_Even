<?php
$title = "강사 목록";
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');
?>



<div class="container">
  <h2 class="page_title">강사목록</h2>


  <form action="" id="search_form" class="row justify-content-end">
    <div class="col-lg-3">
      <select class="form-select" aria-label="Default select example">
        <option selected>대분류를 선택해주세요(임시)</option>
        <option value="1">웹개발</option>
        <option value="2">클라우드</option>
        <option value="3">보안</option>
      </select>
    </div>
    <div class="col-lg-3">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="분류 선택 또는 검색어를 입력해주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <button type="button" class="btn btn-secondary">
        <i class="bi bi-search"></i>
      </button>
      </div>
    </div>
   
    
  </form>

  <form action="">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">이메일</th>
          <th scope="col">분류</th>
          <th scope="col">상태</th>
          <th scope="col">강사전시옵션</th>
          <th scope="col">관리</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td>teacher01</td>
          <td>이코딩</td>
          <td>teacher1@mdo.com</td>
          <td>웹개발</td>
          <td><span class="badge text-bg-secondary">심사중</span></td>
          <td>
            <div class="form-check d-inline-block me-2">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                신규
              </label>
            </div>
            <div class="form-check d-inline-block">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                추천
              </label>
            </div>
          </td>
          <td>
            <a href="">
            <i class="bi bi-pencil-fill"></i>   
            </a>
            <a href="">
            <i class="bi bi-trash-fill"></i>
            </a>
    
          </td>
        </tr>
    </table>
    <!-- //table -->
    <button type="button" class="btn btn-outline-secondary ms-auto d-block">일괄수정</button>
  </form>



  <div class="list_pagination" aria-label="Page navigation example">
    <ul class="pagination d-flex justify-content-center">
      <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="">1</a></li>
      <li class="page-item"><a class="page-link" href="">2</a></li>
      <li class="page-item"><a class="page-link" href="">3</a></li>
      <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
    </ul>
  </div>
   <!-- //Pagination -->
</div>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>