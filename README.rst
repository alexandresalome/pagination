Pagination
==========

.. image:: https://travis-ci.org/alexandresalome/pagination.png?branch=master
   :alt: Build status
   :target: https://travis-ci.org/alexandresalome/pagination

**Requirements**: PHP 5.3

STILL IN DEVELOPMENT

Personal library used to paginate stuff.

Create a pager
--------------

To paginate something:

.. code-block:: php

    $pager = new Pager(new ArrayAdapter($array));

Pager object
------------

.. code-block:: php

    // Change position
    $pager->setOffset(30);
    $pager->setLimit(10);
    $pager->setPerPage(20);
    $pager->setPage(3);

    // Inspect
    $pager->getPageCount(); // can be zero
    $pager->getPage();
    $pager->getPerPage();
    $pager->getOffset();
    $pager->isFirstPage();
    $pager->isLastPage();

    foreach ($pager as $element) {
        echo $element;
    }

Create your own adapter
-----------------------

If you want to paginate something, just create an adapter for it:

.. code-block:: php

    interface AdapterInterface
    {
        public function get($offset, $limit);
        public function count();
    }

Adapters
--------

.. code-block:: php

    // Paginate an array
    $array = range(1, 1000);
    $pager = new Pager(new ArrayAdapter($array));

    // Paginate a git log
    $log = $repository->getLog(); // see gitonomy/gitlib
    $pager = new Pager(new GitlibLogAdapter($log));
