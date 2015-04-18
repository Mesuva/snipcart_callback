<?php
// Author: Ryan Hewitt - http://www.mesuva.com.au
namespace Concrete\Package\SnipcartCallback;
use Package;
use Core;
use Events;

class Controller extends Package {
    protected $pkgHandle = 'snipcart_callback';
    protected $appVersionRequired = '5.7.3';
    protected $pkgVersion = '0.9.6';

    public function getPackageDescription() {
        return t("A package to handle Snipcart callbacks");
    }

    public function getPackageName() {
        return t("eCommerce with Snipcart: Callback Handling");
    }

    public function install() {
        $installed = Package::getInstalledHandles();

        if( !(is_array($installed) && in_array('snipcart',$installed)) ) {
            throw new Exception(t('This package requires that the eCommerce with Snipcart package be installed first'));
        }

        $pkg = parent::install();
        $this->configurePackage($pkg);
    }

    public function upgrade() {
        $pkg = $this;
        $this->configurePackage($pkg);
        parent::upgrade();
    }

    public function configurePackage($pkg) {
        // perform any set up here, this will be run on both installs and upgrades
    }

    public function on_start() {
        $listener = Core::make('\Concrete\Package\SnipcartCallback\Src\Event\Order');
        Events::addListener('on_snipcart_callback', array($listener, 'orderPlaced'));
    }


}