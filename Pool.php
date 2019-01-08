<?php

namespace andytruong\pool;

class Pool
{
    private $size;
    private $forks = [];

    public function __construct(int $size = 5)
    {
        $this->setSize($size);
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function add(callable $callback)
    {
        // some other process is running, waiting for available slot.
        if ($this->size <= count($this->forks)) {
            $pid = pcntl_wait($_);
            unset($this->forks[$pid]);
        }

        switch ($pid = pcntl_fork()) {
            case 0:
                call_user_func($callback);
                exit;

            case -1:
                call_user_func($callback);
                break;

            default:
                $this->forks[$pid] = true;
                break;
        }
    }

    public function wait()
    {
        foreach (array_keys($this->forks) as $pid) {
            pcntl_waitpid($pid, $_);
            unset($this->forks[$pid]);
        }
    }
}
