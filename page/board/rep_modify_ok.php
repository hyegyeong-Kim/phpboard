<?php
	$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
  $db_connect->query("set session character_set_connection=utf8;");
  $db_connect->query("set session character_set_results=utf8;");
  $db_connect->query("set session character_set_client=utf8;");


  $rno = $_POST['rno'];//댓글번호
  $sql = "SELECT * FROM reply WHERE idx='".$rno."'"; //reply테이블에서 idx가 rno변수에 저장된 값을 찾음
  $sql_result = $db_connect->query($sql);
  $reply = mysqli_fetch_array($sql_result);

  $bno = $_POST['b_no']; //게시글 번호
  $sql2 = "SELECT * FROM notice_board WHERE idx='".$bno."'";//board테이블에서 idx가 bno변수에 저장된 값을 찾음
  $sql2_result = $db_connect->query($sql2);
  $board = mysqli_fetch_array($sql2_result);


$input_pw = $_POST['pw'];
$db_pw = $reply['pw'];


  if (password_verify($input_pw, $db_pw)) {
    $sql3 ="UPDATE reply SET content='".$_POST['content']."' WHERE idx = '".$rno."'";//reply테이블의 idx가 rno변수에 저장된 값의 content를 선택해서 값 저장
    $Sql3_resutl = $db_connect->query( $sql3);
    ?>

  <script type="text/javascript">alert('수정되었습니다.'); location.replace("../../read.php?idx=<?php echo $bno; ?>");</script>
  <?php
  }else {?>
     <script type="text/javascript">alert('비밀번호가 틀립니다');
    history.back();
    </script>
  <?php } ?>