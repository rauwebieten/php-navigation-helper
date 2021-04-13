<?php


namespace RauweBieten\Navigation;


class Navigation extends AbstractNavigation
{
    public function setActiveItemsByUrl(string $url): void
    {
        $item = $this->findOneBy(
            function (NavigationItem $navigationItem) use ($url) {
                return $navigationItem->getUrl() === $url;
            }
        );
        if ($item) {
            $item->setActive(true);
        }
    }

    public function findActive(): ?NavigationItem
    {
        return $this->findOneBy(
            function (NavigationItem $navigationItem) {
                return $navigationItem->getActive();
            }
        );
    }

    public function findBy(callable $callback): array
    {
        $iterator = $this->getRecursiveIterator();
        $filterIterator = new \CallbackFilterIterator($iterator, $callback);
        $filterIterator->accept();
        $array = [];
        foreach ($filterIterator as $item) {
            $array[] = $item;
        }
        return $array;
    }

    public function findOneBy(callable $callback): ?NavigationItem
    {
        $array = $this->findBy($callback);
        if (count($array)) {
            return $array[0];
        }

        return null;
    }
}