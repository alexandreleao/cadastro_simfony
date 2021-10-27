<?php
 
 namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\Request;

 /**
  *  @Route("/", name="web_usuario_")
  */

  class UsuarioController extends AbstractController
 {
    /**
     * @Route("/", methods={"GET"}, name="index")
     */

    public function index(): Response 
    {
        return $this->render("usuario/form.html.twig");

    }

   /**
    * @Route("/salvar", methods={"POST"}, name="salvar")
    */

    Public function salvar(Request $request): Response
    {

        $salvar = $request->request->all();

        $usuario = new Usuario;
        $usuario->setNome($salvar['nome']);
        $usuario->setEmail($salvar['email']);

        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->persist($usuario);
        $doctrine->flush();
      

        if($usuario->getId() )
        {
            return $this->render("usuario/sucesso.html.twig",[
                "usuario" => $usuario->getNome()
            ]);
        } else {
            return $this->render("usuario/erro.html.twig",[
                "usuario" => $usuario->getNome()
            ]);
        }

    }
}