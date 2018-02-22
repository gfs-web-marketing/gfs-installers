<?php

namespace Gfs\Installers;

class GfsChatbotLibraryInstaller extends GfsBaseInstaller {

  protected $locations = [
    'library'  => 'app/modules/custom/gfs_chatbot/lib/{$name}',
  ];

}