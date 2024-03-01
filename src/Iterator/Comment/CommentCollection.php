<?php

namespace App\Iterator\Comment;

use App\Iterator\IteratorManager;
use Traversable;

/**
 * Exemple illustrant le design pattern : iterator
 */
class CommentCollection implements \IteratorAggregate
{
    private $items;

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function getIterator(): Traversable
    {
        return new IteratorManager($this->items);
    }
}