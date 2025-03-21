<?php
class FooterController {
  public function render() {
    include './view/footer.php';
  }
}

class ControllerNewsletter {
  public function subscribe() {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pdo = new PDO("mysql:host=localhost;dbname=footer", "root", ""); // change les accès si besoin
        $stmt = $pdo->prepare("INSERT INTO newsletter (email) VALUES (:email)");
        $stmt->execute(['email' => $email]);
        echo "Merci pour votre inscription !";
      } else {
        echo "Adresse email invalide.";
      }
    }
  }
}