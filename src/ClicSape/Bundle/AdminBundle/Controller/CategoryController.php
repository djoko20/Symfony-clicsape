<?php

namespace ClicSape\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ClicSape\Bundle\ClotheBundle\Entity\Category;
    
class CategoryController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repoCat = $em->getRepository('ClicSapeClotheBundle:Category');
        $listCat = $repoCat->findAll();
                
        return $this->render('ClicSapeAdminBundle:Category:list.html.twig', array(
                "listCat" => $listCat
            ));
    }

    public function addAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('category_type', $category);
       
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            
            return $this->forward('ClicSapeAdminBundle:Category:list');
        }
        
        return $this->render('ClicSapeAdminBundle:Category:add.html.twig', array(
                "form" => $form->createView()
            ));    
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repoCat = $em->getRepository('ClicSapeClotheBundle:Category');
        $category = $repoCat->find($id);
        
        $form = $this->createForm('category_type', $category);
        $request = Request::createFromGlobals();
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            
            return $this->forward('ClicSapeAdminBundle:Category:list');
        }
        
        return $this->render('ClicSapeAdminBundle:Category:edit.html.twig', array(
                'category' => $category,
                'form' => $form->createView()
            ));            return new Response($content);
    }

    public function deleteAction(Request $request)
    {
        if($request->get('id') == null){
            throw $this->createNotFoundException('parameter missing');
        }
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('ClicSapeClotheBundle:Category');       
        $category = $repo->find($id);
        
        if($category !== null){
            $em->remove($category);
            $em->flush();
            return new Response(json_encode(true));
        }else{
            throw $this->createNotFoundException('No country found for id : '.$id);
        }
    }
    
    public function allAction(){
        $em = $this->getDoctrine()->getManager();
        $repoCat = $em->getRepository('ClicSapeClotheBundle:Category');
        $listCat = $repoCat->findAll();
        
        $content = $this->renderView('ClicSapeAdminBundle:Global:table.html.twig', array(
           'entities' => $listCat
        ));
        
        return new Response($content);
    }
    
    public function filterAction(Request $request)
    {   
        $filters = $request->get('filter');
        $entityJoin = $request->get('entityJoin');
        $categoryManager = $this->get('category_manager');
        $listCat = '';
        if($filters !== null){            
            $listCat = $categoryManager->findByFilter($filters);            
        }
        elseif($entityJoin !== null){   
            $data = $request->get('data');
            $listCat = $categoryManager->findByFilterJoin($entityJoin, $data);
        }
        else{
            $listCat = $categoryManager->findAll();
        }
        $content = $this->renderView('ClicSapeAdminBundle:Category:list_content.html.twig', array(
                'listCat' => $listCat
            ));
        return new Response($content);
    }
}
