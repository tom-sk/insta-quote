<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Template;
use Image;
use GifCreator;

class ImageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function gif(){
        $img = Image::make('foo.jpg');

        $img->resize(200,200);
        $img->save('gif/bar1.png', 100);
        $img->greyscale();
        $img->save('gif/bar2.png', 100);

        $frames = array(

            "gif/bar1.png", // Image file path
            "gif/bar2.png", // Image file path
           
        );
        
        // Create an array containing the duration (in millisecond) of each frames (in order too)
        $durations = array(80, 80, 80, 80);

        
        // Initialize and create the GIF !
        $gc = new \App\GifCreator();
        $gc->create($frames, $durations, 0);
        $gifBinary = $gc->getGif();

        file_put_contents('gif/Gif.gif', $gifBinary);

        return redirect('home');
    }





    public function postTemplate(Request $request){

        $template = new Template;
        $time  = preg_replace('/[^0-9,]|,[0-9]*$/','',Carbon::now());
        $template->user_id =  Auth::id();
        $template->image = 'templates/'. $time .'template.jpg';
        $template->quote = $request->quote;
        $template->author = $request->author;
        $template->color = 'rgb('.$request->rValue.', '.$request->gValue.', '.$request->bValue.')';
        $template->save();
        info($template);



        $fontColor = 'rgb('.$request->rValue.', '.$request->gValue.', '.$request->bValue.')';
        $dimensions = '540';
        $quote = $request->quote;
        $quoteLength = count(explode(" ",$quote));
        $quoteFontSize = '80';
        $authorFontSize = '80';
        $spacer = $quoteFontSize;
        $seporatorYPadding = ($dimensions/100) * 30;

        if($quoteLength >= 10) {
            $i = 150; //top start position of quote
        } else if($quoteLength >= 8) {
            $i = 200; //top start position of quote
        } else if( $quoteLength >= 6) {
            $i = 300; //top start position of quote
        } else if( $quoteLength >= 4 || $quoteLength >= 0) {
            $i = 400; //top start position of quote
        }

        $img = Image::make('foo.jpg');

        // FX
        // $img->greyscale();
        // $img->pixelate(28);
        // $img->colorize(33, 18, -10);


        $img->resize($dimensions, $dimensions)
        ->rectangle(10, 10, 190, 190)
        ->rectangle(0, 0, $dimensions, $dimensions, function ($draw) use ($fontColor){
            $draw->background('rgba(255, 255, 255, 0)');
            $draw->border(10, $fontColor);
        })
        ->rectangle(50, 50, $dimensions - 50, $dimensions - 50, function ($draw){
            $draw->background('rgba(130, 130, 130, 0.5)');
        })
        ->rectangle(50, 50, $dimensions - 50, $dimensions - 50, function ($draw) use ($fontColor){
            $draw->border(3, $fontColor);
        });





        $string = wordwrap($quote,17,"|");
        //create array of lines
        $strings = explode("|",$string);
        //for each line added
        foreach($strings as $string){
                $img->text($string, $dimensions/2, $i, function($font) use ($fontColor, $quoteFontSize){
                $font->file(public_path('fonts/Mukta/Mukta-Regular.ttf'));
                $font->size($quoteFontSize);
                $font->color($fontColor);
                $font->align('center');
                $font->valign('center');
            });
            $i = $i + $spacer; //shift top postition down 42
        }

        $img->text('James Brown', $dimensions/2, $i + $spacer, function($font) use ($fontColor, $authorFontSize){
            $font->file(public_path('fonts/Mukta/Mukta-Regular.ttf'));
            $font->size($authorFontSize);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('center');
        });

        //          LP   topP  rP  BotP
        $img->rectangle($seporatorYPadding, $i, $dimensions - $seporatorYPadding , $i + 4, function ($draw) use ($fontColor) {
            $draw->background($fontColor);
        });
        $img->save('templates/'. $time .'template.jpg', 100);

       
    }
    public function getTemplate(){

        $userTemplates = Auth::user()->userTemplates()->get();
       
        return view('templates');
    }
}

