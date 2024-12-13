<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

?>
  <style>
    /* Outline-only badge */
    .badge-outline {
      color: #C93333 !important; /* 텍스트 색 */
      background-color: transparent !important; /* 내부색 제거 */
      border: 1px solid #C93333 !important; /* 테두리 색 */
    }

    .lecture_box{
      width: 312px;
    }
  </style>
</head>
<div class="container d-flex justify-content-center gap-3">
  <!-- 강좌 리스트 아코디언 시작 -->
  <div>
    <div>
      <p>웹 개발</p>
      <ul>
        <li>프론트엔드
          <ul>
            <li>HTML / CSS</li>
            <li>Javascript</li>
            <li>jQuery</li>
            <li>React</li>
            <li>Angular</li>
            <li>Vue.js</li>
            <li>TypeScript</li>
          </ul>
        </li>
      </ul>
      <ul>
        <li>백엔드
          <ul>
            <li>Java</li>
            <li>PHP</li>
            <li>Next.js</li>
            <li>Node.js</li>
          </ul>
        </li>
      </ul>
    </div>
    <div>
      <p>클라우드 / DB</p>
      <ul>
        <li>클라우드 컴퓨팅
          <ul>
            <li>AWS</li>
            <li>Azure</li>
            <li>Google Cloud Platform</li>
            <li>DevOps</li>
            <li>Kubernetes</li>
          </ul>
        </li>
      </ul>
      <ul>
        <li>데이터베이스
          <ul>
            <li>SQL</li>
            <li>MySQL</li>
            <li>PostgreSQL</li>
            <li>Oracle</li>
            <li>NoSQL</li>
            <li>MongoDB</li>
            <li>Cassandra</li>
            <li>Couchbase</li>
          </ul>
        </li>
      </ul>
    </div>
    <div>
      <p>보안 / 네트워크</p>
      <ul>
        <li>네트워크 관리
          <ul>
            <li>TCP / IP</li>
            <li>C / C++</li>
          </ul>
        </li>
      </ul>
      <ul>
        <li>보안
          <ul>
            <li>CPPG</li>
            <li>Security</li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- 강좌 리스트 아코디언 끝 -->
  <!-- 강좌 리스트 출력 시작-->
  <div class="col-8 d-flex gap-3">
    <div class="lecture_box">
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
    <div class="lecture_box">
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
    <div class="lecture_box">
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
  <!-- 강좌 리스트 출력 끝 -->
</div>
<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');

?>
