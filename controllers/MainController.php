<?php

class MainController
{
    public function home()
    {
        $this->show('index');
    }

    public function products()
    {
        $this->show('products');
    }

    public function store()
    {
        // Si j'avais des données à aller chercher en BDD, ça serait ici !
        // On placerait les données dans une variable
        $weekOpeningHours = [
                'Sunday' => 'Closed', 
                'Monday' => '7:00 AM to 8:00 PM',
                'Tuesday' => '7:00 AM to 8:00 PM',
                'Wednesday' => '7:00 AM to 8:00 PM',
                'Thursday' => '7:00 AM to 8:00 PM',
                'Friday' => '7:00 AM to 8:00 PM',
                'Saturday' => '9:00 AM to 5:00 PM'
        ];
        // On enverrait le contenu del a $weekOpeningHours au template

        // On utilise la fonction show()
        // Le deuxième argument est un tableau qui peut contenir autant de valeurs qu'on veut
        // On envoie donc à nos templates une seule clé, «weekOpeningHours» avec les horaires d'ouvertures
        // Cette information est nécessaire dans store.tpl.php mais pas dans les autres pages
        // Pour l'instant, avec cette structure, ça nous oblige à envoyer les horaires à toutes les pages 
        $this->show('store', [
            'weekOpeningHours' => $weekOpeningHours,
        ]);
    }

    public function contact()
    {
        $this->show('contact');
    }

    public function about()
    {
        $this->show('about');
    }

    public function show($viewName, $viewVars=[])
    {
        // $viewVars est disponible dans chaque fichier de vue

        // __DIR__ est une constante de PHP qui donne le chemin du fichier où on écrit cette constante
        // Chez moi : /var/www/html/Qui-Gon/S05-E01-exo-controllers-views-Djyp
        // Il manque le slash à la fin, donc on doit concaténer avec /views/ pour obtenir :
        //    /var/www/html/Qui-Gon/S05-E01-exo-controllers-views-Djyp/views/
        // Qu'on concatène avec notre nom de fichier
        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
}