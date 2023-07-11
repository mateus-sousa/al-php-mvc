<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EfetuarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $repositorioUsuarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getParsedBody();
        $email = filter_var($params['email'], FILTER_VALIDATE_EMAIL);

        if ($email === null || $email === false) {
            $this->geraFlashMessage('danger', 'E-mail digitado não é valido.');

            return new Response(302, ["Location" => " /login"]);
        }


        $senha = filter_var($params['senha'], FILTER_SANITIZE_STRING);

        $usuario = $this->repositorioUsuarios->findOneBy([
            'email' => $email
        ]);

        if ($usuario === null || !$usuario->senhaEstaCorreta($senha)) {
            $this->geraFlashMessage('danger', 'E-mail ou senha incorretos.');

            return new Response(302, ["Location" => " /login"]);
        }

        $_SESSION['logado'] = true;

        return new Response(302, ["Location" => "/listar-cursos"]);
    }
}