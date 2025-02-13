$(document).ready(function () {

  //댓글 수정 클릭시 작동
  const commentModify = document.querySelectorAll(".comment-modify");
  commentModify.forEach((button) => {
    button.addEventListener("click", function (){
      const commentItem = this.closest(".comment_write");
      const commentText = commentItem.querySelector(".comment_text");
      const modifyBtn = commentItem.querySelector(".modify-btn");
      const commentEditForm = commentItem.querySelector(".comment-edit-form");

      //기존 댓글 숨기기 =  클릭시 comment_text, modify-btn display 숨기
      commentText.style.display = "none";
      modifyBtn.classList.remove("d-flex");
      modifyBtn.style.display = "none";

      //수정폼 보이기 = comment-edit-form는 display block
      commentEditForm.style.display = "block";

      //const commidInput = commentItem.querySelector("input[name='commid']");
      //console.log("수정할 댓글 ID:", commidInput.value); // 디버깅용
    })
  });





});