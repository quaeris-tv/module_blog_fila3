## Gestione delle pagine

![page_list](img/page_list.jpg)
![page_edit](img/page_edit.jpg)

Sfruttando le potenzialità di Filament, è possibile gestire le pagine che verranno visualizzate del tema frontend, dando la possibilità di creare e modificare le pagine necessarie per il tuo progetto.

## Contenuti delle pagine, i blocchi

Quando si crea o si modifica una pagina, è possibile determinare il suo contenuto tramite i blocchi del builder,  
oggetti che aiutano a configurare e costruire vari componenti dell'interfaccia utente in modo dichiarativo
Questi blocchi sono spesso utilizzati per strutturare e organizzare il contenuto in modo chiaro e modulare.

I vari blocchi disponibili si possono trovare nella cartella Blocks dei moduli utilizzati.

## Creare una Classe Content

All'interno di un file Resource di Filament, inserire dentro il form

```php
Forms\Components\Section::make('Page Content')->schema([
    PageContent::make('content_blocks')
        ->label('Blocchi Contenuto')
        ->required()
        ->columnSpanFull(),
]),

// oppure

Forms\Components\Section::make('Sidebar Content')->schema([
    LeftSidebarContent::make('sidebar_blocks')
        ->label('Blocchi Sidebar')
        ->columnSpanFull(),
]),


```
![page_create](img/page_create.jpg)

per poter poi configurare i blocchi che verranno utilizzati nella pagina.

Ecco un esempio di classe content, in questo caso per determinare il contenuto di una pagina articolo

```php
class ArticleContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                Title::make(context: $context),
                Paragraph::make(context: $context),
                ImageSpatie::make(context: $context),
                ImagesGallery::make(context: $context),
                Rating::make(context: $context),
                Chart::make(context: $context),
                // altri tipi di blocchi...
            ])
            ->collapsible();
    }
}
```