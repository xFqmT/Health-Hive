<?php

// Vercel serverless function for Laravel
$_SERVER['SCRIPT_NAME'] = '/api/index.php';

// Set the public path for Laravel
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Forward to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
