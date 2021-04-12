<?php


namespace RauweBieten\Navigation;


class NavigationItem extends AbstractNavigation
{
    protected $parent;
    protected $name;
    protected $url;
    protected $icon;
    protected $active = false;

    public function __construct(string $url, string $name, string $icon = null) {
        $this->url = $url;
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return NavigationItem
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return NavigationItem
     */
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setParent(AbstractNavigation $navigation)
    {
        $this->parent = $navigation;
    }

    public function getAncestors(): array
    {
        $ancestors = [];
        if ($this->hasParent()) {
            $parent = $this->getParent();
            if ($parent instanceof NavigationItem) {
                $ancestors[] = $parent;
                $ancestors = array_merge($parent->getAncestors(), $ancestors);
            }
        }

        return $ancestors;
    }

    public function getParent(): ?AbstractNavigation
    {
        return $this->parent;
    }

    public function hasParent(): bool
    {
        return !empty($this->parent);
    }

    public function isActive(bool $active = true): bool
    {
        return $this->active === $active;
    }

    public function setActive(bool $active = true)
    {
        $this->active = $active;
    }

    public function hasActiveChild(): bool
    {
        $iterator = $this->getRecursiveIterator();
        foreach ($iterator as $navigationItem) {
            if ($navigationItem->isActive()) {
                return true;
            }
        }
        return false;
    }
}