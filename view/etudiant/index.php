<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/public/node_modules/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="/public/node_modules/bootstrap/dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="/public/css/app.css">
    <title>MVC TP 1</title>
</head>
<body>
<nav  class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><b>GESTION DES NOTE ETUDIANT</b> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Etudiant <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Note</a>
            </li>

        </ul>
    </div>
</nav>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="h2 text-center">Etudiant</h2>
            <button class="btn btn-success" data-toggle="modal" data-target="#addEtut">Ajouter etudiant</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#addNote" onclick="showAddNote(this)">Ajouter note</button>
            <hr>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover" id="tabEtu">
                <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Classe</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($ligne = $etudiants->fetch(PDO::FETCH_OBJ)) : ?>
                    <tr>
                        <td id="matetu<?=$ligne->id?>" > <?= $ligne->mat?></td>
                        <td id="nometu<?=$ligne->id?>" > <?= $ligne->nom?></td>
                        <td id="prenometu<?=$ligne->id?>" > <?= $ligne->prenom?></td>
                        <td id="classetu<?=$ligne->id?>" > <?= $ligne->class?></td>
                        <td style="text-align: center">
                            <button class="btn btn-default" value="<?=$ligne->id?>"
                                    onclick="showNoteEut(this)"
                                    data-toggle="modal" data-target="#showNote">
                                Notes
                            </button>
                            <button class="btn btn-primary" value="<?=$ligne->id?>"
                                    onclick="showediteEtu(this)"
                                    data-toggle="modal" data-target="#editEtut">
                                Editer
                            </button>
                            <button class="btn btn-warning" value="<?=$ligne->id?>" onclick="DelEtu(this)">
                                Suprimer
                            </button>

                        </td>
                    </tr>
                <?php endwhile;?>
                </tbody>


            </table>
        </div>
    </div>
</div>



<!-- EDIT ETUD-->
<div class="modal fade" id="editEtut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <h4 class="modal-title text-center">Edite Etudiant</h4>

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="matEtEdit" class="control-label">Matricule:</label>
                        <input type="text" class="form-control" id="matEtEdit" >
                        <input type="hidden" class="form-control" id="idEtEdit">
                    </div>
                    <div class="form-group">
                        <label for="nomEtEdit" class="control-label">Nom:</label>
                        <input type="text" class="form-control" id="nomEtEdit">
                    </div>
                    <div class="form-group">
                        <label for="prenomEtEdit" class="control-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenomEtEdit">
                    </div>
                    <div class="form-group">
                        <label for="classEtEdit" class="control-label">Classe:</label>
                        <input type="text" class="form-control" id="classEtEdit">
                    </div>

                </form>
            </div>
            <div class="text-center" style="margin-bottom: 25px">
                <button type="button" class="btn btn-primary" onclick="updateEtut()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- ADD ETUD-->
<div class="modal fade" id="addEtut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <h4 class="modal-title text-center">Ajout Etudiant</h4>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="matEtAdd" class="control-label">Matricule:</label>
                        <input type="text" class="form-control" id="matEtAdd" >
                    </div>
                    <div class="form-group">
                        <label for="nomEtAdd" class="control-label">Nom:</label>
                        <input type="text" class="form-control" id="nomEtAdd">
                    </div>
                    <div class="form-group">
                        <label for="prenomEtAdd" class="control-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenomEtAdd">
                    </div>
                    <div class="form-group">
                        <label for="classEtAdd" class="control-label">Classe:</label>
                        <input type="text" class="form-control" id="classEtAdd">
                    </div>

                </form>
            </div>
            <div class="text-center" style="margin-bottom: 25px">
                <button type="button" class="btn btn-primary" onclick="return addEtu(this)">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- ADD Note-->
<div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: auto !important;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <h4 class="modal-title text-center">Ajout Note</h4>
            <div class="modal-body" style="max-height: 500px; overflow: auto">
                <form>
                    <div class="form-group">
                        <label for="valNote" class="control-label">Valeur:</label>
                        <input type="number"  step=0.01 class="form-control" id="valNote" >
                    </div>
                    <div class="form-group">
                        <label for="anneNote" class="control-label">Annee:</label>
                        <input type="number" class="form-control" id="anneNote" required>
                    </div>
                    <div class="form-group">
                        <label for="semNote" class="control-label">Semestre:</label>
                        <input type="number" class="form-control" id="semNote" required>
                    </div>
                    <div class="form-group">
                        <label for="matierNote" class="control-label">Matiere:</label>
                        <input type="text" class="form-control" id="matierNote">
                    </div>
                    <div class="form-group">
                        <label for="matierNote" class="control-label">Etudiant</label>
                        <select class="form-control" id="idEtudiant">
                            <option value="" selected hidden disabled>Faite votre choix</option>
                        </select>
                    </div>

            <div class="text-center" style="margin-bottom: 25px">
                <button type="button" class="btn btn-primary" onclick="addNote()">Enregistrer</button>
            </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- SHOW Note-->
<div class="modal fade" id="showNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: auto !important;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <h4 class="modal-title text-center">Tableau de notes</h4>
            <div class="modal-body">
                <table class="table table-hover table-bordered" id="TabNote">
                    <thead>
                        <tr>
                            <td>Valeur</td>
                            <td>Matiere</td>
                            <td>Semestre</td>
                            <td>Année</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>




<script src="/public/node_modules/jquery/dist/jquery.js"></script>
<script src="/public/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="/public/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="/public/js/app.js"></script>
</body>
</html>