# Structurer une application avec des classes :sunglasses:

Voici un petit site internet de 3 pages.

Actuellement, il est composé de 3 fichiers HTML statiques.

On va améliorer ce site et rendre le tout dynamique, tout en suivant une structuration objet plus professionnelle, plus maintenable et plus scalable.

## Etape 1 : préparation

- déplacer les fichiers HTML dans un sous-répertoire _views_
- renommer ces fichiers `.html` en fichiers `.tpl.php`
- créer le fichier "point d'entrée" PHP à la racine du projet :
  - index.php
  - _ce fichier correspond aux urls que nous "exposons" à nos visiteurs : il n'accéderont jamais directement au dossier views_
- coder l'inclusion des fichiers de _views_ selon le paramètre d'URL `page` fourni
  - accueil : `index.php`
  - store : `index.php?page=store`
  - products : `index.php?page=products`

```php
require_once __DIR__.'/views/index.tpl.php'; // pour la home
```

## Etape 2 : views

- `view` ou `template`, même combat :muscle: :art: :lipstick:
- factoriser le code HTML répété dans les fichiers de vue
  - créer une vue `header.tpl.php` dans _views_
  - créer une vue `footer.tpl.php` dans _views_
- modifier le fichier "point d'entrée" pour inclure ces vues `header.tpl.php` et `footer.tpl.php`

## Etape 3 : une fonction d'affichage

- déclarer une fonction `show` dans `index.php` qui va s'occuper d'inclure les _views_
  ```php
  function show($viewName, $viewVars=[]) {
    // $viewVars est disponible dans chaque fichier de vue
    require_once __DIR__.'/../views/header.tpl.php';
    require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
    require_once __DIR__.'/../views/footer.tpl.php';
  }
  ```
- utiliser cette fonction pour l'inclusion des templates
- pourrait-on réutiliser cette fonction dans d'autres projets ayant la même structure ?

## Etape 4 : heures d'ouverture

- dans la page "store", on affiche les horaires d'ouverture
- et, dans le code HTML d'origine,
  - le _jour du jour_ est affiché en jaune et en gras
  - cependant, c'est du code JavaScript qui permettait cela
- modifier le code PHP pour arriver à mettre en avant le _jour du jour_ (class `today` sur le bon `<li>`)
- attention à la _portée des variables_ :smiling_imp:

<details><summary>Tableau des horaires par jour</summary>

```php
$weekOpeningHours = [
    'Sunday' => 'Closed', 
    'Monday' => '7:00 AM to 8:00 PM',
    'Tuesday' => '7:00 AM to 8:00 PM',
    'Wednesday' => '7:00 AM to 8:00 PM',
    'Thursday' => '7:00 AM to 8:00 PM',
    'Friday' => '7:00 AM to 8:00 PM',
    'Saturday' => '9:00 AM to 5:00 PM'
];
```
  
</details>

## Etape 5 : controllers

- créer une classe `MainController` dans le sous-répertoire `controllers`
- déclarer 3 méthodes vides dans ce `MainController` :
  - `home` (correspondant à la page d'accueil)
  - `products` (correspondant à la page "products")
  - `store` (correspondant à la page "store")
- déclarer la méthode `show` dans `MainController` qui va s'occuper d'inclure les _views_
  ```php
  public function show($viewName, $viewVars=[]) {
    // $viewVars est disponible dans chaque fichier de vue
    require_once __DIR__.'/../views/header.tpl.php';
    require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
    require_once __DIR__.'/../views/footer.tpl.php';
  }
  ```
- dans le corps des 3 méthodes vides :
  - appeler la méthode `show` sur l'objet courant (`$this`) en précisant en argument quelle _view_ vous souhaitez voir afficher
- dans le corps de la méthode `store` :
  - appeler la méthode `show` en ajoutant, en 2ème argument, un `array` contenant les données que vous souhaitez transmettre à la _view_
  ```php
  public function home() {
    // Délègue l'affichage à la méthode "show" du MainController
    $this->show('home');
  }
  ```
- modifier le fichier "point d'entrée"
  - retirer l'inclusion existante (_views_)
  - inclure la classe `MainController`
  - instancier un objet `MainController`
  - appeler la méthode de l'objet `MainController` correspondant au point d'entrée
    ```php
    <?php
    // File index.php
    // [...]
    // Instanciation de la classe MainController
    $controller = new MainController();
    // Appel de la méthode correspondant à ce point d'entrée (page)
    $controller->home();
    ```
- `point d'entrée` > `méthode du controller` > `views` > :ok_hand:

## Dernière étape

Job's done ! :muscle: :tada: :champagne:

Se féliciter, relire la structure de nos fichiers et se représenter le parcours du script PHP dans nos fichiers pour afficher une page HTML
