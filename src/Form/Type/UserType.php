<?php
namespace LudusVisualis\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class UserType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $otpions)
    {
        $builder
            ->add('username', 'text')
            ->add('userlastname', 'text')
            ->add('adress', 'text')
            ->add('zip', 'text')
            ->add('city', 'text')
            ->add('email', 'email') 
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Mot de passe'),
                'second_options'  => array('label' => 'Mot de passe (confirmation)'),
            ))
            ->add('role', 'choice', array('choices' => array('ROLE_USER' => 'User' )
            ));
    }
    
    public function getName()
    {
        return 'user';
    }
}