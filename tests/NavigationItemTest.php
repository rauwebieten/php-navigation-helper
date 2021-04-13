<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class NavigationItemTest extends TestCase
{
    public function testUrlGetterAndSetter() {
        $navigationItem = new \RauweBieten\Navigation\NavigationItem();
        $navigationItem->setUrl('/some-url');
        $this->assertEquals('/some-url', $navigationItem->getUrl());
    }

    public function testNameGetterAndSetter() {
        $navigationItem = new \RauweBieten\Navigation\NavigationItem();
        $navigationItem->setName('Some URL');
        $this->assertEquals('Some URL', $navigationItem->getName());
    }

    public function testIconGetterAndSetter() {
        $navigationItem = new \RauweBieten\Navigation\NavigationItem();
        $navigationItem->setIcon('home-icon');
        $this->assertEquals('home-icon', $navigationItem->getIcon());
    }

    public function testParentGetterAndSetter() {
        $parent = new \RauweBieten\Navigation\NavigationItem();
        $navigationItem = new \RauweBieten\Navigation\NavigationItem();
        $navigationItem->setParent($parent);
        $this->assertEquals($parent, $navigationItem->getParent());
    }
}