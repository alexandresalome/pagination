<?php

namespace Alex\Pagination\Adapter;

/**
 * Adapter for a static PHP array.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class ArrayAdapter implements AdapterInterface
{
    /**
     * @var array
     */
    private $array;

    /**
     * Creates a new pagination adapter with a PHP array.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->array);
    }

    /**
     * {@inheritdoc}
     */
    public function get($offset, $limit)
    {
        return array_slice($this->array, $offset, $limit);
    }
}
