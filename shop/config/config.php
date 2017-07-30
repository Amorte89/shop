<?php
if (!defined("ROOT_DIR")) {
    define("ROOT_DIR", realpath(__DIR__ . "/../"));
}
if (!defined("PUBLIC_DIR")) {
    define("PUBLIC_DIR", ROOT_DIR . "/public/");
}
if (!defined("CONFIG_DIR")) {
    define("CONFIG_DIR", ROOT_DIR . "/config/");
}
if (!defined("UPLOAD_DIR")) {
    define("UPLOAD_DIR", ROOT_DIR . "/upload/");
}
if(!defined("DEFULT_IMG")) {
    define("DEFULT_IMG", PUBLIC_DIR . "./img/");
}
if(!defined("IMG")) {
    define("IMG", "./img/");
}
