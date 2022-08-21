<?php

namespace App\ValueObjects;

class Image
{
    public function __construct(
        public readonly ?string $url,
        public readonly ?string $name,
    ) {
    }

    public static function from(?string $name): self
    {
        $url = $name ? route('image', ['image' => $name]) : null;

        return new static($url, $name);
    }

    public function __toString()
    {
        return $this->url;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
