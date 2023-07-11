<?php

namespace Alura\Cursos\Helper;

trait RenderizadorHtmlTrait
{
    public function renderizaHtml(string $caminho, $dados)
    {
        extract($dados);
        ob_start();
        require __DIR__ . "/../../view/" . $caminho;
        $html = ob_get_clean();
        return $html;
    }
}