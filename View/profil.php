<?php
$title = "Profil | Lutopia";
$description = "Page d'accueil de Lutopia";
$arrayJs = [""];
$pointSlash = "";
ob_start();
?>  <div class="marginProfil">
    <div id="profil">
        <div id="headProfil">
            <h2>Profil de <?=$_SESSION['full-name']; ?></h2>
            <a href="<?= $router->generate('profilParameter')?>">Paramètres</a>
            <form action="/profil" method="GET">
                    <select name="tri" id="tri-select">
                        <option <?php if(isset($_GET['tri']) && $_GET['tri'] == 0){ echo 'selected'; }?> value="0">Enfant</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri']  == 1){ echo 'selected'; }?> value="1">Date de retour</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri'] == 2){ echo 'selected'; }?> value="2">Date d'emprunt</option>
                        <option <?php if(isset($_GET['tri']) && $_GET['tri']  == 3){ echo 'selected'; }?> value="3">Titre</option>
                    </select>
                    <input type="submit" value="Trier">
            </form>
        </div>

        <div id="informationProfil">
            <p>Mon(mes) enfant(s) : </p>
            <?php foreach($info as $key => $value): ?>
            <p class="enfants"><?= $info[$key]->getName();?></p>
            <?php endforeach ?>    
        </div>

        <div id="reservationProfil">
                <p>Mes réservations :</p>
                <?php if(!empty($reservation)) { ?>
                    <div id="listeresaProfilContainer">
                    <?php foreach($reservation as $key => $value): ?>
                        <div class="listeresaProfil">
                            <p><span class="titreListe">Réservation de :</span> <?= $reservation[$key]->name; ?></p>
                            <p><span class="titreListe">Titre : </span><?php echo $reservation[$key]->reservation->getTitle() ?></p> 
                            <p><span class="titreListe">Date de réservation : </span><?php echo $reservation[$key]->reservation->getResevation_date()->format('d-m-Y') ?></p> 
                            <form method="POST" action="/profil">
                                <input type="hidden" name="id_reservation" value="<?= $reservation[$key]->reservation->getId_reservation();?>">
                                <input type="submit" name="cancel" value="Annuler">
                            </form>  
                    </div>
                    <?php endforeach ?>
                    </div>
                <?php } else { ?>
                    <p><span class="pasderesaProfil">Aucune réservation en cours</span></p>
                <?php } ?>
            </div>

            <div id="empruntProfil">
                <p>Mes emprunts en cours : </p>
                <?php if(!empty($borrow)) { ?>
                    <div id="empruntContainer">
                    <?php foreach($borrow as $key => $value): ?>
                        <div class="listeresaProfil">
                            <p><span class="titreListe">Emprunt de : <?php echo $borrow[$key]->getName() ?></span></p>
                            <p><span class="titreListe">Titre : <?php echo $borrow[$key]->getTitle() ?></span></p>
                            <p><span class="titreListe">Date d'emprunt : <?php echo $borrow[$key]->getStart_date()->format('d-m-Y') ?></span></p>
                            <p><span class="titreListe">Date de retour : <?php echo $borrow[$key]->getEnd_date()->format('d-m-Y') ?></span></p>
                    </div>
                    <?php endforeach ?>
                    </div>
                <?php } else { ?>
                    <p><span class="pasderesaProfil">Aucun emprunt en cours</span></p>
                <?php } ?>
            </div>

            <div id="borrowHistory">
                <p>Mon historique d'emprunts: </p>
                <?php if(!empty($borrowHistory)) { ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Rendu par</th>
                                <th>Titre</th>
                                <th>Date d'emprunt</th>
                                <th>Date de retour</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach($borrowHistory as $key => $value): ?>
                                 <tr>
                                    <td><?php echo $borrowHistory[$key]->getName(); ?></td>
                                    <td><?php echo $borrowHistory[$key]->getTitle(); ?></td>
                                    <td><?php echo $borrowHistory[$key]->getStart_date()->format('d-m-Y'); ?></td>
                                    <td><?php echo $borrowHistory[$key]->getEnd_date()->format('d-m-Y'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php } else { ?>
                    <p class="pasderesaProfil" >Aucun emprunt dans l'historique</p>
                <?php } ?>
            </div>
    </div>
</div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>