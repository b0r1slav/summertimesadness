<?php
$modules = get_all_module_information();
foreach ($modules as $module) {
    if (file_exists('../modules/' . $module['name'] . '/routes/breadcrumbs.php')) {
        require_once '../modules/' . $module['name'] . '/routes/breadcrumbs.php';
    }
}