PHP pool
====

Run tasks in parallel with limited threads.

Example usage:

```php
<?php
$pool = new andytruong\pool\Pool($poolSize = 3);

$tasks = [1, 2, 3, 4, 5];
foreach ($tasks as $task) {
    $pool->execute(
        function($task) {
            echo "[callback] processing {$task}" . PHP_EOL;
            sleep(5); # slow task process
            echo "[callback] completed {$task}" . PHP_EOL;
        },
        $task
    );
}

$pool->wait();
```
## Install

    composer require andytruong/php-pool
