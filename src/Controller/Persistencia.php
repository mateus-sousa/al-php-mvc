<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMessageTrait;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();
        //filtra um input do formulario, recebendo o tipo do input, o name do input e o tipo de filtro.
        $descricao = filter_var($post['descricao'], FILTER_SANITIZE_STRING);
        $get = $request->getQueryParams();
        $id = filter_var($get['id'], FILTER_VALIDATE_INT);

        $curso = new Curso();
        $curso->setDescricao($descricao);

        $tipoMensagem = 'success';
        if ($id !== null && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso);

            $this->geraFlashMessage($tipoMensagem, 'Curso atualizado com sucesso.');

        } else {
            $this->entityManager->persist($curso);
            $this->geraFlashMessage($tipoMensagem, 'Curso inserido com sucesso.');
        }

        $this->entityManager->flush();

        return new Response(302, ["Location" => "/listar-cursos"]);
    }
}