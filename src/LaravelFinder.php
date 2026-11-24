<?php

namespace OpenRegion\PhpCsFixerConfig;

class LaravelFinder extends BaseFinder
{
  public function __construct()
  {
    parent::__construct();

    $this
      ->exclude([
        'bootstrap/cache',
        'build',
        'node_modules',
        'storage',
      ])
      ->notName([
        '_ide_helper_actions.php',
        '_ide_helper_models.php',
        '_ide_helper.php',
        '.phpstorm.meta.php',
        '*.blade.php',
      ])
      ->ignoreDotFiles(true);
  }
}
