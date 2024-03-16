@props([
    'tpl',
    'version' => 'v1',
])
<div>
  <livewire:article.ratings-with-image :article="$model" type="show"/>
</div>
