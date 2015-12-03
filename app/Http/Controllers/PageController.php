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
      $title = 'Post';
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

    public function tambahMenu()
    {
        $title = 'Tambah Menu';
        return view('dashboard.tambahmenu', compact('title'));
    }

}
