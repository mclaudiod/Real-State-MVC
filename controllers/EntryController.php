<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Entry;
    use Model\Agent;
    use Intervention\Image\ImageManagerStatic as Image;

    class EntryController {
        public static function create(Router $router) {
            
            $entry = new Entry;
            $agents = Agent::all();

            // Array with error messages

            $errors = Entry::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Creates a new instance
        
                $entry = new Entry($_POST["entry"]);

                // Upload files
        
                // Generate an unique name
        
                $imgName = md5(uniqid(rand(), true)) . ".jpg";
        
                // Resize the image with Intervention
        
                if($_FILES["entry"]["tmp_name"]["img"]) {
                    $img = Image::make($_FILES["entry"]["tmp_name"]["img"])->fit(800,600);
                    $entry->setImage($imgName);
                }
        
                // Validate
        
                $errors = $entry->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {

                    // Create folder with mkdir
                    
                    if(!is_dir(IMAGE_FOLDER)) {
                        mkdir(IMAGE_FOLDER);
                    };
        
                    // Save the image on the server
        
                    $img->save((IMAGE_FOLDER . $imgName));

                    // Save it on the database

                    $entry->save();
                };
            };
            
            $router->render("entries/create", [
                "entry" => $entry,
                "agents" => $agents,
                "errors" => $errors
            ]);
        }

        public static function update(Router $router) {

            $id = validateOrRedirect("/admin", "entry", "Entry");

            $entry = Entry::find($id);
            $agents = Agent::all();

            // Array with error messages

            $errors = Entry::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Assign the atributes
                
                $args = $_POST["entry"];
                $entry->synchronize($args);

                // Upload files
                
                // Generate an unique name
        
                $imgName = md5(uniqid(rand(), true)) . ".jpg";
        
                // Resize the image with Intervention
        
                if($_FILES["entry"]["tmp_name"]["img"]) {
                    $img = Image::make($_FILES["entry"]["tmp_name"]["img"])->fit(800,600);
                    $entry->setImage($imgName);
                }
                
                // Validation
        
                $errors = $entry->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {

                    // Save the image on the server
        
                    if(!is_null($img)) {
                        $img->save((IMAGE_FOLDER . $imgName));
                    }
        
                    // Save it on the database
        
                    $entry->save();
                };
            };

            $router->render("entries/update", [
                "entry" => $entry,
                "agents" => $agents,
                "errors" => $errors
            ]);
        }

        public static function delete() {
            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Validate id
                
                $id = $_POST["id"];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if($id) {
                    
                    $type = $_POST["type"];
        
                    if (validateContentType($type)) {
                        $entry = Entry::find($id);
                        $entry->delete();
                    } 
                };
            };
        }
    }