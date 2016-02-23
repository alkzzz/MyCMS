@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox/css/lightbox.min.css') }}">
@stop

@section('content')
@include('includes.alert')
<a href="{{ route('dashboard::addSlider') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
<hr>
@if(!count($sliders))
<h3>Website belum memiliki slider. Silahkan tambahkan slider dengan mengklik tombol <b>Tambah</b>.</h3>
@else
  <h3 class="topmenu-title" style="width:40%">Gambar Slideshow</h3>
  <h3 class="topmenu-title">Judul Artikel</h3>
  <ul id="sortable" class="parent-menu default">
    @foreach($sliders as $slider)
        <li style="margin-bottom:15px" id="slider_{{ $slider->id }}">
          <div class="topmenu-list" style="width:40%">
              <a href="{{ $slider->gambar }}" data-lightbox="image-{{ $slider->id }}" data-title="{{ $slider->title_id }}"><img src="{{ $slider->thumbnail }}" /></a>
          </div>
          <div class="topmenu-list">
              <h4> {{ $slider->title_id }} </h4>
          </div>
          <div style="display:inline-block;margin-left:2em" class="pull-right">
            <form id="formDelete" action="{{ route('dashboard::deleteTopMenu', $slider->id) }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <input id="delete" style="margin-top: 3em" class="btn btn-danger" type="submit" value="Delete">
            </form>
          </div>
           <a style="margin-left:2em;margin-top: 3em" href="{{ route('dashboard::editTopMenu', $slider->id) }}" class="btn btn-warning pull-right">Edit <i class="fa fa-edit fa-fw"></i></a>
        </li>
    @endforeach
  </ul>
</div>
<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%">Urutkan Slider</button>
@endif
@stop

@section('js')
@parent
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('css/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"> </script>
<script type="text/javascript">
$('input#delete').on('click', function(e){
  e.preventDefault();
  swal({
    title: "Are you sure?",
    text: "Anda yakin akan menghapus slider ini",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Delete",
    closeOnConfirm: false
  },
    function(){
    $("#formDelete").submit();
    swal('Delete','Slider telah dihapus','success');
  });
})
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#urut').click(function() {
    if ($('#urut').text() == "Save") {

      var urutan = $('#sortable').sortable("serialize");

      $('#sortable').sortable({
        disabled : true
      });

      $.ajax({
        url: "{{ route('dashboard::urutSlider')}}",
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { urutan: urutan },
      })
      .done(function() {
        swal({title:'Sukses',text: 'Slider Berhasil Diurutkan', type: 'success',   confirmButtonText: 'OK' });
      })
      .fail(function() {
        swal({title:'Gagal',text: 'Slider Gagal Diurutkan', type: 'error',   confirmButtonText: 'OK' });
      });

      $('#urut').text("Urutkan");

    }
    else {
       $('#sortable').sortable({
              disabled : false,
              placeholder: "slide-highlight",
              opacity: 0.8,
          });
       $('#sortable').disableSelection();
      ($('#urut').text("Save"));
    }
  });
});
</script>

@endsection
