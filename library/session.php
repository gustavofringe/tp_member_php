<?php
function setFlash($message, $type = 'success'){
    $_SESSION['flash'][$type] = $message;
}