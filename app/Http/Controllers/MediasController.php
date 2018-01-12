<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Trailer;
use App\Models\Cast;
use App\Models\MediaToCast;
use App\Models\Genre;

class MediasController extends Controller
{
    //

    public function index(){

        $new_movies=Media::where([['status','=','Released'], ['release_date','<=',date('Y-m-d')]])->orderBy('release_date', 'desc')->take(4)->get();
        $top_rated = Media::where([['status','=','Released']])->orderBy('rating','desc')->take(4)->get();
        $upcoming_movies = Media::where([['title','!=',''],['release_date','>',date('Y-m-d')]])->orderBy('release_date','asc')->take(4)->get();
        return view('pages.index', compact('new_movies','top_rated','upcoming_movies'));
    }

    public function detail($id){
        $movie_detail = Media::find($id);
        $trailers = Trailer::find($id);

        $casts=Media::find($id)->casts->where('cast_character','!=','')->take(5);
        $staffs=Media::find($id)->casts->where('department','=','Production')->take(4);
        $director = Media::find($id)->casts->where('job','=','Director')->take(1);
        $genres = Media::find($id)->genres;
        $companies = Media::find($id)->companies;
    
        $reviews = Media::find($id)->reviews;

       
       // return var_dump(($casts));
        return view ('pages.detail', compact('movie_detail','trailers','casts', 'staffs','genres','companies','director','reviews'));
    }
    

    public function newArrival(){
        $new_movies=Media::where([['type','=','Movie'],['status','=','Released'], ['release_date','<=',date('Y-m-d')]])->orderBy('release_date', 'desc')->paginate(15);

        return view('pages.new_arrival',compact('new_movies'));
    }
    public function topRated(){
        $top_rated=Media::where([['type','=','Movie'],['status','=','Released']])->orderBy('rating', 'desc')->paginate(15);
        return view('pages.top_rated', compact('top_rated'));
    }
    public function upcoming(){
        $upcoming=Media::where([['type','=','Movie'], ['release_date','>',date('Y-m-d')]])->orderBy('release_date', 'asc')->paginate(15);
        return view('pages.upcoming',compact('upcoming'));
    }

    public function airingToday(){
        $recent_tvShows = Media::where([['type','=','TV'],['title','!=','']])->orderBy('release_date', 'desc')->paginate(15);
        return view('pages.airing_today',compact('recent_tvShows'));
    }

    public function topRatedTV(){
        $top_rated=Media::where([['type','=','TV']])->orderBy('rating', 'desc')->paginate(15);
        return view('pages.topRated_tv', compact('top_rated'));
    }

    public function popularTV(){
        $popular=Media::where([['type','=','TV']])->orderBy('rating', 'desc')->paginate(15);
        return view('pages.popular_tv', compact('popular'));
    }





}
