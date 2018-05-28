<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Annoucement;

class AnnoucementController extends Controller
{
    public function index() {
    	$annoucements = Annoucement::orderBy('id', 'desc')->paginate(10);
    	return view('admin.annoucement.index', ['annoucements' => $annoucements]);
    }

    public function create() {
    	return view('admin.annoucement.create');
    }

    public function store(Request $request) {
    	$annoucement = new Annoucement([
    		'eng_title' => $request->input('eng_title'),
    		'vie_title' => $request->input('vie_title'),
    		'eng_content' => $request->input('eng_content'),
    		'vie_content' => $request->input('vie_content'),
    	]);
    	$annoucement->save();
    	return redirect('/admin/annoucements');
    }

    public function edit($id) {
    	$annoucement = Annoucement::find($id);
    	return view('admin.annoucement.edit', ['annoucement' => $annoucement]);
    }

    public function update(Request $request, $id) {
    	$annoucement = Annoucement::find($id);
    	$annoucement->update($request->all());
    	return redirect('/admin/annoucements');
    }

    public function destroy(Request $request, $id) {
    	Annoucement::find($id)->delete();
    	return redirect('/admin/annoucements');
    }
}
