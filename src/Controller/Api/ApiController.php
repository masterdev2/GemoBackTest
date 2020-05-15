<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use App\Entity\Users;

class ApiController extends Controller
{
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

     /**
     * @Route("/api/home" , name="home_api")
     */
    public function HomeApi(Request $request)
    {
        return new JsonResponse(array('response'=>'This is securized api rest!'));
    }

    /**
     * @Route("/public/api/home" , name="home_public_api")
     */
    public function HomePublicApi(Request $request)
    {
        return new JsonResponse(array('response'=>'This is public api rest!'));
    }
}