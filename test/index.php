<?php
declare(strict_types=1);

const path = __DIR__;

include_once __DIR__ . '/../src/vue/interface/InterfaceVueTemplate.php';

include_once __DIR__ . '/../src/vue/exception/VueTemplateNotFoundException.php';

include_once __DIR__ . '/../src/vue/parse/VueTemplate.php';

use wheakerd\vue\parse\VueTemplate;

$bew = new VueTemplate([
    'view_path' => __DIR__,
    'file_path' => 'login.vue',
]);


try {
    $bew->unpack('login.vue')->handle()->fetch();
} catch (Exception $e) {
    echo $e->getMessage();
}