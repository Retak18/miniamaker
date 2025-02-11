<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Classe abstraite dédié au services
 */

 abstract class AbstractService
 {
    protected ParameterBagInterface $params;
    protected EntityManagerInterface $em;
    public function __construct(
        private readonly ParameterBagInterface $params,
        private readonly EntityManagerInterface $em
    )
    {
        $this->params
    }
 }