<?php

return [
    "container_name" => strtolower(env('APP_NAME', 'Doctane') . '-container'),
    "image_name" => strtolower(env('APP_NAME', 'Doctane') . '-image'),
    "port" => "8000",
];