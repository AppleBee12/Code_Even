[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
<div align=center>
  <a href="https://github.com/AppleBee12/Code_Even">
    <img src="admin/images/sb_logo.png" alt="Logo" width="200" height="150">
    <p><img src="admin/images/txt_logo.png" alt="Logo" width="309" height="46"></p>
  </a>
  

<h1 align=center>"Code Even" Amazing ReadMe!</h1>
<p>안녕하세요 코드이븐에 오신 여러분 환영합니다!</p>
<p>이건 여러분과 함께 만들어가고 완성할 Amazing하고 아주 Fantastic한 ReadMe입니다</p>

<a href="https://www.figma.com/design/VH49EasHjN4QLjkcdUEO9n/CODE_EVEN?node-id=0-1&t=n8MCpj3Oq7MdNSB3-1"><strong>Explore the figma »</strong></a>
</div>
### 일정 

- [x] 3차 백엔드(관리자페이지, 강사페이지) : 기획 2024.10.09(수) ~ 10.23(수) *2주
- [x] 3차 백엔드(관리자페이지, 강사페이지) : 디자인 2024.10.24(목) ~ 11.06(수) *2주
- [x] 3차 백엔드(관리자페이지, 강사페이지) : 구현 2024.11.07(목) ~ 11.25(월) *2주
- [ ] 4차 프론트엔드(메인-수강생페이지) : 기획/디자인 2024.11.26(화) ~ 12.04(수) *2주
- [ ] 4차 프론트엔드(메인-수강생페이지) : 구현 2024.12.05(목) ~ 12.18(수) *2주

### 스토리보드

![image](https://github.com/user-attachments/assets/a373f778-bb4a-407a-beaf-0a43d36c7ce8)

![image](https://github.com/user-attachments/assets/8e5ee89e-0383-4cd9-9608-4c970c6b438f)



### Built With

* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![JQuery][JQuery.com]][JQuery-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 1. VS Code(Visual Studio Code) 익스텐션 가이드
프로젝트의 효율적인 진행을 위해 VSC 익스텐션 설치하기:
* **ERD Editor**: 모든 팀원의 ERD 테이블을 확인해 볼 수 있습니다.
![image](https://github.com/user-attachments/assets/5eb6372b-341f-404f-b2ba-18536ada6fdf)

**ERD Editor 사용하기**

![image](https://github.com/user-attachments/assets/d649e463-9e97-4cde-b1b8-367ded73b735)
- key값은 alt+k를 누르면 primary-key로 열쇠모양이 생깁니다.
- 본인 파트에는 알아보기 쉽게 색상을 넣어주세요! 테이블위에 마우스 우클릭>컬러탭에서 설정
- (채림:옐로우, 유나:오렌지, 은진:그린, 은화:블루, 수진:퍼플)

1. 첫 행에 마우스를 클릭 한 뒤에 shift를 누르고 맨 마지막 행을 누르면 테이블 전체가 선택됩니다.
2. 액셀을 켜고 액셀에 복사한 테이블을 붙여넣기 합니다.
3. VScode로 돌아와서 alt+N 혹은 마우스 우클릭+new table 선택 으로 새 테이블을 만든 뒤
4. 액셀에서 다시 한번 데이터를 ctrl+c한 뒤 테이블에 붙여넣기 합니다

![image](https://github.com/user-attachments/assets/1b9316bc-8218-40e3-b2a2-23dfe32c2c3e)

5. 액셀을 거치지 않고 그냥은 붙여넣기 되지 않아요~!

![image](https://github.com/user-attachments/assets/5478f983-5dbc-4d90-abfb-01c82344516d)
 색상등록, primary-key설정이 끝난 최종 테이블 모습!!
 


* **Gitmoji**: Commit창에서 깃모지를 바로 눌러 사용할 수 있습니다.<br>
![image](https://github.com/user-attachments/assets/7ba5fd2d-048f-4bfa-9d5a-1df11f69d41e)
* **Auto Rename Tag**:자동으로 대응/매칭되는 태그명을 변경해줍니다.
* **htmlagwrap**: 내용을 감싸는 태그를 생성할 수 있습니다. (Win: 내용 선택 후 alt + w /Mac: 내용 선택 후 Option + W)
* **Live Server**: HTML 파일을 브라우저에서 실시간으로 미리 볼 수 있습니다.

* 설치 방법
VSCode 상단 메뉴에서 Extensions 아이콘 클릭
위 목록의 이름을 검색하여 설치

## 2. HTML, CSS, JavaScript 코딩 스타일 가이드
일관된 코딩 스타일을 유지하기 위해 다음 규칙을 따라주세요:

* HTML: 들여쓰기는 2칸 또는 4칸, 태그는 소문자 사용 (구분 필요시 "_"언더바 사용)
* CSS: 들여쓰기는 2칸, 색상 코드는 var에서 사용하기
* JavaScript: 들여쓰기는 2칸, 변수 선언은 const와 let 사용


예시<br>
html
> `<!-- HTML -->`<br>
> `<div>`<br>
> `  <p class="desc_hello">Hello World</p>`<br>
> `</div>`<br>

css
> `/* CSS */`<br>
> `body {`<br>
> `  background-color: var(white);`<br>
> `}`<br>

javascript
> `// JavaScript`<br>
> `const greeting = "Hello World";`<br>
> `  console.log(greeting);`


## 3. Git 관리, 깃모지 및 커밋 가이드
* Git 브랜치 전략
각 조원 이름 별 폴더 브랜치를 생성하여 작업 후 master 브랜치로 병합 합니다.(병합하기 전 SOURCE CONTROL에서 SYNC 싱크를 꼭 확인해주세요)<br>

* 깃모지(Gitmoji) 사용법
커밋 메시지에 이모지를 사용해 변경 사항을 직관적으로 표시합니다.<br>
✨ feat: 새로운 기능 추가<br>
🐛 fix: 버그 발견/수정<br>
🚑 hotfix: 긴급 버그 수정 중<br> 
📝 docs: 문서 추가 편집<br>
💄 style: 스타일만 변경(자체적인 수정은 없음, 세미콜론 누락 등에 사용)<br>
♻️ refactor: 코드 구조 변경(결과의 변경은 없음, 코드 구조만 재조정, 가독성을 높이고 유지 보수를 편리하게 하기 위해 사용)<br>
✅ test: 테스트와 관련된 모든 것<br>
🔨 chore: 자잘한 수정이나 빌드 업데이트<br>
🚚 rename: 리소스 이동/이름의 변경<br>
🔥 remove: 폴더 및 파일 삭제


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/AppleBee12/Code_Even.svg?style=for-the-badge
[contributors-url]: https://github.com/AppleBee12/Code_Even/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/AppleBee12/Code_Even.svg?style=for-the-badge
[forks-url]: https://github.comAppleBee12/Code_Even/network/members
[stars-shield]: https://img.shields.io/github/stars/AppleBee12/Code_Even.svg?style=for-the-badge
[stars-url]: https://github.com/AppleBee12/Code_Even/stargazers
[issues-shield]: https://img.shields.io/github/issues/AppleBee12/Code_Even.svg?style=for-the-badge
[issues-url]: https://github.com/AppleBee12/Code_Even/issues
[license-shield]: https://img.shields.io/github/license/AppleBee12/Code_Even.svg?style=for-the-badge
[license-url]: https://github.com/AppleBee12/Code_Even/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/AppleBee12
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 

