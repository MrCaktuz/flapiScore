<?php
namespace Controller;

use Model\Scores;

class ScoreController
{
    private $scores_model = null;

    public function __construct() {
        $this -> scores_model = new Scores;
    }

    public function index() {
        return $this -> scores_model -> topScores();

    }

    public function store() {
        if ( isset( $_POST[ 'score' ] ) ) {
            $score = intval( $_POST[ 'score' ] );
            $scores = $this -> scores_model -> save( $score );
            $message = 'Votre score a bien été enregistré !';

            return [
                'success' => $message
            ];
        } else {
            $message = 'Votre requète n\'as pas été envoyée';

            return[
                'error' => $message
            ];
        }
    }

}
