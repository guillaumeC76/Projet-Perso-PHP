<?php
session_start();
include('inc/pdo.php');
include('inc/function.php');

$sql = "SELECT * FROM produit";
$query = $pdo->prepare($sql);
$query->execute();
$bieres = $query->fetchAll();

include('inc/header.php'); ?>

<h3>La liste de nos bières</h3>

<div class="biere_page">
    
    <?php foreach ($bieres as $biere) { ?>
        
        <a href="http://localhost/A/single_biere.php?nom=<?php echo $biere['nom'] ?>">
            <div class="biere">
                <p><?php echo $biere['nom'] ?> - <?php echo $biere['prix'] ?>€</p>
                <img src="<?php echo $biere['img'] ?>" alt="bière">           
            </div>
        </a>
        
    <?php } ?>	

</div>

<?php include('inc/footer.php'); ?>