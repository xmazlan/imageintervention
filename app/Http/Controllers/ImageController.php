<?php

namespace App\Http\Controllers;

use App\Models\Classgroup;
use App\Models\Position;
use App\Models\Sign;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $fullnameSize = 100;

    public function index()
    {
        Artisan::call('optimize:clear');

        $data = [
            'tab_title'    => 'Image Intervention',
            'signs' => Sign::orderBy('nip')->paginate(10)
        ];

        return view('image.index', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'tab_title' => 'Create TTE',
            'formInput' => [
                'nip' => 'NIP',
                'fullname' => 'Nama Lengkap'
            ],
            'classGroups' => Classgroup::orderBy('name')->get(),
            'positions' => Position::orderBy('name')->get(),
            'posNames' => [
                'lurah',
                'camat',
                'kadis',
                'sekda'
            ]
        ];
        return view('image.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nip' => 'required|unique:signs|numeric',
                'fullname' => 'required|min:5',
                'classGroup' => 'required',
                'position' => 'required',
                'posName' => 'required'
            ],
            [
                'nip.required' => 'NIP wajib diisi',
                'nip.unique' => 'NIP bentrok',
                'nip.numeric' => 'NIP hanya angka yang diizinkan',
                'fullname.required' => 'Nama wajib diisi',
                'fullname.min' => 'Nama terlalu pendek',
                'classGroup.required' => 'Pangkat wajib diisi',
                'position.required' => 'Posisi wajib diisi',
                'posName.required' => 'Nama posisi wajib diisi',
            ]
        );

        $input = [
            'nip' => $request->nip,
            'fullname' => $request->fullname,
            'classGroupID' => $request->classGroup,
            'positionID' => $request->position,
            'positionType' => $request->posName
        ];
        Sign::create($input);

        return redirect('dashboard/image')->with('success', 'Data berhasil diinput');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sign = Sign::find($id);

        // get previous sign id
        $previous = Sign::where('id', '<', $sign->id)->max('id');

        // get next sign id
        $next = Sign::where('id', '>', $sign->id)->min('id');

        $nip = substr_replace(substr_replace(substr_replace($sign->nip, ' ', 15, null), ' ', 14, null), ' ', 8, null);

        $institute = strlen($sign->institute) <= 40 ? $sign->institute : 'Max 40 karakter';
        $fixedUnderline = strlen($sign->fullname) + $sign->moreUnderline;

        $underLine  = '';
        for ($i = 0; $i < $fixedUnderline; $i++) {
            $underLine .= '_';
        }

        if ($sign->positionType == 'lurah') : $bgColor = 'green';
        elseif ($sign->positionType == 'camat') : $bgColor = 'blue';
        elseif ($sign->positionType == 'sekda' || $sign->positionType == 'kadis') : $bgColor = 'red';
        else : $bgColor = 'cyan';
        endif;


        $img = Image::make('assets/img/draft-' . $bgColor . '.png');
        $result = $img->text($sign->fullname, 540, 300, function ($font) {
            $font->file(realpath('assets/fonts/timesbd.ttf'));
            $font->size($this->fullnameSize);
        })->text($underLine, 540, 300, function ($font) {
            $font->file(realpath('assets/fonts/timesbd.ttf'));
            $font->size(100);
        })->text('NIP. ' . $nip, 540, 390, function ($font) {
            $font->file(realpath('assets/fonts/times.ttf'));
            $font->size(75);
        })->text($sign->classGroup->name, 540, 475, function ($font) {
            $font->file(realpath('assets/fonts/times.ttf'));
            $font->size(75);
        })->text($sign->position->name, 540, 830, function ($font) {
            $font->file(realpath('assets/fonts/timesbd.ttf'));
            $font->size(90);
        })->text($institute, 540, 930, function ($font) {
            $font->file(realpath('assets/fonts/timesbd.ttf'));
            $font->size(90);
        });

        $filename   =  'result/' . Str::slug($nip) . '.png';

        $result->save($filename);

        $data = [
            'tab_title' => 'TTE &mdash; ' . $sign->fullname,
            'filename'  => URL::to($filename),
            'sign'      => $sign
        ];

        return view('image.show', $data)->with('previous', $previous)->with('next', $next);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sign::destroy($id);

        return redirect('dashboard/image')->with('success', 'Data berhasil dihapus');
    }

    public function underline($id, $action)
    {
        $change = ($action == 'subs') ? -1 : 1;
        $sign = Sign::find($id);
        $sign->moreUnderline += $change;
        $sign->save();

        return redirect()->back();
    }
}
