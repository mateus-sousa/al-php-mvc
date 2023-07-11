<?php

namespace Alura\Cursos\Entity;
// JsonSerializable é uma interface nativa do PHP para mandar propriedades privadas por JSON
/**
 * @Entity
 * @Table(name="cursos")
 */
class Curso implements  \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */

    //precisa ser retornado qualquer coisa compativel com um objeto Javascript
    public function jsonSerialize()
    {
        return [
          'id' => $this->id,
          'descricao' => $this->descricao
        ];
    }
}
