<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/home.css">
    <title>Document</title>
</head>

<body>
    <div class="start">
        <h1>MOR SOFTWARE JSC</h1>
        <div class="link">
            <a href="index.php?Controller=user&Action=dangnhap" class="button">Đăng nhập</a>
            <a href="index.php?Controller=user&Action=add" class="button">Đăng ký</a>
            
            

            <?php
                if(isset($_SESSION['id_user']))
                {
                    if($_SESSION['role']==1)
                    { ?>
                        <a href="index.php?Controller=cv&Action=apply" class="button">APPLY</a>
                        <a href="index.php?Controller=user&Action=xacnhan" class="button">Xác nhận</a>
                        <?php
                    }
                    else 
                    { ?>
                        <a href="index.php?Controller=cv&Action=list" class="button">Quản lý</a>
                        <a href="index.php?Controller=user&Action=listuserthamgiapv" class="button">UV Tham gia</a>

                        <?php
                    }
                } 
                else echo "Vui long dang nhap" ?>
        </div>
    </div>
    <div class="column">
        <div class="article">
            <h1>Reduced development costs</h1>

           
            <section>
                By having Moa's SE stationed at your company, you can ensure quality and keep costs down to about half
                of the cost in Japan.
            </section>
            <p>M O R</p>
            <section>
                <ul>
                    <li>Đặng Lê Hùng</li>
                    <li>Vũ Văn Tú</li>
                    <li>Lê Mạnh Hùng</li>

                </ul>
            </section>
            <section> <button>APPLY</button> </section>
        </div>
    </div>
    <div class="column">
        <div class="article">
            <h1>human resources</h1>
            <section>
                Many of our employees graduated from prestigious universities in Vietnam, and are highly evaluated not
                only for their technical capabilities, but also for their management and communication skills.
            </section>
            <p>M O R</p>
            <section>
                <ul>
                    <li>Đặng Lê Hùng</li>
                    <li>Vũ Văn Tú</li>
                    <li>Lê Mạnh Hùng</li>
                </ul>
            </section>
            <section> <button>APPLY</button> </section>
        </div>
    </div>
    <div class="column">
        <div class="article">
            <h1>International environment</h1>
            <section>
                Many of our bridge SEs have experience studying or working in Japan, and are able to communicate with
                Japanese customers in Japanese without discomfort.
            </section>
            <p>M O R</p>
            <section>
                <ul>
                    <li>Đặng Lê Hùng</li>
                    <li>Vũ Văn Tú</li>
                    <li>Lê Mạnh Hùng</li>
                </ul>
            </section>
            <section> <button>APPLY</button></section>
        </div>
    </div>
    </div>
</body>

</html>