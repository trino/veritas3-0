<?php
    if (isset($profiles) && $profiles >0) {
        echo $msg . "<br/>";
    } else {
        echo "No re-qualifications found for this day (" . date('Y-m-d') . ")";
    }
   
?>