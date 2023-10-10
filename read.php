<?php
	$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
  $db_connect->query("set session character_set_connection=utf8;");
  $db_connect->query("set session character_set_results=utf8;");
  $db_connect->query("set session character_set_client=utf8;");
?>

<!doctype html>
<head>
<meta charset="UTF-8">
<script defer src="./js/read.js"></script>

<title>게시판</title>
</head>
<body>
	<?php
		$bno = $_GET['idx'];
    $sql_1 = "SELECT * FROM notice_board WHERE idx ='".$bno."'"; /* bno함수에 idx값을 받아와 넣음*/
    $sql_1_result = $db_connect->query($sql_1); /* sql_1 값을 db에 연결해서 쿼리에 넣음*/
		$sql_2 = "SELECT * FROM notice_board WHERE idx='".$bno."'"; /* 받아온 idx값을 선택 */
		$sql_2_result = $db_connect->query($sql_2);
    $board = mysqli_fetch_array($sql_2_result);
    $hit = mysqli_fetch_array($sql_1_result); /* $sql_1_result의 데이터를 php의 array 형태로 가져와 변수 hit에 담는다 */
		$hit = $hit['hit'] + 1;
    $fet = "UPDATE notice_board SET hit = '".$hit."' WHERE idx = '".$bno."'";
    $fet_result = $db_connect->query($fet);
	?>
<!-- 글 불러오기 -->
<div id="board_read">
	<h2><?php echo $board['title']; ?></h2>
		<div id="user_info">
			<?php echo $board['writer']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
				<div id="bo_line"></div>
			</div>
			<div>
				파일 : <a href="upload/<?php echo $board['file'];?>" download><?php echo $board['file']; ?></a>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<li><a href="/">[목록으로]</a></li>
			<li><a href="../page/board/modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			<li><a href="../page/board/delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		</ul>
	</div>
</div>
<!--- 댓글 불러오기 -->
<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
			$reply_sql = "SELECT * FROM reply WHERE con_num='".$bno."' order by idx desc";
			$reply_result = $db_connect->query($reply_sql);
			while($reply = mysqli_fetch_array($reply_result)){ 
		?>
		<div class="dap_lo">
			<div><b><?php echo $reply['name'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
				<a class="dat_edit_bt" href="#">수정</a>
				<a class="dat_delete_bt" href="#">삭제</a>
			</div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit" style="margin-top:20px; border:1px solid red; visibility:hidden;">
				<form method="post" action="./page/board/rep_modify_ok.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
					<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete' style="visibility:hidden;">
				<form action="./page/board/reply_delete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			 		<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<div class="dap_ins" style="margin-top:20px; border:1px solid green;">
		<form action="./page/board/reply_ok.php?idx=<?php echo $bno; ?>" method="post">
			<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
			<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
		</form>
	</div>
</div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
</body>
</html>