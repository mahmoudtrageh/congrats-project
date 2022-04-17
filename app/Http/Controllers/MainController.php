<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Session;
use AtmCode\ArPhpLaravel\ArPhpLaravel;

class MainController extends Controller
{

    public function textOnImage(Request $request)
    {

        $request->validate([
    		'img' => 'required',
    	],[
    		'img.required' => 'يجب اختيار صورة',
    	]);

        $session_token = Session::get('_token');

        $name = ArPhpLaravel::utf8Glyphs($request->name);

        if($request->img == 'eid1') {
            $img = Image::make('images/eid1.jpg');

            if($request->file('logo')) {
                $watermark = Image::make($request->file('logo'));                
                $img->insert($watermark, 'top-right', 30, 30);
            }
            
            $img->text($name, 2300, 3350, function ($font) {
                $font->file(public_path('/font.ttf'));
                $font->size(240);
                $font->color('#fff');
                $font->align('right');
                $font->valign('top');
                $font->angle(0);
            });

        } else if($request->img == 'eid2') {
            $img = Image::make('images/eid2.jpg');

            if($request->file('logo')) {
                $watermark = Image::make($request->file('logo'));                
                $img->insert($watermark, 'top-right', 30, 30);
            }

            $img->text($name, 1000, 1850, function ($font) {
                $font->file(public_path('/font.ttf'));
                $font->size(120);
                $font->color('#000');
                $font->align('center');
                $font->valign('bottom');
                $font->angle(0);
            });
        } else if ($request->img == 'eid3') {
            $img = Image::make('images/eid3.jpg');

            if($request->file('logo')) {
                $watermark = Image::make($request->file('logo'));                
                $img->insert($watermark, 'top-right', 30, 30);
            }
            
            $img->text($name, 6000, 1350, function ($font) {
                $font->file(public_path('/font.ttf'));
                $font->size(200);
                $font->color('#000');
                $font->align('right');
                $font->valign('top');
                $font->angle(0);
            });
        } else if ($request->img == 'ramadan1') {
            $img = Image::make('images/ramadan1.jpg');

            if($request->file('logo')) {
                $watermark = Image::make($request->file('logo'));                
                $img->insert($watermark, 'top-right', 30, 30);
            }
            
            $img->text($name, 4800, 2350, function ($font) {
                $font->file(public_path('/font.ttf'));
                $font->size(200);
                $font->color('#000');
                $font->align('right');
                $font->valign('top');
                $font->angle(0);
            });
        } else if ($request->img == 'ramadan2') {
            $img = Image::make('images/ramadan2.jpg');

            if($request->file('logo')) {
                $watermark = Image::make($request->file('logo'));                
                $img->insert($watermark, 'top-right', 30, 30);
            }
            
            $img->text($name, 2600, 1100, function ($font) {
                $font->file(public_path('/font.ttf'));
                $font->size(120);
                $font->color('#000');
                $font->align('right');
                $font->valign('top');
                $font->angle(0);
            });
        }

        $img->save('upload/congrats_' . $session_token . '.jpg');

        $notification = array(
            'message' => 'تم إنشاء الصورة بنجاح',
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }

    public function downloadImage()
    {
        $session_token = Session::get('_token');

        $filepath = public_path('upload/') . "congrats_$session_token.jpg";

        if (file_exists($filepath)) {
            
            return response()->download($filepath)->deleteFileAfterSend(true);
        } else {
            $notification = array(
                'message' => 'لا يوجد صورة جاهزة للتحميل',
                'alert-type' => 'success'
            );
            return redirect('/')->with($notification);
        }
    }
}
