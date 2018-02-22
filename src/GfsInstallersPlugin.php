<?php

namespace GfsInstallers\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class GfsInstallersPlugin implements PluginInterface {
  public function activate(Composer $composer, IOInterface $io) {

    $installer = new GfsChatbotLibraryInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);

  }
}