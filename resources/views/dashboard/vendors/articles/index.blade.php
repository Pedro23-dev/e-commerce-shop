@extends('layouts.vendor-dashboard-layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Mes articles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Consulter la liste</li>
    </ol>
   
    <div class="card mb-4">
        <div class="card-header" style="display: flex; justify-content:flex-end">
           <a href="{{route('articles.create')}}" class="btn btn-primary btn-sm">Ajouter un article</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        
                        <th></th>
                        <th>Libelle</th>
                        <th>Prix</th>
                        <th>Disponibilité</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                
                <tbody>

                    @foreach ($articles as $article)
                          <tr>
                        <td>
                            @if($article->image)
                            
                    

                            <div style="background-image: url('{{asset('storage/'.$article->image->path)}}');
                            width:50px;
                            height:50px;
                            background-position:center;
                            background-size: cover;"></div>
                        @endif
                            </td>
                        <td>{{$article->name}}</td>
                        <td>{{$article->price}}</td>
                        <td>{{$article->active? 'Disponible':'Rupture de stock'}}</td>
                        <td> <a href="#" class="btn btn-primary">modifier l'article</a>
                             <a href="#" class="btn btn-danger">Supprimer l'article</a></td>
                    </tr>
                    @endforeach
                  
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection