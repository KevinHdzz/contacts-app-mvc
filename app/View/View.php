<?php

namespace ContactsApp\View;

use Exception;

class View {
    /**
     * Renders a view.
     * 
     * @param string $view             View file name (without .php extension).
     * @param array $data  [Optional]  An associative array of data to pass to the view.
     * 
     * @throws Exception  If the view file is not found.
     */
    static function render(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . "/../../views/$view.php";

        if (!file_exists($viewFile)) {
            throw new Exception("View file not found: $viewFile");
        }

        include_once $viewFile;
    }
}
