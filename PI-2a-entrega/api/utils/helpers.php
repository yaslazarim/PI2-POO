<?php 

function dd(mixed ...$items){
    echo '<pre>';
    foreach($items as $item){
        var_dump($item);
    }
    echo '</pre>';
    exit;
}   