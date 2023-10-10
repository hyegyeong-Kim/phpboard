<?php
$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
$db_connect->query("set session character_set_connection=utf8;");
$db_connect->query("set session character_set_results=utf8;");
$db_connect->query("set session character_set_client=utf8;");

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = "UPDATE notice_board SET writer='".$username."',title='".$title."',content='".$content."' where idx='".$bno."'"; 
$result = $db_connect->query($sql);
?>


<script type="text/javascript">alert("수정되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=../../index.php">
