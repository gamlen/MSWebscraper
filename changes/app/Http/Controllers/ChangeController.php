<?php

namespace App\Http\Controllers;

use App\Change;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;
use App\Rules\ValidForm;
use App\Rules\ValidURL;

class ChangeController extends Controller
{   
  /*public function updatePage(Request $request) {
        $url = 'http://ms-idi.eu/';
        $file = file($url);
        //dd($storagePath);
    
        //SAVINGS
        //Storage::disk('local')->put($storagePath, $file); //Вставляем контент
        $newContent = Storage::disk('local')->put('htmltestingcode.txt', $file);
        $newText = Storage::disk('local')->get('htmltestingcode.txt'); //Берем контент
        $oldText = Change::where('name' == $url)
                          ->where('docs')
                          ->get();//Берем с БД

    
        if($oldText != $newText) 
        {  //Сравниваем контент
          $change = Change::find($id);
          $change->docs = $request->update(['docs' => $url]); 
          $change->email = $request->input('email', 'Testing');
          $change->save();
        }

    }*/

    public function addContent(Request $request){
      $request->validate([
        'nosaukums' => ['required', new ValidForm],
        'URL' => ['required', new ValidURL]
        ]);

      $change = new Change();
      $change->nosaukums = $request->input('nosaukums');
      $change->URL = $request->input('URL');
      $change->save();
      return response()->json(['webscraper' => $change], 201);
    }


    function getContent() 
      {
        $changes = Change::all();
        $response = [
            'changes' => $changes
        ]; 
        return response()->json($response, 200);
      }
    
    //$doc = phpQuery::newDocument($file); //Говорим, что будем работать с этим доком
    
    
    //phpQuery::unloadDocuments($doc); //Разгружаем, после всех действии, для оперативной памяти
    
    function send()
      {
       Mail::send(['text' => 'test'], ['name', 'User'], function($message){
         $message->to('kraig-rus@mail.ru', 'To User')->subject('Test email');
         $message->from('testforlaravel@mail.ru', 'To User');
       });
    }
  }