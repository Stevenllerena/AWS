
<?php
error_reporting(E_ALL);

/* Permitir al script esperar para conexiones. */
set_time_limit(0);

/* Activar el volcado de salida implícito, así veremos lo que estamo obteniendo
 * mientras llega. */
ob_implicit_flush();

$address = '192.168.0.15';
$port =55056;

if (($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) === false) {
    echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
}

//if (socket_listen($sock, 5) === false) {
//   echo "socket_listen() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
//}

    do {
//    if (($msgsock = socket_accept($sock)) === false) {
//        echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
//        break;
//    }
    /* Enviar instrucciones. */
 //   $msg = "Bienvenido al Servidor De Prueba de PHP. Para salir, escriba 'quit'. Para cerrar el servidor escriba 'shutdown'";
 //   socket_write($sock, $msg, strlen($msg));

    do {
        if (false === ($buf = socket_read($sock, 4096, PHP_NORMAL_READ))) {
            echo "socket_read() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
            break 2;
        }
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        $talkback = "PHP: Usted dijo '$buf'.\n";
   //     socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    } while (true);
    socket_close($sock);
} while (true);

socket_close($sock);
?>