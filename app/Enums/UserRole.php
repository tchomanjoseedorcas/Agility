<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMINISTRATOR = "ADMINISTRATOR";
    case PROJECT_HOLDER = "PROJECT_HOLDER";
    public static function getLabel(?string $label): ?string
    {
        if(!$label) {
            return null;
        }

        $labels = [
            self::ADMINISTRATOR->value => "Administrateur",
            self::PROJECT_HOLDER->value => "Porteur de projet",
        ];

        return $labels[$label] ?? "Role inconnu";
    }
}
