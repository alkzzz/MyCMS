@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('content')
	<a href="{{ route('dashboard::tambahmenu') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
	<hr>
	<h3 class="lang-help"><em>Indonesia</em> / <em>English</em></h3>
	<ul>
	<li class="parent-menu default">Beranda / Home</li>
	</ul>
	<ul id="sortable">
	@foreach ($daftarmenu as $menu)
		<li id="menu_{{ $menu->slug_id }}" class="parent-menu default">
		<div>{{ $menu->title_id }} / {{ $menu->title_en }} @if ($menu->has_child)
			<a class="arrow-toggle" href="#menu_{{ $menu->id }}" data-toggle="collapse" aria-expanded="false" aria-controls="{{ $menu->id }}"><span class="fa fa-caret-down fa-fw"></span></a> @endif
		<span class="pull-right">@if (!$menu->has_child)<a style="margin-right:20px" href="{{ route('show.page', $menu->slug_id) }}">Show <i class="fa fa-eye fa-fw"></i></a>@endif<a style="margin-right:20px" href="">Edit <i class="fa fa-edit fa-fw"></i></a><a href="">Delete <i class="fa fa-trash fa-fw"></i></a></span></div>
 	@if(!$menu->has_child) </li>
	@else
			<ul id= "menu_{{ $menu->id }}" class="collapse child-menu default">
			@foreach($daftarsubmenu as $submenu)
			@if($submenu->post_parent == $menu->id)
				<li id="submenu_{{ $submenu->slug_id }}">
				<div>{{ $submenu->title_id }} / {{ $submenu->title_en }}
				<span class="pull-right"><a style="margin-right:20px" href="{{ route('show.page', $submenu->slug_id) }}">Show <i class="fa fa-eye fa-fw"></i></a><a style="margin-right:20px" href="">Edit <i class="fa fa-edit fa-fw"></i></a><a style="margin-right:-5px" href="">Delete <i class="fa fa-trash fa-fw"></i></a>
				</div></li>
		</li>
			@endif
			@endforeach
		</ul>
	@endif
	@endforeach
	</ul>
	<hr>
	<button id="urut" type="button" class="btn btn-primary">Urutkan Menu</button>

	@section('js')
	@parent
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/nestedSortable.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"> </script>
	<script>
	$( ".fa-caret-down" ).click(function() {
	  $( this ).toggleClass( "fa-caret-up" );
	});
	</script>

	<script type="text/javascript">
	$(document).ready(function() {
		$('#urut').click(function() {
			if ($('#urut').text() == "Save") {

				var urutan = $('#sortable').nestedSortable("serialize");

				$('#sortable').nestedSortable({
					disabled : true
				});

				$.ajax({
					url: "{{ route('dashboard::urutmenu')}}",
					type: 'POST',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: { urutan: urutan },
				})
				.done(function() {
					swal({title:'Sukses',text: 'Menu Berhasil Diurutkan', type: 'success',   confirmButtonText: 'OK' });
				})
				.fail(function() {
					swal({title:'Gagal',text: 'Menu Gagal Diurutkan', type: 'error',   confirmButtonText: 'OK' });
				});

				$('#urut').text("Urutkan");

			}
			else {

        		$('#sortable').nestedSortable({
        			disabled : false,
        			disableParentChange : true,
        			maxLevels: 2,
        			cursor : "move",
		        	listType: "ul",
		        	handle: 'div',
		            items: 'li',
		            toleranceElement: '> div',
		            placeholder: "highlight",
		        });
		        $('#sortable').disableSelection();

				($('#urut').text("Save"));
			}
		});
	});
	</script>
	@stop
@stop
