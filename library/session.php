<?php
class Session
{
    public static function setFlash($message, $type = 'success')
    {
        $_SESSION['flash'][$type] = $message;
    }
}