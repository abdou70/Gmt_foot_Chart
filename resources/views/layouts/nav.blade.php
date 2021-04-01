@section('nav')
<section id="container">
  <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
  <!--header start-->
  <header class="header black-bg">
    <div class="sidebar-toggle-box">
      <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="" class="logo"><b>GMT-<span>FOOD</span></b></a>
    <!--logo end-->

    <div class="top-menu ">
      <ul class="nav pull-right top-menu">
      <li>
          <a  class="logout but" href="{{ route('statistique') }}">
            Statistiques
          </a>
        </li>

        <li>
          <a  class="logout but" href="{{ route('statistic_commande') }}">
            graphique_Commande
          </a>
        </li>

        <li>
          <a  class="logout but" href="{{ route('statistic_client') }}">
            graphique_Client
          </a>
        </li>

        <li><a class="logout but " href="{{ route('logout') }}" onclick="return logout(event);">
            {{ __('Deconnexion') }}</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>

      </ul>
    </div>
  </header>
  <!--header end-->
  <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
  <!--sidebar start-->
  <aside>
    <div id="sidebar" class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <p class="centered"><a href="#"><img src="{{ asset('template/img/user.jpg') }}" class="img-circle" width="80"></a></p>
        <h5 class="centered">{{ Auth::user()->name }} </h5>
        <li class="mt">
          <a class="active" href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i>
            <span>Mon Compte</span>
          </a>
        </li>
        @can('manage-users')
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>Profils</span>
          </a>
          <ul class="sub">
            <li><a href="{{ route('admin.profils.index') }}">Lister les profils</a></li>
            <!--  <li><a href="{{ route('admin.profils.create') }}">Ajouter un profil</a></li>
            
  -->
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-users"></i>
            <span>Utilisateurs</span>
          </a>
          <ul class="sub">
            <li><a href="{{ route('admin.users.index') }}">Lister les utilisateurs</a></li>
            <!--        <li><a href="{{ route('admin.users.create') }}">Ajouter un utilisateur</a></li>
            
 -->
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-th"></i>
            <span>Catégories</span>
          </a>
          <ul class="sub">
            <li><a href="{{route('getallcategorie')}}">Lister les categories</a></li>
            <!--  <li><a href="{{route('addcategorie')}}">Ajouter un categories</a></li>
     -->
          </ul>
        </li>
        <li class="sub-menu">
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-cutlery"></i>
            <span>Produits</span>
          </a>
          <ul class="sub">
            <li><a href="{{route('getallproduit')}}">Lister les produits</a></li>
            <!--      <li><a href="{{route('addproduit')}}">Ajouter un produit</a></li>
            
     -->
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-list"></i>
            <span>Mode de payment</span>
          </a>
          <ul class="sub">
            <li><a href="{{route('getallreglement')}}">Liste des modes payment</a></li>
            <li><a href="{{route('addreglement')}}">Ajouter un mode payment</a></li>
          </ul>
        </li>
        @endcan
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-shopping-cart"></i>
            <span>Commandes</span>
          </a>
          <ul class="sub">
            <li><a href="{{url('CurrentCommande')}}">Lister les commande</a></li>
            <li><a href="{{url('commande')}}">Enregistrer une commande</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-dollar"></i>
            <span>Ventes</span>
          </a>
          <ul class="sub">
            <li><a href="{{route('CurrentVente')}}">Visualiser les Ventes</a></li>
            <li><a href="{{url('vente')}}">Enregistrer une vente</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-users"></i>
            <span>Clients</span>
          </a>
          <ul class="sub">
            <li><a href="{{route('addclient')}} ">Liste Clients </a></li>
          </ul>
        </li>
      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>
  <!--sidebar end-->


</section>
</section>
<!--main content end-->

</section>
@endsection