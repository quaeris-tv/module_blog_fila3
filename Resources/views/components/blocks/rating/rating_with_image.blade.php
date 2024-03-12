@props([
    'tpl',
    'version' => 'v1',
])
<div>
  <livewire:article.ratings-with-image :article="$model" :tpl="$_tpl"/>
</div>
