
<html>
<head>
<link rel="stylesheet" type="text/css" href="Css/login.css">
</head>
    <div class="login-box">
        <h2>DANG KY</h2>
        <form  method="post">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number." required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address">
                <label>Email</label>
            </div>
            <button name="register" >DANG KY</button>
                
      
        </form>
        <a href="index.php?Controller=user&Action=dangnhap">DANG NHAP</a>
    </div>
</html>