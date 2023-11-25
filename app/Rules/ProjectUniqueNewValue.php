<?php

namespace App\Rules;

use App\Models\Project;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ProjectUniqueNewValue implements ValidationRule
{
    private readonly string $dbProperty;
    private $existingValue;
    private $propertyId;

    public function __construct(string $dbProperty, $existingValue, $propertyId)
    {
        $this->dbProperty = $dbProperty;
        $this->existingValue = $existingValue;
        $this->propertyId = $propertyId;
    }


    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value == $this->existingValue || $value === null) {
            return;
        }

        $valueExists = Project::where([
            [$this->dbProperty, '=', $value],
            ['id', '!=', $this->propertyId]
        ])->exists();

        if($valueExists) {
            $fail(":attribute a déjà été utilisé");
        }
    }
}
