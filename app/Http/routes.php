<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('login',['as'=>'getLogin','uses'=>'LoginController@getLogin']);	
Route::post('login',['as'=>'postLogin','uses'=>'LoginController@postLogin']);

Route::group(['middleware'=>'auth'],function(){	
		Route::group(['prefix'=>'lbm_admin','namespace'=>'Admin'],function(){
			Route::get('/',['as'=>'dashboard','uses' => 'UsersController@dashboard']);
			Route::group(['prefix'=>'user'],function(){
				Route::get('listUser/{check?}',['as'=>'listUser','uses'=>'UsersController@index']);
				Route::post('listUser',['as'=>'listUser','uses'=>'UsersController@destroyall']);
				Route::get('addUser',['as'=>'addUser','uses'=>'UsersController@create']);
				Route::post('addUser',['as'=>'postAddUser','uses'=>'UsersController@store']);
				Route::get('editProfile',['as'=>'editProfile','uses'=>'UsersController@show']);
				Route::post('editProfile',['as'=>'editProfile','uses'=>'UsersController@edit']);
				Route::post('search',['as'=>'search.user','uses'=>'UsersController@search']);
			});
			Route::group(['prefix'=>'kind'],function(){
				Route::get('listKind',['as'=>'listKind','uses'=>'KindController@listKind']);
				Route::get('addKind',['as'=>'addKind','uses'=>'KindController@addKind']);
				Route::post('addKind',['as'=>'addKind','uses'=>'KindController@postAddKind']);
				Route::post('listKind',['as'=>'listKind','uses'=>'KindController@delKind']);
				Route::get('editKind/{id}',['as'=>'editKind','uses'=>'KindController@editKind']);
				Route::post('editKind/{id}',['as'=>'editKind','uses'=>'KindController@postEditKind']);
				Route::post('search',['as'=>'search.kind','uses'=>'KindController@search']);
				Route::post('/addKindFromFilm',function(\Illuminate\Http\Request $request){
					DB::table('kinds')->insert([
						'kind_name' => $request['nameKind'], 
						'created_at' => new DateTime]
					);		
				})->name('addKindFromFilm');
			});
			Route::group(['prefix'=>'film'],function(){
				Route::get('listFilm',['as'=>'listFilm','uses'=>'FilmController@listF']);
				Route::post('listFilm',['as'=>'postlistFilm','uses'=>'FilmController@delFilm']);
				Route::get('addfilm',['as'=>'addfilm','uses'=>'FilmController@getadd']);
				Route::post('addfilm',['as'=>'addfilm','uses'=>'FilmController@postAdd']);
				Route::get('editfilm/{movie_id}',['as'=>'editfilm','uses'=>'FilmController@editFilm']);
				Route::post('editfilm/{movie_id}',['as'=>'posteditfilm','uses'=>'FilmController@posteditFilm']);
				Route::post('search',['as'=>'search.film','uses'=>'FilmController@search']);
				Route::get('detail/{id}',['as'=>'detail','uses'=>'FilmController@detail']);
				Route::post('editEn/{mid}',['as'=>'editEn','uses'=>'FilmController@editEn']);
				Route::post('lockEpisodes', function(\Illuminate\Http\Request $request){
					DB::table('episodes')
					->where('episodes_id',$request['eid'])
					->update([
						'completed' => $request['complete'],
						'episodes_updated_at' => new DateTime
					]);
				})->name('lockEpisodes');
			});
			Route::group(['prefix'=>'episodes'], function(){
				Route::get('addEp/{id}',['as'=>'addEp','uses'=>'EpisodesController@getAdd']);
				Route::post('addEp/{id}',['as'=>'addEp','uses'=>'EpisodesController@postAdd']);
				Route::get('delEp/{id}',['as'=>'delEp','uses'=>'EpisodesController@delEp']);
				Route::get('edit/{id}',['as'=>'editEp','uses'=>'EpisodesController@editEp']);
				Route::post('edit/{idm}/{id}/{nameEp}',['as'=>'postEditEp','uses'=>'EpisodesController@postEditEp']);
				Route::get('learn/{ide}',['as'=>'learn','uses'=>'EpisodesController@getLearn']);
				Route::post('/insert',function(\Illuminate\Http\Request $request){
					DB::table('sentence')->insert(
						    ['episodes_id' => $request['eid'], 
						    'english' => trim($request['content']),
						    'vietnamese' =>"",
							'created_at' => new DateTime,
							'numOrder' => $request['no']]
						);
					DB::table('user_sentence')->insert(
					    ['user_id' => Auth::user()->id, 
					    'created_at' => new DateTime,
					    'episodes_id' => $request['eid'],
					    'numOrder' => $request['no']]
					);
				})->name('insert');
			});
			Route::group(['prefix'=>'sentence'],function(){
				Route::get('check/{eid}',['as'=>'check','uses'=>'SentenceController@check']);
				Route::post('/enRight',function(\Illuminate\Http\Request $request){
					DB::table('sentence')->where([
						['episodes_id', '=', $request['eid']],
						['numOrder','=',$request['numOrder']]
					])->update([
						'english' => trim($request['en']),
						'vietnamese' => $request['vi'],
						'updated_at' => new DateTime
					]);
				})->name('enRight');
				Route::post('/wrong',function(\Illuminate\Http\Request $request){
					DB::table('user_episodes')->insert(
					    ['episodes_id' => $request['eid'], 
					    'user_id' => Auth::user()->id,
					    'created_at' => new DateTime,
					    'numOrderWrong' => $request['numOrderWrong']
					]
					);			
				})->name('wrong');
				Route::post('wrongSen/{eid}/{now}',['as'=>'wrongSen','uses'=>'SentenceController@wrongSen']);
				Route::get('videoPage/{eid}',['as'=>'videoPage','uses'=>'SentenceController@videoPage']);
				Route::post('editFileInCheck/{mid}',['as'=>'editFileInCheck','uses'=>'SentenceController@editFileInCheck']);
				Route::get('listSen/{mid}/{eid}',['as'=>'listSen','uses'=>'SentenceController@listSen']);
				Route::get('editSen/{eid}/{num}',['as'=>'editSen','uses'=>'SentenceController@editSen']);
				Route::post('/editSentence',function(\Illuminate\Http\Request $request){
					DB::table('sentence')
					->where([
						['episodes_id','=', $request['eid']],
						['numOrder','=', $request['numOrder']]
					])
					->update([
						'english' => $request['en'],
						'vietnamese' => $request['vi'],
						'updated_at' => new DateTime
					]);
				})->name('editSentence');
				Route::get('delSen/{eid}/{num}',['as'=>'delSen','uses'=>'SentenceController@delSen']);
			});


			// Word
			Route::group(['prefix'=>'words'],function(){
				Route::get('listVocabulary',['as'=>'listVocabulary','uses'=>'VocabularyController@listVocabulary']);
				Route::post('/addVocabulary',function(\Illuminate\Http\Request $request){
					DB::table('vocabulary')->insert([
						'user_id' => Auth::user()->id,
						'english_words' => trim($request['en']),
						'vietnamese_words' => trim($request['nghia']),
						'created_at' => new DateTime
						]);
					})->name('addVocabulary');
				});
				Route::get('practiceWord',['as'=>'practiceWord','uses'=>'VocabularyController@practiceWord']);
				Route::post('checkVocabulary',['as'=>'checkVocabulary','uses'=>'VocabularyController@checkVocabulary']);
				Route::post('editVocabulary',function(\Illuminate\Http\Request $request){

					DB::table('vocabulary')
					->where([
						['user_id','=', Auth::user()->id],
						['vietnamese_words','=',$request['vi']]
					])
					->orWhere([
						['user_id','=', Auth::user()->id],
						['english_words','=',$request['en']]
					])
					->update(
					    [
					    	'english_words' => $request['en'],
					    	'vietnamese_words' => $request['vi'],
					    	'updated_at' => new DateTime
					    ]
					);
				})->name('editVocabulary');
		});
});

Route::get('logout',['as'=>'logout','uses'=>'LoginController@logout']);


