$(document).ready(function () {

  //댓글 수정 클릭시 작동
  const commentModify = document.querySelectorAll(".comment-modify");
  commentModify.forEach((button) => {
    button.addEventListener("click", function (){
      const commentItem = this.closest(".comment_write");
      const commentText = commentItem.querySelector(".comment_text");
      const modifyBtn = commentItem.querySelector(".modify-btn");
      const commentEditForm = commentItem.querySelector(".comment-edit-form");

      //기존 댓글 숨기기
      commentText.classList.add("d-none");
      modifyBtn.classList.add("d-none");

      //수정폼 보이기
      commentEditForm.style.display = "block";

      //const commidInput = commentItem.querySelector("input[name='commid']");
      //console.log("수정할 댓글 ID:", commidInput.value); // 디버깅용
    })
  });

    //댓글 수정 취소시
    const cancelEdit = document.querySelectorAll(".cancel-edit");
    cancelEdit.forEach((button) => {
      button.addEventListener("click", function (e){
        const commentItem = this.closest(".comment_write");
        const commentText = commentItem.querySelector(".comment_text");
        const modifyBtn = commentItem.querySelector(".modify-btn");
        const commentEditForm = commentItem.querySelector(".comment-edit-form");
  
        e.preventDefault;

        //기존 댓글 보이기
        commentText.classList.remove("d-none");
        modifyBtn.classList.remove("d-none");
  
        //수정폼 보이기
        commentEditForm.style.display = "none";

      })
    });
  





});