<?php
class Noticia
{
    private ?int $id;
    private ?string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private int $usuarioId;

    public function __construct(
        string $titulo,
        string $texto,
        string $resumo,
        string $imagem,
        int $usuarioId,
        ?int $id = null,
        ?string $data = null
    ) {
        $this->setTitulo($titulo);
        $this->setTexto($texto);
        $this->setResumo($resumo);
        $this->setImagem($imagem);
        $this->setUsuarioId($usuarioId);
        $this->setId($id);
        $this->setData($data);
    }


    private function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    private function setData(?string $data): void
    {

        $this->data = $data;
    }
    public function getData(): ?string
    {
        return $this->data;
    }
    private function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    private function setTexto(string $texto): void
    {
        $this->texto = $texto;
    }
    public function getTexto(): string
    {
        return $this->texto;
    }
    private function setResumo(string $resumo): void
    {
        $this->resumo = $resumo;
    }
    public function getResumo(): string
    {
        return $this->resumo;
    }
    private function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }
    public function getImagem(): string
    {
        return $this->imagem;
    }

    private function setUsuarioId(int $usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }
    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }
}
 