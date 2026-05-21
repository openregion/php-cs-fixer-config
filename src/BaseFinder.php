<?php

namespace OpenRegion\PhpCsFixerConfig;

use PhpCsFixer\Finder as PhpCsFixerFinder;
use SplFileInfo;

class BaseFinder extends PhpCsFixerFinder
{
  public function __construct()
  {
    parent::__construct();

    $this
      ->exclude([
        '.idea',
        '.vscode',
      ])
      /** don't fix php mixed with html {@link https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/issues/3702#issuecomment-404202952} */
      ->filter(
        static function (SplFileInfo $file) {
          if (!$file->isReadable()) {
            return false;
          }

          foreach (token_get_all(file_get_contents($file->getRealPath())) as $token) {
            if (is_array($token) && token_name($token[0]) === 'T_INLINE_HTML') {
              return false;
            }
          }

          return true;
        },
      )
      // don't ignore dot files/dirs
      ->ignoreDotFiles(false);
  }
}
