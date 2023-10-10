<!--- 게시글 수정 -->
<?php
  $db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
  
  $db_connect->query("set session character_set_connection=utf8;");
  $db_connect->query("set session character_set_results=utf8;");
  $db_connect->query("set session character_set_client=utf8;");
    
	$bno = $_GET['idx'];
	$sql = "SELECT * FROM notice_board WHERE idx='$bno';"; //SQL 테이블 선택
  $result = $db_connect->query($sql);  //DB와 테이블을 연결한다.
	$board = mysqli_fetch_array($result); //결과값 반환!!!!  mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴

 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
</head>
<body>
    <div id="board_write">
        <h1><a href="/">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
            <div id="write_area">
                <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?php echo $board['writer']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['content']; ?></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />  
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>