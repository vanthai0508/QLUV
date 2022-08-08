
<html>
<head>
<link rel="stylesheet" type="text/css" href="Css/login.css">
</head>
    <div class="login-box">
        <h2>DANG NHAP</h2>
        <form  method="post">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required>
                <label>Password</label>
            </div>
            <button name="login" >DANG NHAP</button>
                
      
        </form>
        <a href="index.php?Controller=user&Action=add">DANG KY</a><br><br>
        <a href="index.php?Controller=user&Action=quenpass">QUÊN MẬT KHẨU</a>
    </div>
</html>