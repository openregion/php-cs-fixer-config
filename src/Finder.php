<?php

namespace OpenRegion\PhpCsFixerConfig;

use PhpCsFixer\Finder as BaseFinder;
use SplFileInfo;

class Finder extends BaseFinder
{
  public function __construct()
  {
    parent::__construct();

    $this
      ->exclude([
        '.idea',
        '.vscode',
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
      )
      /** don't fix php mixed with html {@link https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/issues/3702#issuecomment-404202952} */
      ->contains(['/\A<\?php/ium'])
      ->notContains(['/\?>[\s\r\n]*.+(.|\r|\n)*\z/um'])
      // don't ignore dot files/dirs
      ->ignoreDotFiles(false);
  }
}
