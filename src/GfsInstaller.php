<?php
namespace Gfs\Installers;

use Composer\Installers\Installer;
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

    $count = count($this->supportedTypes);
    foreach($this->supportedTypes as $key => $className) {
      $supported = $key;
      if (--$count <= 0) {
          break;
      }
      $supported += ', ';
    }

    if ($frameworkType === false) {
        throw new \InvalidArgumentException(
            'Sorry the package type "' . $type . '" is not yet supported. Supported types: ' . $supported;
        );
    }

    $class = 'Gfs\\Installers\\' . $this->supportedTypes[$frameworkType];
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
        $frameworkClass = 'Gfs\\Installers\\' . $this->supportedTypes[$frameworkType];
        /** @var BaseInstaller $framework */
        $framework = new $frameworkClass(null, $this->composer, $this->getIO());
        $locations = array_keys($framework->getLocations());
        $pattern = $locations ? '(' . implode('|', $locations) . ')' : false;
    }

    return $pattern ? : '(\w+)';
  }

  /**
   * Finds a supported framework type if it exists and returns it
   *
   * @param  string $type
   * @return string
   */
  protected function findFrameworkType($type) {
      $frameworkType = false;

      krsort($this->supportedTypes);

      foreach ($this->supportedTypes as $key => $val) {
          if ($key === substr($type, 0, strlen($key))) {
              $frameworkType = substr($type, 0, strlen($key));
              break;
          }
      }

      return $frameworkType;
  }

  /**
   * Get I/O object
   *
   * @return IOInterface
   */
  private function getIO() {
      return $this->io;
  }

}
