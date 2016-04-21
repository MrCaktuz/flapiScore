<?php
namespace Model;

// Model\Comments
class Scores extends Model
{
    protected $table = 'scores';

    public function topScores() {
        $sql = sprintf( 'SELECT *
                FROM %s
                ORDER BY score DESC;', $this -> table );

        $stmnt = $this -> cn -> query( $sql );

        return $stmnt -> fetchAll();
    }
}
