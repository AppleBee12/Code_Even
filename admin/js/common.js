document.addEventListener("DOMContentLoaded", function () {

  
    const alertBox = document.querySelector(".alarm .alert");

    // 클릭 이벤트 핸들러
    // function showAlert() {
    //   if (alertBox.classList.contains("fade")) {
    //     alertBox.classList.remove("fade");
    //     alertBox.classList.add("show");
    //   }else if(alertBox.classList.contains("show")){
    //     alertBox.classList.remove("show");
    //     alertBox.classList.add("fade");
    //   }
    // }
    function showAlert() {
        alertBox.classList.toggle("fade");
        alertBox.classList.toggle("show");
    }

    const badge = document.querySelector(".alarm .badge");
    const closeButton = document.querySelector("button.close");
  
    badge.addEventListener("click", showAlert);
    closeButton.addEventListener("click", showAlert);



  const path = window.location.pathname.split("/");//왜 빈값이 생길까?
  const folderName = path.length > 1 ? path[path.length - 2] : path[0];
  const menuItems = document.querySelectorAll("li[data-link]");
  //li button -> remove collapsed , aria-expanded -> true, ul -> add show
  // console.log(path);
  // console.log(folderName);
  menuItems.forEach((menuItem) => {
      const datalink = menuItem.getAttribute("data-link");
      const collapseButton = menuItem.querySelector(".btn-toggle");
      const collapseContent = menuItem.querySelector(".btn-toggle-nav");

      if (datalink === folderName) {            
          menuItem.classList.add("active");

          if (collapseButton && collapseContent) {
              collapseButton.classList.remove("collapsed");
              collapseButton.setAttribute("aria-expanded", "true");
              collapseContent.classList.add("show");
          }
      }
  });

});