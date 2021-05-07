<?php

// Étape 5 : On inclut notre nouvelle classe MainController
require_once __DIR__ . '/controllers/MainController.php';

// Première étape
// On utilise désormais un seul fichier pour récupérer toutes les pages du projet
// On va donc récupérer la page demandé dans une paramètre «page» dans l'url, ex: index.php?page=store

$page = filter_input(INPUT_GET, '_url'); // Une forme d'équivalent plus agréable à utiliser que $_GET['_url']

// $page vaut null si le paramètre n'est pas dans l'url ou alors il vaut ce qui a été prècisé dans index.php?page=
// Si $page vaut null on lui affecte la valeur «home»

if ($page === null) {
    $page = '/home';
}

// On déclare des routes dans un tableau
// Chaque route est identifié par un nom
// Dans chaque route, on précise la page demandée (/products, /store, / ou /home)
// Puis on précise le nom de la méthode de controleur associée à la page demandée
$routes = [
    'home' => [
        'page' => '/home',
        'method' => 'home'
    ],

    'about' => [
        'page' => '/about',
        'method' => 'about'
    ],
    
    'store' => [
        'page' => '/store',
        'method' => 'store'
    ],
    'products' => [
        'page' => '/products',
        'method' => 'products'
    ],
    'products2' => [
        'page' => '/produits', // Ce qu'on voit dans l'url
        'method' => 'products' // La méthode de MainController qu'on lui associe
    ],
    'contact' => [
        'page' => '/formulaire-de-contact',
        'method' => 'contact'
    ],
];

foreach ($routes as $route) {
    if ($route['page'] == $page) {
        $method = $route['method'];
        break; // permet de sortir de la boucle car on a trouvé ce qu'on cherche
    }
}

// Si $method n'est pas défini, c'est que la page demandé n'existe pas
// On va donc afficher 404 au lieu d'exécuter une méthode de controleur dont on n'a pas le nom
if (isset($method)) {
    // On instancie MainController
    $controller = new MainController();
    $controller->$method(); // $method() veut dire «exécute la méthode dont le nom se trouve dans $method»
} else {
    echo '404';
}
