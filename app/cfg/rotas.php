<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/drive' => [
        'GET' => '\Controlador\DriveControlador#index',
        'POST' => '\Controlador\DriveControlador#armazenar',
    ],
    '/drive/?' => [
        'DELETE' => '\Controlador\DriveControlador#destruir',
    ],
    '/drive/?/comentarios' => [
        'GET' => '\Controlador\ComentarioControlador#mostrar',
        'POST' => 'Controlador\ComentarioControlador#armazenar',
        'DELETE' => 'Controlador\ComentarioControlador#destruir',
        'PATCH' => 'Controlador\ComentarioControlador#atualizar'
    ],
    '/drive/?/editar' => [
        'GET' => 'Controlador\ComentarioControlador#editar',
    ],
];
