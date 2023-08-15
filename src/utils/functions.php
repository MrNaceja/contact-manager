<?php

function varlog(mixed $log) {
    if (is_array($log)) {
        echo '<pre>';
            echo var_dump($log);
        echo '</pre>';
        return;
    }
    if (is_callable($log)) {
        echo $log();
        return;
    }
    echo $log;
}