<?php

    $subdomain = 'grishapiskarev'; //Поддомен нужного аккаунта
    $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

    /** Соберем данные для запроса */
    $data = [
        'client_id' => '0321706f-d9a1-4dea-83b5-834c5e37a670',
        'client_secret' => 'y8lPYgF1BWpa8cOc1dwNQsPosEfZIdWQ0jMaDH6yLU4dTO4X08GRBkuYJfuGNq6q',
        'grant_type'    => 'authorization_code',
        'code'          => 'def50200974ea4189c93afa2312c66d9784add2d7b867d08eb372670780c932e78578075348b59cdc48e36b4abb71eeb9084b3f8ce8583647c0c68c440baffd86117d8d240ed892e561d85b526a0a38ce46fda80e2a56ad92109c0e6914e953d506bba60e4bf4305cd32937fae14d73e333c3d81f71f6853e96666d8249d4aa796a00cdeb32223952a010e0db97366d9f7588258b3fe073fda2f01f767ed5b210855626ad23c645d7eccec39a8af3387fc5dd27f23b24e23b058077623903819172e4af1af475bd19ff441632eb2bfada7e202f4701238e0a74c19debf1f3250ac51e416cb651f8aee0d2e55d8927555c3351d1ae5b086bd1d350b652cf8f69e3bfa318a7330b283b2768871855c785485b766b352574146a88cf6f8e4b8e18ea5fa300bd73d16192eeef7b77d93841f51d7ca771deab6e89527da135f2c698650ac9e6f88e3568d0c63f157d88d8a34e9a2e5a3a9ffada3fc2fd319044c7b7bd3166e0c4ee67a119a4297fbad0bc275c575227ac17c3f4764b9ddcfe6878973af65ff3f164df3ad9d11edbcc6ec4838b92e12816df3117342d5ce50bee8e96e0f828ead79d0e21014e1ab535e540855965bb77cfda1f0ce4b8a21c918a71565569a518eeeb108c18032b9372c0e99cd295bd9530a04c700',
        //'grant_type'    => 'refresh_token',
        //'refresh_token' =>
        // 'def5020089d639971ab933d1be0ceb080aa79761a15edeb1f9ec8b92f879bcbba54d596f59a0227b85f5b6c51f4d7ac94c8ee685b43e460271ac03a2cd51a5ad6287ad0c30b195a0fcaa2fb40c23366ea67e2dd4aa3b635f8c59d6e3e87cbcebb2a7f3c9e5b24038a15a41234d18ca88d01701f15dac69e27e4e972a2b12f221c539b9dd8264b8df3f45e9194eb60946eb71677fc8127ea5562e23787f16122a6dca01f09ef1fac3c2522bc61fd94e35eeceb3473127ab3f6fc3913ab67f28fa7052e31b4fefb96e4d58c9d6485234941a11739b304534aae8a91ed3ce0a18a1fbb59fd1bb8b28c70b66af8f3774830b95634846dd79eaa0633dfcd8c16fbb25bea3c3fc2de8f1c85bf972ee6f36b6f4d8f242ea3a1e0a33e47ca8fc28faffa47846efd8877dcc5a861ecb316a4f7d2ab3614aec2649d9a02e869281d8ffeb5d7b38b32eceb044ff1fea82b997ba84fff2168aa4da4cbbf0da5201ff7db0e0e7110ce42446f1c7ac0443e89b3edcaf8268963a6f1b49397c6ee3ed2dc696e294d12f360fa5f07c4d8b5f2567cfab3c99962a3830d53fb1aca248e31e1b65199c570ad93a230ed476d6c18e4322bff6f10e310db6c7517b0fdf048245298f5f5827eb7b0174e2e49c17ba68850490d25a16b6a9a082148bd0a5b9a8a2ffe9dba394',
        'redirect_uri'  => 'http://cz95764.tw1.ru/',
    ];

    /**
     * Нам необходимо инициировать запрос к серверу.
     * Воспользуемся библиотекой cURL (поставляется в составе PHP).
     * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
     */
    $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $link);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
    $code = (int)$code;
    $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    /*   try
       {
           if ($code < 200 || $code > 204) {
               throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
           }
       }
       catch(Exception $e)
       {
           die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
       }

       /**
        * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
        * нам придётся перевести ответ в формат, понятный PHP
        */
    $response = json_decode($out, true);
   echo "<pre>";
   print_r($response);
   echo "<pre>";
    $access_token = $response['access_token']; //Access токен
    $refresh_token = $response['refresh_token']; //Refresh токен
    $token_type = $response['token_type']; //Тип токена
    $expires_in = $response['expires_in']; //Через сколько действие токена истекает