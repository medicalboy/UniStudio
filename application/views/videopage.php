<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body>

<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?php echo base_url(); ?>videos" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="<?php echo base_url(); ?>Manipulation" class="nav-link px-2 link-dark">Image processing</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
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
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php if($this->session->userdata('logged_in')) : ?>
            <li> <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout"> Sign out </a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </header>


  <?php echo form_open(base_url().'products/rating/'.$fileid); ?>
    <div class="bg-light me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
            <div id="courseId"></div>
            <h2 class="display-5">Courses</h2>
            <p class="lead">And an even wittier subheading.</p>
            <div class="bg-body shadow-sm mx-auto" id="result" style="width: 80%; height: 500px; border-radius: 21px 21px 0 0;">
                The rating of this course is <?php echo $ratings ?>
              <!-- <a href="<?php echo base_url(); ?>products" class="btn btn-inline">add to cart -->
            </div>
            <button>rating</button>
            <label for="categories">Please rate this course from 1-5:</label>
                <select name="categories" id="categories">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
   <?php echo form_close(); ?>
            <div class="lead">
                <h2>Comments:</h2>
                <input id="textarea" style = "width:500px; height:300px;border-style: solid; border-color:black" name="content">
                <button type= "submit">post</button>

            </div>
            <div id="comment">
            </div>
        </div>
    </div>
<script>

  
  // var courseid = document.querySelector("#courseId");
  // courseid.textContent = window.location.href.split("/").pop();
  var ccid = window.location.href.split("/").pop();
  var textarea = document.querySelector("#textarea");
  $("button").click(function(){
    $.ajax({
      url:`<?php echo base_url(); ?>products/do_comment/${ccid}`,
      method:"POST",
      data:{content:textarea.value},
      success:function(response){
        alert("Succsessful");
        location.reload();
      }
    });
  });





  // var listid=[];
  // listid.push(ccid);
  // console.log(ccid);
    $.ajax({
      url:"<?php echo base_url(); ?>products/fetchcomment",
      method:"GET",
      success:function(response){
        var parsed = JSON.parse(response);
        var item=[];
        for(var i=0;i<parsed.length;i++){
          var content=parsed[i].content;
          var vid=parsed[i].vid;
          var postby=parsed[i].postby;
          var cid = parsed[i].cid;
          item.push('comment :'+cid+'</br>');
          item.push('postby :'+ postby+'</br>');
          item.push(content+'<br>');
        }
        $('#comment').append.apply($('#comment'), item);  
      }
     })
      var parsedData1;
      var item1=[];
      $.ajax({
      url:"<?php echo base_url(); ?>ajax/fetchAll",
      method:"POST",
      success:function(response){
        parsedData1 = JSON.parse(response);
        for(var i = 0; i<parsedData1.length; i++){
          var fileid = parsedData1[i].id;
          item1.push(fileid);
        }
      }
    })

    let numbers = item1;

     $.ajax({
      url:"<?php echo base_url(); ?>ajax/fetchvideo",
      method:"GET",
      success:function(response){
        // console.log(numbers);
        var parsedData = JSON.parse(response);
        var items=[];
        for(var i = 0; i<parsedData.length; i++){
          var filename = parsedData[i].coursename;
          var vid=parsedData[i].vid;
          console.log(vid);
          if (ccid==vid) {
            items.push($("<h4>").text(vid));
            items.push($('<video width="320" height="240" controls><source  src="' +'<?php echo base_url(); ?>/uploads/' +filename + '" type="video/mp4"></video>'));
          }
        $('#result').append.apply($('#result'), items);  
        }
    }
 })

</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>