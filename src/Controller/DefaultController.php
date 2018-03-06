<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19.02.2018
 * Time: 11:10
 */
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Form\TaskType;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/show_admin")
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function show_admin($id=1)
    {
        $User = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        if (!$User) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('The UserName: '.$User->getUsername().' the Password'.$User->getPassword());

    }


    /**
     *@Route("/ff")
     */

    public function newform(Request $request)
    {


        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class,$task);
           /* ->add('task', TextType::class,array('required'=>false))
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            return $this->redirectToRoute('app_homepage',array('s'=>'task_success'));
        }
*/

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}