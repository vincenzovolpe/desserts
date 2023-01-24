<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Vetrina Pasticceria  

    Esempio di vetrina di una pasticceria che vende dolci che hanno un nome ed un prezzo. Ogni dolce è composto da una lista di ingredienti. Ogni ingrediente quantità e unità di misura.
    La gestione della pasticceria (per esempio) è in mano a Luana e Maria che vogliono avere ilproprio account per poter accedere all'area di backoffice tramite email e password (possibilitàdi registrazione basica  di altri utenti).

    Nell’area di backoffice si possono gestire (CRUD) i dolci e metterli in vendita con una certa disponibilità. I dolci in vendita invecchiano ed in base al tempo trascorso dalla loro messa in vendita hanno prezzi diversi: primo giorno prezzo pieno, secondo giorno costano l’80%, il terzo giorno il 20%. Il quarto giorno non sono commestibili e devono essere ritirati dalla vendita.

    Nella pagina vetrina dove tutti possono vedere la lista di dolci disponibili e il prezzo relativo. Andando nella pagina del dettaglio del dolce (tramite la tecnica Flip Card), si scoprono
    gli ingredienti indicati dalla ricettacompreso la descrizione.

## Installazione del progetto 

Download del progetto da github

Settare il database nel file .env 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desserts
DB_USERNAME=root
DB_PASSWORD=
```

Aprire cmd nella directory del progetto

Eseguire in sequenza i seguenti comandi:
```
composer install
npm install (o se preferisci yarn)
cp .env.example .env

Settare il database nel file .env 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desserts
DB_USERNAME=root
DB_PASSWORD=
```

Eseguire questi altri comandi in cmd nella directory del progetto

php artisan key:generate
php artisan migrate
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder
php artisan serve
```

## Demo funzionante online

https://www.volpevincenzo.it/desserts


Email e password di default per accedere come admin

```
email: vinci792010@gmail.com
password: 123456
```

Email e password demo per accedere come Luana (permessi user)

```
email: luana@gmail.com
password: 1234
```

Email e password demo per accedere come Maria (permessi user)

```
email: luana@gmail.com
password: 1234
```

## Screenshot


![Desserts Vetrina](https://www.volpevincenzo.it/desserts/image/vetrina_desserts.jpg)


![Desserts CRUD](https://www.volpevincenzo.it/desserts/image/crud_desserts.jpg)
