<?php
namespace App\Traits;

/**
 * generate active identifier from is_active attributes
 */
trait ActiveIdentifier
{

    public function getActiveIdentifier($status)
    {
        $identifier = [
            0 => [
                'text-class' => 'text-danger',
                'row-class' => 'bg-danger',
                'label' => "<i class='fas fa-exclamation'></i> Not Active",
            ],
            1 => [
                'text-class' => '',
                'row-class' => '',
                'label' => "<i class='fas fa-check'></i> Active",
            ]
        ];

        return $identifier[$status];
    }
}
