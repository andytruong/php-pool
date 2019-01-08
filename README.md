PHP pool
====

Example usage:

```php
<?php
$pm = new andytruong\pool\Pool($poolSize = 3);

$tasks = [1, 2, 3, 4, 5];
foreach ($tasks as $task) {
    $pm->add(
        function() use ($task) {
            echo "[callback] processing {$task}" . PHP_EOL;
            sleep(5); # slow task process
            echo "[callback] completed {$task}" . PHP_EOL;
        }
    );
}

$pm->wait();
```
## Install

    composer require andytruong/php-pool
