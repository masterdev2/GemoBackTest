<?php
namespace App\Manager;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LangManager
{
    public function __construct()
    {
    }

    // Calcul number of lang utilisation
    public function numRepousingLanguage($lang, $langs)
    {
        $num = 0;
        foreach($langs as $l){
            if($l['language'] == $lang){
                $num++;
            }
        }
        return $num;
    }

    // Get Repos wprking with a specific lang
    public function listRepousingLanguage($lang, $langs)
    {
        $repos = [];
        foreach($langs as $l){
            if($l['language'] == $lang){
                $repos[] = [ 'nameRepo' => $l['name'], 'repoUrl' => $l['repoUrl'] ];
            }
        }
        return $repos;
    }
}