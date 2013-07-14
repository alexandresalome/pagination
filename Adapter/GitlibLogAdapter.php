<?php

namespace Alex\Pagination\Adapter;

use Gitonomy\Git\Log;

/**
 * Adapter for a Log object of Gitonomy gitlib.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class GitlibLogAdapter implements AdapterInterface
{
    /**
     * @var Log
     */
    private $log;

    /**
     * Constructor.
     *
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * {@inheritdoc}
     */
    public function get($offset, $limit)
    {
        $this->log->setOffset($offset);
        $this->log->setLimit($limit);

        return $this->log->getCommits();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->log->countCommits();
    }
}
