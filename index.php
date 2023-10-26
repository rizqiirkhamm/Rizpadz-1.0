<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Web Orang Ganteng</title>
</head>

<body>

    <?php include "./db.php" ?>
    <?php include "./editModal.php" ?>
    <?php require './db_conn.php'; ?>
    <?php
    if (isset($_POST["submit"])) {
        if (!isset($_POST["hidden"])) {
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $sql = "INSERT INTO `notes`(`title`, `description`) VALUES ('$title', '$desc')";
            $res = mysqli_query($con, $sql);
        }
    };
    ?>

    <header class="header">
        <a href="home" class="logo">Rizpadz</a>

        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#notes">Notes</a>
            <a href="#todolist">Todolist</a>
        </nav>
    </header>



    <section class="home" id="home">
        <div class="home-content">
            <h1>Hi, Welcome Rizpadz</h1>
            <h3>Todolist & Notes</h3>
            <p>Rizpadz is features that allow users to organize tasks to be done as well as record and store important information, ideas, or thoughts. With this combination, users can easily plan their work and have quick access to relevant notes to improve productivity and information management."</p>
            <div class="btn-box">
                <a href="#todolist">To-dolist</a>
                <a href="#notes">Notes</a>
            </div>
        </div>

        <div class="home-sci">
            <a href="https://www.instagram.com/rizqiirkhamm/" target="_blank"><i class='bx bxl-instagram'></i></a>
            <a href="https://www.linkedin.com/in/rizqi-irkham-maulana-4a9690247/" target="_blank"><i class='bx bxl-linkedin'></i></a>
            <a href="https://github.com/rizqiirkhamm" target="_blank"><i class='bx bxl-github'></i></a>
        </div>

        <span class="home-imgHover"></span>
    </section>
    <!-- <div class="quick-links">
                <ul>
                    <li>
                        <i class="fa-solid fa-share-alt"></i>
                        <p>SHARE TO</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-audio-decription"></i>
                        <p>RECENT NEWS</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-cog"></i>
                        <p>ANALYTICS</p>
                    </li>
                    <li>
                        <i class="fa-brands fa-bitcoin"></i>
                        <p>Wallet</p>
                    </li>
                </ul>
            </div> -->
    </div>
    </section>
    <!-- Notes -->
    <section class="notes" id="notes">
        <h1 class="h1">Notes</h1>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-lg-10 ">
                    <form class="form" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter Title.." name="title">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" id="desc" rows="3" placeholder="Enter Description.." name="desc"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1>Your Notes</h1>
                    <?php
                    $sql = "SELECT * FROM `notes`";
                    $res = mysqli_query($con, $sql);
                    $noNotes = true;
                    while ($fetch = mysqli_fetch_assoc($res)) {
                        $noNotes = false;
                        echo '<div class="card my-3">
                    <div class="card-body">
                      <h5 class="card-title">' . $fetch["title"] . '</h5>
                      <p class="card-text">' . $fetch["description"] . '</p>
                      <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $fetch["sno"] . '">Edit</button>
                      <a href="./delete.php?id=' . $fetch["sno"] . '" class="btn btn-danger">Delete</a>
                    </div>
                  </div>';
                    }
                    if ($noNotes) {
                        echo '<div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Message</h5>
                      <p class="card-text">No Notes are available for reading.</p>
                    </div>
                  </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- todolist -->
    <section class="todolist" id="todolist">
        <?php
        require 'db_conn.php';
        ?>
        <div class="main-section">
            <h1 class="h1-todolist">Todolist</h1>
            <div class="add-section">
                <form action="app/add.php" method="POST" autocomplete="off">
                    <?php if (isset($_POST['mess']) && $_POST['mess'] == 'error') { ?>
                        <input type="text" name="title" style="border-color: #ff6666" placeholder="This field is required" />
                        <button type="submit">Add &nbsp; <span>&#43;</span></button>

                    <?php } else { ?>
                        <input type="text" name="title" placeholder="Enter your todolist..." />
                        <button type="submit">Add &nbsp; <i class="fa-solid fa-plus"></i></button>

                    <?php } ?>
                </form>
            </div>
            <?php
            $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
            ?>
            <div class="show-todo-section">
                <h1>Your TodoList</h1>
                <?php if ($todos->rowCount() <= 0) { ?>
                    <div class="todo-item">
                        <div class="empty">
                            <p>No Todolist are available for reading.</p>
                        </div>
                    </div>
                <?php } ?>

                <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="todo-item">
                        <?php if ($todo['checked']) { ?>
                            <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                            <h2 class="checked"><?php echo $todo['title'] ?></h2>
                        <?php } else { ?>
                            <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                            <h2><?php echo $todo['title'] ?></h2>
                        <?php } ?>
                        <button id="<?php echo $todo['id']; ?>" class="remove-to-do">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="25" width="25">
                                <path fill="#6361D9" d="M8.78842 5.03866C8.86656 4.96052 8.97254 4.91663 9.08305 4.91663H11.4164C11.5269 4.91663 11.6329 4.96052 11.711 5.03866C11.7892 5.11681 11.833 5.22279 11.833 5.33329V5.74939H8.66638V5.33329C8.66638 5.22279 8.71028 5.11681 8.78842 5.03866ZM7.16638 5.74939V5.33329C7.16638 4.82496 7.36832 4.33745 7.72776 3.978C8.08721 3.61856 8.57472 3.41663 9.08305 3.41663H11.4164C11.9247 3.41663 12.4122 3.61856 12.7717 3.978C13.1311 4.33745 13.333 4.82496 13.333 5.33329V5.74939H15.5C15.9142 5.74939 16.25 6.08518 16.25 6.49939C16.25 6.9136 15.9142 7.24939 15.5 7.24939H15.0105L14.2492 14.7095C14.2382 15.2023 14.0377 15.6726 13.6883 16.0219C13.3289 16.3814 12.8414 16.5833 12.333 16.5833H8.16638C7.65805 16.5833 7.17054 16.3814 6.81109 16.0219C6.46176 15.6726 6.2612 15.2023 6.25019 14.7095L5.48896 7.24939H5C4.58579 7.24939 4.25 6.9136 4.25 6.49939C4.25 6.08518 4.58579 5.74939 5 5.74939H6.16667H7.16638ZM7.91638 7.24996H12.583H13.5026L12.7536 14.5905C12.751 14.6158 12.7497 14.6412 12.7497 14.6666C12.7497 14.7771 12.7058 14.8831 12.6277 14.9613C12.5495 15.0394 12.4436 15.0833 12.333 15.0833H8.16638C8.05588 15.0833 7.94989 15.0394 7.87175 14.9613C7.79361 14.8831 7.74972 14.7771 7.74972 14.6666C7.74972 14.6412 7.74842 14.6158 7.74584 14.5905L6.99681 7.24996H7.91638Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            <span class="tooltiptext">remove</span>
                        </button>
                        <br>
                        <small>created: <?php echo $todo['date_time'] ?></small>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>