<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>OHS</strong> Beta <b style="color:red;">ISSUES</b></h1>
    <hr/>
    <h3 class="h3 mb-3">$_POST Array is being Empty</h3>
    <p>Workaround :</p>
    <p>Add this Following Line to Starting of your Script!</p>
    <p style="color:blue;">
        <?php
            echo '&#60;?php if(isset($_SERVER["HTTP_ARRAY_DATA"])){ $_POST = json_decode($_SERVER["HTTP_ARRAY_DATA"],"false"); } ?>'; 
        ?>
    </p>
    <hr/>

    <hr/>
    <h3 class="h3 mb-3">File Upload Not Working</h3>
    <p>Workaround :</p>
    <p>Sorry , No Workaround currently available...</p>
    <hr/>

    <hr/>
    <h3 class="h3 mb-3">SSL Support not available</h3>
    <p>Workaround :</p>
    <p>Sorry , No Workaround currently available...</p>
    <hr/>
</div>