<?php

namespace Src;

use PDO;
use PDOException;

class DB
{
    public PDO $pdo;
    public object $instance;
    private string $dsn;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $this->setConfig();
        $this->pdo = new PDO("$this->dsn", "$this->user", "$this->pass", $options);
    }

    private function setConfig(): void
    {
        $config = require '../app/config/configDb.php';

        $this->dsn = $config['dsn'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
    }

    public function getInstance(): object
    {
        if (empty($this->instance)) {
            $this->instance = new self();
        }
        return $this->instance;
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    public function get(string $request): bool|array
    {
        $prepare = $this->pdo->prepare($request);

        try {
            if ($prepare->execute()) {
                return $prepare->fetchAll();
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    public function send(string $request): bool
    {
        $prepare = $this->pdo->prepare($request);
        $prepare->execute();
        $updateRows = $prepare->rowCount();

        try {
            if ($updateRows >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
    }
}

