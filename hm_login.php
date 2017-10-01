<?php

/*--- 로그인 폼 파일 ---*/

?>
<!DOCTYPE html>
<html>
<head>
<body>
    <form method="post" action="hm_login2.php">
        <h1>LOGIN</h1>
        <input type="text" name="loginId" value="id">
        <input type = "password" name = "loginPw" value="pw">
        <input type="submit" value="LOGIN">
        <input type="hidden" name="login" value="log">
    </form>
</body>
</head>
</html>
