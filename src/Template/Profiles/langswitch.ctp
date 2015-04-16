<?php
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }
    $language = $this->requestAction('documents/translate');
    echo Translate("langswitched", $language);
?>