<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class ValidationHelper
{
    /**
     * Build validation rules for dynamic custom fields.
     *
     * @param Collection $fields The collection of field models (e.g., PengajarField, SantriField)
     * @param array $baseRules The base validation rules to merge into
     * @param string $prefix The prefix for the field names in the request (e.g., 'additional_data.')
     * @return array
     */
    public static function buildCustomFieldRules(Collection $fields, array $baseRules = [], string $prefix = 'additional_data.'): array
    {
        $rules = $baseRules;

        foreach ($fields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            
            if (isset($field->type) && $field->type === 'number') {
                $rule .= '|numeric';
            }
            
            $rules[$prefix . $field->name] = $rule;
        }

        return $rules;
    }
}
