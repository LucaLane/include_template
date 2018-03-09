<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'include template',
    'description' => 'Basic extension which acts as interface for the template folder.',
    'category' => 'frontend',
    'author' => 'Luca Aebischer',
    'author_email' => 'luca.aebischer@cabag.ch',
    'author_company' => 'cab services ag',
    'state' => 'stable',
    'uploadfolder' => '0',
    'clearCacheOnLoad' => 1,
    'version' => '2.0.1',
    'constraints' => array(
        'depends' => array(
            'typo3' => '8.7.0-9.5.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
