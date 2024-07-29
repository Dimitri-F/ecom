<?php

namespace Class;

class Renderer
{
    private string $viewType;
    private string $viewPath;
    private ?array $params;

    public function __construct(string $viewPath, ?array $params = [], string $viewType = 'public')
    {
        $this->viewPath = $viewPath;
        $this->params = $params;
        $this->viewType = $viewType;
    }

    public function view(): bool|string
    {
        ob_start();
        extract($this->params);

        $baseViewPath = $this->getBaseViewPath();
        require $baseViewPath . $this->viewPath . '.php';

        return ob_get_clean();
    }

    private function getBaseViewPath(): string
    {
        return match ($this->viewType) {
            'admin' => BASE_ADMIN_VIEW_PATH,
            default => BASE_VIEW_PATH,
        };
    }

    public static function make(string $viewPath, array $params = [], string $viewType = 'public'): static
    {
        return new static($viewPath, $params, $viewType);
    }

    public function __toString()
    {
        return $this->view();
    }

}