<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

?>
  <style>
    /* Outline-only badge */
    .badge-outline {
      color: #C93333 !important; /* 텍스트 색 */
      background-color: transparent !important; /* 내부색 제거 */
      border: 1px solid #C93333 !important; /* 테두리 색 */
    }

    .tc_name{
      color: var(--bk500);
    }
  </style>
</head>

<div class="container d-flex justify-content-center accordion" id="accordionExample">
  <div class="row w-100">
    <!-- 강좌 리스트 아코디언 시작 -->
    <div class="col-3">
      <p>웹 개발</p>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrontend" aria-expanded="true" aria-controls="collapseFrontend">
            프론트엔드
          </button>
        </li>
        <div id="collapseFrontend" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>HTML / CSS</li>
            <li>Javascript</li>
            <li>jQuery</li>
            <li>React</li>
            <li>Angular</li>
            <li>Vue.js</li>
            <li>TypeScript</li>
          </ul>
        </div>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBackend" aria-expanded="false" aria-controls="collapseBackend">
            백엔드
          </button>
        </li>
        <div id="collapseBackend" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>Java</li>
            <li>PHP</li>
            <li>Next.js</li>
            <li>Node.js</li>
          </ul>
        </div>
      </ul>
      <p>클라우드 / DB</p>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCloud" aria-expanded="true" aria-controls="collapseCloud">
            클라우드 컴퓨팅
          </button>
        </li>
        <div id="collapseCloud" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>AWS</li>
            <li>Azure</li>
            <li>Google Cloud Platform</li>
            <li>DevOps</li>
            <li>Kubernetes</li>
          </ul>
        </div>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDatabase" aria-expanded="false" aria-controls="collapseDatabase">
            데이터베이스
          </button>
        </li>
        <div id="collapseDatabase" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>SQL</li>
            <li>MySQL</li>
            <li>PostgreSQL</li>
            <li>Oracle</li>
            <li>NoSQL</li>
            <li>MongoDB</li>
            <li>Cassandra</li>
            <li>Couchbase</li>
          </ul>
        </div>
      </ul>
      <p>보안 / 네트워크</p>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNetwork" aria-expanded="true" aria-controls="collapseNetwork">
            네트워크 관리
          </button>
        </li>
        <div id="collapseNetwork" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>TCP / IP</li>
            <li>C / C++</li>
          </ul>
        </div>
      </ul>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecurity" aria-expanded="false" aria-controls="collapseSecurity">
            보안
          </button>
        </li>
        <div id="collapseSecurity" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>CPPG</li>
            <li>Security</li>
          </ul>
        </div>
      </ul>
    </div>
    <!-- 강좌 리스트 출력 시작-->
    <div class="col-9">
      <div class="row w-100">
        <div class="lecture_box col-4">
          <img src="" alt="" />
          <div class="d-flex justify-content-between">
            <!-- 상 시작-->
            <div>
              <span class="badge text-bg-danger badge-outline">BEST</span>
              <span class="badge text-bg-danger badge-outline">NEW</span>
              <span class="badge text-bg-danger text-bg-danger">레시피</span>
            </div>
            <div class="d-flex gap-2">
              <i class="bi bi-star-fill"></i>
              <span>5.0</span>
            </div>
          </div>
          <!-- 상 시작-->
          <!-- 중 시작 -->
          <div>
            <p>HTML 필수 이론</p>
          </div>
          <div>
            <p class="tc_name">길동쌤</p>
          </div>
          <!-- 중 끝 -->
          <!-- 하 시작 -->
          <div class="d-flex justify-content-between">
            <div>
              <b>17,600</b>원
            </div>       
            <div>
              <i class="bi bi-heart"></i>
              <i class="bi bi-heart-fill"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
          <!-- 하 끝 -->
        </div>
        <div class="lecture_box col-4">
          <img src="" alt="" />
          <div class="d-flex justify-content-between">
            <!-- 상 시작-->
            <div>
              <span class="badge text-bg-danger badge-outline">BEST</span>
              <span class="badge text-bg-danger badge-outline">NEW</span>
              <span class="badge text-bg-danger text-bg-danger">레시피</span>
            </div>
            <div class="d-flex gap-2">
              <i class="bi bi-star-fill"></i>
              <span>5.0</span>
            </div>
          </div>
          <!-- 상 시작-->
          <!-- 중 시작 -->
          <div>
            <p>HTML 필수 이론</p>
          </div>
          <div>
            <p class="tc_name">길동쌤</p>
          </div>
          <!-- 중 끝 -->
          <!-- 하 시작 -->
          <div class="d-flex justify-content-between">
            <div>
              <b>17,600</b>원
            </div>       
            <div>
              <i class="bi bi-heart"></i>
              <i class="bi bi-heart-fill"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
          <!-- 하 끝 -->
        </div>
        <div class="lecture_box col-4">
          <img src="" alt="" />
          <div class="d-flex justify-content-between">
            <!-- 상 시작-->
            <div>
              <span class="badge text-bg-danger badge-outline">BEST</span>
              <span class="badge text-bg-danger badge-outline">NEW</span>
              <span class="badge text-bg-danger text-bg-danger">레시피</span>
            </div>
            <div class="d-flex gap-2">
              <i class="bi bi-star-fill"></i>
              <span>5.0</span>
            </div>
          </div>
          <!-- 상 시작-->
          <!-- 중 시작 -->
          <div>
            <p>HTML 필수 이론</p>
          </div>
          <div>
            <p class="tc_name">길동쌤</p>
          </div>
          <!-- 중 끝 -->
          <!-- 하 시작 -->
          <div class="d-flex justify-content-between">
            <div>
              <b>17,600</b>원
            </div>       
            <div>
              <i class="bi bi-heart"></i>
              <i class="bi bi-heart-fill"></i>
              <i class="bi bi-cart-plus"></i>
            </div>
          </div>
          <!-- 하 끝 -->
        </div>
      </div>
    </div>
    <!-- 강좌 리스트 출력 끝 -->
  </div>
</div>

<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/footer.php');

?>
