<?php

namespace RauweBieten\Navigation;

class RecursiveNavigationItemIterator extends \RecursiveArrayIterator
{
    public function hasChildren(): bool
    {
        return !empty($this->current()->getChildren());
    }

    public function getChildren(): self
    {
        return new static($this->current()->getChildren());
    }
}