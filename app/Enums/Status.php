<?php

namespace App\Enums;

enum Status: string
{
    case NEW = "NEW";
    case ACTIVE = "ACTIVE";
    case HOLD = "HOLD";
    case FINISHED = "FINISHED";


    public static function getLabel(string $enum): object
    {
        return (object) match ($enum) {
            Status::NEW->value => [
                "id" => 1,
                "value" => Status::NEW->value
            ],
            Status::ACTIVE->value => [
                "id" => 2,
                "value" => Status::ACTIVE->value
            ],
            Status::HOLD->value => [
                "id" => 3,
                "value" => Status::HOLD->value
            ],
            Status::FINISHED->value => [
                "id" => 4,
                "value" => Status::FINISHED->value
            ],
            default => [
                "id" => null,
                "value" => null,
            ],
        };
    }
}
