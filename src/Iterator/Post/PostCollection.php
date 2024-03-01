<?php

namespace App\Iterator\Post;

use App\Iterator\IteratorManager;
use Traversable;

/**
 * PostCollection : Tableau de Posts qui pourra être parcouru à partir de l'iterator
 * Exemple illustrant le design pattern : Iterator
 */
class PostCollection implements \IteratorAggregate
{
    private $items = [];

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function getIterator(): Traversable
    {
        return new IteratorManager($this->items);
    }
}