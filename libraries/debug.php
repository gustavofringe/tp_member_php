<?php
function dd($var){
    ?>
    <pre>
    <?php print_r($var); ?>
    </pre>
    <?php
    die();
}