<?php 
    $db_connect = mysqli_connect( '192.168.0.100', 'user_hgkim', 'user_hgkim', 'db_hgkim', '3307' );
    $db_connect->query("set session character_set_connection=utf8;");
    $db_connect->query("set session character_set_results=utf8;");
    $db_connect->query("set session character_set_client=utf8;");
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/BBS/css/style.css" />
</head>
<body>
<div id="board_area"> 
<!-- 18.10.11 검색 추가 -->
<?php
 
  /* 검색 변수 */
  $catagory = $_GET['catgo'];
  $search_con = $_GET['search'];
?>
    <?php if($catagory=='title'){
        $catname = '제목';
    } else if($catagory=='writer'){
        $catname = '작성자';
    } else if($catagory=='content'){
        $catname = '내용';
    } ?>
  <h1><?php echo $catname; ?>:<?php echo $search_con; ?> 검색결과</h1>
  <h4 style="margin-top:30px;"><a href="../../index.php">홈으로</a></h4>
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
          $sql2 ="SELECT * FROM notice_board WHERE $catagory LIKE '%$search_con%' order by idx desc";
          $sql2_result = $db_connect -> query($sql2);
          while($board = mysqli_fetch_array($sql2_result)){
           
          $title=$board["title"]; 
            if(strlen($title)>30)
              { 
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }
            $sql3 = "SELECT * FROM reply WHERE con_num='".$board['idx']."'";
            $sql3_result = $db_connect -> query($sql3);
            $rep_count = mysqli_num_rows($sql3_result);
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $board['idx']; ?></td>
          <td width="500">
        <!--- 추가부분 18.08.01 --->
        <!--- 추가부분 18.08.01 END -->
            <a href='../../read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $board["title"]; ?><span class="re_ct">[<?php echo $rep_count; ?>]</span></a>
          </td>
          <td width="120"><?php echo $board['writer']?></td>
          <td width="100"><?php echo $board['date']?></td>
          <td width="100"><?php echo $board['hit']; ?></td>

        </tr>
      </tbody>

      <?php } ?>
    </table>
    <!-- 18.10.11 검색 추가 -->
    <div id="search_box2">
      <form action="./search_result.php" method="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>