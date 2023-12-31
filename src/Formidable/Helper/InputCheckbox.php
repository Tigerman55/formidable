<?php

declare(strict_types=1);

namespace Formidable\Helper;

use DOMDocument;
use Formidable\Field;

final class InputCheckbox
{
    use AttributeTrait;

    public function __invoke(Field $field, array $htmlAttributes = []): string
    {
        $htmlAttributes['type']  = 'checkbox';
        $htmlAttributes['id']    = 'input.' . $field->key;
        $htmlAttributes['name']  = $field->key;
        $htmlAttributes['value'] = 'true';

        if ($field->value === 'true') {
            $htmlAttributes['checked'] = 'checked';
        }

        $document = new DOMDocument('1.0', 'utf-8');
        $input    = $document->createElement('input');
        $document->appendChild($input);
        $this->addAttributes($input, $htmlAttributes);

        return $document->saveHTML($input);
    }
}
