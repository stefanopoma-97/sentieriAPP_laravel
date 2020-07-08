@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Sentieri</a>
@endsection


@section('navbar')
<li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
<li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

    @if($logged)
    <li class="dropdown" style="margin-left: 5em;">
        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Account</a></li>
            <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
            @if($user->admin == 'y')
            <li><a href="{{ route('user.elenco') }}">Lista utenti</a></li>
            <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
            @else
            @endif
            <li><a href="{{ route('user.logout') }}">Log out</a></li>
        </ul>
    </li>
    @else
        <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
        <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

    @endif

@endsection

@section('sfondo')
@endsection


@section('header')
<!--<h2 class="pull-left">Dettagli utente: {{$user_dettagli->username}}</h2>-->
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li class="active">Utente</li>
</ul>
@endsection

@section('corpo')
<div class="container pt-5" style="margin-top: 2em;">
    

    <div class="row">

        <div align="center" class="col-md-12">
            <div> 
                <div style="position:relative">
                <img alt="image" width="200px" height="200px"class="img-circle img-responsive " src="{{$url}}">
                </div>
                <div class="row">
<!--                    <div class="col-md2">
                        @if($user_dettagli->admin=='y')
                        <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                            <span class="popuptext">Utente amministratore</span>
                            <span class="glyphicon glyphicon-tower" ></span>
                        </div>
                        @else
                        @endif
                    </div>-->
                </div>
                
                <h2>
                    
                    <strong>{{ $user_dettagli->username }}  </strong>
                    @if ($user_dettagli->id == $user_id)
                    <span onclick="location.href='{{ route('user.edit', ['id'=> $user_id]) }}'" class="glyphicon glyphicon glyphicon-cog"></span>
                    <h5><a href="{{route('user.rimuovifotoprofilo',['id'=> $user->id])}}">Rimuovi foto profilo</a></h5>
                    @endif
                </h2>
                    
                
                
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <ul class="list-group ">
                        <li class="list-group-item"><q>Nome: {{ $user_dettagli->nome }}</q></li>
                        <li class="list-group-item ">Cognome: {{ $user_dettagli->cognome }}</li>
                        @if($user->id == $user_dettagli->id)
                        <li class="list-group-item ">Città: {{ $user_dettagli->citta->nome }}</li>
                        <li class="list-group-item ">Mail: {{ $user_dettagli->mail }}</li>
                        <li class="list-group-item "><a href="{{route('esperienza.mieesperienze',['id'=> $user->id])}}">Esperienze da revisionare</a></li>
                        @if(count($user_dettagli->preferiti)==0)
                        <li class="list-group-item ">Preferiti: {{ count($user_dettagli->preferiti) }}</a></li>
                        @else
                        <li class="list-group-item ">Preferiti: <a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">{{ count($user_dettagli->preferiti) }}</a></li>
                        @endif
                        @else
                        @endif
                        <li class="list-group-item ">Percorsi effettuati: {{ count($user_dettagli->esperienze) }}</li>
                        
                        <li class="list-group-item "><q>"{{$user_dettagli->descrizione}}"</q></li>
                        @if ($user_dettagli->id == $user_id)
                        <form action="{{route('user.fotoprofilo',['id'=> $user->id])}}" id="modifica_foto_profilo" name="modifica_foto_profilo" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="foto_profilo" class="col-form-label">Foto profilo</label>
                                    <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                        <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                                        <span class="glyphicon glyphicon-info-sign" ></span>
                                    </div>
                                </div>

                                <div class="col-sm-7">
                                    <input onchange="sizee(this)" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="foto_profilo" name="foto_profilo" placeholder="foto_profilo">
                                    <span class="invalid-input" id="invalid-foto_profilo"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" name="id" value="{{ $user_id }}"/>
                                    <label for="mySubmit" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); check_foto_profilo(this);" id="mySubmit" type="submit" value="save" class="hidden"/>

                                </div>
                            </div>

                            <div class="form-group">
                                
                            </div>
                        </form>
                        @endif

                    </ul>
                </div>

            </div>
        </div>
    </div>
    
    @if ($user_dettagli->id == $user_id)
    <!--action="{{route('user.update',['id'=> $user->id])}}"-->
    
    
    @endif    
    
        <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">Percorsi effettuati</h3>
            </div>
        </div>
        </div>
        <div class="row">
            
                <div class="col-md-10 col-md-offset-1">
                    <table id="tabella_elenco_sentieri_effettuati" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                        <col width='40%'>
                        <col width='20%'>
                        <col width='20%'>
                        <col width='10%'>
                        
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Categoria</th>
                                <th>Città</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sentieri_effettuati as $sentiero)
                            <tr>
                                <td>{{ $sentiero->titolo }}</td>
                                <td>{{ $sentiero->categoria->nome }}</td>
                                <td>{{ $sentiero->citta->nome }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}"><span class="glyphicon glyphicon-info"></span> Info</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                       
                    </table>
                </div>
            </div>


    </div>

@if(count($esperienze) == 0)
@else

<div class="container">
    <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">Esperienze personali</h3>
            </div>
        </div>
    </div>


<div id="myCarousel" class="carousel slide container" data-ride="carousel">
  <!-- Indicators -->
<!--  <ol class="carousel-indicators" >
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

      <?php $pos = 1 ?>
      @foreach ($esperienze->chunk(4) as $esperienze4)


      <?php
      if ($pos == 1)
          echo '<div class="item active">';
      else
          echo '<div class="item">';
      $pos++
      ?>

      <div class="row col-md-10 col-md-offset-1">
          @foreach($esperienze4 as $esperienza)

          <div class="col-m-3 col-sm-3">
              <ul class="list-group ">
                  <li align='center' class="list-group-item "><h4>{{ $esperienza->sentiero->titolo }}</h4></li>
                  <li style="height: 100px" class="list-group-item"><q>{{ $esperienza->sentiero->descrizione }}</q></li>
                  <li class="list-group-item ">Difficoltà:   {{ $esperienza->difficolta}}</li>
                  <li class="list-group-item ">Voto:   {{ $esperienza->voto }}</li>
                  <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
              </ul>
          </div>

          @endforeach
      </div>
  </div>
  @endforeach

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" style="background-image: none;" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" style="background-image: none;" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>

  
</div>
@endif
@endsection