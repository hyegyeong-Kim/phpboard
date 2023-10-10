<?php
/* db load */
$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
$db_connect->query("set session character_set_connection=utf8;");
$db_connect->query("set session character_set_results=utf8;");
$db_connect->query("set session character_set_client=utf8;");


$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../../upload/".$filename;
move_uploaded_file($tmpfile,$folder);

//각 변수에 write.php에서 input name값들을 저장한다
$username = $_POST['writer'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
date_default_timezone_set('Asia/Seoul');
$date = date('Y-m-d H:i');
if($username && $userpw && $title && $content){
    $sql = "INSERT INTO notice_board (title, content, writer, date, hit, file) values('".$title."','".$content."','".$username."','".$date."', 0,'".$o_name."')";
    $result = $db_connect->query($sql);
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='../../index.php';</script>";
    
}else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>