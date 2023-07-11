<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorHtmlTrait;
    private $repositorioCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $id = filter_var($params['id'], FILTER_VALIDATE_INT);

        if ($id === null || $id === false) {
            return new Response(302, ["Location" => "/listar-cursos"]);
        }
        $curso = $this->repositorioCursos->find($id);

        $html = $this->renderizaHtml("cursos/formulario.php", [
            'curso' => $curso,
            'titulo' => "Alterar Curso"
        ]);

        return new Response(200, [], $html);
    }
}