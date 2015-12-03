<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\User;
use Datatables;

class DashboardController extends Controller
{
  	public function index()
  	{
      $title = 'Home';
  		return view('dashboard.index', compact('title'));
  	}

  	public function postDataUser()
  	{
      $user = User::all();
      //dd($user);
  		return Datatables::of($user)
            ->addColumn('show', function ($user) {
                return '<a href="test/'.$user->id.'" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Show</a>';
              })
              ->addColumn('edit', function () {
                return '<a href="" class="btn btn-info"><i class="fa fa-edit fa-fw"></i> Edit</a>';
            })
            ->addColumn('delete', function () {
              return '<a href="" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Delete</a>';
            })->make(true);
  	}

  	public function daftarUser()
  	{
      $title = 'Daftar User';
  		return view('datatable', compact('title'));
  	}
}
