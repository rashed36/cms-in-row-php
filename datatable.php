<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datatable</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
</head>
<body>
    <table class="table table-bordered table-hover" id="userTable">
        <thead>
            <th style="text-align:left;">First Name</th>
            <th>Last Name</th>
            <th>Age</th>
        </thead>
        <tbody>
                    <tr class="text-center">
                        <td>Rashedul</td>
                        <td>Islam</td>
                        <td>22</td>
                    </tr>
        </tbody>
    </table>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
    </script>
</body>
</html>