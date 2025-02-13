$(document).ready(function () {
  document.querySelectorAll(".comment-modify").forEach((btn) => {
    btn.addEventListener("click", function (){
      const commentItem = this.closest(".comment_write");
      const commentText = commentItem.querySelector(".comment-text");
      const modifyBtn = commentItem.querySelector(".modify-btn");
      const commentModify = commentItem.querySelector(".comment-modify");

      
      //기존 댓글 숨기기 =  클릭시 comment_text, modify-btn display 숨기
      //수정폼 보이기 = comment-modify는 display block
    })
  })










});