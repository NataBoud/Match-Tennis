<?php

require_once('./Joueur.php');
require_once ('Tournoi.php');
include "tools.php";
abstract class MenuTemplate
{

    public static function  menuTemplate($choices) : string
    {
        do {
            foreach ($choices as $nb => $choice) {
                echo GREEN ." $nb. $choice" .RESET;
            }
            // Demande de saisie à l'utilisateur
            echo "Entrez le nombre correspondant à votre sélection : ";
            $userChoice = trim(fgets(STDIN));

            // Vérification de la validité de la saisie
            if (!in_array($userChoice, array_keys($choices))) {
                // Demande de saisie à nouveau
                echo RED . "Saisie erronée. Veuillez entrer un choix valide : ";
                $userChoice = trim(fgets(STDIN));
            }
        } while (!in_array($userChoice, array_keys($choices)));

        return $userChoice;
    }

    public static function menu(): void
    {
        echo YELLOW . "Menu :" . RESET . PHP_EOL;
        echo YELLOW . "1. Ajoutez au moins deux joueurs pour commencer le match" . RESET . PHP_EOL;
        echo RED . "2. Quitter" . RESET . PHP_EOL;
    }

    public static function afficherMenu($menu) : void
    {
        $choice = readline(GREEN . "Afficher le menu ? (y/n) " . RESET );
        match (strtolower($choice)) {
            "y" => self::menuUtilisateur($menu),
            "n" => exit(),
            default => RED ."Saisie invalide" . RESET . PHP_EOL
        };
    }
    public  function start($menu): void
    {
        self::menu();
        do {

            $choix = readline(YELLOW . "Choisissez une option : " . RESET );
            match ($choix) {
                '1' => $menu->ajouterJoueur(),
                '2' => exit(GREEN . "Fin du programme." . RESET . PHP_EOL),
                default =>  RED . "Veuillez choisir une option valide." . RESET . PHP_EOL
            };
        } while (count(Tournoi::listerJoueurs()) < 2);

        echo YELLOW . "Vous pouvez commencer jouer !". RESET . PHP_EOL;
        self::menuUtilisateur($menu);
    }

    public static function menuUtilisateur($menu): void
    {

        echo GREEN . "Menu :\n" . RESET;
        $mainMenuArray = array(
            1 =>  GREEN . "Ajouter un joueur\n",
            2 =>   "Modifier un joueur\n",
            3 =>  "Supprimer un joueur\n" ,
            4 =>  "Lister les joueurs\n",
//            5 =>  "Créer un match\n",
//            6 =>  "Lister les matchs\n" . RESET,
            7 =>  RED . "Quitter\n" . RESET,
        );
        $userChoice = self::menuTemplate($mainMenuArray);
        match ($userChoice) {
            '1' => $menu->ajouterJoueur(),
            '2' => $menu->modifierJoueur(),
            '3' => $menu->supprimerJoueur(),
            '4' => $menu->listerJoueurs(),
//            '5' => $this->creerMatch($tournoi),
//            '6' => $this->listerMatchs($tournoi),
            '7' => exit("Fin du programme." . PHP_EOL),
            default => RED . "Veuillez choisir une option valide.". RESET . PHP_EOL
        };
    }

}



