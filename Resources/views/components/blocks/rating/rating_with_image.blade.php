@props([
    'tpl',
    'version' => 'v1',
])
<div>
<<<<<<< HEAD
  <livewire:article.ratings-with-image :article="$model" type="show"/>
=======
  <livewire:article.ratings-with-image :article="$model" type="show" :ratings="[]" :article_uuid="$model->uuid"/>
>>>>>>> origin/dev
</div>
