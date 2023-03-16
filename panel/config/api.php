<?php
include("init.php");
$execution = false;
if(isset($_POST['set_password'])){
    $execution = true;
    file_put_contents("/opt/openhostpanel/user/password" , $_POST['password']);
    JRedir("../");
}

if(isset($_POST['validate_login'])){
    $execution = true;
    if($_POST['username'] == "ohs_admin"){
        if($_POST['password'] == file_get_contents("/opt/openhostpanel/user/password")){
            $_SESSION['uid'] = time();
            JRedir("../home.php");
        }else{
            JRedir("../?status=false");
        }
    }else{
        JRedir("../?status=false");
    }
}

if(isset($_POST['change_php'])){
    $execution = true;
    $siteJson = json_decode(file_get_contents("/opt/openhostpanel/user/sites.json"),"false");
    $siteJson[replaceDash($_POST['site'])]['php'] = $_POST['php'];
    file_put_contents("/opt/openhostpanel/user/sites.json" , json_encode($siteJson));
    echo "success";
}

if(isset($_POST['delete_site'])){
    $execution = true;
    $siteJson = json_decode(file_get_contents("/opt/openhostpanel/user/sites.json"),"false");
    unset($siteJson[replaceDash($_POST['site'])]);
    rrmdir("/opt/openhostpanel/sites/"._replaceDash($_POST['site'])."");
    file_put_contents("/opt/openhostpanel/user/sites.json" , json_encode($siteJson));
    echo "success";
}

if(isset($_POST['add_site'])){
    $execution = true;
    $siteJson = json_decode(file_get_contents("/opt/openhostpanel/user/sites.json"),"false");
    $siteJson[replaceDash($_POST['domain'])] = array('php' => $_POST['php']);
    mkdir("/opt/openhostpanel/sites/"._replaceDash($_POST['domain'])."");
    file_put_contents("/opt/openhostpanel/user/sites.json" , json_encode($siteJson));
    echo "success";
}

if($execution == false){
    echo ('<link href="../css/app.css" rel="stylesheet">');
    echo ('<main class="d-flex w-100">');
    echo ('<div class="container d-flex flex-column">');
    echo ('<div class="row vh-100">');
    echo ('<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">');
    echo ('<div class="d-table-cell align-middle">');
    echo (' <div class="text-center mt-4">
                <h1 class="h2">Unexpected Error</h1>
                <p class="lead">
                    OHS was Unable to Process the Api request
                </p>
            </div>');
    echo ('</div>');
    echo ('</div>');
    echo ('</div>');
    echo ('</div>');
    echo ('</main>');
}