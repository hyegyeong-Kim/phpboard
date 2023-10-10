<?php

    $db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    
    $db_connect->query("set session character_set_connection=utf8;");
    $db_connect->query("set session character_set_results=utf8;");
    $db_connect->query("set session character_set_client=utf8;");

    if ( $db_connect == false ) {
        echo "<p>Failure - " . mysqli_connect_error() . "</p>";
    } else {
        echo "<p>Success</p>";
    }

   
    // $sql = "SELECT * FROM notice_board";
    // $sql_result = $db_connect->query($sql);
  // mysql 테이블 생성  
  //   $mdk = "CREATE TABLE  tb_user(
  //     useridx int primary key auto_increment,
  //     userid varchar(300) unique not null,
  //     userpw varchar(300) not null,
  //     username varchar(300) not null,
  //     userphone varchar(300) not null,
  //     useremail varchar(300),
  //     regdate datetime default CURRENT_TIMESTAMP
  //     -- Add more columns as needed
  // ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
  //   $mdk_result = $db_connect->query($mdk);

  //select
  // $sql = "SELECT * FROM notice_board";
  // $sql_result = $db_connect->query($sql);

  //데이터 넣기 (insert)
  // $insert = "INSERT INTO notice_board (title, writer, date, hit)
  // VALUES ('dfdfdf123', '희진', '23-08-12', 6),
  //       ('12345678', '동동', '23-08-12', 8),
  //       ('124556', '채인', '23-08-13', 3),
  //       ('124567', 'fass1', '23-08-13', 3),
  //       ('124589', 'fass2', '23-08-13', 3),
  //       ('124510', 'fass3', '23-08-13', 3),
  //       ('124511', 'fass4', '23-08-13', 3),
        // ('124512', 'fass5', '23-08-13', 3)";
  // $insert_result1 = $db_connect->query($insert) 

  //컬럼 추가하기
  // $add = "ALTER TABLE notice_board ADD file varchar(100) NOT NULL AFTER hit";
  // $add_result = $db_connect->query($add);

    //ifnull 변환 후 데이터에 update
    // $null = "UPDATE notice_board SET content = IFNULL(content, 'null 입니다.')";
    // $null_result = $db_connect->query($null);



?>


<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" href="./main.css">
<link rel="stylesheet" href="./write.css">
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script> 
<script src="./js/common.js"></script>
</head>
<body>
<div id="board_area"> 
  <nav style="text-align:right;">
    <a href="./login.php"><button>로그인</button></a>
    <a href="./regist.php"><button>회원가입</button></a>
  </nav>
  <h1>자유게시판,</h1>
  <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <div id="search_box">
      <form action="../page/board/search_result.php" method="get">
        <select name="catgo">
          <option value="title">제목</option>
          <option value="writer">글쓴이</option>
          <option value="content">내용</option>
        </select>
        <input type="text" name="search" size="40" required="required" /> <button>검색</button>
      </form>
    </div>

    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
         if(isset($_GET['page'])){
          $page = $_GET['page'];
            }else{
              $page = 1;
            }
              $sql = "SELECT * FROM notice_board";
              $sql_result = $db_connect->query($sql);
              $row_num = mysqli_num_rows($sql_result); //게시판 총 레코드 수
              echo $row_num;
              $list = 10; //한 페이지에 보여줄 개수
              $block_ct = 5; //블록당 보여줄 페이지 개수
              $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
              $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
              $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

              $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
              if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
              $total_block = ceil($total_page/$block_ct); //블럭 총 개수
              $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

              $sql2 = "SELECT * FROM notice_board order by idx desc limit $start_num, $list";  
              $sql2_result = $db_connect->query($sql2);
              while($board = mysqli_fetch_array($sql2_result)){
              $title=$board["title"]; 

              /* 댓글수 넣기 */
              $con_idx = $board["idx"];
              $reply_count = "SELECT COUNT(*) as cnt FROM reply where con_num=$con_idx";
              $reply_count_result = $db_connect -> query($reply_count);
              $con_reply_count = mysqli_fetch_array($reply_count_result);
                if(strlen($title)>30)
                { 
                  $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                }
              ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500">
          <?php  
            date_default_timezone_set('Asia/Seoul');
            
            $timenow = date("Y-m-d H:i"); //지금시간
            $boardtime = $board['date'];//작성한 시간
            if($timenow == $boardtime ){//작성한 시간으로부터 한시간이 넘으면
              $img = "<img src='./img/new.png' alt='new' title='new'  />";
            }else{ //지난이후에는 img 삭제
              $img="";
            }
          ?>
          <a href="./read.php?idx=<?php echo $board["idx"];?>"><?php echo $board['title']."[".$con_reply_count["cnt"]."]".$img;?></a></td>
          
          <td width="120"><?php echo $board['writer']; ?></td>
          <td width="100"><?php echo $board['date']; ?></td>
          <td width="100"><?php echo $board['hit']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <div id="page_num">
      <ul>
        <?php
        if($page<=1){
          echo "<li class='fo_re'>처음</li>";
        }else{
          echo "<li><a href='?page=1'>처음</a></li>";
        }
        if($page<=1){

        }else{
          $pre = $page-1;
          echo "<li><a href='?page=$pre'>이전</a></li>";
        }
        for($i=$block_start; $i<=$block_end; $i++){
          if($page == $i){
            echo "<li class='fo_re'>[$i]</li>";
          }else{
            echo "<li><a href='?page=$i'>[$i]</a></li>";
          }
        }
        if($block_num>=$total_block){
        }else{
          $next = $page + 1;
          echo "<li><a href='?page=$next'>다음</a></li>";
        }
        if($page>=$total_page){
          echo "<li class='fo_re'>마지막</li>";
        }else{
          echo "<li><a href='?page=$total_page'>마지막</a></li>";
        }
      ?>  
      </ul>
      

    </div>
 


    <div id="write_btn">
      <a href="/page/board/write.php"><button>글쓰기</button></a>
    </div>
  </div>
</body>
</html>