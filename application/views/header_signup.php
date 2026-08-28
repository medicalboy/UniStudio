
<!doctype html>
<html lang="en">
  <head>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="assets/css/header.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  </head>
  <body>
<main>
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="<?php echo base_url(); ?>Manipulation" class="nav-link px-2 link-dark">Image processing</a></li>
          <li><a href="<?php echo base_url(); ?>products/fetch_detail" class="nav-link px-2 link-dark">Shopping cart</a></li>
          <li><a href="<?php echo base_url(); ?>weather" class="nav-link px-2 link-dark">Weather</a></li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search" id="search_text" name="search">
        </form>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url(); ?>profile">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php if($this->session->userdata('logged_in')) : ?>
            <li> <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout"> Sign out </a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </header>

  
  <!-- <section>
    <div class="card card-body" id="result">
    </div>
      
  </section> -->
</main>
<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">Courses</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="<?php echo base_url(); ?>add_course" class="btn btn-primary my-2">Add course</a>
        <a href="<?php echo base_url(); ?>videos" class="btn btn-secondary my-2">Home</a>
      </p>
    </div>
  </div>
</section>
 
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id = "newresult">
    </div>
  </div>
</div>

</main>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
<script>
var container = document.querySelector("#newresult");
var parsedData;
 $.ajax({
      url:"<?php echo base_url(); ?>ajax/fetchAll",
      method:"POST",
      success:function(response){
        console.log(JSON.parse(response));
        parsedData = JSON.parse(response);
        for(var i = 0; i<parsedData.length; i++){
          var filename = parsedData[i].filename;
          var path = parsedData[i].path.slice(30);
          var div = document.createElement("div");
          var fileid = parsedData[i].id;
          var subject = parsedData[i].subject;
          var description = parsedData[i].description;
          div.className = "col";
          div.id = "data";
          div.innerHTML = `
            <div class="card shadow-sm">
              <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?php echo base_url(); ?>uploads/${path}"aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title><?php echo $filename; ?>></title>
              <div class="card-body">
                <h3 class="card-text">${subject}</h3>
                <p class="card-text">${description}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">                   
                    <a href="<?php echo base_url(); ?>products/loadFile?id=${fileid}" class="btn btn-inline">Watch</a>
                  </div>
                  <a href="<?php echo base_url(); ?>products/like/${filename}" class="btn btn-inline">like</a>

                </div>
              </div>
            </div>`
          container.appendChild(div);
        }
      }
 })

            // $(document).ready(function(){
            // load_data();
            //     function load_data(query){
            //         $.ajax({
            //         url:"<?php echo base_url(); ?>ajax/fatch",
            //         method:"GET",
            //         data:{query:query},
            //         success:function(response){
            //           var obj = JSON.parse(response);
            //           var filename = obj.filename;
            //           if()
            //           $('#result').html("Not Found!");
            //             // $('#result').html("");
                        // if (response == "" ) {
                        //     $('#result').html(response);
                        // }else{
                    
                        //     if(obj.length>0){
                        //         var items=[];
                        //         $.each(obj, function(i,val){

                                  // var link = $('<a href="' +'<?php echo base_url(); ?>/uploads/' +val.filename + '" />');
                                  // items.push(link);
                                  //   items.push($("<h4>").text(val.filename));
                                  //   if (val.filename.includes("jpg")) {
                                  //       items.push($('<img width="320" height="240" src="' +'<?php echo base_url(); ?>/uploads/' +val.filename + '" />'));
                                  //   }else{
                                  //       items.push($('<video width="320" height="240" controls><source  src="' +'<?php echo base_url(); ?>/uploads/' +val.filename + '" type="video/mp4"></video>'));
                                  //   }
                            // });
                            // $('#result').append.apply($('#result'), items);         
                            // }else{
                            // $('#result').html("Not Found!");
                            // }; 
                //         };
                //     }
                // });
                // }

$('#search_text').keyup(function(){
    var alldata = document.querySelectorAll("#data")
    var search = $(this).val();
    if(search != ''){
      for(var i = 0; i<parsedData.length; i++){
        var filename = parsedData[i].filename;
        if(!filename.includes(search)){
            alldata[i].style.display = "none";
          }
        }
    }else{
      for(var i = 0; i<parsedData.length; i++){
        var filename = parsedData[i].filename;
          alldata[i].style.display = "inline";
      }
    }
});

</script>
<script>
    window.onbeforeunload = function () {
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    }
    else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    }
    else if (typeof document.body != 'undefined') {
        scrollPos = document.body.scrollTop;
    }
    document.cookie = "scrollTop=" + scrollPos; //存储滚动条位置到cookies中
}
 
window.onload = function () {
    if (document.cookie.match(/scrollTop=([^;]+)(;|$)/) != null) {
        var arr = document.cookie.match(/scrollTop=([^;]+)(;|$)/); //cookies中不为空，则读取滚动条位置
        document.documentElement.scrollTop = parseInt(arr[1]);
        document.body.scrollTop = parseInt(arr[1]);
    }
}
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD3YvnVh0YkKJ-vBZ5p5U6AdovieTfYl0&region=GB&callback=initMap">
</script>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
