<?php

namespace App\Controller\Api;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/api/v1", name="api_v1_usuario_")
 */

class UsuarioController extends AbstractController
{
   /**
    * @Route("/lista", methods={"GET"}, name="lista")
    */

    public function lista(): Response
    {
        $doctrine = $this->getDoctrine()->getRepository(Usuario::class);

        return new Response($doctrine->pegarTodos());
    }

    /**
     * @Route("/cadastra", methods={"POST"}, name="cadastra")
     */

    public function cadastra(Request $request): Response
    {
        /*
        $string = "{\"nome\":\"juan\",\"email\":\"juan@gmail.com\"}";
        $arr = ['nome' => 'juan', 'email' => 'juan@gmail.com'];
        dump(json_decode($string, true));
        die();
        */
        
        $salvar= $request->request->all();
        $usuario = new Usuario;
        $usuario->setNome($salvar['nome']);
        $usuario->setEmail($salvar['email']);

        
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->persist($usuario);
        $doctrine->flush();
        

        
        
        if( $doctrine->contains($usuario) )
        {
            return new JsonResponse([
                'mensagem' => 'Usuário adicionado com sucesso!',
                'usuario' => [
                    'nome' => $usuario->getNome(),
                    'email' => $usuario->getEmail(),
                    'id' => $usuario->getId()
                ]
            ], 200);
            
        } else {
            return new Response("errado", 404);
        }

      
    }
}