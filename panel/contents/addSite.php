<?php
include("../config/init.php");
$sites = get_Sites();
?>
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Websites</strong> Add Website </h1>
    <hr/>
    <div class="card">
		<div class="card-header">
		    <h5 class="card-title mb-0">Add Website</h5>
		</div>
		<div class="card-body">
            <strong>Domain</strong>
		    <input type="domain" class="form-control" placeholder="domain.com" id="domain_add">
            <strong>PHP Version</strong>
            <select class="form-select mb-3" id="php_selector">
                <option value="74">PHP 7.4</option>
                <option value="81">PHP 8.1</option>
                <option value="82">PHP 8.2</option>
            </select>
	    </div>
        <a href="#" onclick="addSite()" class="btn btn-primary">Add Website</a>
	</div>
</div>