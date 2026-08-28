<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
  <main>
        <section class="py-5 text-center container">
          <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
              <h1 class="fw-light">Album example</h1>
              <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
              <p>
                <a href="<?php echo base_url(); ?>welcome" class="btn btn-primary my-2">Find your courses</a>
                <a href="<?php echo base_url(); ?>upload" class="btn btn-secondary my-2">Upload your videos</a>
              </p>
            </div>
          </div>
        </section>
          <div class="album py-5 bg-light">
           <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="result">
                        <div class="col">
                          <div class="card shadow-sm">
                          <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="uploads/<?php echo $img_path?>"aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title><?php echo $filename; ?>></title>
                            <div class="card-body">
                              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
    
        <!-- 
        <div class="album py-5 bg-light">
          <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="result">

              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm">
                  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                  <div class="card-body">
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-muted">9 mins</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
  </main>
<!-- <script type="text/javascript">
  $(window).scroll(function(){
  var scrollTop = $(this).scrollTop();
  var scrollHeight = $(document).height();
  var windowHeight = $(this).height();
  if(scrollTop + windowHeight >= scrollHeight){
    var newnode = document.createElement("result");
    newnode.innerHTML = "new item";
    document.body.appendChild(newnode);
    var newline = document.createElement("br");
    document.body.appendChild(newline);
  }
});
</script> -->

<script type="text/javascript">
$(window).scroll(function(){
  var scrollTop = $(this).scrollTop();
  var scrollHeight = $(document).height();
  var windowHeight = $(this).height();
  if(scrollTop + windowHeight >= scrollHeight){
			//发送一条ajax请求
			$.ajax({
				url: "<?php echo base_url(); ?>ajax/fatch_thumbnail",
				method: "Get",
				data: {
					filename: 'jpg'
				},
				success: function (response) {
					var obj = JSON.parse(response);
					if (obj.length > 0) {
						var items = [];
						$.each(obj, function (i, val) {
						  items.push($('<img width="320" height="240" src="' + '<?php echo base_url(); ?>/uploads/' + val.filename + '" />'));
						});

						$('#result').append.apply($('#result'), items);
					} 
				}
			});
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
