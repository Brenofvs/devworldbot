<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @author Brenofvs <brenofvs.consultoria@gmail.com>
 * @package Source\Models
 */
class Categoria extends Model
{
    /** @var array $safe no update or create */
    protected static $safe = ["categoria_id"];

    /** @var string $entity database table */
    protected static $entity = "categorias";

    /** @var array $required table fileds */
    protected static $required = ["categoria"];

    /**
     * @param string $title
     * @param string $body
     * @param string $image
     * @return Categoria
     */
    public function bootstrap(
        string $categoria,
    ): Categoria {
        $this->categoria = $categoria;
        return $this;
    }

    /**
     * @param string $query
     * @param string $params
     * @param string $columns
     * @return array|null
     */
    public function queryBuild(string $query = "", string $params = "", string $columns = "*"): ?array
    {
        $qb = $this->read("SELECT {$columns} FROM " . self::$entity . " {$query}", $params);
        if ($this->fail() || !$qb->rowCount()) {
            return null;
        }
        return $qb->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @param string $query
     * @param string $params
     * @param string $columns
     * @return null|Categoria
     */
    public function find(string $query, string $params, string $columns = "*"): ?Categoria
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE {$query}", $params);
        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|Categoria
     */
    public function findById(int $id, string $columns = "*"): ?Categoria
    {
        return $this->find("categorias.categoria_id = :id", "id={$id}", $columns);
    }

    /**
     * @param $email
     * @param string $columns
     * @return null|Categoria
     */
    public function findByTitle($title, string $columns = "*"): ?Categoria
    {
        return $this->find("categorias.categoria = :title", "title={$title}", $columns);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        $all = $this->read(
            "SELECT {$columns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}"
        );

        if ($this->fail() || !$all->rowCount()) {
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @return null|Categoria
     */
    public function save(): ?Categoria
    {
        if (!$this->required()) {
            $this->message->warning("Você precisa preencher todos os campos!");
            return null;
        }

        /** User Update */
        if (!empty($this->categoria_id)) {
            $postId = $this->categoria_id;

            if ($this->find("categorias.categoria = :nome AND categorias.categoria_id != :id", "nome={$this->categoria}&id={$postId}")) {
                $this->message->warning("Uma categoria com esse nome já está cadastrada!");
                return null;
            }

            $this->update(self::$entity, $this->safe(), "categorias.categoria_id = :id", "id={$postId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return null;
            }
        }

        /** Categoria Create */
        if (empty($this->categoria_id)) {
            if ($this->find("categorias.categoria = :nome", "nome={$this->categoria}")) {
                $this->message->warning("Uma categoria com esse nome já está cadastrada!");
                return null;
            }

            $postId = $this->create(self::$entity, $this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return null;
            }
        }

        $this->data = ($this->findById($postId))->data();
        return $this;
    }

    /**
     * @return null|Categoria
     */
    public function destroy(): ?Categoria
    {
        if (!empty($this->categoria_id)) {
            $this->delete(self::$entity, "categorias.categoria_id = :id", "id={$this->categoria_id}");
        }

        if ($this->fail()) {
            $this->message->error("Não foi possível remover a subcategoria!");
            return null;
        }

        $this->data = null;
        return $this;
    }
}
