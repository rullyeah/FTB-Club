<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Language;
use AppBundle\UserCases\CreateLanguageRequest;
use AppBundle\UserCases\CreateLanguageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LanguageController extends Controller
{
    /**
     * @Route("/panel/language", name="list-languages")
     */
    public function indexAction()
    {
        $languages = $this->getDoctrine()
            ->getRepository(Language::class)
            ->findAll();

        return $this->render('language/list.html.twig', array('items' => $languages));
    }

    /**
     * @Route("/panel/language/edit/{slug}", name="edit-language")
     */
    public function editLanguageAction(Request $request, $slug)
    {

        $language = $this->getDoctrine()
            ->getRepository(Language::class)
            ->find($slug);

        $form = $this->createFormBuilder(
            array('name' => $language->name(), 'locale' => $language->locale()))
            ->add('name', TextType::class)
            ->add('locale', TextType::class)
            ->add('send', SubmitType::class, array('label' => 'Edit Language'))
            ->getForm();

        $form->handleRequest($request);

        if ($form ->isSubmitted()) {
            $data = $form->getData();
            $language->changeName($data['name']);
            $language->changeLocale($data['locale']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            return $this->redirect($this->generateUrl('single-language', array('slug' => $language->id())));
        }

        return $this->render('language/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/panel/language/create", name="create-language")
     */
    public function createLanguageAction(Request $request)
    {

        $language = null;

        $form = $this->createFormBuilder($language)
            ->add('name', TextType::class)
            ->add('locale', TextType::class)
            ->add('send', SubmitType::class, array('label' => 'Create Language'))
            ->getForm();

        $form->handleRequest($request);

        if ($form ->isSubmitted()) {
            $data = $form->getData();

            $language = (new CreateLanguageService())->execute(new CreateLanguageRequest($data['name'],$data['locale']));

            $em = $this->getDoctrine()->getManager();
            $em->persist($language);
            $em->flush();

            return $this->redirect($this->generateUrl('single-language', array('slug' => $language->id())));
        }

        return $this->render('language/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/panel/language/{slug}", name="delete-language")
     * @Method("DELETE")
     */
    public function deleteLanguageAction($slug)
    {
        if ( empty($slug)) {
            return new Response('Not exists', 204);
        }

        $em = $this->getDoctrine()
            ->getManager();

        $language = $em->getRepository(Language::class)->find($slug);

        if ( $language == null) {
            return new Response('Not exists', 204);
        }

        $em->remove($language);
        $em->flush();

        return new Response('Deleted', 202);

    }

    /**
     * @Route("/panel/language/{slug}", name="single-language")
     */
    public function detailLanguageAction($slug = '')
    {
        if ( !empty($slug)){
            $language = $this->getDoctrine()
                ->getRepository(Language::class)
                ->find($slug);

            return $this->render('language/single.html.twig', array('language' => $language));


        } else {
            return new Response('<pre>'.print_r('Nothing',1).'</pre>');
        }
    }
}
