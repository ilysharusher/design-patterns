<?php

class QueryBuilder
{
    private array $select;
    private string $from;
    private array $where;

    public function select(array $fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;
        return $this;
    }

    public function where(array $conditions): self
    {
        $this->where = $conditions;
        return $this;
    }

    public function get(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s',
            implode(', ', $this->select),
            $this->from,
            implode(' AND ', $this->where)
        );
    }
}

$query = (new QueryBuilder())
    ->select(['id', 'name', 'email'])
    ->from('users')
    ->where(['age > 18', 'name = "John"'])
    ->get();

echo $query;