<?php

namespace Class;

class Renderer
{

//    public function __construct(private string $viewPath, private ?array $params)
//    {
//    }
//
//    public function view()
//    {
//        ob_start();
//
//        extract($this->params);
//
//        require BASE_VIEW_PATH . $this->viewPath . '.php';
//
//        return ob_get_clean();
//    }
//
//    public static function make(string $viewPath, array $params = []): static
//    {
//        return new static($viewPath, $params);
//    }
//
//    public function __toString()
//    {
//        return $this->view();
//    }

    private string $viewType;
    private string $viewPath;
    private ?array $params;

    public function __construct(string $viewPath, ?array $params = [], string $viewType = 'public')
    {
        $this->viewPath = $viewPath;
        $this->params = $params;
        $this->viewType = $viewType;
    }

    public function view()
    {
        ob_start();
        extract($this->params);

        $baseViewPath = $this->getBaseViewPath();
        require $baseViewPath . $this->viewPath . '.php';

        return ob_get_clean();
    }

    private function getBaseViewPath(): string
    {
        switch ($this->viewType) {
            case 'admin':
                return BASE_ADMIN_VIEW_PATH;
            default:
                return BASE_VIEW_PATH;
        }
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