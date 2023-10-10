<?php
/* db load */
$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
$db_connect->query("set session character_set_connection=utf8;");
$db_connect->query("set session character_set_results=utf8;");
$db_connect->query("set session character_set_client=utf8;");


//각 변수에 write.php에서 input name값들을 저장한다
$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$userpw_ch = $_POST['userpw_ch'];
$username = $_POST['username'];
$userphone = $_POST['userphone'];
$useremail = $_POST['useremail'];
date_default_timezone_set('Asia/Seoul');
$regdate = date('Y-m-d H:i');
if($userpw != $userpw_ch){
  echo "<script>
  alert('비밀번호가 일치하지 않습니다.');
  history.back();</script>";
}else if($userid && $userpw && $userpw_ch && $username && $userphone && $useremail && $regdate){
    $sql = "INSERT INTO tb_user (userid, userpw, userpw_ch, username, userphone, useremail, regdate ) values('".$userid."','".$userpw."','".$userpw_ch."', '".$username."','".$userphone."','".$useremail."','".$regdate."')";
    $result = $db_connect->query($sql);
    echo "<script>
    alert('회원가입이 완료되었습니다..');
    location.href='../../index.php';</script>";
    
}else{
    echo "<script>
    alert('회원가입 실패.');
    history.back();</script>";
}

?>