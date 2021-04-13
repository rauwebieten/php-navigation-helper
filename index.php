<?php

namespace demo;

use RauweBieten\Navigation\Navigation;
use RauweBieten\Navigation\NavigationItem;

require_once __DIR__ . '/vendor/autoload.php';

$navigation = new Navigation();

$dashboard = new NavigationItem('/','Dashboard');
$navigation->addChildren($dashboard);

$crm = new NavigationItem('/crm','CRM');
$navigation->addChildren($crm);

$contacts = new NavigationItem('/crm/contacts','Contacts');
$crm->addChildren($contacts);

$customers = new NavigationItem('/crm/customers','Customers');
$crm->addChildren($customers);

$newCustomers = new NavigationItem('/crm/customers/new','New customers');
$customers->addChildren($newCustomers);

$navigation->setActiveItemsByUrl('/crm/customers/new');

// ----------------------

$iterator = $navigation->getRecursiveIterator();
foreach ($iterator as $navigationItem) {
    print str_repeat('...', $iterator->getDepth());
    print $navigationItem->getName();
    if ($navigationItem->hasActiveChild()) {
        print " -- active-path";
    }
    if ($navigationItem->getActive()) {
        print " -- active";
    }
    print "\n";
}

print "-----------------\n";

// breadcrumb

$active = $navigation->findActive();
$ancestors = $active->getAncestors();

foreach ($ancestors as $ancestor) {
    print "{$ancestor->getName()} > ";
}

print $active->getName() . "\n";