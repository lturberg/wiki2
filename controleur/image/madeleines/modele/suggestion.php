<?php
require_once 'Connexion.php';

if (isset($_POST['mot'])) {
    $mot = $_POST['mot'];
    $mot = htmlspecialchars($mot);

    // Assume you have a table named 'mots' with columns 'id' and 'libelle'
    $sql = "SELECT libelle FROM mot WHERE id BETWEEN 157 AND 11712 AND libelle LIKE :mot";
    
    $connexion = Connexion::getInstance();
    $stmt = $connexion->prepare($sql);
    $stmt->bindValue(':mot', $mot . '%', PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result)) {
        echo json_encode($result);
    } else {
        echo json_encode(['message' => 'Aucune suggestion trouvée.']);
    }
} else {
    echo json_encode(['message' => 'Aucun mot fourni.']);
}
?>
