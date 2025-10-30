<?php

declare(strict_types=1);


namespace Framework;

//View template. Support default view syntax
class PHPTemplateViewer implements TemplateViewerInterface
{
    public function render($template, array $data = []): string
    {
        extract($data, EXTR_SKIP);

        ob_start();

        require dirname(__DIR__,2)."/views/$template";

        return ob_get_clean();
    }
}