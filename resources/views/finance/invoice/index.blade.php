@extends('layouts.app')

@section('style')
<style>
</style>
@endsection

@section('content')
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-pencil-square-o fa-fw "></i>
                {{ $title }} x1
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-send"></i> </span>
                        <h2>Tambah {{ $title }}</h2>
                    </header>
                    <div>
                        <div class="widget-body">
                            <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">No. Invoice </label>
                                        <div class="col-md-2">
                                            <input class="form-control" id="id" name="id" placeholder="Kode {{ $title }}" type="text" value="{{ $newid }}" readonly>
                                        </div>
                                        <div class="col-sm-2 pull-right">
                                            <div class="input-group">
                                                <input type="text" id="tanggal" name="tanggal" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}" readonly="readonly">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <label class="col-md-1 control-label pull-right">Tanggal </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nama Pelanggan </label>
                                        <div class="col-md-2">
                                            <select class="form-control" style="width:100%;" name="id_costumer" required></select>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                        <!-- <div class="col-sm-2 pull-right">
                                            <div class="input-group">
                                                <input type="text" id="jatuh_tempo" name="jatuh_tempo" placeholder="Select a date" class="form-control datepicker" data-dateformat="dd/mm/yy" value="{{ $tanggal }}">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <label class="col-md-1 control-label pull-right">Jatuh Tempo </label> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Pembayaran</label>
                                        <div class="col-md-2" style="">
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="pembayaran" value="C" checked="">
                                                <span>Cash</span>
                                            </label>
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="pembayaran" value="K">
                                                <span>Kredit</span>
                                            </label>
                                        </div>
                                        <label for="" class="col-md-1 control-label form-akun">Ke Akun</label>
                                        <div class="col-md-2 form-akun">
                                            <select class="form-control" style="width:100%;" name="id_akun"></select>
                                        </div>
                                        <label for="" class="col-md-1 control-label form-tempo">Tempo (Hari)</label>
                                        <div class="col-md-1 form-tempo">
                                            <input id="tempo" name="tempo" type="decimal" class="form-control" value="" placeholder="Hari">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-2 control-label">Term Of Payment </label>
                                        <div class="col-md-1">
                                            <input class="form-control ribuan" id="top" name="top" type="text" value="0">
                                        </div>
                                        <label class="col-md-1 control-label" style="margin-left:-50px;">Hari </label>
                                    </div> -->

                                </fieldset><br><br>
                                <fieldset>
                                    <legend>Details {{ $title }}</legend>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label class="control-label">Kode Barang</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Deskripsi</label>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">Qty</label>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">Unit Price</label>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">Unit Disc</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">Total Price</label>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="control-label">-</label>
                                        </div>
                                    </div>
                                    <div id="detail">
                                        <div class="detailLine form-group">
                                            <div class="itemLine col-md-3">
                                                <select style="width:100%" id="master_bj_id[]" name="master_bj_id[]" class="form-control" required=""></select>
                                            </div>
                                            <div class="itemLine col-md-3">
                                                <input class="form-control" name="deskripsi[]" placeholder="Deskripsi" type="text" readonly>
                                            </div>
                                            <div class="itemLine col-md-1">
                                                <input class="form-control ribuan calc" value="0" name="qty[]" style="text-align:right;" placeholder="0" type="text">
                                            </div>
                                            <div class="itemLine col-md-1">
                                                <input class="form-control ribuan calc" value="0" name="price[]" style="text-align:right;" placeholder="0" type="text">
                                            </div>
                                            <div class="itemLine col-md-1">
                                                <input class="form-control ribuan calc" value="0" name="disc[]" style="text-align:right;" placeholder="0" type="text">
                                            </div>
                                            <div class="itemLine col-md-2">
                                                <input class="form-control decimal calc" value="0" name="total[]" style="text-align:right;" placeholder="0" type="text" readonly>
                                            </div>
                                            <div class="itemLine col-md-1">
                                                <input type="hidden" name="indexRow[]" value="0">
                                                <button type="button" name="btnRemoveLine[]" class="btn-remove-line btn btn-default btn-circle"><i class="glyphicon glyphicon-minus"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <button id="btnAddLine" class="btn btn-primary btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
                                            </div>
                                            <div class="control-label col-md-2 col-md-offset-3">
                                                <strong>Total Qty</strong>
                                            </div>
                                            <div class="col-md-1">
                                                <input class="form-control ribuan" value="0" name="total_qty" style="text-align:right;" placeholder="0" type="text" readonly>
                                            </div>
                                            <div class="control-label col-md-2">
                                                <strong>Sub Total</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control ribuan" value="0" name="sub_total" style="text-align:right;" placeholder="0" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-2 col-md-offset-7">
                                                <strong>DP</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control ribuan calc" value="0" name="dp" style="text-align:right;" placeholder="0" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-2 col-md-offset-7">
                                                <strong>PPH 10%</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control ribuan calc" value="0" name="pph" style="text-align:right;" placeholder="0" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label col-md-2 col-md-offset-7">
                                                <strong>Grand Total</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control ribuan" value="0" name="grand_total" style="text-align:right;" placeholder="0" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label for="terbilang">Terbilang</label>
                                                <textarea name="terbilang" rows="2" cols="100"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="btnAdd" type="submit" class="btn btn-primary">
                                                <i class="fa fa-send"></i>
                                                Buat {{ $title }}
                                            </button>
                                            <a id="btnResetAdd" class="btn btn-default">
                                                <i class="fa fa-refresh"></i>
                                                Batal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
