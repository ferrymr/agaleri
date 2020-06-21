@extends('layouts.app')

@section('style')
<style>
</style>
@endsection

@section('content')
<div id="main" class="utama_panel" role="main">
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-pencil-square-o fa-fw "></i>
                    {{ $title }}
                </h1>
            </div>
        </div>
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-send"></i> </span>
                            <h2>Filter {{ $title }}</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <form id="formAdd" name="formAdd" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Status</label>
                                            <div class="col-md-2">
                                                <select style="width:100%" id="param" name="param" class="form-control">
                                                    <option value="a" selected>All</option>
                                                    <option value="s">Selesai</option>
                                                    <option value="b">Batal</option>
                                                    <option value="p">Process</option>
                                                    <option value="n">New</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Dari Tanggal</label>
                                            <div class="itemLine col-md-2">
                                                <div class="input-group">
                                                    <input class="form-control" id="from" type="text" placeholder="Tanggal Awal">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                            <label class="col-md-1 control-label">Sampai</label>
                                            <div class="itemLine col-md-2">
                                                <div class="input-group">
                                                    <input class="form-control" id="to" type="text" placeholder="Tanggal Akhir">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="itemLine col-md-2">
                                                <button type="button" id="view_print" class="btn btn-success">View & Print</button>
                                                <button type="button" id="export" class="btn btn-primary">Export</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

    </div>

    @endsection

    @section('script')
    <script>
        var tag = '{{ $tag }}';
        var token = $('meta[name="csrf-token"]').attr('content');

        $("#from").datepicker({
            dateFormat: 'dd/mm/yy',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        }).datepicker("setDate", new Date());

        $("#to").datepicker({
            dateFormat: 'dd/mm/yy',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        }).datepicker("setDate", new Date());

        $('#view_print').on('click', function(e) {
            var from = $('#from').val();
            var to = $('#to').val();
            var param = $('#param').val();
            if (from && to !== '') {
                from = from.replace(/\//g, '-');
                to = to.replace(/\//g, '-');
                window.open(baseurl + '/view_print_report_transaksi/' + param + '/' + from + '/' + to);
            }
        });

        $('#export').on('click', function(e) {
            var from = $('#from').val();
            var to = $('#to').val();
            var param = $('#param').val();
            if (from && to !== '') {
                from = from.replace(/\//g, '-');
                to = to.replace(/\//g, '-');
                window.open(baseurl + '/export_report_transaksi/' + param + '/' + from + '/' + to);
            }
        });

        $('#produk_id').select2({
            ajax: {
                url: baseurl + '/get_e_produk',
                delay: 250,
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });

        $('#size_id').select2({
            ajax: {
                url: baseurl + '/get_size',
                delay: 250,
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                    }
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                }
            }
        });

        var table = $('#' + tag + '-table').DataTable({
            lengthMenu: [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('stok_produk.api') }}",
                data: function(d) {
                    d.from = $('#from').val(),
                        d.to = $('#to').val();
                }
            },
            columns: [{
                    data: 'id_barang',
                    name: 'id_barang'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'id_size',
                    name: 'id_size'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
            ]
        });

        $('#from,#to').on('change', function(e) {
            clear_table();
        });

        // Fungsi clear table 
        function clear_table() {
            table.ajax.reload();
        }

        $('#create').on('click', function() {
            $('#modalCreate').modal('show');
        });

        $('#btnCreate').on('click', function() {
            createData();
        });

        function createData() {
            $.ajax({
                url: "{{ route('masuk_barang.create') }}",
                type: "POST",
                data: $('#formCreate').serialize(),
                success: function(data) {
                    myswal('s', data.message, 's', 1500);
                    clear_form()
                    table.ajax.reload();
                },
                error: function() {
                    myswal('e', 'No Data..', 'e', 1500);
                }
            });
        }


        function clear_form() {
            $('#formCreate')[0].reset();
            $('.select2').val('').change();
            $("#produk_id").select2("val", "");
            $("#size_id").select2("val", "");
        }
    </script>
    @endsection