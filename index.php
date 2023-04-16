<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/popup.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="js/mask.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница с кнопкой</title>
</head>
<body>
<div class="parent">
    <div class="block">
        <button class="open-popup" type="button">Кликни</button>
    </div>
</div>
<div class="popup_bg">
    <div class="popup">
        <div class="popup_img_title">
            <div>
                <span class="popup_text">Получите набор файлов для руководителя</span>
            </div>
            <div>
                <img class="popup-img" src="img/image1.jpg" alt="">
            </div>
        </div>
        <div class="popup_form">
            <form action="workingAPI.php" method="post">
                <img src="css/svg/cross-circle.svg" alt="" class="close-popup">
                <label>
                    <div class="label_text">
                        Введите Email для получения файлов
                    </div>
                    <input type="text" name="email" placeholder="name@mail.com" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                </label>
                <label>
                    <div class="label_text">
                        Введите телефон для получения доступа
                    </div>
                    <input id="phone" type="text" name="phone" placeholder="+7(000)000-00-00" required >
                </label>
                <button class="popup_button" type="submit">Отправить</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script src="js/main.js"></script>
<script>
    $("#phone").mask("+7(999) 999-99-99");
</script>