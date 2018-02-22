<?php
namespace GfsInstallers;

use Composer\Installer\Installer;
use Composer\Package\PackageInterface;

class GfsInstaller extends Installer {

  /**
   * Package types to installer class map
   *
   * @var array
   */
  private $supportedTypes = [
    'gfs-chatbot'  => 'GfsChatbotLibraryInstaller',
  ];

  /**
   * {@inheritDoc}
   */
  public function getInstallPath(PackageInterface $package) {
    $type = $package->getType();
    $frameworkType = $this->findFrameworkType($type);

    if ($frameworkType === false) {
        throw new \InvalidArgumentException(
            'Sorry the package type of this package is not yet supported.'
        );
    }

    $class = 'GfsInstallers\\' . $this->supportedTypes[$frameworkType];
    $installer = new $class($package, $this->composer, $this->getIO());

    return $installer->getInstallPath($package, $frameworkType);
  }

  /**
   * Get the second part of the regular expression to check for support of a
   * package type
   *
   * @param  string $frameworkType
   * @return string
   */
  protected function getLocationPattern($frameworkType) {
    $pattern = false;
    if (!empty($this->supportedTypes[$frameworkType])) {
        $frameworkClass = 'GfsInstallers\\' . $this->supportedTypes[$frameworkType];
        /** @var BaseInstaller $framework */
        $framework = new $frameworkClass(null, $this->composer, $this->getIO());
        $locations = array_keys($framework->getLocations());
        $pattern = $locations ? '(' . implode('|', $locations) . ')' : false;
    }

    return $pattern ? : '(\w+)';
  }

}
