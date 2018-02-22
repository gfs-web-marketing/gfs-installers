<?php

namespace Gfs\Installers;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class GfsInstallersPlugin implements PluginInterface {
  public function activate(Composer $composer, IOInterface $io) {
    echo 'gfs installer';
    $installer = new GfsInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }
}