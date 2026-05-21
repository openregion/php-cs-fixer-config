<?php

namespace OpenRegion\PhpCsFixerConfig;

use SplFileInfo;

class BitrixFinder extends BaseFinder
{
  public function __construct()
  {
    parent::__construct();

    $this
      ->exclude([
        'bitrix',
        'upload',
      ])
      // ignore generated bitrix annotations
      ->notName(['orm_annotations.php'])
      // ignore module's options.php
      ->filter(
        static fn(SplFileInfo $file) => !preg_match(
          '/^.*\/local\/modules\/[^\/]+\/options\.php$/u',
          $file->getRealPath(),
        )
      );
  }
}
