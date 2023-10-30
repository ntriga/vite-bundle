<?php

namespace Pentatrion\ViteBundle\Asset;

class Tag
{
    public const SCRIPT_TAG = 'script';
    public const LINK_TAG = 'link';

    private string $tagName;
    private array $attributes;
    private string $content;
    private bool $internal;

    public function __construct($tagName, $attributes, $content = '', $internal = false)
    {
        $this->tagName = $tagName;
        $this->attributes = $attributes;
        $this->content = $content;
        $this->internal = $internal;
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }

    public function isScriptTag(): bool
    {
        return self::SCRIPT_TAG === $this->tagName;
    }

    public function isLinkTag(): bool
    {
        return self::LINK_TAG === $this->tagName;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string      $name  The attribute name
     * @param string|bool $value Value can be "true" to have an attribute without a value (e.g. "defer")
     */
    public function setAttribute(string $name, $value): self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function removeAttribute(string $name): self
    {
        unset($this->attributes[$name]);

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function removeContent(): self
    {
        $this->content = '';

        return $this;
    }

    public function isInternal(): bool
    {
        return $this->internal;
    }
}
