<?php

namespace GfsInstallers;

use Composer\Package\PackageInterface;
use Composer\Installer\BaseInstaller;

class GfsBaseInstaller extends BaseInstaller {

  /**
   * {@inheritDoc}
   */
  public function getInstallPath(PackageInterface $package) {
    $prefix = substr($package->getPrettyName(), 0, 23);
    if ('gfs/' !== $prefix) {
        throw new \InvalidArgumentException(
            'Unable to install template, GFS templates '
            .'should always start their package name with '
            .'"gfs/"'
        );
    }

    return parent::getInstallPath($package);
  }

}
