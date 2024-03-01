<?php 

namespace App\Iterator;

/**
 * Class IteratorManager : Va permettre d'itérer sur une collection d'objets
 * @implements \Iterator<int, string>
 * Exemple illustrant le design pattern : Iterator
 */
class IteratorManager implements \Iterator
{
    private $items;
    private $index = 0;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->index]);
    }

    public function key()
    {
        return $this->index;
    }

    public function current()
    {
        return $this->items[$this->index];
    }

    public function next():void
    {
        ++$this->index;
    }

}

