@props(['src', 'alt' => 'image', 'width' => '100', 'class' => 'img-thumbnail'])

<img src="{{ $src }}" width="{{ $width }}" alt="{{ $alt }}"
  class="{{ $class }}" {{ $attributes }}>
