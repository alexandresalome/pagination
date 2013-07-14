<?php

namespace Alex\Pagination\Adapter;

use Doctrine\ORM\QueryBuilder;

/**
 * Adapter class for a Doctrine QueryBuilder object.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class DoctrineQueryBuilderAdapter implements AdapterInterface
{
    /**
     * @var QueryBuilder
     */
    protected $builder;

    /**
     * Constructor.
     *
     * @param QueryBuilder $builder
     */
    public function __construct(QueryBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function get($offset, $limit)
    {
        $qb = clone $this->builder;
        $qb
            ->setFirstResult($offset)
            ->setMaxResults($limit)
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        $qb = clone $this->builder;
        $qb->select('COUNT('.$qb->getRootAlias().')');

        return $qb->getQuery()->getSingleScalarResult();
    }
}
