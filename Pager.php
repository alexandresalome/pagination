<?php

namespace Alex\Pagination;

use Alex\Pagination\Adapter\AdapterInterface;

/**
 * Pager object used to paginate a set of results.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
class Pager implements \IteratorAggregate, \Countable
{
    /**
     * @var PagerAdapterInteface
     */
    private $adapter;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $total;

    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter backend to use for effective calls
     * @param int              $perPage default number of items per page
     */
    public function __construct(AdapterInterface $adapter, $perPage = 10)
    {
        $this->adapter = $adapter;
        $this->perPage = 10;
    }

    /**
     * Changes current offset of the pager.
     *
     * @param int $offset new offset value
     *
     * @return Pager
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Changes the current page.
     *
     * @param int $page the page to jump to.
     *
     * @return Pager
     */
    public function setPage($page)
    {
        $this->offset = (max(1, (int) $page) - 1) * $this->perPage;

        return $this;
    }

    /**
     * Tests if the page is first page.
     *
     * @return boolean
     */
    public function isFirstPage()
    {
        return $this->getPage() == 1;
    }

    public function isLastPage()
    {
        return $this->getPage() == $this->getPageCount();
    }

    public function getPage()
    {
        return floor($this->offset/$this->perPage) + 1;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setPerPage($perPage)
    {
        $this->perPage = (int) $perPage;

        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getLimit()
    {
        return $this->perPage;
    }

    public function count()
    {
        if (null === $this->total) {
            $this->total = $this->adapter->count();
        }

        return $this->total;
    }

    /**
     * Can be zero.
     */
    public function getPageCount()
    {
        return ceil($this->count() / $this->perPage);
    }

    public function getResults()
    {
        return $this->getIterator();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->adapter->get($this->offset, $this->perPage));
    }

    /**
     * Returns an array of page numbers for a given range.
     *
     * @return array
     */
    public function getPageRange($range = 4)
    {
        $from = max(1, $this->getPage() - $range);
        $to = min($this->getPageCount(), $this->getPage() + $range);

        return range($from, $to);
    }
}
