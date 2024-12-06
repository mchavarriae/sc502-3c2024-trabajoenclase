<?php
require 'message_log.php';
session_start();
session_unset();
session_destroy();

logDebug("Usuario cerro sesion");

// header('Location: /semana11/app-tareas/index.html');
// Get the current URL path
$currentPath = $_SERVER['REQUEST_URI']; // Full path in the URL, e.g., /semana11/app-tareas/backend/redirect.php

// Remove '/backend/' from the path
$newPath = str_replace('/backend/', '/', $currentPath);

// Construct the new URL for redirection
$newUrl = dirname($newPath) . '/index.html';

// Redirect to the new path
header('Location: ' . $newUrl);