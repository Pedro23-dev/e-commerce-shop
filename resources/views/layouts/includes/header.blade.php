 <!-- Navigation-->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container px-4 px-lg-5">
         <a class="navbar-brand" href="{{'/'}}">Pedro_store🍏</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                 <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                 <li class="nav-item"><a class="nav-link" href="#!">A propos</a></li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Boutique</a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <li><a class="dropdown-item" href="#!">All Products</a></li>
                         <li>
                             <hr class="dropdown-divider" />
                         </li>
                         <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                         <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                     </ul>
                 </li>
             </ul>
             <form class="d-flex">
                 <button class="btn btn-outline-dark" type="submit">
                     <i class="bi-cart-fill me-1"></i>
                     Cart
                     <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                 </button>
             </form>

             @guest
             <div style="margin-left: 1rem;">
                 <li class="nav-item dropdown" style="list-style-type: none;">
                     <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Compte</a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <li><a class="dropdown-item" href="{{route('user.register')}}">Créer mon compte</a></li>
                         <li>
                             <hr class="dropdown-divider" />
                         </li>
                         <li><a class="dropdown-item" href="{{route('user.Login')}}">Me connecter</a></li>

                     </ul>
                 </li>
             </div>
             @endguest

             @auth
                     <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{auth('web')->user()->name}}</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item " href="{{route('user.logout')}}">Me déconnecter</a></li>
                </ul>
            </li>
        </ul>

             {{-- <a href="{{route('user.logout')}}" class="btn btn-danger" style="margin-left: 1rem;">Me déconnecter</a> --}}
             @endauth

         </div>
     </div>
 </nav>