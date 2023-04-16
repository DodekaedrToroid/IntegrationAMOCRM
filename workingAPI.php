<?php

 if (isset($_POST['email']) && !empty($_POST['email'])) {
     $name_contact = 'Лысов Ю.А.';
     $contacts['add'] = [ //массив для создания контакта
         'name' => $name_contact,
         'custom_fields_values' => [
             [
                 'field_name' => 'Телефон',
                 'field_code' => 'PHONE',
                 'field_type' => 'multitext',
                 'values'     => [
                     [
                         'value'     => $_POST['phone'],
                         'enum_code' => 'WORK'
                     ]
                 ]
             ],
             [
                 'field_name' => 'Емейл',
                 'field_code' => 'EMAIL',
                 'field_type' => 'multitext',
                 'values'     => [
                     [
                         'value'     => $_POST['email'],
                         'enum_code' => 'WORK'
                     ]
                 ]
             ]
         ]
     ];




     $subdomain = 'grishapiskarev'; //Поддомен нужного аккаунта
     $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/contacts'; //Формируем URL для запроса

     /** Получаем access_token из вашего хранилища */
     $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhjMGMzZTk5MjBjNTIxOTY4ZTk3MjdlZmZlODdlODNiZmE4MDU0YjY5YzNmZDAzZTdmOWI3YWU1MGE1M2IwOWJmZmI4MjdiZDU4NzQ2MGI1In0.eyJhdWQiOiIwMzIxNzA2Zi1kOWExLTRkZWEtODNiNS04MzRjNWUzN2E2NzAiLCJqdGkiOiI4YzBjM2U5OTIwYzUyMTk2OGU5NzI3ZWZmZTg3ZTgzYmZhODA1NGI2OWMzZmQwM2U3ZjliN2FlNTBhNTNiMDliZmZiODI3YmQ1ODc0NjBiNSIsImlhdCI6MTY4MTY2OTMwMSwibmJmIjoxNjgxNjY5MzAxLCJleHAiOjE2ODE3NTU3MDEsInN1YiI6Ijk1MDI2NzgiLCJhY2NvdW50X2lkIjozMTAwNDc1OCwiYmFzZV9kb21haW4iOiJhbW9jcm0ucnUiLCJzY29wZXMiOlsicHVzaF9ub3RpZmljYXRpb25zIiwiZmlsZXMiLCJjcm0iLCJmaWxlc19kZWxldGUiLCJub3RpZmljYXRpb25zIl19.gIG3zZ8h6IXvrH_cPf_EHVrYKnjKr5-MKIXBk3X0J6PAlzNL7A_GO9DyYPiUtFGVLt5WDKjcLb9i1bAyBJHqEpVxylQLu1_52tJYf9amn3on_f1GxECpBXAzVic-rEAqmNirlMzap1yzDThC4vaSQ024edCGcBN5SF4nsqsV5dgckT54xbvn0rlyaDm5ups5iaioSggTl2ljt3vpRRB_2-0Ex9J1D5Uer2dQT3b3DRRUSY_m_niEL81NcdO23LyHUlu0I89kmmOlIpmnyEs4B8waHz4l3Wk9zX24g0gWdpYrhcake70te7ATTtwh0D2paj--AmWnVwvNx2V5_cIVtQ';
     /** Формируем заголовки */
     $headers = [
         'Authorization: Bearer ' . $access_token
     ];

     $curl = curl_init();
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
     curl_setopt($curl, CURLOPT_URL, $link);
     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); //авторизация
     curl_setopt($curl, CURLOPT_HEADER, false);
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($contacts));
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


     $curl = curl_init();
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
     curl_setopt($curl, CURLOPT_URL, $link);
     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); //авторизация
     curl_setopt($curl, CURLOPT_HEADER, false);
     $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
     $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
     curl_close($curl);
     /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
     $code = (int)$code;

     $Response = json_decode($out, true);


     foreach ($Response['_embedded']['contacts'] as $key => $item) {
         if ($item['name'] == $name_contact) {
             $contact_id = $item['id'];
         }
     }


     $leads['add'] = [
         [
             'name'        => 'Заявка с сайта',
             'contacts_id' => $contact_id
         ]
     ];

     $link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';

     $curl = curl_init(); //Сохраняем дескрипторъ cеанса cURL
     /** Устанавливаем необходимые опции для сеанса cURL  */
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-oAuth-client/1.0');
     curl_setopt($curl, CURLOPT_URL, $link);
     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); //авторизация
     curl_setopt($curl, CURLOPT_HEADER, false);
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($leads));
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
     $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
     $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
     curl_close($curl);
     /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
     $code = (int)$code;

     echo "Заявка отправлена успешно!";
 }