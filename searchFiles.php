<?php

// Задаем маску для подходящих файлов
$pattern = '/^([a-zA-Z0-9]*)\.ixt$/i';

$folder = __DIR__ . '/datafiles';
$list = scandir($folder);
$foundFiles = [];
foreach ($list as $item) {
    preg_match($pattern, $item, $matches);
    /* в случае успешного нахождения количество элементов в массиве matches будет == 2.
    Сама строка и название без расширения */
    if (count($matches) == 2) {
        $foundFiles[$matches[1]] = $matches[0];
    }
}

if (!$foundFiles) {
    echo 'Heт файлов, соответсвующих необходимой маске.';
} else {
    ksort($foundFiles);
    echo "Найдены  файлы:" . PHP_EOL;
    echo join(', ' . PHP_EOL, $foundFiles);
}

