<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Salutation
{
    public string $name = 'User';

    public function getSalutation(): string
    {
        $hour = (int) date('H'); //Récupère l'heure actuelle

        if($hour >= 5 && $hour < 18) {
            return 'Bonjour';

        } elseif ($hour>= 18 && $hour <23) {
        
            return 'Bonsoir';
        }else {
            return 'Il est tard 😩😄';
        }
    }
}
