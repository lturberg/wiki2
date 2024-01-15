<?php

include './modele/ModeleUserDAO.php';

$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_SPECIAL_CHARS);

try {
    // Supposons que votre fonction updateUserData retourne un résultat ou lève une exception
    ModeleUserDAO::updateUserData($firstname, $name, $mail);

    // Si vous êtes arrivé ici, la mise à jour a été effectuée avec succès
    header("Location: ./?action=defaut");
} catch (PDOException $e) {
    // En cas d'erreur, vous pouvez afficher le message d'erreur ou faire d'autres manipulations nécessaires
    echo $e->getMessage();
    header("Location: ./?action=modifInfo");
}
?>
