<?php

session_start();

include_once '../atvd02/global.php';

// Exibição de Erros - PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Controller Principal - Carrega Página Principal
PessoaController::index();
