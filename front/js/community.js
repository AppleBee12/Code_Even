$(document).ready(function () {

  //댓글 수정 클릭시 작동
    document.querySelectorAll(".comment-modify").forEach((btn) => {
    btn.addEventListener("click", function (){
      const commentItem = this.closest(".comment_write");
      const commentText = commentItem.querySelector(".comment-text");
      const modifyBtn = commentItem.querySelector(".modify-btn");
      const commentEditForm = commentItem.querySelector(".comment-edit-form");

      
      //기존 댓글 숨기기 =  클릭시 comment_text, modify-btn display 숨기
      //수정폼 보이기 = comment-modify는 display block

      commentText.style.display = "none";
      modifyBtn.style.display = "none";
      commentEditForm.style.display = "block";
    })
  });

    //댓글 수정 취소 클릭시 작동
    //반대로
   









});