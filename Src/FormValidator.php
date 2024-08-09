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

    /**
     * Valide et déplace un fichier uploadé (photo).
     *
     * @param string $field Le nom du champ dans le formulaire.
     * @param array $allowedTypes Les types MIME autorisés.
     * @param int $maxSize La taille maximale autorisée en octets.
     * @param string $uploadDir Le répertoire où stocker le fichier.
     * @return array Tableau contenant le chemin du fichier et les erreurs. ['filePath' => $filePath, 'error' => $error]
     */
    public static function validateFile(string $field, array $allowedTypes, int $maxSize, string $uploadDir): array
    {
        $error = null;
        $filePath = null;

        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$field]['tmp_name'];
            $fileName = basename($_FILES[$field]['name']);
            $fileSize = $_FILES[$field]['size'];
            $fileType = mime_content_type($fileTmpPath);

            // Vérifier le type MIME du fichier
            if (!in_array($fileType, $allowedTypes)) {
                $error = "Le fichier doit être de type : " . implode(", ", $allowedTypes) . ".";
                return ['filePath' => null, 'error' => $error];
            }

            // Vérifier la taille du fichier
            if ($fileSize > $maxSize) {
                $error = "Le fichier est trop volumineux. La taille maximale autorisée est de " . ($maxSize / 1024 / 1024) . " Mo.";
                return ['filePath' => null, 'error' => $error];
            }

            // Définir le chemin complet du fichier
            $filePath = $uploadDir . '/' . $fileName;

            // Déplacer le fichier vers le répertoire cible
            if (!move_uploaded_file($fileTmpPath, $filePath)) {
                $error = "Erreur lors du téléchargement de la photo.";
                return ['filePath' => null, 'error' => $error];
            }
        } else {
            $error = "Aucune photo téléchargée ou une erreur est survenue lors du téléchargement.";
        }

        return ['filePath' => $filePath, 'error' => $error];
    }
}