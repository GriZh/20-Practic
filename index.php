<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практики</title>
</head>

<body>

    <!-- 1 задание -->

    <?php
    $host = 'localhost';
    $db = 'school_management';
    $user = 'root';
    $password = '';


    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
    echo "Соединение успешно установлено!";
    ?>


    <!-- 2 задание -->

    <p> Введите имя студента</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Отправить</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("INSERT INTO students (name) VALUES (?)");
            $stmt->bind_param("s", $name);

            $name = $_POST['name'];
            $stmt->execute();

            $stmt->close();
            $conn->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите имя!';
        }
        ;
    }
    ?>

    <!-- 3 задание -->

    <table border="1">
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>ID группы</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "<td>" . $row["group_id"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нет студентов.";
        }

        $conn->close();
        ?>
    </table>

    <!-- 4 задание -->

    <p>Введите название группы</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Отправить</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("INSERT INTO groups (name) VALUES (?)");
            $stmt->bind_param("s", $name);

            $name = $_POST['name'];
            $stmt->execute();

            $stmt->close();
            $conn->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите название!';
        }
        ;
    }
    ?>

    <!-- 5 задание -->

    <div style='display:flex'>
        <table border="1" height='20px'>
            <tr>
                <td>ID</td>
                <td>Имя</td>
            </tr>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'school_management');
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
                }
            } else {
                echo "Нет студентов.";
            }
            ?>
        </table>

        <div style="width:20px"></div>

        <table border="1" height='20px'>
            <tr>
                <td>ID</td>
                <td>Имя группы</td>
            </tr>
            <?php
            $sql = "SELECT * FROM groups";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
                }
            } else {
                echo "Нет групп.";
            }
            $conn->close();
            ?>
        </table>
    </div>

    <br>
    <form method="post" style='display:flex'>
        <div style='display:flex;flex-direction:column;'>
            Введите id студента
            <input name="stud" id="stud" type="number">
        </div>

        <div style='display:flex;flex-direction:column;'>
            Введите id группы
            <input name="grup" id="grup" type="number">
        </div>

        <button type="submit">Связать</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['stud']) and isset($_POST['grup'])) {
        if ($_POST['stud'] != '' and $_POST['grup'] != '') {
            $stmt = $conn->prepare("UPDATE students SET group_id = ? WHERE id = ?");
            $stmt->bind_param("ii", $grup, $stud);

            $stud = $_POST['stud'];
            $grup = $_POST['grup'];
            $stmt->execute();

            $stmt->close();
            $conn->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Заполните все поля!';
        }
        ;
    }
    ?>

    <!-- 6 задание -->

    <table border="1" height='20px'>
        <tr>
            <td>Имя</td>
            <td>Группа</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT students.name AS student_name, groups.name AS group_name 
        FROM students 
        LEFT JOIN groups ON students.group_id = groups.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["student_name"] . "</td>" . "<td>" . $row["group_name"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нечего выводить.";
        }

        $conn->close();
        ?>
    </table>

    <!-- 7 задание -->

    <div style='display:flex'>
        <table border="1" height='20px'>
            <tr>
                <td>ID</td>
                <td>Имя</td>
            </tr>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'school_management');
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
                }
            } else {
                echo "Нет студентов.";
            }
            ?>
        </table>

        <div style="width:20px"></div>

        <table border="1" height='20px'>
            <tr>
                <td>ID</td>
                <td>Имя группы</td>
            </tr>
            <?php
            $sql = "SELECT * FROM courses";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
                }
            } else {
                echo "Нет курсов.";
            }
            $conn->close();
            ?>
        </table>
    </div>

    <br>
    <form method="post" style='display:flex'>
        <div style='display:flex;flex-direction:column;'>
            Введите id студента
            <input name="stud" id="stud" type="number">
        </div>

        <div style='display:flex;flex-direction:column;'>
            Введите id курса
            <input name="kurs" id="kurs" type="number">
        </div>

        <button type="submit">Связать</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['stud']) and isset($_POST['kurs'])) {
        if ($_POST['stud'] != '' and $_POST['kurs'] != '') {
            $stmt = $conn->prepare("INSERT INTO student_courses (student_id,course_id) VALUES (?,?)");
            $stmt->bind_param("ii", $stud, $kurs);

            $stud = $_POST['stud'];
            $kurs = $_POST['kurs'];

            $stmt->execute();
            $stmt->close();
            $conn->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Заполните все поля!';
        }
        ;
    }
    ?>

    <!-- 8 задание -->

    <table border="1" height='20px'>
        <tr>
            <td>Название курса</td>
            <td>Количество студентов на курсе</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT courses.name AS course_name, COUNT(student_courses.student_id) AS student_count 
        FROM courses 
        LEFT JOIN student_courses ON courses.id = student_courses.course_id 
        GROUP BY courses.name";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["course_name"] . "</td>" . "<td>" . $row["student_count"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нечего выводить.";
        }

        $conn->close();
        ?>
    </table>

    <!-- 9 задание -->

    <table border="1">
        <tr>
            <td>ID</td>
            <td>Имя</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нет студентов.";
        }

        $conn->close();
        ?>
    </table>
    <br>

    <p>Введите id студента, которого нужно удалить</p>
    <form method="post">
        <input name="name" id="name" type="number">
        <button type="submit">Отчислить!</button>
    </form>


    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt2 = $conn->prepare("DELETE FROM student_courses WHERE student_id = ?");
            $stmt2->bind_param("i", $id);

            $id = $_POST['name'];

            $stmt2->execute();
            $stmt->execute();
            $stmt2->close();
            $stmt->close();

            $conn->close();

            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите id!';
        }
        ;
    }
    ?>

    <!-- 10 задание -->

    <table border="1">
        <tr>
            <td>ID</td>
            <td>Имя</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нет студентов.";
        }

        $conn->close();
        ?>
    </table>
    <br>

    <form method="post" style='display:flex'>
        <div style='display:flex;flex-direction:column;'>
            Введите id студента
            <input name="idi" id="idi" type="number">
        </div>
        <div style='display:flex;flex-direction:column;'>
            Введите новое имя студента
            <input name="name" id="name" type="text">
        </div>
        <button type="submit">Изменить имя</button>
    </form>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['idi'] != '' and $_POST['name'] != '') {
            $stmt = $conn->prepare("UPDATE students SET name=? WHERE id=?");
            $stmt->bind_param("si", $name, $id);

            $id = $_POST['idi'];
            $name = $_POST['name'];

            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите имя и id!';
        }
        ;
    }
    ?>
    <!-- 11 задание -->

    <table border="1">
        <tr>
            <td>Преподаватель</td>
            <td>Курс</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT teachers.name AS teacher_name, courses.name AS course_name 
        FROM teachers 
        LEFT JOIN courses ON teachers.id = courses.teacher_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["teacher_name"] . "</td>" . "<td>" . $row["course_name"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нечего показывать.";
        }

        $conn->close();
        ?>
    </table>

    <!-- 12 задание -->

    <p>Введите имя студента</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Отправить</button>
    </form>
    <?php
    $p1 = 0;
    if (isset($_POST['name'])) {
        $conn = new mysqli('localhost', 'root', '', 'school_management');
        $sql = "
	    SELECT students.name AS student_name, students.id AS student_is, groups.name AS group_name, courses.name AS course_name
		FROM students
        LEFT JOIN groups ON students.group_id = groups.id
        LEFT JOIN student_courses ON students.id =student_courses.student_id
        LEFT JOIN courses ON student_courses.course_id = courses.id";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            if ($row["student_name"] == $_POST['name']) {
                echo
                    "ID: " . $row["student_is"] . "<br>" .
                    "Имя: " . $row["student_name"] . "<br>" .
                    "Группа: " . $row["group_name"] . "<br>" .
                    "Курс: " . $row["course_name"];
                $p1 = 1;
            }
        }
        if ($p1 == 0) {
            echo "Не найдено";
        }

        $conn->close();
    }
    ?>

    <!-- 13 задание -->

    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["group_id"] == "") {
                echo $row["name"] . $row["group_id"] . "<br>";
            }
        }
    } else {
        echo "Не найдено.";
    }

    $conn->close();
    ?>

    <!-- 14 задание -->

    <p>Введите название курса</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Отправить</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("INSERT INTO courses (name) VALUES (?)");
            $stmt->bind_param("s", $name);

            $name = $_POST['name'];
            $stmt->execute();

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите название!';
        }
        ;
    }
    ?>

    <!-- 15 задание -->

    <p>Введите имя преподавателя</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Добавить</button>
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("INSERT INTO teachers (name) VALUES (?)");
            $stmt->bind_param("s", $name);

            $name = $_POST['name'];
            $stmt->execute();

            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите имя!';
        }
        ;
    }
    ?>

    <!-- 16 задание -->

    <p>Введите название курса</p>
    <form method="post">
        <input name="name" id="name" type="text">
        <button type="submit">Отправить</button>
    </form>
    <?php
    $p1 = 0;
    if (isset($_POST['name'])) {
        if ($_POST['name'] != "") {
            $conn = new mysqli('localhost', 'root', '', 'school_management');
            $sql = "
	    SELECT students.name AS student_name, students.id AS student_is, courses.name AS course_name
		FROM students
        LEFT JOIN student_courses ON students.id =student_courses.student_id
        LEFT JOIN courses ON student_courses.course_id = courses.id";

            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                if ($row["course_name"] == $_POST['name']) {
                    echo
                        $row["student_name"] . "<br>";
                    $p1 = 1;
                }
            }
            if ($p1 == 0) {
                echo "Не найдено";
            }

            $conn->close();
        } else {
            echo "Введите название!";
        }
    }
    ?>

    <!-- 17 задание -->

    <table border="1">
        <tr>
            <td>ID</td>
            <td>Курс</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["id"] . "</td>" . "<td>" . $row["name"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нет курсов.";
        }

        $conn->close();
        ?>
    </table>
    <br>

    Введите id курса, который нужно удалить
    <form method="post">
        <input name="name" id="name" type="number">
        <button type="submit">Удалить</button>
    </form>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    if (isset($_POST['name'])) {
        if ($_POST['name'] != '') {
            $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt2 = $conn->prepare("DELETE FROM student_courses WHERE course_id = ?");
            $stmt2->bind_param("i", $id);

            $id = $_POST['name'];

            $stmt2->execute();
            $stmt->execute();
            $stmt2->close();
            $stmt->close();

            $conn->close();

            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo 'Введите id!';
        }
        ;
    }
    ?>

    <!-- 18 задание -->

    <form method="POST">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT * FROM groups";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo
                    "<input type='radio' name='gruppa' value=" . $row['id'] . ">" . $row['name'] . "<br>";
            }
        } else {
            echo "Нет студентов.";
        }

        $conn->close();
        ?>
        <button type="submit">Отправить</button>
    </form>

    <?php
    $p1 = 0;
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    $sql = "SELECT groups.name AS group_name, groups.id AS id, students.name AS student_name FROM groups LEFT JOIN students ON groups.id=students.group_id";
    $result = $conn->query($sql);

    if (isset($_POST['gruppa'])) {
        while ($row = $result->fetch_assoc()) {
            if ($_POST['gruppa'] == $row['id']) {
                echo
                    $row['student_name'] . '<br>';
                if ($row['student_name'] != '') {
                    $p1 = 1;
                }
            }
        }
        $conn->close();

        if ($p1 == 0) {
            echo 'В этой группе никто не учится';
        }
    }
    ;
    ?>

    <!-- 19 задание -->

    <h4>Студенты, зарегистрированные на нескольких курсах:</h4>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'school_management');

    $sql = "SELECT students.name AS student_name, COUNT(student_courses.course_id) AS course_count 
        FROM students 
        JOIN student_courses ON students.id = student_courses.student_id 
        GROUP BY students.id 
        HAVING course_count > 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["student_name"] . "<br>";
        }
    } else {
        echo "Нет студентов.";
    }

    $conn->close();
    ?>

    <!-- 20 задание -->

    <table border="1">
        <tr>
            <td>Преподаватель</td>
            <td>Количество студентов у преподавателя</td>
        </tr>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'school_management');

        $sql = "SELECT teachers.name AS teacher_name, COUNT(student_courses.student_id) AS total_students 
        FROM teachers 
        JOIN courses ON teachers.id = courses.teacher_id 
        JOIN student_courses ON courses.id = student_courses.course_id 
        GROUP BY teachers.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["teacher_name"] . "</td>" . "<td>" . $row["total_students"] . "</td>" . "</tr>";
            }
        } else {
            echo "Нечего показывать.";
        }
        $conn->close();
        ?>
    </table>
</body>

</html>