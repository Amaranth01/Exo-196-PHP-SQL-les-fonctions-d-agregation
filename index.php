<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.

    try {
        $server = 'localhost';
        $db = 'exo_196';
        $user = 'root';
        $pswd = '';

        $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pswd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stm = $bdd ->prepare("SELECT MIN(age) as minimum FROM user");
        if($stm->execute()) {
            $min = $stm->fetch();
            echo "<div> L'âge minimum est de : " . $min['minimum'] . " ans" . "</div> <br>";
        }

        $stm = $bdd ->prepare("SELECT MAX(age) as maximum FROM user");
        if($stm->execute()) {
            $max = $stm->fetch();
            echo "<div> L'âge maximum est de : " . $max['maximum'] . " ans" . "</div> <br>";
        }

        $stm = $bdd ->prepare("SELECT count(*) as number FROM user");
        if($stm->execute()) {
            $num = $stm->fetch();
            echo "<div> Le nombre d'utilisateur est de : " . $num['number'] . "</div> <br>";
        }

        $stm = $bdd ->prepare("SELECT count(*) as number FROM user WHERE numero >= 5");
        if($stm->execute()) {
            $rue = $stm->fetch();
            echo "<div> Le nombre d'utilisateur dont le numéro de rue est plus grand que 5 est de : " . $rue['number'] .  "</div> <br>";
        }

        $stm = $bdd ->prepare("SELECT AVG(age) as moyenne_age FROM user");
        if($stm->execute()) {
            $moyenne = $stm->fetch();
            echo "<div> La moyenne d'âge des utilisateurs est de " . $moyenne['moyenne_age'] . " ans" . "</div> <br>";
        }

        $stm = $bdd ->prepare("SELECT SUM(numero) as somme FROM user");
        if($stm->execute()) {
            $somme = $stm->fetch();
            echo "<div> La somme des numéros de maison est de " . $somme['somme'] . "</div> <br>";
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>
</body>
</html>

