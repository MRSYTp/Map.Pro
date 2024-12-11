
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7Map Panel</title>
    <link href="favicon.png" rel="shortcut icon" type="image/png">

    <link rel="stylesheet" href="assets/css/styles.css<?="?v=" . rand(99, 9999999)?>" />
    <link rel="stylesheet" href="assets/css/style-panel.css<?="?v=" . rand(99, 9999999)?>" />

</head>
<body>
    <div class="main-panel">
        <h1>پنل مدیریت <span style="color:#007bec">Map PRO</span></h1>
        <div class="box">
            <a class="statusToggle" href="" target="_blank">🏠</a>
            <a class="statusToggle all" href="adm.php">همه</a>
            <a class="statusToggle active" href="?verified=1">فعال</a>
            <a class="statusToggle" href="?verified=0">غیرفعال</a>
            <a class="statusToggle" href="?logout=1" style="float:left" target="_blank">خروج</a>
        </div>
        <div class="box">
        <table class="tabe-locations">
        <thead>
        <tr>
        <th style="width:40%">عنوان مکان</th>
        <th style="width:15%" class="text-center">تاریخ ثبت</th>
        <th style="width:10%" class="text-center">lat</th>
        <th style="width:10%" class="text-center">lng</th>
        <th style="width:25%">وضعیت</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>llllll</td>
            <td class="text-center">ssssss</td>
            <td class="text-center">ddddddd</td>
            <td class="text-center">fffffff</td>
            <td>
                <button class="statusToggle " data-loc=''>
                    تایید
                </button> 
                <button class="preview" data-loc=''>👁️‍🗨️</button> 
            </td>
        </tr>
    
        </tbody>
        </table>
        </div>

    </div>

    <div class="modal-overlay" style="display: none;">
        <div class="modal" style="width: 70%; height: 400px;">
            <span class="close">x</span>
            <div class="modal-content">
                <iframe id='mapWivdow' src="#" frameborder="0"></iframe>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>
</body>
</html>
