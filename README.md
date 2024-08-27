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

- [UI](https://github.com/laraxot/module_ui_fila3/blob/dev/README.md)
- [Xot](https://github.com/laraxot/module_xot_fila3/blob/dev/README.md)
- [Tenant](https://github.com/laraxot/module_tenant_fila3/blob/dev/README.md)

Leggere ed eseguire correttamente le istruzioni all'interno dei file README.md di ciascuno di questi moduli

## [Gestione delle pagine frontend](docs/pages.md)

## Contenuti

* Articoli
* Categorie
* Banner
* Profili

### Articoli

##### Accesso

L'accesso alla sezione si effettua cliccando sulla voce "Articoli" del menu laterale.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723029281966](docs/img/1723029281966.png)
=======
![1723029281966](image/README/1723029281966.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723029281966](docs/img/1723029281966.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723029281966](docs/img/1723029281966.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

##### Creazione di un nuovo articolo

* Cliccare sul pulsante in alto a destra "Nuovo"
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
* Inserire tutte le informazioni necessarie (segnate con *) e utili per rendere più chiara ed esaustiva l'indagine che si vuole creare![1723030063173](docs/img/1723030063173.png)La struttura di un articolo ha una composizione "a blocchi", è possibile cioè inserire tipologie diverse di elementi quali "Titolo", "Paragrafo", "Immagine", "Carosello di immagini", "Opzione di risposta" e "Grafico" e spostarli all'interno della composizione stessa della pagina trascinando i blocchi interessati sopra o sotto.
=======
* Inserire tutte le informazioni necessarie (segnate con *) e utili per rendere più chiara ed esaustiva l'indagine che si vuole creare![1723030063173](image/README/1723030063173.png)La struttura di un articolo ha una composizione "a blocchi", è possibile cioè inserire tipologie diverse di elementi quali "Titolo", "Paragrafo", "Immagine", "Carosello di immagini", "Opzione di risposta" e "Grafico" e spostarli all'interno della composizione stessa della pagina trascinando i blocchi interessati sopra o sotto.
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
* Inserire tutte le informazioni necessarie (segnate con *) e utili per rendere più chiara ed esaustiva l'indagine che si vuole creare![1723030063173](docs/img/1723030063173.png)La struttura di un articolo ha una composizione "a blocchi", è possibile cioè inserire tipologie diverse di elementi quali "Titolo", "Paragrafo", "Immagine", "Carosello di immagini", "Opzione di risposta" e "Grafico" e spostarli all'interno della composizione stessa della pagina trascinando i blocchi interessati sopra o sotto.
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
* Inserire tutte le informazioni necessarie (segnate con *) e utili per rendere più chiara ed esaustiva l'indagine che si vuole creare![1723030063173](docs/img/1723030063173.png)La struttura di un articolo ha una composizione "a blocchi", è possibile cioè inserire tipologie diverse di elementi quali "Titolo", "Paragrafo", "Immagine", "Carosello di immagini", "Opzione di risposta" e "Grafico" e spostarli all'interno della composizione stessa della pagina trascinando i blocchi interessati sopra o sotto.
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

  Al termine della creazione, per salvare il nuovo articolo è sufficiente cliccare sul pulsante "Salva".

### Categorie

Come il nome suggerisce, rappresentano i temi che contraddistinguono gli articoli/indagini all'interno della piattaforma. Ogni Articolo appartiene ad una specifica Categoria.

##### Accesso

L'accesso alla sezione si effettua cliccando sulla voce "Categorie" dal menu laterale.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723122503024](docs/img/1723122503024.png)
=======
![1723122503024](image/README/1723122503024.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723122503024](docs/img/1723122503024.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723122503024](docs/img/1723122503024.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

Le categorie principali corrispondono a "Sport", "Politica", "Scienza", "Intrattenimento", "Affari e finanze".

##### Creazione di una nuova categoria

Per inserire una nuova categoria è sufficiente cliccare sul pulsante in alto a destra "Nuovo".

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723123593783](docs/img/1723123593783.png)
=======
![1723123593783](image/README/1723123593783.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723123593783](docs/img/1723123593783.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723123593783](docs/img/1723123593783.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

Per completare l'inserimento di una nuova categoria è necessario compilare tutti i campi obbligatori quali "Titolo della categoria" e "slug".

Per rendere una categoria più chiara ed esauriente è possibile inserire una breve descrizione della stessa, caricare un'immagine e/o un'icona che la rappresenti.

Al termine della creazione, per salvare la nuova categoria è sufficiente cliccare sul pulsante "Salva".

### Banners

I Banners rappresentano le copertine che sfogliano a modi carosello nella Homepage della piattaforma.

##### Accesso

Per accedere alla lista dei banners è sufficiente cliccare sulla voce "Banners" dal menu laterale.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723126923298](docs/img/1723126923298.png)
=======
![1723126923298](image/README/1723126923298.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723126923298](docs/img/1723126923298.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723126923298](docs/img/1723126923298.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

##### Creazione di un nuovo banner

Per aggiungere un nuovo banner si deve cliccare sul pulsante in alto a destra "Nuovo".

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723127052220](docs/img/1723127052220.png)
=======
![1723127052220](image/README/1723127052220.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723127052220](docs/img/1723127052220.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723127052220](docs/img/1723127052220.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

Per completare l'inserimento è necessario compilare tutti i campi obbligatori (contraddistinti dal *), quali "Titolo", "Descrizione" e "Category ID". Gli altri campi non sono obbligatori ma sono utili per rendere più chiara l'utilità del banner in questione.

Al termine della creazione, per salvare il nuovo banner è sufficiente cliccare sul pulsante "Salva".

### Profili

Come il nome suggerisce, è la sezione in cui si possono consultare tutti i profili registrati nella piattaforma.

##### Accesso

Per accedere alla lista dei profili, è sufficiente cliccare sulla voce "Profili" dal menu laterale.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723128470387](docs/img/1723128470387.png)
=======
![1723128470387](image/README/1723128470387.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723128470387](docs/img/1723128470387.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723128470387](docs/img/1723128470387.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

##### Creazione di un nuovo profilo

Per creareun nuovo profilo, cliccare sul pulsante "Nuovo" in alto a destra.

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
![1723128759093](docs/img/1723128759093.png)
=======
![1723128759093](image/README/1723128759093.png)
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
![1723128759093](docs/img/1723128759093.png)
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
![1723128759093](docs/img/1723128759093.png)
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1

Le informazioni più importanti da inserire per ogni profilo sono "Username", "email", "First Name" e "Last Name". Le prime due sono voci univoche, non è possibile avere due profili con lo stesso Username o con lo stesso indirizzo email.

Per terminare la creazione di un nuovo profilo, è sufficiente cliccare sul pulsante "Salva".
