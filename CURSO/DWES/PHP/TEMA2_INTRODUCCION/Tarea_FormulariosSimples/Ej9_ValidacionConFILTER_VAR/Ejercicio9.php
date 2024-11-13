<?php
    if(filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
        echo nl2br("Email validado.\n");
    } else {
        echo nl2br("Email no validado.\n");
    }

    if(filter_var($_REQUEST["url"], FILTER_VALIDATE_URL)) {
        echo nl2br("URL validada.\n");
    } else {
        echo nl2br("URL no validada.\n");
    }
?>