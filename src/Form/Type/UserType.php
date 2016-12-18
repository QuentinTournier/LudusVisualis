<?php
namespace LudusVisualis\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class UserType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $passwordText = 'Password';
        $passwordTextConfirm = 'Password (Confirm)';
        $builder
            ->add('username', 'text')
            ->add('userlastname', 'text')
            ->add('address', 'text')
            ->add('zip', 'text')
            ->add('city', 'text')
            ->add('email', 'email') 
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'options'         => array('required' => true),
                'first_options'   => array('label' => $passwordText),
                'second_options'  => array('label' => $passwordTextConfirm),
            ))
            ->add('role', 'choice', array('choices' => array('ROLE_USER' => 'User' )
            ));
    }
    
    public function getName()
    {
        return 'user';
    }
}