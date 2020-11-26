<?php

class Repository implements IRepository
{
    protected $pdo;
    protected $driver;
    public function __construct(PDO $pdo,$driver = 'mysql')
    {
        $this->pdo = $pdo;
        $this->driver = $driver;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    protected function escapeIdent($ident)
    {
        switch ($this->driver)
        {
            case 'mysql':
                return "`".str_replace("`", "``", $ident)."`";

            default:
                throw new \Exception("You must define escape rules for the driver ($this->driver)");
        }
    }
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function insert($object)
    {
        $table = $this->escapeIdent(strtolower(basename(get_class($object))));
        $properties = get_object_vars($object);
        unset($properties['id']);
        $params = array_values($properties);
        $names = '';
        foreach($properties as $name => $value)
        {
                $names .= $this->escapeIdent($name) . ",";
        }
        $names = substr($names, 0, -1);
        $values = str_repeat('?,', count($params) - 1) . '?';
        $sql = "INSERT IGNORE INTO $table ($names) VALUES ($values)";
        $this->query($sql, $params);
    }

    public function findAll($class)
    {
        $table = $this->escapeIdent(strtolower(basename($class)));
        $sql = "SELECT * FROM $table";
        return $this->query($sql,[])->fetchAll(PDO::FETCH_CLASS, $class);
    }
}