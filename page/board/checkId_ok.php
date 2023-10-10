<?php
        $db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' ) or die('데이터베이스가 없습니다.');
    
        $db_connect->query("set session character_set_connection=utf8;");
        $db_connect->query("set session character_set_results=utf8;");
        $db_connect->query("set session character_set_client=utf8;");

    // $db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' ) or die('데이터베이스가 없습니다.');
    // $db_connect->query("set session character_set_connection=utf8;");
    // $db_connect->query("set session character_set_results=utf8;");
    // $db_connect->query("set session character_set_client=utf8;");
    
    $userid = $_GET['userid'];
    $sql = "SELECT useridx FROM tb_user WHERE userid='$userid'";
    $result = $db_connect->query($sql);
    $data = mysqli_fetch_array($result);


    echo isset($data['useridx']) ? "X" : "O";

?>