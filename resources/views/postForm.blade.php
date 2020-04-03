<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clean Blog - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('/') }}myblog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('/') }}myblog/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{ asset('/') }}myblog/css/clean-blog.min.css" rel="stylesheet">

  <!-- include libraries(jQuery, bootstrap) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

</head>

<body>

  <!-- Navigation -->
  @include('navigation')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('myblog/img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>New Post</h1>
            <span class="subheading">Post New Article.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <form method="POST" @if(isset($article)) action="/edit/{{ $article->id }}" @else action="/post" @endif novalidate="">
          {{ csrf_field() }}
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Title</label>
            <input type="text" class="form-control" placeholder="Title" name="title" required data-validation-required-message="Please enter title." @if(isset($article)) value={{ $article->title }} @endif>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>SubTitle</label>
              <input type="text" class="form-control" placeholder="SubTitle" name="subtitle" required data-validation-required-message="Please enter subtitle." @if(isset($article)) value={{ $article->subtitle }} @endif>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Content</label>
              <textarea id="summernote" name="editordata">@if(isset($article)) {!! $article->content !!} @endif</textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>


  <script>
    $('#summernote').summernote({
      placeholder: 'Content',
      tabsize: 2,
      height: 350,
      focus: true,
      callbacks: {
          onImageUpload: function (image) {

              uploadImage(image[0]);
          }
      }

      // function uploadImage(image) {
      //       var data = new FormData();
      //       data.append("image", image);
      //       $.ajax({
      //           url: 'uploadImage',
      //           cache: false,
      //           contentType: false,
      //           processData: false,
      //           data: data,
      //           type: "post",
      //           success: function (url) {
      //               if (url.status == 1) {
      //                   var image = $('<img>').attr('src','/backend/'+url.path);
      //                   $('#summernote').summernote("insertNode", image[0]);
      //               }
      //           },
      //           error: function (data) {
      //               console.log(data);
      //           }
      //       });
      //   }
      // onImageUpload: 
      // function(files, editor, welEditable) {
        // sendFile(files[0], editor, welEditable);
      // }
      // function sendFile(file, editor, welEditable) {
      //   data = new FormData();
      //   data.append("file", file);
      //     $.ajax({
      //         data: data,
      //         type: "POST",
      //         url: "uploadImage",
      //         cache: false,
      //         contentType: false,
      //         processData: false,
      //         success: function(url) {
      //             editor.insertImage(welEditable, url);
      //         }
      //     });
      // }
    });
  </script>
</body>

</html>
