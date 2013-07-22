<?php

namespace Alex\Pagination\Adapter;

use Doctrine\ORM\PersistentCollection;

/**
 * Adapter class for a Doctrine collection object.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class DoctrineCollectionAdapter implements AdapterInterface
{
    /**
     * @var PersistentCollection
     */
    protected $collection;

    /**
     * Constructor.
     *
     * @param PersistentCollection $collection
     */
    public function __construct(PersistentCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function get($offset, $limit)
    {
        return $this->collection->slice($offset, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->collection);
    }
}