@include('finance.invoice.view.modalGeneralView');
@endsection

@section('script')
<script>
    var token = $('meta[name="csrf-token"]').attr('content');
    var tag = '{{$tag}}';
    // console.log();

    $(function() {
        var detailLine = $('#detail .detailLine').eq(0).html();
        changeMasterBJ();
        removeRowClick();
        select2Run();

        $('#btnAddLine').on('click', function(e) {
            $('#detail .detailLine').last().after('<div class="detailLine form-group">' + detailLine + '</div>');
            $('[name="master_bj_id[]"]:last').next(".select2-container").hide();
            $('[name="btnRemoveLine[]"]').unbind('click');
            runselect2();
            removeRowClick();
            changeMasterBJ();
            e.preventDefault();
        });

        // Pembayaran Cash / Kredit
        $('.form-akun').show();
        $('.form-tempo').hide();
        $('[name=pembayaran]').on('change', function(e) {
            if ($(this).val() == 'C') {
                $('.form-akun').show();
                $('.form-tempo').hide();
            } else {
                $('.form-akun').hide();
                $('.form-tempo').show();
            }
        });

        $('#detail').on('keyup', '.calc', function() {
            var self = $(this);
            var qty = self.parents('.detailLine').find('.calc[name="qty[]"]');
            var price = self.parents('.detailLine').find('.calc[name="price[]"]');
            // var pph = self.parents('.detailLine').find('.calc[name="pph"]');
            var disc = self.parents('.detailLine').find('.calc[name="disc[]"]');
            if (parseFloat(ribuantodb(disc.val())) > 0) {
                price_x = parseFloat(ribuantodb(price.val())) - parseFloat(ribuantodb(disc.val()));
            } else {
                price_x = parseFloat(ribuantodb(price.val()));
            }
            var total = self.parents('.detailLine').find('.calc[name="total[]"]');
            var total_price = decimal(parseFloat((ribuantodb(qty.val()) * price_x)));
            // var pph = (ribuantodb(total_price) / 100) * 10;
            // total_price = total_price + pph;
            if (parseFloat(ribuantodb(disc.val())) > parseFloat(ribuantodb(total_price))) {
                myswal('w', 'Diskon Terlalu Besar!', 'w', 1500);
                disc.val(0);
                total.val(total_price);
            }
            var total_item = parseFloat(ribuantodb(total_price));
            // pph.val(decimal(pph));
            total.val(decimal(total_item));
            hitungTotal();
            runselect2();
            runRibuan();
            runDecimal();
        });



        $('#btnResetAdd').on('click', function(e) {
            resetForm();
        });

        $('#formAdd').validator().on('submit', function(e) {
            $('input[name=_method]').val('POST');
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                url = "{{ url('invoice') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#formAdd').serialize(),
                    success: function(data) {
                        if (data.status == true) {
                            window.open(baseurl + '/invoice/' + id + '/print');
                            myswal('s', data.message, 's', 1500);
                            resetForm();
                            $('#id').val(data.newid);
                        } else {
                            myswal('e', data.message, 'e', 1500);
                            $('#id').val(id);
                        }
                    },
                    error: function(data) {
                        myswal('e', data.message, 'e', 1500);
                    }
                });
                return false;
            }
        });

        runselect2();
        select2Run();
    });

    function select2Run() {
        $('[name="id_akun"]').select2({
            ajax: {
                url: baseurl + '/get_akun',
                delay: 250,
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        category: 'k3',
                        k31: '110101',
                        k32: '110102',
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
            }
        });
    }

    function get_detail_master_bj(id, index) {
        url = "{{ url('get_detail_master_bj') }}";
        var data = {
            id: id
        };
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function(rsp) {
                $('[name="deskripsi[]"]').eq(index).val(rsp[0].text);
                $('[name="price[]"]').eq(index).val(ribuan(rsp[0].harga_default));
            },
            error: function(data) {
                myswal('e', data.message, 'e', 1500);
            }
        });
        return false;
    }

    function changeMasterBJ() {
        $('[name="master_bj_id[]"]').on('change', function(e) {
            var id = $(this).val();
            var index = $('[name="master_bj_id[]"]').index(this);
            if ($(this).val() != null) {
                get_detail_master_bj(id, index);
            }
        });
    }

    //Fungsi Reset Data form
    function resetForm() {
        $('#formAdd')[0].reset();
        $("select").val('').trigger('change');
        $('.detailLine').not(':eq(0)').remove();
    }

    //Fungsi Hitung Total All
    function hitungTotal() {
        var sub_total = 0;
        $('[name="total[]"]').each(function() {
            var val = ribuantodb($(this).val());
            sub_total = parseFloat(sub_total) + parseFloat(val);
        });
        var sub_total_val = decimal(sub_total);
        $('[name=sub_total]').val(sub_total_val);

        var total_qty = 0;
        $('[name="qty[]"]').each(function() {
            var qty = ribuantodb($(this).val());
            total_qty = parseFloat(total_qty) + parseFloat(qty);
        });
        var num_qty = decimal(total_qty);
        $('[name=total_qty]').val(ribuan(num_qty));

        var dp = $('[name=dp]').val();
        var grand_total = parseFloat(ribuantodb(sub_total_val)) - parseFloat(ribuantodb(dp));
        var pph = (grand_total / 100) * 10;
        grand_total = grand_total + pph;
        $('[name=pph]').val(decimal(pph));
        $('[name=grand_total]').val(decimal(grand_total));
        // var terbilang = terbilang(grand_total);
        $('[name=terbilang]').val(terbilang(grand_total)+' Rupiah');
        $('[name=terbilang]').prop('readonly',true);

    }

    //Fungsi View Data
    function viewData(id) {
        $.ajax({
            url: "{{ url('invoice') }}" + '/' + id + "/view",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var d = data['data'];
                var p = data['profile'];
                var t = data['type'];
                $('#modalShow').modal('show');
                $('.modal-title').text('View {{$title}} ' + d[0].id);
                $('.profile').html('');
                $('#view_name').html(p[0].name_perusahaan);
                $('#view_alamat').html(p[0].alamat);
                $('#view_telepon').html(p[0].telp);
                $('.dataview').html('');
                $('#view_id').html(d[0].id);
                $('#view_tanggal').html(d[0].tanggal);
                $('#view_supplier').html(d[0].nama_supplier);
                $('#view_alamat_supplier').html(d[0].alamat_supplier);
                $('#view_proses').html(d[0].nama_proses);
                $('#view_attention').html(d[0].attention);
                var s = '';
                var total_trans = decimal(d[0].total_trans);
                for (var i = 0; i < d.length; i++) {
                    s += '<tr>\n\
        <td>' + d[i].nama_barang + '</td>\n\
        <td></td>\n\
        <td></td>\n\
        <td></td>\n\
        <td>' + d[i].qty + '</td>\n\
        <td>' + d[i].nama_satuan + '</td>\n\
        <td>' + data.currency + ' ' + decimal(d[i].price) + '</td>\n\
        <td>' + data.currency + ' ' + decimal(d[i].total) + '</td>\n\
        </tr>';
                }
                s += '<tr>\n\
      <td colspan="7">Total</td>\n\
      <td><strong>' + data.currency + ' ' + total_trans + '</strong></td>\n\
      </tr>';

                $('#view_detail').html('');
                $('#view_detail').append(s);
            },
            error: function() {
                myswal('e', 'No Data..', 'e', 1500);
            }
        });
    }


    function removeRowClick() {
        $('[name="btnRemoveLine[]"]').on('click', function(e) {
            var index = $(this);
            var detail = index.parents('.detailLine').index();
            if (detail == 0) {
                myswal('w', 'Row 1 Tidak Dapat Dihapus!', 'w', 1500);
                return true;
            }
            removeRow(detail);
            hitungTotal();
            e.preventDefault();
        });
    }

    function removeRow(index) {
        $('.detailLine').eq(index).remove();
    }
</script>
@endsection