<?php

namespace vendor\framework;

use DateTime;

class Logger
{
    const TYPE_WARNING = 'warning';
    const TYPE_ALERT = 'alert';
    const TYPE_INFO = 'info';
    const TYPE_DEBUG = 'debug';

    private $filePath;
    private $type;
    private $message;

    public function __construct(string $filePath = '', string $type = '', string $message = '')
    {
        $this->filePath = $filePath;
        $this->type = $type === '' ? '' : self::TYPE_INFO;
        $this->message = $message;
    }

    public function getFilePath():string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getMessage():string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function write(string $filePath = '', string $type = '', string $message = ''): void
    {
        if ($filePath === '' && $this->filePath === '') {
            throw new \Exception('We need one file name.');
            exit;
        }

        $file = $filePath === '' ? $this->$filePath : $filePath;
        if (!file_exists($file)) {
            touch($file);
        }

        $type = $type === '' ? $this->type : $type;
        $time = (new DateTime())->format('d/m/Y H:i:s');
        // $myfile = fopen($file, "w");
        // fwrite($myfile, "[{$type}][{$time}] {$message}" . PHP_EOL);
        // fclose($myfile);

        file_put_contents($file, "[{$type}][{$time}] {$message}" . PHP_EOL, FILE_APPEND);
    }
}