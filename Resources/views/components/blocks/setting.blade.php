@props([
    'tpl',
    'version' => 'v1',
])
{{-- {{ dddx([$tpl, $version]) }} --}}
<div>
  {{-- @include('blog::components.blocks.'.$tpl.'.'.$version) --}}
  <livewire:profile.setting :tpl="$tpl" :version="$version" />
</div>
