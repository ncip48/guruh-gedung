<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#tanggal").datepicker({
                dateFormat: 'dd MM yy',
                minDate: 0,
                "setDate": new Date()
            });
        });
    </script>
</head>

<body>
    <p>Date: <input type="text" id="tanggal" name="tanggal"></p>
    <select name="meja" id="meja">
        <option value="">Pilih Meja</option>
        @foreach ($gedung as $m)
            <option value="{{ $m->id }}">{{ $m->nama }}</option>
        @endforeach
    </select>

    <div class="waktu">

    </div>

    <script>
        $(document).ready(function() {
            function convertDate(date) {
                var dates = new Date(date);
                var yyyy = dates.getFullYear().toString();
                var mm = (dates.getMonth() + 1).toString();
                var dd = dates.getDate().toString();

                var mmChars = mm.split('');
                var ddChars = dd.split('');

                return yyyy + '-' + (mmChars[1] ? mm : "0" + mmChars[0]) + '-' + (ddChars[1] ? dd : "0" + ddChars[
                    0]);
            }

            $("#meja").change(function() {
                cariJadwal();
            });

            $("#tanggal").change(function() {
                if ($("#meja").val() != "") {
                    cariJadwal();
                }
            });

            function cariJadwal() {
                $(".waktu").html('');
                var tanggal = $("#tanggal").val();
                tanggal = convertDate(tanggal);
                var meja = $("#meja").val();
                console.log(tanggal);
                field = $(".field").val();
                $.ajax({
                    type: "GET",
                    url: "api/cek-meja?tanggal=" + tanggal + "&id_meja=" + meja,
                    success: function(data) {
                        $.each(data.data, function(k, v) {
                            // / do stuff
                            console.log(v);
                            var status = v.status == 0 ? 'Tersedia' : 'Tidak Tersedia';
                            $(".waktu").append('<h2>' + v.jam + '</h2><br><h5>' +
                                status + '</h5>');
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>
