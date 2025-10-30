<?php

namespace Framework;

//Blueprint for view templates
interface TemplateViewerInterface
{
    public function render($template, array $data = []): string;
}