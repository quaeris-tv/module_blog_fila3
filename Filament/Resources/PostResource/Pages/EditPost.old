<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\PostResource;
use Savannabits\FilamentModules\Concerns\ContextualPage;
use Filament\Resources\Pages\Concerns\HasActiveLocaleSwitcher;
use Filament\Resources\Pages\Concerns\HasActiveFormLocaleSwitcher;

class EditPost extends EditRecord
{
    use ContextualPage;
    //use EditRecord\Concerns\Translatable;
    //use ListRecords\Concerns\Translatable;
    use HasActiveLocaleSwitcher;
    //use HasActiveFormLocaleSwitcher;

    protected static string $resource = PostResource::class;
    public $activeFormLocale = null;
    
    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    public function updatedActiveLocale(): void
    {   
        $this->syncInput(
            'activeFormLocale',
            $this->activeLocale,
        );
    }


    public function getRecordTitle(): string
    {
        if ($this->activeFormLocale) {
            $this->record->setLocale($this->activeFormLocale);
        }

        return parent::getRecordTitle();
    }

    public function updatedActiveFormLocale(): void
    {
        $this->fillForm();
    }

    

    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        
        if ($this->activeFormLocale === null) {
            $this->setActiveFormLocale();
        }
        

        $data = $this->record->attributesToArray();
        
        
        foreach (static::getResource()::getTranslatableAttributes() as $attribute) {
            //$data[$attribute] = $this->record->getTranslation($attribute, $this->activeFormLocale);
            $data[$attribute] = $this->record->translateOrNew($this->activeFormLocale)->{$attribute};
        }
        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    protected function setActiveFormLocale(): void
    {
        $resource = static::getResource();

        $availableLocales = array_keys($this->record->getTranslations($resource::getTranslatableAttributes()[0]));
        $resourceLocales = $this->getTranslatableLocales();
        $defaultLocale = $resource::getDefaultTranslatableLocale();

        $this->activeLocale = $this->activeFormLocale = in_array($defaultLocale, $availableLocales) ? $defaultLocale : array_intersect($availableLocales, $resourceLocales)[0] ?? $defaultLocale;
        $this->record->setLocale($this->activeFormLocale);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        
        $record->fill(Arr::except($data, $record->getTranslatableAttributes()));

        foreach (Arr::only($data, $record->getTranslatableAttributes()) as $key => $value) {
            //$record->setTranslation($key, $this->activeFormLocale, $value);
            $record->translateOrNew($this->activeFormLocale)->{$key}=$value;
        }
        
        $record->save();

        return $record;
    }
}
