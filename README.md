# php-cs-fixer-config
Конфиг [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) для использования в git репозиториях.

⚠️ В [Finder](./src/Finder.php) стоит исключение на PHP файлы со встроенным в них HTML, т.к. PHP CS Fixer не умеет корректно их форматировать. Подробнее об этом [здесь](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/issues/3702#issuecomment-404202952).

## Установка
Рекомендуется установить пакет через [Composer](https://getcomposer.org/).
```bash
composer require --dev openregion/php-cs-fixer-config
```

## Правила
По умолчанию задан набор правил, указанный в [\OpenRegion\PhpCsFixerConfig\Config::BASE_RULES](./src/Config.php). На проекте могут быть заданы дополнительные правила через метод [\OpenRegion\PhpCsFixerConfig\Config::setRules()](./src/Config.php). Для удобного просмотра правил можно использовать [специальную страницу](https://mlocati.github.io/php-cs-fixer-configurator/).

## Как пользоваться
1. Создать в корне проекта файл конфигурации `.php-cs-fixer.dist.php` с содержимым:
    ```php
    <?php

    use OpenRegion\PhpCsFixerConfig\Config;
    use OpenRegion\PhpCsFixerConfig\Finder;

    $finder = (new Finder())
      ->in(__DIR__);

    return (new Config())
      ->setFinder($finder);
    ```
2. Добавить дополнительные исключения (через Finder) и правила (через Config) в ранее созданный файл, если это требуется на проекте.
3. Запустить в корне проекта фиксер для правки текущего кода:
   ```shell
   php ./vendor/bin/php-cs-fixer fix
   ```
4. Удостовериться, что конфиг не правит лишнее.
5. Настроить [git хук](https://github.com/openregion/git-hooks/tree/master/scripts/pre-commit#php-cs-fixer-fix) для автоматической правки изменяемых файлом перед коммитом.
