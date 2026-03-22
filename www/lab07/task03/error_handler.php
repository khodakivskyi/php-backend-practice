<?php
ob_start();

function handleFatalError(){
    $error = error_get_last();

    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        if (ob_get_length()) {
            ob_clean();
        }

        http_response_code(500);

        echo "<h1>500 Internal Server Error</h1>";
    }
    else {
        http_response_code(200);
        ob_end_flush();
    }
}

register_shutdown_function('handleFatalError');

echo "<h1>200</h1>";

//f();