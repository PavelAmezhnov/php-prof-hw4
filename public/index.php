<?php

use BracketCounter\BracketCounter;

require_once '../vendor/autoload.php';

if (!isset($_POST['string'])) {
    http_response_code(400);
    exit('Необходимо указать строку для проверки');
}
$string = htmlspecialchars($_POST['string']);

try {
    if (BracketCounter::check($string)) {
        $httpCode = 200;
        $message = "Строка корректная";
    } else {
        $httpCode = 400;
        $message = "Строка некорректная";
    }
} catch (InvalidArgumentException $e) {
    $httpCode = 400;
    $message = 'В строке недопустимые символы';
} catch (Throwable $e) {
    $httpCode = 500;
    $message = 'Ошибка сервера';
}

http_response_code($httpCode);
echo $message;
