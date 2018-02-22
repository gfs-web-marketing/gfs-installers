<?php

namespace GfsInstallers;

class GfsChatbotLibraryInstaller extends GfsBaseInstaller {

  protected $locations = [
    'library'  => 'modules/custom/gfs_chatbot/lib/{$name}',
  ];

}