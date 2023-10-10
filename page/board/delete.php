<?php
		$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
    $db_connect->query("set session character_set_connection=utf8;");
    $db_connect->query("set session character_set_results=utf8;");
    $db_connect->query("set session character_set_client=utf8;");
	
	$bno = $_GET['idx'];
	$sql = "DELETE FROM notice_board WHERE idx='$bno';";
  $result = $db_connect->query($sql);
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=../../index.php" />