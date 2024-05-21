@extends('layouts.app')
@section('title', 'Daftar Rak Buku')
@section('content')
<script>
$(function() {
    $("#btn-save").click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            nama: $('#nama').val(),
            lokasi: $('#lokasi').val(),
            keterangan: $('#keterangan').val()
        };
        var state = $('#btn-save').val();
        var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{ $action }}';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function(data) {
                var todo = 'Pengiriman Data berhasil'
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});
</script>

<script>
$(function() {
    $("#datepicker").datepicker();
})
</script>

<h2>{{ $store }} Data Rak Buku</h2>
<form method="POST" action="{{$action}}">
    @csrf
    @if (strtolower($store) == 'ubah')
    @method('PUT')
    @endif
    <table>
        <input type="hidden" name="id" value="{{ $rak->id }}" />
        <tr>
            <td>
                <div class="send_bt">
                    <a href="{{ url('/rak_buku') }}">Kembali</a>
                </div>
            </td>
        </tr>
        <tr>
            <td>Nama Rak</td>
            <td>:</td>
            <td><input type="text" class="mail_text" id="nama" name="nama" placeholder="input nama rak"
                    value="{{ $rak->nama }}" /></td>
            @error('nama')
            <div>
                <b>{{ $message }}</b>
            </div>
            @enderror
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td><input type="text" class="mail_text" id="lokasi" name="lokasi" placeholder="input lokasi"
                    value="{{ $rak->lokasi }}" /></td>

            @error('lokasi')
            <div>
                <b>{{ $message }}</b>
            </div>
            @enderror
        </tr>


        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><input type="text" class="mail_text" id="keterangan" name="keterangan" placeholder="input keterangan"
                    value="{{ $rak->keterangan }}" /></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>
                <input type="text" id="datepicker" name="tanggal" placeholder="input tanggal" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="{{ $store }}" id="btn_save"/>
                <!-- <div class="send_bt" id="btn-save">
                    Simpan
                </div> -->
            </td>
        </tr>
    </table>
</form>
@endsection