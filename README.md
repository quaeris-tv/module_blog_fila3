# Module Blog
Modulo dedicato alla gestione di un blog

## Aggiungere Modulo nella base del progetto
Dentro la cartella laravel/Modules

```bash
git submodule add https://github.com/laraxot/module_blog_fila3.git Blog
```

## Verificare che il modulo sia attivo
```bash
php artisan module:list
```
in caso abilitarlo
```bash
php artisan module:enable Blog
```

## Eseguire le migrazioni
```bash
php artisan module:migrate Blog
```