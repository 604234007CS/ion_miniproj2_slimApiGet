<?php

// get all todos
    $app->get('/MEMBER', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM member ORDER BY ");
        $sth->execute();
        $MEMBER = $sth->fetchAll();
        return $this->response->withJson($MEMBER);
    });
 

    $app->get('/RENTEDROOM', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM rentedroom ORDER BY rentedroom_id");
       $sth->execute();
       $RENTEDROOM = $sth->fetchAll();
       return $this->response->withJson($RENTEDROOM);
   });

   $app->get('/TYPE', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM type ORDER BY type_id");
   $sth->execute();
   $TYPE = $sth->fetchAll();
   return $this->response->withJson($TYPE);
});

    $app->get('/PICTURE', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM picture ORDER BY picture_id");
   $sth->execute();
   $PICTURE = $sth->fetchAll();
   return $this->response->withJson($PICTURE);
});

    // Retrieve todo with id 
    $app->get('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });
 
 
    // Search for todo with given search teram in their name
    $app->get('/todos/search/[{query}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Add a new todo
    $app->post('/todo', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO tasks (task) VALUES (:task)";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson($input);
    });
        
 
    // DELETE a todo with given id
    $app->delete('/todo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("DELETE FROM tasks WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Update todo with given id
    $app->put('/todo/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE tasks SET task=:task WHERE id=:id";
         $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("task", $input['task']);
        $sth->execute();
        $input['id'] = $args['id'];
        return $this->response->withJson($input);
    });



    $app->get('/Condominium', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT 
        rentedroom.rentedroom_id,
        rentedroom.rentedroom_name,
        rentedroom.rentedroom_address,
        rentedroom.price,
        rentedroom.facilities,
        rentedroom.namepic,
        type.type_name,
        rentedroom.restrict_gender,
        rentedroom.rentedroom_phone
    FROM rentedroom, type, picture 
    WHERE rentedroom.type_id = type.type_id AND type.type_id LIKE 't001%' AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price ");
       $sth->execute();
       $Condominium = $sth->fetchAll();
       return $this->response->withJson($Condominium);
    });


    $app->get('/Apartment', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT 
        rentedroom.rentedroom_id,
        rentedroom.rentedroom_name,
        rentedroom.rentedroom_address,
        rentedroom.price,
        rentedroom.facilities,
        rentedroom.namepic,
        type.type_name,
        rentedroom.restrict_gender,
        rentedroom.rentedroom_phone
    FROM rentedroom, type, picture 
    WHERE rentedroom.type_id = type.type_id AND type.type_id LIKE 't002%' AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price ");
       $sth->execute();
       $Apartment = $sth->fetchAll();
       return $this->response->withJson($Apartment);
    });


    $app->get('/Mansion', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT 
        rentedroom.rentedroom_id,
        rentedroom.rentedroom_name,
        rentedroom.rentedroom_address,
        rentedroom.price,
        rentedroom.facilities,
        rentedroom.namepic,
        type.type_name,
        rentedroom.restrict_gender,
        rentedroom.rentedroom_phone
    FROM rentedroom, type, picture 
    WHERE rentedroom.type_id = type.type_id AND type.type_id LIKE 't003%' AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price ");
       $sth->execute();
       $Mansion = $sth->fetchAll();
       return $this->response->withJson($Mansion);
    });

    
    $app->get('/Dorm', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT 
        rentedroom.rentedroom_id,
        rentedroom.rentedroom_name,
        rentedroom.rentedroom_address,
        rentedroom.price,
        rentedroom.facilities,
        rentedroom.namepic,
        type.type_name,
        rentedroom.restrict_gender,
        rentedroom.rentedroom_phone
    FROM rentedroom, type, picture 
    WHERE rentedroom.type_id = type.type_id AND type.type_id LIKE 't004%' AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price ");
       $sth->execute();
       $Dorm = $sth->fetchAll();
       return $this->response->withJson($Dorm);
    });


    $app->get('/search/[{query}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE rentedroom_name LIKE :query ORDER BY rentedroom_name");
       $query = "%".$args['query']."%";
       $sth->bindParam("query", $query);
       $sth->execute();
       $rentedroom = $sth->fetchAll();
       return $this->response->withJson($rentedroom);
   });

   $app->get('/showroom/[{rentedroom_name}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom WHERE rentedroom_name LIKE :rentedroom_name ORDER BY rentedroom_name");
  $query = "%".$args['rentedroom_name']."%";
  $sth->bindParam("rentedroom_name", $query);
  $sth->execute();
  $showroom = $sth->fetchAll();
  return $this->response->withJson($showroom);
});

$app->get('/room/[{rentedroom_name}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM rentedroom ");
  $query = "%".$args['rentedroom_name']."%";
  $sth->bindParam("rentedroom_name", $query);
  $sth->execute();
  $room = $sth->fetchAll();
  return $this->response->withJson($room);
});


$app->get('/room3000', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.rentedroom_id,
	rentedroom.rentedroom_name,
	rentedroom.rentedroom_address,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.namepic,
	type.type_name,
	rentedroom.restrict_gender,
	rentedroom.rentedroom_phone
FROM rentedroom, type, picture 
WHERE rentedroom.type_id = type.type_id  AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price < 3000;");
   $sth->execute();
   $room3000 = $sth->fetchAll();
   return $this->response->withJson($room3000);
});

$app->get('/room3001', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.rentedroom_id,
	rentedroom.rentedroom_name,
	rentedroom.rentedroom_address,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.namepic,
	type.type_name,
	rentedroom.restrict_gender,
	rentedroom.rentedroom_phone
FROM rentedroom, type, picture 
WHERE rentedroom.type_id = type.type_id  AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price BETWEEN '3000%' AND '4000%';");
   $sth->execute();
   $room3001 = $sth->fetchAll();
   return $this->response->withJson($room3001);
});

$app->get('/room4000', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.rentedroom_id,
	rentedroom.rentedroom_name,
	rentedroom.rentedroom_address,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.namepic,
	type.type_name,
	rentedroom.restrict_gender,
	rentedroom.rentedroom_phone
FROM rentedroom, type, picture 
WHERE rentedroom.type_id = type.type_id  AND rentedroom.rentedroom_id = picture.rentedroom_id AND rentedroom.price > 4000;");
   $sth->execute();
   $room4000 = $sth->fetchAll();
   return $this->response->withJson($room4000);
});

$app->get('/room', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT 
	rentedroom.rentedroom_id,
	rentedroom.rentedroom_name,
	rentedroom.rentedroom_address,
	rentedroom.price,
	rentedroom.facilities,
    rentedroom.namepic,
	type.type_name,
	rentedroom.restrict_gender,
	rentedroom.rentedroom_phone
FROM rentedroom, type, picture 
WHERE rentedroom.type_id = type.type_id  AND rentedroom.rentedroom_id = picture.rentedroom_id ");
   $sth->execute();
   $room = $sth->fetchAll();
   return $this->response->withJson($room);
});