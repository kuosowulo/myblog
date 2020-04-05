<!DOCTYPE html>
<html lang="en">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index">Home</a>
          </li>
          @if(Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="post">Post</a>
            </li>
            @if(isset($article))
                @if(Auth::user()->id == $article->author || Auth::user()->IsAdmin == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('viewEditPost', ['id' => $article->id]) }}">Edit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('deletePost', ['id' => $article->id]) }}">Delete</a>
                  </li>
                @endif
            @endif
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logOut') }}">LogOut</a>
              </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">LogIn</a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</html>
