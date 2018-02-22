<?php

namespace GfsInstallers\Composer;

class GfsChatbotLibraryInstaller extends GfsBaseInstaller {
  
  protected $locations = [
    'chatbot-library'  => 'modules/custom/gfs_chatbot/lib/{$name}',
  ];

  /**
   * {@inheritDoc}
   */
  public function supports($packageType) {
    return 'gfs-chatbot-library' === $packageType;
  }
}