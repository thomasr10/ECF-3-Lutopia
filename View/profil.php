<?php
$title = "Profil | Lutopia";
$description = "Page d'accueil de Lutopia";
$arrayJs = [""];
$pointSlash = "";
ob_start();
?>
    <div>
        <h2>Profil de <?=$_SESSION['full-name']; ?></h2>
            <a href="<?= $router->generate('profilParameter')?>">Paramètre</a>
            <div>
                <form action="/profil" method="GET">
                    <select name="tri" id="tri-select">
                        <option <?php if(isset($_GET['tri']) && $_GET['tri'] == 0){ echo 'selected'; }?> value="0">Enfant</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri']  == 1){ echo 'selected'; }?> value="1">Date de retour</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri'] == 2){ echo 'selected'; }?> value="2">Date de d'emprunt</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri']  == 3){ echo 'selected'; }?> value="3">Titre</option>
                    </select>
                    <input type="submit" value="Trier">
                </form>
            </div>
            <div>
                <p>Mes informations :</p>
                <?php foreach($info as $key => $value): ?>
                    <article>
                        <p>Vos enfants : <?= $info[$key]->getName(); ?></p>
                    </article>
                <?php endforeach ?>    
            </div>

            <div>
                <p>Mes réservations : </p>
                <?php if(!empty($reservation)) { ?>
                    <?php foreach($reservation as $key => $value): ?>
                        <article>
                            <p>Réservation de : <?= $reservation[$key]->name; ?>
                            <p>Titre : <?php echo $reservation[$key]->reservation->getTitle() ?></p> 
                            <p>Date de réservation : <?php echo $reservation[$key]->reservation->getResevation_date()->format('d-m-Y') ?></p> 
                            <form method="POST" action="/profil">
                                <input type="hidden" name="id_reservation" value="<?= $reservation[$key]->reservation->getId_reservation();?>">
                                <input type="submit" name="cancel" value="Annuler">
                            </form>  
                        </article>
                    <?php endforeach ?>
                <?php } else { ?>
                    <p>Aucune réservation en cours</p>
                <?php } ?>
            </div>
            <div>
                <p>Mes empreints en cours : </p>
                <?php if(!empty($borrow)) { ?>
                    <?php foreach($borrow as $key => $value): ?>
                        <article>
                            <p>Emprunt de : <?php echo $borrow[$key]->getName() ?></p>
                            <p>Titre : <?php echo $borrow[$key]->getTitle() ?></p>
                            <p>Date d'emprunt : <?php echo $borrow[$key]->getStart_date()->format('d-m-Y') ?></p>
                            <p>Date de retour : <?php echo $borrow[$key]->getEnd_date()->format('d-m-Y') ?></p>
                        </article>
                        <hr> <!-- a supprimer pour la visibilité -->
                    <?php endforeach ?>
                <?php } else { ?>
                    <p>Aucune empreints en cours</p>
                <?php } ?>
            </div>
            <div>
                <p>Mon historique d'empreints: </p>
                <?php if(!empty($borrowHistory)) { ?>
                    <?php foreach($borrowHistory as $key => $value): ?>
                        <article>
                            <p>Rendu par : <?php echo $borrowHistory[$key]->getName() ?></p>
                            <p>Titre : <?php echo $borrowHistory[$key]->getTitle() ?></p>
                            <p>Date d'emprunt : <?php echo $borrowHistory[$key]->getStart_date()->format('d-m-Y') ?></p>
                            <p>Date de retour : <?php echo $borrowHistory[$key]->getEnd_date()->format('d-m-Y') ?></p>
                        </article>
                        <hr> <!-- a supprimer pour la visibilité -->
                    <?php endforeach ?>
                <?php } else { ?>
                    <p>Aucune empreints dans l'historique</p>
                <?php } ?>
            </div>
    </div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>