<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMINISTRATOR = "ADMINISTRATOR";
    case PROJECT_HOLDER = "PROJECT_HOLDER";
    case EMPLOYEE = "EMPLOYEE";
    public static function getLabel(?string $label): ?string
    {
        if(!$label) {
            return null;
        }

        $labels = [
            self::ADMINISTRATOR->value => "Administrateur",
            self::PROJECT_HOLDER->value => "Porteur de projet",
            self::EMPLOYEE->value => "Employée",
        ];

        return $labels[$label] ?? "Role inconnu";
    }
}
