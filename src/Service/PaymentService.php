<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Classe PAyment Services dédiée à la gestion des paiements  des abonnements des utilisateurs 
 */

 class PaymentServices extends AbstractService
 {
    public function __construct(
        private readonly ParameterBagInterface $params,
        private readonly ParameterBag $em,
    )
    {
        parent::__construct();
    }
 }