<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files (css, js, images) directly
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf)$/', $uri)) {
    return false;
}

// Route PHP requests
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/home.php';
} elseif (file_exists(__DIR__ . $uri)) {
    require __DIR__ . $uri;
} else {
    http_response_code(404);
    echo "404 Not Found";
}
