<?php


namespace RauweBieten\Navigation;


class NavigationItem extends AbstractNavigation
{
    protected $parent = null;
    protected $name = null;
    protected $url = null;
    protected $icon = null;
    protected $active = false;

    public function __construct(
        string $url = null,
        string $name = null,
        string $icon = null
    ) {
        $this->url = $url;
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return $this
     */
    public function setUrl($url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param AbstractNavigation $navigation
     * @return $this
     */
    public function setParent(AbstractNavigation $navigation) :self
    {
        $this->parent = $navigation;
        return $this;
    }

    /**
     * @return AbstractNavigation|null
     */
    public function getParent(): ?AbstractNavigation
    {
        return $this->parent;
    }

    /**
     * @return array|NavigationItem[]
     */
    public function getAncestors(): array
    {
        $ancestors = [];
        $parent = $this->getParent();
        if ($parent) {
            $ancestors[] = $parent;
            if ($parent instanceof NavigationItem) {
                $ancestors = array_merge($parent->getAncestors(), $ancestors);
            }
        }

        return $ancestors;
    }

    public function getRoot(): ?AbstractNavigation
    {
        $ancestors = $this->getAncestors();
        if (count($ancestors)) {
            return $ancestors[0];
        }
        return null;
    }

    public function getActive(bool $active = true): bool
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
            if ($navigationItem->getActive()) {
                return true;
            }
        }
        return false;
    }
}