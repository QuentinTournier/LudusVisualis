<?php
$container->loadFromExtension('security', array(
    'providers' => array(
        'our_db_provider' => array(
            'entity' => array(
                'class'    => 'AppBundle:User',
                'property' => 'username',
            ),
        ),
    ),
));