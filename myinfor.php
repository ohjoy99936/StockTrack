<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    .navbar {
        font-size: 23px;
    }

    .navbar-brand {
        font-size: 30px; /* 调整这里的值以改变字体大小 */
    }
</style>

    <title>Stock Track</title>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">Stock Track</span>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/stocktrack/myinfor.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="manageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage Staff
                </a>
                <div class="dropdown-menu" aria-labelledby="manageDropdown">
                    <a class="dropdown-item" href="/stocktrack/edit.php">Name</a>
                    <a class="dropdown-item" href="/stocktrack/edit.php">Mob</a>
                    <a class="dropdown-item" href="/stocktrack/edit.php">Address</a> 
                    <a class="dropdown-item" href="/stocktrack/edit.php">Email</a> 
                    <a class="dropdown-item" href="/stocktrack/delete.php">Delete</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/stocktrack/clay.php">Clay Track</a>
            </li>
                        <li class="nav-item">
                <a class="nav-link" href="/stocktrack/glaze.php">Glaze Track</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/stocktrack/logout.php">Log Out</a>
            </li>
        </ul>
    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
