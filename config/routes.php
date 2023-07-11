<?php

use Alura\Cursos\Controller\{CursosJson,
    CursosXml,
    EfetuarLogin,
    EfetuarLogout,
    Exclusao,
    FormularioEdicao,
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Persistencia};

// No php podemos dar um return em um arquivo, e ele ser chamado como se fosse uma funçao.
return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/efetuar-login' => EfetuarLogin::class,
    '/logout' => EfetuarLogout::class,
    '/buscarCursosEmJson' => CursosJson::class,
    '/buscarCursosEmXml' => CursosXml::class
];