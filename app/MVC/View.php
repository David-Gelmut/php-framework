<?php

namespace App\MVC;

class View
{
  //  public string $content = '';

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
            $content = ob_get_clean();
        } else {
            abort("Not found view {$viewFile}", 500);
        }

        if ($layout === false) {
            return $content;
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

    public function renderPartial($view, $data = []): string
    {
        extract($data);
        $viewFile = RESOURCES . "/{$view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require $viewFile;
            return ob_get_clean();
        } else {
            return "Not found view {$viewFile}";
        }
    }

    public function getAlerts(): void
    {
        if (!empty($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $key => $value) {
                echo $this->renderPartial(
                    "includes/alert_{$key}",
                    [
                        "flash_{$key}" => session()->getFlash($key)
                    ]);
            }
        }
    }

    public function getErrors(mixed $fieldname): string
    {
        $output = '';
        $errors = session()->get('form_errors');
        if (isset($errors[$fieldname])) {
            $output .= $this->renderPartial("includes/list_error", ['errors' => $errors[$fieldname]]);
        }
        return $output;
    }
}