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

## Inserire le dipendenze
Per installare correttamente il modulo Blog è necessario installare le dipendenze dei 3 seguenti moduli:

- [UI](https://github.com/aurmich/module_ui_fila3/blob/dev/README.md)
- [Xot](https://github.com/aurmich/module_xot_fila3/blob/dev/README.md)
- [Tenant](https://github.com/aurmich/module_tenant_fila3/blob/dev/README.md)

## [Gestione delle pagine frontend](docs/pages.md)
