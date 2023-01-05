<?php declare(strict_types=1);
namespace DBManager;
use mysqli;
class DBManager {
    protected array $_config;
    public function __construct() {
        return $this;
    }
    public function addHost(string $name,string $hostname,string $username,string $password,string $schema='',string $charset='utf8mb4',int $port=3306) : self {
        $this->_config[$name] = array(
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'schema' => $schema,
            'port' => $port,
            'charset' => $charset
        );
        return $this;
    }
    public function newClient(string $name) : ?mysqli {
        if(isset($this->_config[$name])){
            $client = @new mysqli(
                $this->_config[$name]['hostname'],
                $this->_config[$name]['username'],
                $this->_config[$name]['password'],
                $this->_config[$name]['schema'],
                $this->_config[$name]['port']
            );
            if($client->connect_error) return null;
            @$client->set_charset($this->_config[$name]['charset']);
            return $client;
        }
        return null;
    }
}