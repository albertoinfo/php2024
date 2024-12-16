<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clientes Paginado</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Listado de Clientes</h1>
    </div>
    <div id="content">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>IP Address</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>31</td>
                    <td>Cleo</td>
                    <td>Hatchell</td>
                    <td>Female</td>
                    <td>28.15.112.148</td>
                    <td>414-297-0799</td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>Stefan</td>
                    <td>Dowsey</td>
                    <td>Male</td>
                    <td>129.202.197.193</td>
                    <td>516-519-9304</td>
                </tr>
                <tr>
                    <td>33</td>
                    <td>Chelsie</td>
                    <td>Webster</td>
                    <td>Female</td>
                    <td>179.103.47.63</td>
                    <td>915-811-1494</td>
                </tr>
            </tbody>
        </table>
        <form>
            <button name="orden" value="Primero">&#8606; Primero</button>
            <button name="orden" value="Anterior">&#8592; Anterior</button>
            <button name="orden" value="Siguiente">&#8594; Siguiente</button>
            <button name="orden" value="Ultimo">&#8608; Último</button>
        </form>
    </div>
</div>
</body>
</html>
