<?php
namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use App\Fetcher\Fetch;
use App\Manager\LangManager;

class ApiController extends Controller
{
    protected $em;
    protected $fetch;
    protected $langManager;
    public function __construct(EntityManagerInterface $em,Fetch $fetch, LangManager $langManager)
    {
        $this->em = $em;
        $this->fetch = $fetch;
        $this->langManager = $langManager;
    }

     /**
     * @Route("/api/home" , name="home_api")
     */
    public function HomeApi(Request $request)
    {
        return new JsonResponse(array('response'=>'This is securized api rest!'));
    }

    /**
     * @Route("/public/api/popularLanguages" , name="popularLanguages")
     */
    public function popularLanguages(Request $request)
    {
        $items = $this->fetch->getLanguages();
        $response = [];

        foreach($items as $item){
            if($item['language']){
                $response[$item['language']]['language'] = $item['language'];
                $response[$item['language']]['numbRepos'] = $this->langManager->numRepousingLanguage($item['language'], $items); 
                $response[$item['language']]['listRepos'] = $this->langManager->listRepousingLanguage($item['language'], $items); 
            }
        }
        return new JsonResponse($response);
    }
}