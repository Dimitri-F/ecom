<?php

namespace Class;

/**
 * Class Renderer
 *
 * Cette classe est responsable du rendu des vues en fonction du type de vue (public ou admin) et des paramètres fournis.
 */
class Renderer
{
    private string $viewType;
    private string $viewPath;
    private ?array $params;

    /**
     * Constructeur de la classe Renderer.
     *
     * @param string $viewPath Chemin de la vue à rendre (sans l'extension .php).
     * @param array|null $params Paramètres à extraire et à rendre disponibles dans la vue.
     * @param string $viewType Type de vue (public ou admin), détermine le répertoire de base des vues.
     */
    public function __construct(string $viewPath, ?array $params = [], string $viewType = 'public')
    {
        $this->viewPath = $viewPath;
        $this->params = $params;
        $this->viewType = $viewType;
    }

    /**
     * Rendu de la vue.
     *
     * Cette méthode capture la sortie de la vue et retourne son contenu sous forme de chaîne de caractères.
     *
     * @return bool|string Le contenu de la vue rendu ou false en cas d'erreur.
     */
    public function view(): bool|string
    {
        ob_start();
        extract($this->params);

        $baseViewPath = $this->getBaseViewPath();
        require $baseViewPath . $this->viewPath . '.php';

        return ob_get_clean();
    }

    /**
     * Obtient le chemin de base des vues selon le type de vue (public ou admin).
     *
     * @return string Le chemin de base des vues.
     */
    private function getBaseViewPath(): string
    {
        return match ($this->viewType) {
            'admin' => BASE_ADMIN_VIEW_PATH,
            default => BASE_VIEW_PATH,
        };
    }

    /**
     * Crée une nouvelle instance de Renderer.
     *
     * @param string $viewPath Chemin de la vue à rendre (sans l'extension .php).
     * @param array $params Paramètres à extraire et à rendre disponibles dans la vue.
     * @param string $viewType Type de vue (public ou admin), détermine le répertoire de base des vues.
     * @return static Une instance de Renderer.
     */
    public static function make(string $viewPath, array $params = [], string $viewType = 'public'): static
    {
        return new static($viewPath, $params, $viewType);
    }

    /**
     * Méthode magique __toString.
     *
     * Permet de rendre la vue lorsque l'objet Renderer est traité comme une chaîne de caractères.
     *
     * @return string Le contenu de la vue rendu.
     */
    public function __toString(): string
    {
        return $this->view();
    }
}
