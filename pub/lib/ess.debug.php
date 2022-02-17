<?php
function testData( $data ){
    echo '<pre>'; print_r($data); echo '</pre>';
}
function testDataHere( $data ){
    testData( $data );
    die();
}