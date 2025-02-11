<?php

namespace App\MVC;

class View
{
    public string $content = '';

    public function __construct(public string $layout)
    {
    }

    public function render($view, $data = [], $layout = ''): string
    {
        extract($data);
        $viewFile = RESOURCES . "/{$view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require $viewFile;
            $this->content = ob_get_clean();
        } else {
            abort("Not found view {$viewFile}", 500);
        }


        if ($layout === false) {
            return $this->content;
        }

        $layoutFileName = $layout ?: $this->layout;
        $layoutFile = LAYOUTS . "/{$layoutFileName}.php";

        if (is_file($layoutFile)) {
            ob_start();
            require_once $layoutFile;
            return ob_get_clean();
        } else {
            abort("Not found layout {$layoutFile}", 500);
        }
        return '';
    }
}