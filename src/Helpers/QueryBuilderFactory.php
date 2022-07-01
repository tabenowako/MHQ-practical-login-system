<?php 

namespace App\Helpers;
use App\Database\PDOConnection;
use App\Database\PDOQueryBuilder;
use App\Helpers\Config;
use App\Database\QueryBuilder;

class QueryBuilderFactory{ //connect application to database default pdo connection and get query builder

    public static function make(string $credentialFile = "database", string $credentialType = "pdo", array $options = []): QueryBuilder{

        $connection = null;
        $credentials = array_merge(Config::get($credentialFile, $credentialType), $options);

        switch($credentialType){
            case 'pdo':
                 $connection = (new PDOConnection($credentials))->connect();
                 return new PDOQueryBuilder($connection);
            break;
            default:
            //throw exception
        }
    }

    //DB connection can be set to a singleton if required.
}

?>