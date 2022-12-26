<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @author Brenofvs <brenofvs.consultoria@gmail.com>
 * @package Source\Models
 */
class Sub extends Model
{
    /** @var array $safe no update or create */
    protected static $safe = ["sub_id", "categoria_id", "categoria"];

    /** @var string $entity database table */
    protected static $entity = "subcategoria";

    /** @var array $required table fileds */
    protected static $required = ["id_categoria", "subcategoria"];

    /**
     * @param string $title
     * @param string $body
     * @param string $image
     * @return Sub
     */
    public function bootstrap(
        string $id_categoria,
        string $subcategoria,
    ): Sub {
        $this->id_categoria = $id_categoria;
        $this->subcategoria = $subcategoria;
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
     * @return null|Sub
     */
    public function find(string $query, string $params, string $columns = "*"): ?Sub
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " JOIN categorias on categorias.categoria_id = subcategoria.id_categoria WHERE {$query}", $params);
        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|Sub
     */
    public function findById(int $id, string $columns = "*"): ?Sub
    {
        return $this->find("subcategoria.sub_id = :id", "id={$id}", $columns);
    }

    /**
     * @param $email
     * @param string $columns
     * @return null|Sub
     */
    public function findByTitle($title, string $columns = "*"): ?Sub
    {
        return $this->find("subcategoria.subcategoria = :title", "title={$title}", $columns);
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
     * @return null|Sub
     */
    public function save(): ?Sub
    {
        if (!$this->required()) {
            $this->message->warning("Você precisa preencher todos os campos!");
            return null;
        }

        /** User Update */
        if (!empty($this->sub_id)) {
            $postId = $this->sub_id;

            if ($this->find("subcategoria.subcategoria = :nome AND subcategoria.id_categoria = :cat AND subcategoria.sub_id != :id", "nome={$this->subcategoria}&cat={$this->id_categoria}&id={$postId}")) {
                $this->message->warning("Uma subcategoria com esse nome já está cadastrado nessa categoria!");
                return null;
            }

            $this->update(self::$entity, $this->safe(), "subcategoria.sub_id = :id", "id={$postId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return null;
            }
        }

        /** Sub Create */
        if (empty($this->sub_id)) {
            if ($this->find("subcategoria.subcategoria = :nome AND subcategoria.id_categoria = :cat", "nome={$this->subcategoria}&cat={$this->id_categoria}")) {
                $this->message->warning("Uma subcategoria com esse nome já está cadastrado nessa categoria!");
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
     * @return null|Sub
     */
    public function destroy(): ?Sub
    {
        if (!empty($this->sub_id)) {
            $this->delete(self::$entity, "subcategoria.sub_id = :id", "id={$this->sub_id}");
        }

        if ($this->fail()) {
            $this->message->error("Não foi possível remover a subcategoria!");
            return null;
        }

        $this->data = null;
        return $this;
    }
}
