<?php
		$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
    $db_connect->query("set session character_set_connection=utf8;");
    $db_connect->query("set session character_set_results=utf8;");
    $db_connect->query("set session character_set_client=utf8;");

    $bno = $_GET['idx'];
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
    
    if($bno && $_POST['dat_user'] && $userpw && $_POST['content']){
        $sql ="INSERT INTO reply(con_num,name,pw,content,date) VALUE('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."','".$date."')";
        $result = $db_connect->query($sql);
        echo "<script>
        alert('댓글이 작성되었습니다.'); 
        location.href='../../read.php?idx=$bno';</script>";
    }else{
        echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
    }
?>