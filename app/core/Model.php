<?php

class Model
{
    protected $table = '';
    protected $primaryKey = 'id';
    protected $allowedFields = [];
    protected $query = "";
    protected $data = false;

    public function __construct()
    {
        $this->db = new Database;
        $this->query = "SELECT * FROM $this->table";
    }

    public function findAll()
    {
        $this->db->query($this->query);
        if (!empty($this->data)) {
            $key = array_keys($this->data);
            foreach ($key as $k) {
                $this->db->bind($k, $this->data[$k]);
            }
        }
        return $this->db->resultSet();
    }

    public function first()
    {
        $this->db->query($this->query);
        if (!empty($this->data)) {
            $key = array_keys($this->data);
            foreach ($key as $k) {
                $this->db->bind($k, $this->data[$k]);
            }
        }
        return $this->db->single();
    }

    public function where($data = [])
    {
        $new = new Model;
        $key = array_keys($data);
        for ($i = 0; $i < count($key); $i++) {
            $c[$i] = $key[$i] . ' = :' . $key[$i];
        }
        $where = ' ' . implode(' && ', $c) . ' ';

        $new->query = ' ' . $this->query . ' WHERE ' . $where . ' ';

        $new->data = $data;

        return $new;
    }

    public function save($data = [])
    {
        // mengambil nama key dari data yang dikirim
        $key = array_keys($data);

        // mengambil isi alowedfields
        $allow = '(:' . implode(', :', $this->allowedFields) . ')';

        $query = "INSERT INTO $this->table
                    VALUES
                  $allow";

        $this->db->query($query);
        foreach ($key as $k) {
            $this->db->bind($k, $data[$k]);
        }
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($value, $data = [])
    {
        $key = array_keys(($data));
        $pk = $this->primaryKey . ' = :' . $this->primaryKey;

        for ($i = 0; $i < count($this->allowedFields); $i++) {
            $c[$i] = $this->allowedFields[$i] . ' = :' . $this->allowedFields[$i];
        }
        $c = implode(', ', $c);

        $query = "UPDATE $this->table  SET $c WHERE $pk";
        $this->db->query($query);
        foreach ($key as $k) {
            $this->db->bind($k, $data[$k]);
        }
        $this->db->bind($this->primaryKey, $value);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $key = ' WHERE ' . $this->primaryKey . '=:' . $this->primaryKey;
        $this->db->query('DELETE FROM ' . $this->table . $key);
        $this->db->bind($this->primaryKey, $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function select($data = ' * ')
    {
        $new = new Model;
        $new->query = ' SELECT ' . $data . ' FROM ' . $this->table . ' ';
        return $new;
    }

    public function join($join = "", $key = "")
    {
        $new = new Model;
        $j = explode(' ', $join);

        if (!empty($j[1])) {
            $query = "$this->query INNER JOIN $j[0] AS $j[1] ON $key";
        } else {
            $query = "$this->query INNER JOIN $join ON $key";
        }

        $new->query = $query;

        return $new;
    }
}
