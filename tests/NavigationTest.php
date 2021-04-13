<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use RauweBieten\Navigation\Navigation;
use RauweBieten\Navigation\NavigationItem;

class NavigationTest extends TestCase
{
    /** @var \RauweBieten\Navigation\Navigation */
    public $navigation;
    public $books, $music, $hiphop, $jazzyHiphop, $experimentalHiphop, $jazz, $freeJazz, $bebop, $swing;

    public function setUp(): void
    {
        $this->navigation = new Navigation();

        $this->books = new NavigationItem('/books');
        $this->navigation->addChildren($this->books);

        $this->music = new NavigationItem('/music');
        $this->navigation->addChildren($this->music);

        $this->hiphop = new NavigationItem('music/hiphop');
        $this->jazzyHiphop = new NavigationItem('music/hiphop/jazzy');
        $this->experimentalHiphop = new NavigationItem('music/hiphop/experimental');
        $this->hiphop->addChildren($this->jazzyHiphop, $this->experimentalHiphop);

        $this->jazz = new NavigationItem('music/jazz');
        $this->freeJazz = new NavigationItem('music/jazz/free-jazz');
        $this->bebop = new NavigationItem('music/jazz/bebop');
        $this->swing = new NavigationItem('music/jazz/swing');
        $this->jazz->addChildren($this->freeJazz, $this->bebop, $this->swing);

        $this->music->addChildren($this->hiphop, $this->jazz);
    }

    public function testGetChildren()
    {
        $children = $this->music->getChildren();
        $this->assertContains($this->hiphop, $children);
        $this->assertContains($this->jazz, $children);
        $this->assertNotContains($this->freeJazz, $children);
        $this->assertCount(2, $children);
        $this->assertTrue($this->music->hasChildren());
    }

    public function testParent()
    {
        $this->assertEquals($this->hiphop, $this->jazzyHiphop->getParent());
    }

    public function testAncestors()
    {
        $this->assertContains($this->navigation, $this->jazzyHiphop->getAncestors());
        $this->assertContains($this->music, $this->jazzyHiphop->getAncestors());
        $this->assertContains($this->hiphop, $this->jazzyHiphop->getAncestors());
        $this->assertNotContains($this->experimentalHiphop, $this->jazzyHiphop->getAncestors());
        $this->assertNotContains($this->books, $this->jazzyHiphop->getAncestors());
    }
}