//댓글 삭제시 deleteComment()로 넘어온 데이터 서버에 AJAX방식으로 비동기 요청

function deleteComment(commid, uid, board_type, post_id) {
  console.log('삭제할 댓글 commid:', commid, 'uid:', uid, 'board_type:', board_type, 'post_id:', post_id);

  if (confirm('정말로 댓글을 삭제하시겠습니까?')) {
    $.ajax({
      url: 'submit_comment_delete.php',
      type: 'POST',
      data: {
        commid: commid,
        uid: uid,
        board_type: board_type,
        post_id: post_id
      },
      success: function(response) {
        alert('댓글이 삭제되었습니다.');
        location.reload(); // 댓글 삭제 후 페이지 새로고침
      },
      error: function(xhr, status, error) {
        alert('댓글 삭제에 실패했습니다. 다시 시도해 주세요.');
      }
    });
  }
}