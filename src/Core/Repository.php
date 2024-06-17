<?php


namespace Core;


class Repository
{
    private $table;
    private $columns;
    private $db;

    public function __construct($db, $table, $columns)
    {
        $this->db = $db;
        $this->table = $table;
        $this->columns = $columns;
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $this->db->query($query);
        return $this->db->getResults();
    }

    public function getIds()
    {
        $query = "SELECT id FROM {$this->table}";
        $this->db->query($query);
        $results = $this->db->getResults();
        $ids = [];
        foreach ($results as $result) {
            $ids[] = $result['id'];
        }
        return $ids;
    }

    public function get($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $this->db->query($query, ['id' => $id]);
        $results = $this->db->getResults();
        return $results[0];
    }

    public function getMaxId()
    {
        $query = "SELECT MAX(id) as max_id FROM {$this->table}";
        $this->db->query($query);
        $results = $this->db->getResults();
        return $results[0]['max_id'];
    }

    public function save($entity)
    {
        if ($entity['id'] == 0) {
            $entity['id'] = $this->getMaxId() + 1;
        } else {
            $this->delete($entity);
        }
        $this->insert($entity);
        return $entity['id'];
    }

    private function insert($entity)
    {
        $columns_list = $this->createColumnList();
        $values_list = $this->createValuesList();
        $query = "INSERT INTO {$this->table} ($columns_list) VALUES ($values_list)";
        $this->db->execute($query, $entity);
    }

    public function delete($entity)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id LIMIT 1";
        $this->db->execute($query, ['id' => $entity['id']]);
    }

    private function createColumnList()
    {
        return implode(',', $this->getColumnKeys());
    }

    private function createValuesList()
    {
        $keys = [];
        foreach ($this->getColumnKeys() as $column) {
            $keys[] = ":" . $column;
        }
        return implode(',', $keys);
    }

    public function getColumnKeys()
    {
        return array_keys($this->columns);
    }

    public function create()
    {
        $entity = [];
        foreach ($this->columns as $column => $type) {
            $value = null;
            switch ($type) {
                case 'int':
                    $value = 0;
                    break;
                case 'string':
                    $value = "";
                    break;
            }
            $entity[$column] = $value;
            return $entity;
        }
    }

    public function filterAll($column, $value)
    {
        $entities = $this->getAll();
        $filtered_list = [];
        foreach ($entities as $entity) {
            if ($entity[$column] == $value) {
                $filtered_list[] = $entity;
            }
        }
        return $filtered_list;
    }
}