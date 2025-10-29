<?php

namespace Framework;

interface TemplateViewerInterface
{
    public function render($template, array $data = []): string;
}