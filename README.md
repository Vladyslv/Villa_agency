# Villa Agency – PHP OOP projekt

Realitná webová stránka napísaná v čistom PHP 8 (OOP) s MySQL databázou.

## Funkcie

- **CRUD operácie** nad entitou *Properties* – pridanie, zobrazenie, editácia, mazanie
- **Admin login** s hashovaním hesla (`password_hash` / `password_verify`)
- **Kontaktný formulár** ukladá správy do databázy, admin ich vidí v adminovi
- **Upload obrázkov** pre nehnuteľnosti
- **Dynamický obsah** na frontend stránkach (homepage + properties listing + property detail)
- **Prepared statements** všade kde sa pracuje s DB – ochrana proti SQL injection
- **POST → REDIRECT → GET** vzor pri delete/create/update

## Použité technológie

- PHP 8.0+ (OOP)
- MySQL 8.0+ alebo MariaDB 10.5+
- PDO (s `PDO::ATTR_ERRMODE = PDO::ERRMODE_EXCEPTION` a `FETCH_OBJ`)
- Bootstrap 5 + HTML/CSS šablóna [TemplateMo Villa Agency](https://templatemo.com/tm-591-villa-agency)

## Inštalácia

1. **Skopírujte projekt** do `htdocs` v XAMPP:
   ```
   C:/xampp/htdocs/villa_agency/
   ```

2. **Spustite Apache a MySQL** v XAMPP Control Panel.

3. **Importujte databázu**: otvorte phpMyAdmin (`http://localhost/phpmyadmin`), vytvorte si novú DB alebo nechajte skript, aby si ju vytvoril sám:
   - kliknite na záložku **SQL**
   - skopírujte celý obsah súboru `database.sql`
   - kliknite **Go**

4. **Skontrolujte prístupové údaje** v `app/core/Database.php` (default je `root` / prázdne heslo – tak ako v XAMPP).

5. **Otvorte web** v prehliadači:
   ```
   http://localhost/villa_agency/
   ```
   (root `index.php` vás presmeruje na `public/templates/index.php`)

## Prihlásenie do admina

| Pole  |       Hodnota       |
|-------|---------------------|
| Email | `admin@villa.local` |
| Heslo |     `admin123`      |

Po prihlásení sa v nav menu objaví link **Admin** vedúci do administrácie.

## Štruktúra projektu

```
villa_agency/
├── index.php                     ← root, presmeruje na home
├── database.sql                  ← schéma + ukážkové dáta
├── app/
│   ├── core/
│   │   ├── App.php               ← autoloader (init())
│   │   ├── Database.php          ← PDO connection
│   │   ├── Helper.php            ← title, logovanie
│   │   ├── Redirect.php          ← statický redirect
│   │   └── Auth.php              ← login / logout / check / isAdmin
│   └── models/
│       ├── Property.php          ← CRUD model
│       └── Contact.php           ← store / all / delete pre správy
├── public/
│   ├── assets/                   ← CSS, JS, fonty, obrázky šablóny
│   ├── uploads/                  ← obrázky nehnuteľností (upload)
│   └── templates/
│       ├── index.php             ← home (latest 6 properties)
│       ├── properties.php        ← všetky properties
│       ├── property-details.php  ← detail jednej property
│       ├── contact.php           ← kontaktný formulár
│       ├── login.php             ← prihlásenie
│       ├── logout.php            ← odhlásenie
│       ├── admin.php             ← dashboard
│       ├── property-create.php   ← formulár pre vytvorenie
│       ├── property-edit.php     ← formulár pre úpravu
│       └── partials/
│           ├── header.php        ← public header
│           ├── footer.php        ← public footer
│           ├── header-admin.php  ← admin header 
│           └── footer-admin.php  ← admin footer
└── storage/                      ← err.log 
```