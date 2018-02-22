<?php

namespace Gfs\Installers;

use Composer\Package\PackageInterface;
use Composer\Installers\BaseInstaller;

class GfsBaseInstaller extends BaseInstaller {

  /**
   * {@inheritDoc}
   */
  public function getInstallPath(PackageInterface $package, $frameworkType = '') {
    $prefix = substr($package->getPrettyName(), 0, 20);
    if ('gordon-food-service/' !== $prefix) {
        throw new \InvalidArgumentException(
            'Unable to install template, GFS templates '
            .'should always start their package name with '
            .'"gordon-food-service/". Was ' . $package->getPrettyName()
        );
    }

    return parent::getInstallPath($package, $frameworkType);
  }

}
