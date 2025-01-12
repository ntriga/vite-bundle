<?php

namespace Pentatrion\ViteBundle\Twig;

use Pentatrion\ViteBundle\Service\EntrypointRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EntryFilesTwigExtension extends AbstractExtension
{
    private $entrypointRenderer;

    public function __construct(EntrypointRenderer $entrypointRenderer)
    {
        $this->entrypointRenderer = $entrypointRenderer;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_entry_script_tags', [$this, 'renderViteScriptTags'], ['is_safe' => ['html']]),
            new TwigFunction('vite_entry_link_tags', [$this, 'renderViteLinkTags'], ['is_safe' => ['html']]),
            new TwigFunction('vite_entry_inline_tags', [$this, 'renderViteInlineTags'], ['is_safe' => ['html']]),
            new TwigFunction('vite_entry_lazy_link_tags', [$this, 'renderViteLazyLinkTags'], ['is_safe' => ['html']]),
            new TwigFunction('vite_mode', [$this, 'getViteMode']),
        ];
    }

    public function getViteMode(?string $configName = null): ?string
    {
        return $this->entrypointRenderer->getMode($configName);
    }

    public function renderViteScriptTags(string $entryName, array $options = [], ?string $configName = null): string
    {
        return $this->entrypointRenderer->renderScripts($entryName, $options, $configName);
    }

    public function renderViteLinkTags(string $entryName, array $options = [], ?string $configName = null): string
    {
        return $this->entrypointRenderer->renderLinks($entryName, $options, $configName);
    }

    public function renderViteLazyLinkTags(string $entryName, array $options = [], ?string $configName = null): string
    {
        return $this->entrypointRenderer->renderLazyLinks($entryName, $options, $configName);
    }

    public function renderViteInlineTags(string $entryName, array $options = [], ?string $configName = null): string
    {
        return $this->entrypointRenderer->renderInlineStyles($entryName, $options, $configName);
    }
}
