<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>


</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
</style>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="http://www.newsan.com.ar/wp-content/uploads/2018/11/logo2018.png" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table border="0" id="table-data" width="80%">
        <tr>
            <td width="70px">SN</td>
            <td width="">: {{ $product->sn }}</td>
            <td width="30px">Dueño</td>
            <td>: {{ $product->asignable->nama }}</td>
        </tr>

        <tr>
            <td>Producto</td>
            <td >: {{ $product->activo->name }}</td>
            <td>Nombre de Red</td>
            <td >: {{ $product->qty }}</td>
        </tr>

        <tr>
            <td>Categoria</td>
            <td>: {{ $product->category->name }}</td>
            <td>Email</td>
            <td>: {{ $product->asignable->email }}</td>
        </tr>

        <tr>
            <td>Telefono</td>
            <td>: {{ $product->asignable->telepon }}</td>
            <td>Sector</td>
            <td>: {{ $product->asignable->sector }}</td>
        </tr>





    </table>

    {{--<hr  size="2px" color="black" align="left" width="45%">--}}


    {{-- <table border="0" width="80%">
        <tr align="right">
            <td>Preparador</td>
        </tr>
    </table> --}}

    {{-- <table border="0" width="80%">
        <tr align="right">
            <td><img src="https://upload.wikimedia.org/wikipedia/en/f/f4/Timothy_Spall_Signature.png" width="100px" height="100px"></td>
        </tr>

    </table> --}}
    {{-- <table border="0" width="80%">
        <tr align="right">
            <td>{{\Auth::user()->name}}</td>
            <td>{{\Auth::user()->email}}</td>
        </tr>
    </table> --}}



</div>
