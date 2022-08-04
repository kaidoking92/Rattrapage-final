<h1 class="title">Utilisateurs</h1>

    <!--<section class="resumenumbers">
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">100€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p></article>
				<article class="numbers"><p class="bignumbers">1000€</p><p class="smallnumbers">Chiffres d'affaires quotidienTEMPLATE</p><p class="smallestnumber"><i class="fa-solid fa-arrow-trend-up"></i> 15%</p></article>
	</section>-->

    <div class="table">
        <div class="table-head">
          <div class="tab">
            <p>Tous les utilisateurs</p>
          </div>
        </div>

        <table class="table-body">
            <tr>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Email </th>
                <th> Status </th>
                <th> Actions </th>


            </tr>
          
            <?php foreach ($users as $user): ?>
                <tr>
                    <td> <?= $user->getFirstname(); ?> </td>
                    <td> <?= $user->getLastname(); ?> </td>
                    <td>  <?= $user->getEmail(); ?> </td>
                    <td>   Statut : <?= $user->getStatus() ?'Validé':'Non validé'; ?> </td>
                    <td> <a href="/user/<?= $user->getId(); ?>">
                            <button class="button button--white">Modifier</button>
                        </a>
                        <div id="delete" style="display: inline-block;">
                            <?php $this->includePartial("form", $user->getRemoveUserForm()) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php
                if($pages > 1){
            ?>
                <nav>
                    <ul class="pagination">
                        <?php
                        if($currentPage != 1){
                        ?>
                            <li><a href="/users?page=<?= $currentPage - 1 ?>">Précédent</a></li>
                        <?php
                        }
                        for($i = 1;$i<=$pages;$i++):
                        ?>
                            <li><a href="./users?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                        endfor;
                        if($currentPage != $pages){
                        ?>
                            <li><a href="./users?page=<?= $currentPage + 1 ?>">Suivant</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            <?php
            }
            ?>
        </div>
    </div>




