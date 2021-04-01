@extends('layouts.template')
@include('layouts.nav')
@section('content')
    <div class="row mt">
      <div class="col-lg-12">
        <form method="POST" action="{{route('update',['id'=> $clients->id ])}}">
                        @csrf
                   <div class="form-group">

                    <label for="id" class="control-label"> Modifier le client :</label> 
                    <input type="hidden"  name="id" id="id" value="{{ $clients->id }}" class="form-control" />
                    </div>
                   
                    <div class="form-group">
                    <br>
                        <label for="nom" class="control-label"> Nom et Prenom du Client :</label>
                        <input type="text" name="nom" id="nom" 
                        value="{{ $clients->nom }}"  class="form-control"  onblur="notNumber(this)"  required/>
                    </div>

                    
                    <div class="form-group">
                        <br>
                        <label for="adresse" class="control-label"> Adresse du Client:</label>
                        <input type="text" name="adresse" id="adresse" 
                        value="{{ $clients->adresse }}"  class="form-control" required onblur="notNumber(this)" />
                    </div>

                    <div class="form-group">
                    <br>
                        <label for="telephone" class="control-label">  Telephone du Client :</label>
                        <input type="text" name="telephone" id="telephone" 
                        value="{{ $clients->tel }}"  class="form-control" onblur="telephoneCheck(this)" required />
                    </div>

                    

                    <div class="form-group">

                        <input class="btn btn-success" type="submit" name="Envoyer" id="envoyer" href='/client/add' value="Envoyer" />  
                        <input class="btn btn-theme" type="submit" name="Annuler" id="Annuler" href='/client/add' value="Annuler" /> 

                    </div>
                </form>
             </div>
            </div>
            <!-- /form-panel --> 
    </div>

</div>
@endsection
@include('layouts.footer')
       