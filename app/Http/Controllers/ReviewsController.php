<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Media;

class ReviewsController extends Controller
{
    //
    public function review(Request $request){
        $score=$request->input('score');
        $user=$request->input('user');
        $media_id=$request->input('mediaID');
        $content = $request->input('review_content');
        $review_id=str_random(25);

        $review = new Review();
        $review->id=$review_id;
        $review->review_content=$content;
        $review->author=$user;
        $review->review_rating=$score;
        $review->review_url='';
        $review->save();

        \DB::table('media_review')->insert(['media_id'=>$media_id,'review_id'=>$review_id]);
        $tmp =\DB::table('medias')->join('media_review', 'media_review.media_id','=','medias.id')->join('reviews','reviews.id','=','media_review.review_id')
                                             ->select('reviews.review_rating')->where([['medias.id','=',$media_id]])->get();
      
        $counter=0;
        $review_count=count($tmp);
   
        foreach ($tmp as $rating)
          {
             $counter += (int)$rating->review_rating;
          }
        $overall_ratings=$counter/count($tmp);
        $update=Media::find($media_id);
        $update->rating=$overall_ratings;
        $update->save();
                                                    
                                     
      
        return redirect()->route('detail',['id'=>$media_id])->with('status', 'Successfully added your review');

                                      
                                    

    }
}
