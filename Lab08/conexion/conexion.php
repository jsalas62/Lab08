<?php
function conectar(){
    $conn = mysqli_connect('localhost', 'root', 'usbw', 'eval02');
    return $conn;
}

function desconectar($conn){
    mysqli_close($conn);
}