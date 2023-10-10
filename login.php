<!DOCTYPE html>
<html>

<head>
  <title>로그인</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <main id="login_wrap" class="wrap">
    <section>
      <h1>login</h1>
      <form action="login_ok.php" name="loginform" method="POST" id="login_form" class="form">
        <p>
          <input type="text" name="userid" id="user_id" placeholder="id">
        </p>
        <p>
          <input type="password" name="userpw" id="user_pw" placeholder="password">
        </p>
        <p>
          <input type="submit" value="Login">
        </p>
      </form>
    </section>


  </main>
</body>

</html>