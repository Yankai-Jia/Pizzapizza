<?php
/**
 * 登录页面
 */

// 载入配置文件
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (empty($_POST['email']) || empty($_POST['password'])) {

    $message = 'please refill form';
  } else {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$connection) {

      die('<h1>Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error() . '</h1>');
    }


    $result = mysqli_query($connection, sprintf("select * from user where email = '%s' limit 1", $email));

    if ($result) {

      if ($user = mysqli_fetch_assoc($result)) {

        if ($user['pwd'] == $password) {

          session_start();

          $_SESSION['is_logged_in'] = true;
          $_SESSION['current_login_user'] = $user;

          header('Location: index.php');
          exit;
        }
      }
      $message = 'invalid password or name';

      mysqli_free_result($result);
    } else {

      $message = 'invalid password or name';
    }

    mysqli_close($connection);
  }
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="assets/bootstrap.css">
  <link rel="stylesheet" href="assets/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action="login.php" method="post">
      <img class="avatar" src="assets/img/default.png">
      <?php if (isset($message)) : ?>
      <div class="alert alert-danger">
        <strong>wrong！</strong><?php echo $message; ?>
      </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="email" class="sr-only">email</label>
        <input id="email" name="email" type="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="email" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">password</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="password">
      </div>
      <button class="btn btn-primary btn-block" type="submit">log in</button>
    </form>
  </div>
<div style="border-radius: "></div>

  <script src="assets/jquery.js"></script>
  <script>
        $(function () {
            $('#email').on('blur',function () {
                var format=/[0-9a-zA-Z.-_]+[@][0-9a-zA-Z.-_]+([.][a-zA-Z.]+){1,2}/;
                var text=$(this).val();
                console.log(text);
                if (!text || ! format.test(text)) return;
                  $.get('api/user_img.php', {email : text} , function (res) {
                      if (!res) return;
                      $('.avatar').fadeOut(function () {
                          $(this).on('load',function () {
                              $(this).fadeIn();
                          }).attr('src',res);
                      });
                  });
            });

        })
  </script>
</body>
</html>
