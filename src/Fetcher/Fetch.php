<?php
namespace App\Fetcher;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use GuzzleHttp\Client;

class Fetch
{
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getLanguages()
    {
        //get date before 30 days
        $datebefore30days = date('Y-m-d', strtotime('-30 days'));
        //curl initialise
        $chL = curl_init();
        curl_setopt($chL, CURLOPT_URL, 'https://api.github.com/search/repositories?q=created:>'.$datebefore30days.'&sort=stars&order=desc');
        curl_setopt($chL, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($chL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($chL, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($chL, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0');
        //get response
        $responseL = curl_exec($chL);
        // encode response
        $res = json_decode($responseL);
        $repos = [];
        //prepare data to return
        foreach($res->items as $item){
            $repo = [];
            $repo['language'] = $item->language;
            $repo['name'] = $item->full_name;
            $repo['repoUrl'] = $item->html_url;
            $repos[] = $repo;
        }
        return $repos;
    }
}