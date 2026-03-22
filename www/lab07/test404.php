<?php
http_response_code(404);
echo "<h1>404 Not Found</h1>";

register_shutdown_function(function () {
    require_once('task06/traffic_logger.php');
});
