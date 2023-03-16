  <script src="js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <?php if(isset($_SESSION['uid'])){ ?>
  <style>
  .loaderlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
  }

  .loaderlayText{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
  }

  .bd-example>:last-child, .bd-example>nav:last-child .breadcrumb {
      margin-bottom: 0;
  }
  .spinner-border {
      --bs-spinner-width: 2rem;
      --bs-spinner-height: 2rem;
      --bs-spinner-vertical-align: -0.125em;
      --bs-spinner-border-width: 0.25em;
      --bs-spinner-animation-speed: 0.75s;
      --bs-spinner-animation-name: spinner-border;
      border: var(--bs-spinner-border-width) solid currentcolor;
  }
  .spinner-border, .spinner-grow {
      display: inline-block;
      width: var(--bs-spinner-width);
      height: var(--bs-spinner-height);
      vertical-align: var(--bs-spinner-vertical-align);
      border-radius: 50%;
      animation: var(--bs-spinner-animation-speed) linear infinite var(--bs-spinner-animation-name);
  }
  </style>
  <div class="loaderlay">
    <div class="loaderlayText">
      <div class="card">
        <div class="card-body">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function toggleLoader(){
      $('.loaderlay').toggle();
    }

    function loadPage(page){
      toggleLoader();
      $.ajax({
        url : "contents/"+page+".php",
        dataType: "html",
        success:(data) => {
          toggleLoader();
          $('#dContent').html(data);
        }
      })
    }

    function updatePHP(id){
      var phpVer = $(`#php_${id}`).val();
      toggleLoader();
      $.ajax({
        url : "config/api.php",
        method:"POST",
        type:"POST",
        data:{
          site : id,
          php : phpVer,
          change_php : 1
        },
        success:(data) => {
          if(data == "success"){
            toggleLoader();
            loadPage("webSites");
          }
        }
      });
    }

    function deleteSite(id){
      toggleLoader();
      $.ajax({
        url : "config/api.php",
        method:"POST",
        type:"POST",
        data:{
          site : id,
          delete_site : 1
        },
        success:(data) => {
          if(data == "success"){
            toggleLoader();
            loadPage("webSites");
          }
        }
      });
    }

    function addSite(){
      toggleLoader();
      $.ajax({
        url : "config/api.php",
        method:"POST",
        type:"POST",
        data:{
          domain : $('#domain_add').val().replaceAll(".","_"),
          php : $('#php_selector').val(),
          add_site : 1
        },
        success:(data) => {
          if(data == "success"){
            toggleLoader();
            loadPage("webSites");
          }
        }
      });
    }

  </script>
  <?php } ?>
</body>
</html>