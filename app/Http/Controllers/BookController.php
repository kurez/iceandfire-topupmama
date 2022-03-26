<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use DB;
use App\Models\Comments;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
// use Request;

class BookController extends Controller
{
    //
    public function index()
    {
        // fetch book from ICEANDFIRE api
        $client = new Client(); // use GuzzleHttp\Client
        $url = "https://www.anapioficeandfire.com/api/books?pageSize=100";

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        // response from Guzzle
        $responseBody = json_decode($response->getBody(), true);

        /* 
        sort the response by using the release date

        *
        * returns from newest date

        */
        usort($responseBody, function($a, $b) {
            return $a['released'] < $b['released'] ? 1 : -1;
        });

        // reverse array to return from earliest
        return array_reverse($responseBody);
        
    }

    public function storeComment (Request $request ) {
        
        // validate request
        $this->validate($request,[
            'comment'=>'required|max:500' // limit comment characters to 500
         ]);

        // insert comment into table
        $stored = DB::table('comments')->insert(
            ['book_name' => $request['book'], 
            'client_ip' => $request->ip(),
            'comment' => $request['comment'],
            'created_at' => date("Y-m-d H:i:s", strtotime('now'))]
        );

        // if success
        if ($stored) {
            return 'Comment was saved successfully!';
        }
        // if error
        return 'Comment was  not saved!';
    }

    public function showComments (Request $request) {

        // fetch book details by name 
        $comments = DB::table('comments')->where('book_name', $request['name'])->orderByDesc('created_at')->get();

        // if no comments found in query
        if (sizeof($comments) < 1) {
            return 'No comments available!';
        }

        return response()->json($comments);

    }

    public function allComments (Request $request) {
        
        $comments = DB::table('comments')->orderByDesc('created_at')->get();

        // if no comments found in query
        if (sizeof($comments) < 1) {
            return 'No comments available!';
        }

        return response()->json($comments);

    }

    public function getCommentsCount (Request $request) {
        // fetch comment count
        $comments = DB::table('comments')
        ->selectRaw('book_name, COUNT(*) as count')
        ->groupBy('book_name')
        ->orderBy('count', 'desc')
        ->get();

        return response()->json($comments);
    }

    public function getCharacters (Request $request) {
        
        // fetch book from ICEANDFIRE api
        
        $client = new Client(); // use GuzzleHttp\Client
        $url = 'https://www.anapioficeandfire.com/api/books/'.$request['name'];

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        // response from Guzzle to fetch book
        $responseBody = json_decode($response->getBody(), true);


        // fetch 
        $url = 'https://www.anapioficeandfire.com/api/characters?page='.$request['page'].'&pageSize=50';

        $responseChar = $client->request('GET', $url, [
            'verify'  => false,
        ]);


        $responseBodyChar = json_decode($responseChar->getBody(), true);
     
        // create a array to store character details
        $newArray = [];

        // loop over to store into array if character if found in book
        foreach ($responseBodyChar as $k1 ){
            foreach ($responseBody['characters'] as $k2 ){
                if ($k2 === $k1['url'])
                array_push($newArray, ['name' => $k1['name'],'gender' => $k1['gender'],'born' => $k1['born'],'died' => $k1['died'],'url' => $k1['url']]);
            }
        }
           
       // filter by gender
        $response = [];
        if ($request['gender'] !== 'All') {
            
            foreach ($newArray as $array) {
                if ($array['gender'] === $request['gender']) {
                    array_push($response, ['name' => $array['name'],'gender' => $array['gender'],'born' => $array['born'],'died' => $array['died'],'url' => $array['url']]);
                }
            }

        } else {
            foreach ($newArray as $array) {
                    array_push($response, ['name' => $array['name'],'gender' => $array['gender'],'born' => $array['born'],'died' => $array['died'],'url' => $array['url']]);
            }
        }
        
        // perform sorting by desc and using name,gender,(age) as criteria
        $collection = collect($response);
        if($request['sort'] === 'Desc') {
            $sorted = $collection->sortBy([[$request['criteria'],'desc']]);
            $count = $collection->count();
            return response()->json(['data' => $sorted, 'count' => $count]);
        } else if ($request['sort'] === 'Asc') {
            $sorted = $collection->sortBy([[$request['criteria'], 'asc']]);
            $count = $collection->count();
            return response()->json(['data' => $sorted, 'count' => $count]);
        } 


    }
}
