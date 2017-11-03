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

    public function freeTemplateSave(Request $request){
        $fontColor = 'rgb('.$request->rValue.', '.$request->gValue.', '.$request->bValue.')';
        $dimensions = '540';
        
        $url = $request->imageURL;
        info($request);
        //QUOTE 
        $quote = $request->quote;
        $quoteLength = count(explode(" ",$quote));
        $quoteFontSize = '35';
        $quoteFontType = $request->quoteTextStyle['fontType'];
        $quotePosition = $request->quoteTextStyle['position'];
        //AUTHOR
        $author = $request->author;
        $authorFontSize = '35';
        $authorFontType = $request->authorTextStyle['fontType'];
        $authorPosition = $request->authorTextStyle['position'];
        //STYLE
        $overlayOpacity = $request->overlayStyle['backgroundOpacity'];

        $borderTop = $request->overlayStyle['borderTop'];
        $borderBottom = $request->overlayStyle['borderBottom'];
        $borderRight = $request->overlayStyle['borderRight'];
        $borderLeft = $request->overlayStyle['borderLeft'];
        
        $barStyle = $request->overlayStyle['backgroundOpacity'];

        $requestOuterBorderStyle = $request->borderStyle['border'];
        $outerBorderWidth = ($requestOuterBorderStyle == '2px') ? 10 : 0;
        $innerBorderWidth = ( $borderTop && $borderBottom && $borderRight && $borderLeft) ? 3 : 0;;


        $spacer = $quoteFontSize + '10';

        // Length of bar is 120
        $offset = 120;
        $seporatorYPadding = 210 - $offset;
        $seporatorXPadding = 330 - $offset;

            info($dimensions - $seporatorYPadding);
        
        if($quoteLength >= 10) {
            $i = 180; //top start position of quote
        } else if($quoteLength >= 8) {
            $i = 200; //top start position of quote
        } else if( $quoteLength >= 6) {
            $i = 200; //top start position of quote
        } else if( $quoteLength >= 4 || $quoteLength >= 0) {
            $i = 220; //top start position of quote
        }

        $img = Image::make($url);

        // FX
        // $img->greyscale();
        // $img->pixelate(28);
        // $img->colorize(33, 18, -10);


        $img->resize($dimensions, $dimensions)
        ->rectangle(10, 10, 190, 190)
        ->rectangle(0, 0, $dimensions, $dimensions, function ($draw) use ($fontColor, $outerBorderWidth){
            $draw->background('rgba(255, 255, 255, 0)');
            $draw->border($outerBorderWidth, $fontColor);
        })
        ->rectangle(50, 50, $dimensions - 50, $dimensions - 50, function ($draw) use ($overlayOpacity){
            $draw->background('rgba(51, 51, 51, ' . $overlayOpacity . ')');
        })
        ->rectangle(50, 50, $dimensions - 50, $dimensions - 50, function ($draw) use ($fontColor, $innerBorderWidth){
            $draw->border($innerBorderWidth, $fontColor);
        });




        // ****** Wrap Text onto different lines ******** //
        $string = wordwrap($quote, 20, "|");
        //create array of lines
        $strings = explode("|", $string);
        //for each line added

        if($quotePosition == 'center'){
           $quoteDimension = $dimensions/2;
        }else if($quotePosition == 'left'){
            $quoteDimension = $dimensions/6;
        }else if($quotePosition == 'right') {
            $quoteDimension = $dimensions - 90;
        }

        foreach($strings as $string){
                $img->text($string,  $quoteDimension , $i, function($font) use ($fontColor, $quoteFontSize, $quotePosition){
                $font->align($quotePosition);
                $font->valign('center');
                $font->file(public_path('fonts/Mukta/Mukta-Regular.ttf'));
                $font->size($quoteFontSize);
                $font->color($fontColor);

            });
            $i = $i + $spacer; //shift top postition down 42
        }

        $img->text($author, $dimensions/2, $i + $spacer, function($font) use ($fontColor, $authorFontSize){
            $font->file(public_path('fonts/Mukta/Mukta-Regular.ttf'));
            $font->size($authorFontSize);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('center');
        });

        // Spacer Bar alignment 
        //          LP   topP  rP  BotP
        $img->rectangle($seporatorYPadding, $i, $seporatorXPadding , $i + 1, function ($draw) use ($fontColor) {
            $draw->background($fontColor);
        });
        $img->save('free.jpg', 100);

         
    }
    public function downloadFreeImage(){
        return view('free-image');
        // return response()->download(public_path() . '/free.jpg');
    }
}

