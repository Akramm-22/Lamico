<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sensor Data Iot</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #a8edea, #5dade2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 92%;
            max-width: 950px;
            background: rgba(255,255,255,0.85);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,.15);
        }

        h1 {
            text-align: center;
            color: #0a4f6e;
            margin-bottom: 25px;
        }

        a {
            text-decoration: none;
        }

        /* BUTTON */
        .btn {
            padding: 10px 20px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: .3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,114,255,.4);
        }

        .btn-edit {
            background: #48c9b0;
            color: white;
        }

        .btn-delete {
            background: #ff6b6b;
            color: white;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #0a4f6e;
            color: white;
            padding: 14px;
        }

        td {
            padding: 14px;
            text-align: center;
            color: #0a4f6e;
        }

        tr:nth-child(even) {
            background: #eafafc;
        }

        tr:hover {
            background: #d6f5f8;
        }

        /* FORM */
        input {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #bde6f1;
            outline: none;
            margin-bottom: 15px;
        }

        input:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 8px rgba(0,198,255,.4);
        }

        .search-box {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .alert {
            background: #48c9b0;
            color: white;
            padding: 12px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 20px;
        }

        .action-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 25px;
}

.search-input {
    flex: 1;    
}

.btn-add {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 22px;
    border-radius: 35px;
    background: linear-gradient(45deg, #00c6ff, #0072ff);
    color: white;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(0,114,255,.35);
    transition: .3s ease;
    white-space: nowrap;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,114,255,.5);
}

    </style>
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>
