<?php

return [
    
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^add~' => [\MyProject\Controllers\MainController::class, 'add'],
    '~^freereport/(.*)$~' => [\MyProject\Controllers\MainController::class, 'freereport'],
    '~tripreport~' => [\MyProject\Controllers\TripController::class, 'tripreport'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
];