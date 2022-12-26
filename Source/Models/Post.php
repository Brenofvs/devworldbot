<?php

namespace Source\Models;

use Source\Core\Model;

/**
 *
 * @author Brenofvs <brenofvs.consultoria@gmail.com>
 * @package Source\Models
 */
class Post extends Model
{
    /** @var array $safe no update or create */
    protected static $safe = ["cursos_id", "sub_id", "subcategoria", "categoria_id", "categoria"];

    /** @var string $entity database table */
    protected static $entity = "cursos";

    /** @var array $required table fileds */
    protected static $required = ["id_categoria", "id_subcategoria", "nome", "message_id"];

    /**
     * @param string $title
     * @param string $body
     * @param string $image
     * @return Post
     */
    public function bootstrap(
        string $id_categoria,
        string $id_subcategoria,
        string $nome,
        string $message_id,
    ): Post {
        $this->id_categoria = $id_categoria;
        $this->id_subcategoria = $id_subcategoria;
        $this->nome = $nome;
        $this->message_id = $message_id;
        return $this;
    }

    /**
     * @param string $query
     * @param string $params
     * @param string $columns
     * @return array|null
     */
    public function queryBuild(string $query, string $params = "", string $columns = "*"): ?array
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
     * @return null|Post
     */
    public function find(string $query, string $params, string $columns = "*"): ?Post
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " JOIN subcategoria on subcategoria.sub_id = cursos.id_subcategoria JOIN categorias on categorias.categoria_id = cursos.id_categoria WHERE {$query}", $params);
        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|Post
     */
    public function findById(int $id, string $columns = "*"): ?Post
    {
        return $this->find("cursos.cursos_id = :id", "id={$id}", $columns);
    }

    /**
     * @param $email
     * @param string $columns
     * @return null|Post
     */
    public function findByTitle($title, string $columns = "*"): ?Post
    {
        return $this->find("cursos.nome = :title", "title={$title}", $columns);
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
     * @return null|Post
     */
    public function save(): ?Post
    {
        if (!$this->required()) {
            $this->message->warning("Você precisa preencher todos os campos!");
            return null;
        }

        /** User Update */
        if (!empty($this->cursos_id)) {
            $postId = $this->cursos_id;

            if ($this->find("cursos.nome = :nome AND cursos.id_categoria = :cat AND cursos.id_subcategoria = :sub AND cursos.cursos_id != :id", "nome={$this->nome}&cat={$this->id_categoria}&sub={$this->id_subcategoria}&id={$postId}")) {
                $this->message->warning("Um curso com esse nome já está cadastrado nessa categoria!");
                return null;
            }

            $this->update(self::$entity, $this->safe(), "cursos.cursos_id = :id", "id={$postId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return null;
            }
        }

        /** Post Create */
        if (empty($this->cursos_id)) {
            if ($this->find("cursos.nome = :nome AND cursos.id_categoria = :cat AND cursos.id_subcategoria = :sub", "nome={$this->nome}&cat={$this->id_categoria}&sub={$this->id_subcategoria}")) {
                $this->message->warning("Um curso com esse nome já está cadastrado nessa categoria!");
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
     * @return null|Post
     */
    public function destroy(): ?Post
    {
        if (!empty($this->cursos_id)) {
            $this->delete(self::$entity, "cursos.cursos_id = :id", "id={$this->cursos_id}");
        }

        if ($this->fail()) {
            $this->message->error("Não foi possível remover o curso");
            return null;
        }

        $this->data = null;
        return $this;
    }
}
