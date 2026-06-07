<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">
    </a>

    <button class="navbar-toggler" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">
          </a>
        </li>
      </ul>

      <!-- KANAN -->
      <div class="d-flex">
        @auth
        <a href="{{ route('logout') }}"
           class="btn btn-danger">
          Logout
        </a>
        @endauth

      </div>

    </div>
  </div>
</nav>