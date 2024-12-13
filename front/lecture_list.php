<?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/front/inc/header.php');

?>
  <style>

  .title_wrap{
    margin-top: 90px;
    margin-bottom: 90px;
  }


    /* Outline-only badge */
    .badge-outline {
      color: #C93333 !important; /* 텍스트 색 */
      background-color: transparent !important; /* 내부색 제거 */
      border: 1px solid #C93333 !important; /* 테두리 색 */
    }

    .tc_name{
      color: var(--bk500);
    }

    .acc_title{
      background: #BCBCBC;
      height: 50px;
      font-size: 18px;
      font-weight: 700;
      color: var(--bk900);
      position: relative;

      p{
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        padding-left: 20px;
      }
    }

    .accordion{
      --bs-accordion-btn-focus-box-shadow: none;
      --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round'%3e%3cpath d='M2 5L8 11L14 5'/%3e%3c/svg%3e");
    }

    .accordion-item,
    .accordion-item:first-of-type>.accordion-header .accordion-button{
      border-top-left-radius: 0 !important;
      border-top-right-radius: 0 !important;
      border-bottom-left-radius: 0 !important;
      border-bottom-right-radius: 0 !important;
    }

    .accordion-button:not(.collapsed){
      color: #fff;
      background-color: rgba(0, 0, 0, .7);
    }
    
    .accordion-button{
      padding-left: 40px;
    }

    .accordion-body{

      padding: 0;
      
      li{
        height: 50px;
        padding-left: 60px;
        position: relative;
        cursor: pointer;
        
        p{
          position:absolute;
          top: 50%;
          transform: translateY(-50%);
        }
      }
      
      li:hover{
        color: #fff;
        background-color: rgba(0, 0, 0, .7);
      }
    }

    .bi-star-fill{
      color: #FFCE0C;
    }

    .bi-heart-fill{
      color: var(--primary);
    }

  </style>
</head>
<div class="container title_wrap">
  <p class="headt3">강좌</p>
</div>
<div class="container d-flex justify-content-center accordion" id="accordionExample">
  <div class="row w-100">
    <!-- 강좌 리스트 아코디언 시작 -->
    <div class="col-3">
      <div class="acc_title">
        <p>웹 개발</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrontend" aria-expanded="true" aria-controls="collapseFrontend">
            프론트엔드
          </button>
        </li>
        <div id="collapseFrontend" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>
              <p>HTML / CSS</p>
            </li>
            <li>
              <p>Javascript</p>
            </li>
            <li>
              <p>jQuery</p>
            </li>
            <li>
              <p>React</p>
            </li>
            <li>
              <p>Angular</p>
            </li>
            <li>
              <p>Vue.js</p>
            </li>
            <li>
              <p>TypeScript</p>
            </li>
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
            <li>
              <p>Java</p>
            </li>
            <li>
              <p>PHP</p>
            </li>
            <li>
              <p>Next.js</p>
            </li>
            <li>
              <p>Node.js</p>
            </li>
          </ul>
        </div>
      </ul>
      <div class="acc_title">
        <p>클라우드 / DB</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCloud" aria-expanded="true" aria-controls="collapseCloud">
            클라우드 컴퓨팅
          </button>
        </li>
        <div id="collapseCloud" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>
              <p>AWS</p>
            </li>
            <li>
              <p>Azure</p>
            </li>
            <li>
              <p>Google Cloud Platform</p>
            </li>
            <li>
              <p>DevOps</p>
            </li>
            <li>
              <p>Kubernetes</p>
            </li>
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
            <li>
              <p>SQL</p>
            </li>
            <li>
              <p>MySQL</p>
            </li>
            <li>
              <p>PostgreSQL</p>
            </li>
            <li>
              <p>Oracle</p>
            </li>
            <li>
              <p>NoSQL</p>
            </li>
            <li>
              <p>MongoDB</p>
            </li>
            <li>
              <p>Cassandra</p>
            </li>
            <li>
              <p>Couchbase</p>
            </li>
          </ul>
        </div>
      </ul>
      <div class="acc_title">
        <p>보안 / 네트워크</p>
      </div>
      <ul class="accordion-item">
        <li class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNetwork" aria-expanded="true" aria-controls="collapseNetwork">
            네트워크 관리
          </button>
        </li>
        <div id="collapseNetwork" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <ul class="accordion-body">
            <li>
              <p>TCP / IP</p>
            </li>
            <li>
              <p>C / C++</p>
            </li>
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
            <li>
              <p>CPPG</p>
            </li>
            <li>
              <p>Security</p>
            </li>
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
