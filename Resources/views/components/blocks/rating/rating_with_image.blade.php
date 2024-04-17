@props([
    'tpl',
    'version' => 'v1',
])
<<<<<<< HEAD
{{-- {{ dddx(get_defined_vars()) }} --}}
<div>
  {{-- <livewire:article.ratings :article="$model" :tpl="$_tpl"/> --}}
  {{-- <livewire:article.ratings2 :article="$model" :tpl="$_tpl"/> --}}
=======
<div>
  <livewire:article.ratings-with-image :article="$model" type="show" :ratings="[]" :article_uuid="$model->uuid"/>
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
</div>
