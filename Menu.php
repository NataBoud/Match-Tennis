<?php


require_once('./Joueur.php');
require_once ('TennisMatch.php');
require_once ('Tournoi.php');
require_once ('MenuTemplate.php');

class Menu extends MenuTemplate
{

    public function __construct()  {

    }

    public function ajouterJoueur($menu): void
    {
        Tournoi::ajouterJoueur();
        count(Tournoi::listerJoueurs()) > 2 ? self::afficherMenu($menu) : null;
    }
    public function listerJoueurs($menu): void
    {
        $joueurs = Tournoi::listerJoueurs();
        foreach ($joueurs as $index => $joueur) {
            echo YELLOW ."Joueur numéro " . ($index + 1) . ": " . $joueur->getNom() . " " . $joueur->getPrenom() . " (Classement: " . $joueur->getClassement() . ")" . RESET . PHP_EOL;
        }
        self::afficherMenu($menu);
    }

    public function modifierJoueur($menu): void
    {
        $index = (int)readline(GREEN . "Numéro du joueur à modifier : " . RESET);
        $joueur = Tournoi::getJoueur($index - 1);
        Tournoi::modifierJoueur($index - 1, $joueur);
        self::afficherMenu($menu);
    }

    public function supprimerJoueur($menu): void
    {
        $index = (int)readline(GREEN . "Numéro du joueur à supprimer : ");
        Tournoi::supprimerJoueur($index - 1);
        self::afficherMenu($menu);
    }
}










