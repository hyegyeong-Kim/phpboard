<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./login.css">
  <link rel="stylesheet" href="./regist.css">
  <title>Document</title>
</head>
<body>
<div id="regist_wrap" class="wrap">
        <div>
            <h1>Regist Form</h1>
            <form action="regist_ok.php" method="post" name="regiform" id="regist_form" class="form" onsubmit="return sendit()">
                <p style=position:relative;><input type="text" name="userid" id="userid" placeholder="ID"><input type="button" id="checkIdBtn" value="check" onclick="checkId()" ></input></p>
                <p id="result">&nbsp;</p>
                <p><input type="password" name="userpw" id="userpw" placeholder="Password"></p>
                <p><input type="password" name="userpw_ch" id="userpw_ch" placeholder="Password Check"></p>
                <p><input type="text" name="username" id="username" placeholder="Name"></p>
                <p><input type="text" name="userphone" id="userphone" placeholder="Phone Number 000-0000-0000"></p>
                <p><input type="text" name="useremail" id="useremail" placeholder="E-mail"></p>
                <div class="bottom_wrap" style="height:120px; display:flex; flex-direction:column; justify-content:space-between;">
                  <p style="margin-top:10px;"><input type="submit" value="Sin Up" class="signup_btn"></p>
                  <p class="pre_btn">Are you join? <a href="./login.php">Login.</a></p>
                  <p><a style="padding:5px; background:#eee; border:1px solid #000; border-radius:10px;" href="./index.php">Home</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/regist.js"></script>
</body>
</html>