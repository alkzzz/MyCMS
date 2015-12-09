<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;
use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use Localization;
use cms\Post;
use cms\Category;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('menu');
    }

    public function urutmenu(Request $request)
    {
    	$data = $request->all();
      parse_str($data['urutan'], $urutan);
      $daftarmenu = Post::page()->menu()->get();
      $daftarsubmenu = Post::page()->submenu()->get();

        foreach ($urutan['menu'] as $slug => $value) {
            foreach ($daftarmenu as $menu) {
                $i = array_search($menu->slug_id, array_keys($urutan['menu']));
                $menu->urutan = $i;
                $menu->save();
            }
        }
        foreach ($urutan['submenu'] as $sub => $menu) {
            foreach ($daftarsubmenu as $submenu) {
                $j = array_search($submenu->slug_id, array_keys($urutan['submenu']));
                $submenu->urutan = $j;
                $submenu->save();
            }
        }
    }

    public function daftarMenu()
    {
      $title = 'Daftar Menu';
    	$daftarmenu = Post::page()->menu()->get()->sortBy('urutan');
      $daftarsubmenu = Post::page()->submenu()->get()->sortBy('urutan');
    	return view('dashboard.daftarmenu', compact('title','daftarmenu','daftarsubmenu'));
    }

    public function showPage($menu)
    {
        $locale = Localization::getCurrentLocale();
        if ($page = Post::where('slug_'.$locale, '=', $menu)->first())
        {
          return view('page.showPage', compact('page'));
        }
        else {
          $page = Category::where('slug_'.$locale, '=', $menu)->firstOrFail();
          $daftar_artikel = Post::article()->where('id_kategori', '=', $page->id)->get();
          return view('kategori.index', compact('page', 'daftar_artikel'));
        }

    }

    public function addPage()
    {
        $title = 'Tambah Menu';
        return view('page.addPage', compact('title'));
    }

    public function storePage(Request $request)
    {
        $input = $request->all();
        $input['urutan'] = 99;
        $input['post_type'] = 'page';

        $inputmenu_id = $request->input('title_id');
        $input['title_id'] = $inputmenu_id[0];
        for ($i=1; $i < count($inputmenu_id); $i++) {
          $input['title_id'] = $inputmenu_id[$i];
          dd($input['title_id']);
        }
    }

}
