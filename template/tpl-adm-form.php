<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Pro Login</title>
    <link href="assets/favicon.png" rel="shortcut icon" type="image/png">

    <link rel="stylesheet" href="assets/css/styles.css<?="?v=" . rand(99, 9999999)?>" />
    <style>
    body{
        background:#f2f2f2;
    }
    a{
        text-decoration: none;
    }
    h1{
        text-align: center;
    }
    .main-panel{
        width:1000px;
        margin:30px auto;
    }
    .box {
        background: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0px 3px 3px #EEE;
        margin-bottom: 20px;
    }
    form {
        width: 350px;
        margin: 20px auto;
    }
    input {
        border-radius: 5px;
        border: 1px solid #b9daf8;
        font-size: 20px;
        width: 100%;
        text-align: left;
        padding: 5px 20px;
        box-sizing: border-box;
        margin: 5px;
    }
    </style>
</head>
<body>
    <div class="main-panel">
    <h1>ورود به پنل مدیریت <span style="color:#007bec">Map PRO</span></h1>
        <div class="box">
            <form action="<?= site_url("adm.php") ?>" method="post">
                <input type="text" name="username" placeholder="Username" autocomplete="off"><br>
                <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
                <input type="submit" value="Login" style="text-align: center">
            </form>
        </div>
    </div>

</body>
</html>
