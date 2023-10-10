

<?php 
session_start(); 

$db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' ) or die('데이터베이스가 없습니다.');
$db_connect->query("set session character_set_connection=utf8;");
$db_connect->query("set session character_set_results=utf8;");
$db_connect->query("set session character_set_client=utf8;");

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		echo "<script>
    alert('아이디를 입력해주세요');
    history.back();</script>";
	}else if(empty($pass)){
    echo "<script>
    alert('비밀번호를 입력해주세요');
    history.back();</script>";
	}else{
		// hashing the password
        $pass = md5($pass);

        

		$sql = "SELECT * FROM tb_user WHERE userid='$uname' AND userpw='$pass'";
		$result = $db_connect->query($sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['userid'] === $uname && $row['userpw'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: ./index.php");
		        exit();
            }else{
				header("Location: index.php?error=계정명 또는 암호가 틀렸다");
		        exit();
			}
		}else{
			header("Location: index.php?error= 계정명 또는 암호가 틀렸다");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}