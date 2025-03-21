<?php
class NewsletterController {
    public function subscribe() {
        // Définir le header JSON AVANT toute sortie
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                try {
                    // Connexion à la base de données sécurisée
                    $pdo = new PDO("mysql:host=localhost;dbname=footer", "root", "");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                    // Vérifier si l'email est déjà inscrit
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM newsletter WHERE email = :email");
                    $stmt->execute(['email' => $email]);
                    if ($stmt->fetchColumn() > 0) {
                        echo json_encode(["status" => "error", "message" => "Email déjà inscrit."]);
                        return;
                    }

                    // Insérer l'email en BDD
                    $stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (:email)");
                    $stmt->execute(['email' => $email]);

                    // Réponse JSON de succès
                    echo json_encode(["status" => "success", "message" => "Merci pour votre inscription !"]);
                } catch (PDOException $e) {
                    echo json_encode(["status" => "error", "message" => "Erreur BDD : " . $e->getMessage()]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Adresse email invalide."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Requête invalide."]);
        }
    }
}

