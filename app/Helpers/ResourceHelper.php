<?php
namespace App\Helpers;

class ResourceHelper
{
    public static function getFirstMediaOriginalUrl($object, string $relationName = 'avatar', string $defaultImageName = 'store.png', bool $shouldReturnDefault = true)
    {
        if ($object->relationLoaded($relationName)) {
            return collect($object->getRelation($relationName)->first())->get('original_url') ?: ($shouldReturnDefault ? asset('/storage/default/' . $defaultImageName) : null);
        }

        return null;
    }
}
