<?php


namespace RauweBieten\Navigation;


class AbstractNavigation
{
    /**
     * @var array|NavigationItem[]
     */
    protected $children = [];

    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren() :bool
    {
        return count($this->children);
    }

    public function add(NavigationItem $navigationItem): self
    {
        $this->children[] = $navigationItem;
        $navigationItem->setParent($this);
        return $this;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->children);
    }

    public function getRecursiveIterator(): \RecursiveIteratorIterator
    {
        return new \RecursiveIteratorIterator(
            new RecursiveNavigationItemIterator($this->children),
            \RecursiveIteratorIterator::SELF_FIRST
        );
    }
}