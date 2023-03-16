<?php
include("../config/init.php");
$sites = get_Sites();
?>
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Websites</strong> All Websites </h1>
    <a href="#" class="btn btn-primary" onclick="loadPage('addSite')">Add Website + </a>
    <hr/>
    <?php foreach($sites as $index => $row){ ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?=replaceStar($index)?></h5>
            </div>
            <div class="card-body">
                <strong>PHP Version</strong>
                <select class="form-select mb-3" id="php_<?=replaceDot(replaceStar($index))?>">
                    <option selected value="<?=$row['php']?>">PHP <?=$row['php']?></option>
                    <option value="74">PHP 7.4</option>
                    <option value="81">PHP 8.1</option>
                    <option value="82">PHP 8.2</option>
                </select>
                <a href="#" onclick="updatePHP('<?=replaceDot(replaceStar($index))?>')" class="btn btn-primary">Update Version</a>
                <a href="#" onclick="deleteSite('<?=replaceDot(replaceStar($index))?>')" class="btn btn-danger">Delete</a>
            </div>
        </div>
    <?php } ?>
</div>