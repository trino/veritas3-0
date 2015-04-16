<?php
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }
    //$language = translate($this->requestAction('documents/translate'),$this->requestAction('documents/isdebugging'));
    echo " " . gettext("langswitched") . " (" . $language . ")";
?>