<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {

    Route::resource('users', 'UsersController');
    Route::get('/user/delete/{id}', 'UsersController@delete')->name('deleteuser');
    Route::put('update-password', 'UsersController@updatePassword')->name('update-pass');
    Route::get('set-password/{id}', 'UsersController@setPassword')->name('set-pass');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {

    Route::resource('profils', 'ProfilController');
});


//Produits
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/produit/add', 'ProduitController@add')->name('addproduit');
Route::get('/produit/edit/{id}', 'ProduitController@edit')->name('editproduit');
Route::post('/produit/update', 'ProduitController@update')->name('updateproduit');
Route::post('/produit/ajouter', 'ProduitController@ajouter')->name('ajouterproduit');
Route::get('/produit/delete/{id}', 'ProduitController@delete')->name('deleteproduit');
Route::get('/produit/getall', 'ProduitController@getAll')->name('getallproduit');

//Categories
Route::get('/categorie/add', 'CategorieController@add')->name('addcategorie');
Route::get('/categorie/edit/{id}', 'CategorieController@edit')->name('editcategorie');
Route::post('/categorie/update', 'CategorieController@update')->name('updatecategorie');
Route::post('/categorie/ajouter', 'CategorieController@ajouter')->name('ajoutercategorie');
Route::get('/categorie/delete/{id}', 'CategorieController@delete')->name('deletecategorie');
Route::get('/categorie/getall', 'CategorieController@getAll')->name('getallcategorie');

//Clientel
Route::get('/client/add', 'ClientsController@add')->name('addclient');
Route::post('/client/persist', 'ClientsController@persist')->name('persistclient');
Route::get('/client/{id}', 'ClientsController@edit')->name('editclient');
Route::post('/client/searchPost/', 'ClientsController@searchPost')->name('searchclient');
Route::get('/client/searchNom/{search}', 'ClientsController@index')->name('search');
Route::get('/clientpdf', 'ClientsController@export')->name('exportclients');
Route::get('/client/delete/{id}', 'ClientsController@delete')->name('delete');
Route::get('/client/edit/{id}/', 'ClientsController@edit')->name('editclient');
Route::post('/client/update/{id}', 'ClientsController@update')->name('update');

//change password
Route::put('update-password', 'PasswordController@updatePassword')->name('update-password');
Route::get('set-password', 'PasswordController@setPassword')->name('set-password');

//commande 
Route::get('cart', 'CommandeController@cart');
Route::get('commande', 'CommandeController@listproduit');
Route::get('add-to-cart/{id}', 'CommandeController@addToCart');
Route::patch('update-cart', 'CommandeController@update');
Route::delete('remove-from-cart', 'CommandeController@remove');
Route::post('saveCommande', 'CommandeController@saveCommande')->name('enregistrerCommande');
Route::get('CurrentCommande', 'CommandeController@CurrentCommande')->name('CurrentCommande');
Route::get('nonlivres', 'CommandeController@CommandeNonLivres')->name('nonlivres');
Route::get('validerlivraison/{id}', 'CommandeController@ValiderLivraison')->name('validerlivraison');
Route::get('pdfCommande', 'CommandeController@genererpdf')->name('pdfCommande');
Route::get('/stats/all', 'CommandeController@stat')->name('statistique');
Route::get('/search/{search}', 'CommandeController@search')->name('cli');

//ventes
Route::get('vente', 'VenteController@listproduit');
Route::get('cartv', 'VenteController@cart');
Route::get('add-to-cartv/{id}', 'VenteController@addToCart');
Route::patch('update-cartv', 'VenteController@update');
Route::delete('remove-from-cartv', 'VenteController@remove');
Route::post('saveVente', 'VenteController@saveVente')->name('enregistrerVente');
Route::get('CurrentVente', 'VenteController@CurrentVente')->name('CurrentVente');
Route::get('CurrentVente', 'VenteController@CurrentVente')->name('CurrentVente');
Route::get('pdfvente', 'VenteController@genererpdf')->name('pdfvente');

//reglement

Route::get('/reglement/add', 'ReglementController@add')->name('addreglement');
Route::post('/reglement/ajouter', 'ReglementController@ajouter')->name('ajouterreglement');
Route::get('/reglement/getall', 'ReglementController@getAll')->name('getallreglement');


//chart
Route::get('/commande/statistic', 'ChartController@statecommande')->name('statistic_commande');
Route::get('/vente/statistic', 'ChartController@stateclient')->name('statistic_client');
