<!-- ----- début fragmentMenu -->

<nav data-bs-theme="dark" class="navbar navbar-expand-lg bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="accueil">Sattler-Jyad <?php if (isset($user)): ?> | <?= ModelUser::getNamedStatus($user->getStatus()) ?> | <?= $user->getFirstname() ?> <?= $user->getLastname() ?> |<?php endif; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (isset($user) && $user->getStatus() == ModelUser::ADMIN) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrateur</a>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header">Spécialités</h6></li>
                        <li><a class="dropdown-item" href="specialite">Liste des spécialités</a></li>
                        <li><a class="dropdown-item" href="specialite/selection">Sélectionner une spécialité par son id</a></li>
                        <li><a class="dropdown-item" href="specialite/ajouter">Créer une nouvelle spécialité</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Personnes</h6></li>
                        <li><a class="dropdown-item" href="praticiens">Liste des praticiens et leur spécialités</a></li>
                        <li><a class="dropdown-item" href="praticiens/nombre-patients">Nombre de praticien par patient</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Autre</h6></li>
                        <li><a class="dropdown-item" href="informations">Toutes les informations</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if (isset($user) && $user->getStatus() == ModelUser::DOCTOR) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Praticien</a>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header">Disponibilités</h6></li>
                        <li><a class="dropdown-item" href="disponibilite">Liste de mes disponibilités</a></li>
                        <li><a class="dropdown-item" href="disponibilite/ajouter">Ajout de nouvelles disponibilités</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Rendez-vous</h6></li>
                        <li><a class="dropdown-item" href="rendez-vous/praticien">Liste des rendez-vous avec le nom des patients</a></li>
                        <li><a class="dropdown-item" href="patients">Liste de mes patients (sans doublon)</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if (isset($user) && $user->getStatus() == ModelUser::PATIENT) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Patient</a>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header">Profil</h6></li>
                        <li><a class="dropdown-item" href="profil">Mon profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><h6 class="dropdown-header">Rendez-vous</h6></li>
                        <li><a class="dropdown-item" href="rendez-vous/patient">Mes rendez-vous</a></li>
                        <li><a class="dropdown-item" href="rendez-vous/ajouter">Prendre rendez-vous</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="innovations/donnees-statistiques">Proposez une fonctionnalité originale</a></li>
                        <li><a class="dropdown-item" href="innovations/amelioration-du-router">Proposez une amélioration du code MVC</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Connexion</a>
                    <ul class="dropdown-menu">
                        <?php if (!isset($_SESSION) || $_SESSION === 'vide' || !isset($_SESSION['user'])) : ?>
                        <li><a class="dropdown-item" href="connexion">Se connecter</a></li>
                        <li><a class="dropdown-item" href="inscription">S'inscrire</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="deconnexion">Se déconnecter</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ----- fin fragmentMenu -->

