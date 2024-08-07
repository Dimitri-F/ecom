<?php

namespace Class;

class FormValidator
{
    /**
     * Valide et assainit les données du formulaire en vérifiant qu'elles sont présentes et correspondent aux types attendus.
     *
     * @param array $fields Tableau associatif où les clés sont les noms des champs et les valeurs sont les types attendus.
     * @return array Tableau contenant les données assainies et les erreurs. ['data' => $sanitizedData, 'errors' => $errors]
     */
    public static function validateForm(array $fields): array
    {
        $sanitizedData = [];
        $errors = [];

        foreach ($fields as $field => $type) {
            if (empty($_POST[$field])) {
                $errors[$field] = "Le champ $field est requis.";
                continue;
            }

            $value = $_POST[$field];

            switch ($type) {
                case 'int':
                    if (!filter_var($value, FILTER_VALIDATE_INT)) {
                        $errors[$field] = "Le champ $field doit être un entier valide.";
                    } else {
                        $sanitizedData[$field] = (int)$value;
                    }
                    break;
                case 'float':
                    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
                        $errors[$field] = "Le champ $field doit être un nombre décimal valide.";
                    } else {
                        $sanitizedData[$field] = (float)$value;
                    }
                    break;
                case 'string':
                    if (!is_string($value)) {
                        $errors[$field] = "Le champ $field doit être une chaîne de caractères.";
                    } else {
                        $sanitizedData[$field] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                    }
                    break;
                default:
                    $errors[$field] = "Le type du champ $field est invalide.";
            }
        }

        return ['data' => $sanitizedData, 'errors' => $errors];
    }
}