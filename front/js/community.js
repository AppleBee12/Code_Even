$(document).ready(function () {

  //댓글 수정 클릭시 작동
  const commentModify = document.querySelectorAll(".comment-modify");
  commentModify.forEach((button) => {
    button.addEventListener("click", function (){
      const commentItem = document.querySelector(".comment_write");
      const commentText = commentItem.querySelector(".comment_dtext");
      const modifyBtn = commentItem.querySelector(".modify-btn");
      const commentEditForm = commentItem.querySelector(".comment-edit-form");

      //기존 댓글 숨기기 =  클릭시 comment_text, modify-btn display 숨기
      commentText.style.display = "none";
      modifyBtn.style.display = "none";

      //수정폼 보이기 = comment-modify는 display block
      commentEditForm.style.display = "block";
    })
  });





});