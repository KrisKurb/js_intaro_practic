<?php
function getResumes($db)
{
    $query = $db->prepare("SELECT *, extract(year from age(c_dr)) as age FROM candidate");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Candidate');
    $query->execute();
    $data = $query->fetchAll();

    if (count($data) > 0) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(404);

        $res=[
            "status" => false,
            "message" => "Кандидаты не найдены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function getCandidateById($db, $id)
{
    $query = $db->prepare("SELECT * FROM candidate WHERE c_id = :id");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Candidate');
    $query->execute([':id' => $id]);
    $data = $query->fetchAll();

    if (count($data) > 0) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(404);

        $res=[
            "status" => false,
            "message" => "Кандидат не найден"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function deleteEducationById($db, $id)
{
    $query = $db->prepare("DELETE FROM education WHERE ed_id = :id");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Education');
    $result = $query->execute([':id' => $id]);
    if ($result) {
        http_response_code(200);
        $res=[
            "status" => true,
            "message" => "Образование удалено"
        ];

        echo json_encode($res);
    }
    else {
        http_response_code(400);

        $res=[
            "status" => false,
            "message" => "Образование не удалось удалить"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function getEducationByIdCandidate($db, $id)
{
    $query = $db->prepare("SELECT * FROM education WHERE ed_id = :id ORDER BY ed_id DESC");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Education');
    $query->execute([':id' => $id]);
    $data = $query->fetchAll();

    if (count($data) > 0) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else {

        http_response_code(406);

        $res=[
            "status" => false,
            "message" => "Образования не найдены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function addResume($db)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("INSERT INTO candidate (profession, city, photo, c_number,
                            c_name, email, c_dr, salary, skills, me, status)
                            res_ind (:profession,:city, :photo, :c_number, :c_name, :email, :c_dr, :salary,
                            :skills, :me, :status) RETURNING c_id");
    $params = [
        ':profession' =>  $data->candidate->profession->res_ind,
        ':city' => $data->candidate->city->res_ind,
        ':photo' => $data->candidate->photo->res_ind,
        ':c_number' => $data->candidate->c_number->res_ind,
        ':c_name' => $data->candidate->c_name->res_ind,
        ':email' => $data->candidate->email->res_ind,
        ':c_dr' => $data->candidate->c_dr->res_ind,
        ':salary' => (float)$data->candidate->salary->res_ind,
        ':skills' => $data->candidate->skills->res_ind,
        ':me' => $data->candidate->me->res_ind,
        ':status' => $data->candidate->status->res_ind
    ];
    $query->execute($params);
    $id = $query->fetchAll(PDO::FETCH_COLUMN);
    $c_id = $id[0];

    if (isset($c_id)) {

        foreach( $data->candidate->education as $education ) {
            addEducation($db, $c_id, $education);
        }

        $res=[
            "status" => true,
            "id" => $c_id,
            "message" => "Кандидат добавлен"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Резюме не добавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function addEducation($db, $c_id, $data)
{
    if ($data->level->res_ind !== "") {
        $query = $db->prepare("INSERT INTO education (c_id, level, university,
                            faculty, specialization, ed_year)
                            res_ind (:c_id, :level, :university, :faculty, :specialization, :ed_year) 
                            RETURNING ed_id");
        if($data->ed_year->res_ind === '' || !isset($data->ed_year->res_ind))
            $data->ed_year->res_ind = null;
        if($data->university->res_ind === '' || !isset($data->university->res_ind))
            $data->university->res_ind = null;
        if($data->faculty->res_ind === '' || !isset($data->faculty->res_ind))
            $data->faculty->res_ind = null;
        if($data->specialization->res_ind === '' || !isset($data->specialization->res_ind))
            $data->specialization->res_ind = null;
        $params = [
            ':c_id' => $c_id,
            ':level' => $data->level->res_ind,
            ':university' => $data->university->res_ind,
            ':faculty' => $data->faculty->res_ind,
            ':specialization' => $data->specialization->res_ind,
            ':ed_year' => $data->ed_year->res_ind
            ];
        $result = $query->execute($params);
        $id = $query->fetchAll(PDO::FETCH_COLUMN);
        $ed_id = $id[0];

        if ($result) {
            http_response_code(201);
            $res=[
                "status" => true,
                "message" => "Образование добавлено",
                "ed_id" => $ed_id
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(503);

            $res=[
                "status" => false,
                "message" => "Образование не добавлено",
                "data" => $data
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}
function editResume($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("UPDATE candidate SET profession = :profession, 
                            city = :city, photo = :photo, c_number = :c_number,
                            c_name = :c_name, email = :email, c_dr = :c_dr,
                             salary = :salary, skills = :skills, me = :me, status = :status
                            WHERE c_id = :c_id");
    $params = [
        ':profession' =>  $data->candidate->profession->res_ind,
        ':city' => $data->candidate->city->res_ind,
        ':photo' => $data->candidate->photo->res_ind,
        ':c_number' => $data->candidate->c_number->res_ind,
        ':c_name' => $data->candidate->c_name->res_ind,
        ':email' => $data->candidate->email->res_ind,
        ':c_dr' => $data->candidate->c_dr->res_ind,
        ':salary' => (float)$data->candidate->salary->res_ind,
        ':skills' => $data->candidate->skills->res_ind,
        ':me' => $data->candidate->me->res_ind,
        ':status' => $data->candidate->status->res_ind,
        ':c_id' => $id
    ];
    $result = $query->execute($params);

    if ($result) {


        foreach( $data->candidate->education as $education ) {
            editEducation($db, $education);
        }

        $res=[
            "status" => true,
            "id" => $id,
            "message" => "Данные по кандидату обновлены"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(506);

        $res=[
            "status" => false,
            "message" => "Данные по кандидату не обновлены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
function editEducation($db, $data)
{
    $query = $db->prepare("UPDATE education SET level = :level, university = :university,
                            faculty = :faculty, specialization = :specialization, ed_year = :ed_year
                            WHERE ed_id = :ed_id");
    if($data->ed_year->res_ind === '' || !isset($data->ed_year->res_ind))
        $data->ed_year->res_ind = null;
    if($data->university->res_ind === '' || !isset($data->university->res_ind))
        $data->university->res_ind = null;
    if($data->faculty->res_ind === '' || !isset($data->faculty->res_ind))
        $data->faculty->res_ind = null;
    if($data->specialization->res_ind === '' || !isset($data->specialization->res_ind))
        $data->specialization->res_ind = null;
    $params = [
        ':level' =>  $data->level->res_ind,
        ':university' => $data->university->res_ind,
        ':faculty' => $data->faculty->res_ind,
        ':specialization' => $data->specialization->res_ind,
        ':ed_year' => $data->ed_year->res_ind,
        ':ed_id' => $data->id->res_ind
    ];
    $result = $query->execute($params);

    if ($result) {
        http_response_code(201);
        $res=[
            "status" => true,
            "message" => "Образование обнавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Образование не обнавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}

function updateStatus($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));

    $query = $db->prepare("UPDATE candidate SET status = :status
                            WHERE c_id = :c_id");
    $params = [
        ':status' => $data->status,
        ':c_id' => $id
    ];
    $result = $query->execute($params);

    if ($result) {

        $res=[
            "status" => true,
            "message" => "Данные по кандидату обновлены"
        ];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(506);

        $res=[
            "status" => false,
            "message" => "Данные по кандидату не обновлены"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
