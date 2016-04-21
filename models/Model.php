<?php
namespace Model;

// Model\Model
class Model
{
    protected $cn = '';
    protected $table = '';

    function __construct() { // Je lie la DB ici.
        $dbConfig = parse_ini_file( 'db.ini' );

        $pdoOptions = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];
        try{
            $dsn = sprintf( '%s:host=%s;dbname=%s', $dbConfig[ 'driver' ], $dbConfig[ 'host' ], $dbConfig[ 'dbname' ] );
            $this -> cn = new \PDO( $dsn, $dbConfig[ 'username' ], $dbConfig[ 'password' ], $pdoOptions );
            $this -> cn -> exec( 'SET CHARACTER SET UTF8' );
            $this -> cn -> exec( 'SET NAMES UTF8' );
        } catch( \PDOException $e ) {
            die( $e -> getMessage() );
        }
    }

    public function all() { // Je récupère toutes les données de la DB ici.
        $sql = 'SELECT * FROM '.$this -> table;
        $stmnt = $this -> cn -> query( $sql );

        return $stmnt -> fetchAll();
    }

    public function save( $score ){
        $sql = sprintf( 'INSERT INTO %s (%s)
                VALUES( :score )', $this -> table, 'score' );

        $stmnt = $this -> cn -> prepare( $sql );
        $stmnt -> execute( [':score' => $score] );

        return $stmnt;
    }
}
