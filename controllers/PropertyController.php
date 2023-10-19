<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Property;
    use Model\Agent;
    use Model\Entry;
    use Intervention\Image\ImageManagerStatic as Image;

    class PropertyController {
        public static function index(Router $router) {
            
            $properties = Property::all();
            $agents = Agent::all();
            $entries = Entry::all();

            // Shows conditional message

            // This means that if result is not defined then it's null, it doesn't exist, and so you can't get an error

            $result = $_GET["result"] ?? null;
            
            $router->render("properties/admin", [
                "properties" => $properties,
                "agents" => $agents,
                "entries" => $entries,
                "result" => $result
            ]);
        }

        public static function create(Router $router) {
            
            $property = new Property;
            $agents = Agent::all();

            // Array with error messages

            $errors = Property::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Creates a new instance
        
                $property = new Property($_POST["property"]);
        
                // Upload files
        
                // Generate an unique name
        
                $imgName = md5(uniqid(rand(), true)) . ".jpg";
        
                // Resize the image with Intervention
        
                if($_FILES["property"]["tmp_name"]["img"]) {
                    $img = Image::make($_FILES["property"]["tmp_name"]["img"])->fit(800,600);
                    $property->setImage($imgName);
                }
        
                // Validate
        
                $errors = $property->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {
        
                    // Create folder with mkdir
                    
                    if(!is_dir(IMAGE_FOLDER)) {
                        mkdir(IMAGE_FOLDER);
                    };
        
                    // Save the image on the server
        
                    $img->save((IMAGE_FOLDER . $imgName));
        
                    // Save it on the database
        
                    $property->save();
                };
            };
            
            $router->render("properties/create", [
                "property" => $property,
                "agents" => $agents,
                "errors" => $errors
            ]);
        }

        public static function update(Router $router) {

            $id = validateOrRedirect("/admin", "property", "Property");

            $property = Property::find($id);
            $agents = Agent::all();

            // Array with error messages

            $errors = Property::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Assign the atributes
                
                $args = $_POST["property"];
                $property->synchronize($args);
        
                // Upload files
                
                // Generate an unique name
        
                $imgName = md5(uniqid(rand(), true)) . ".jpg";
        
                // Resize the image with Intervention
        
                if($_FILES["property"]["tmp_name"]["img"]) {
                    $img = Image::make($_FILES["property"]["tmp_name"]["img"])->fit(800,600);
                    $property->setImage($imgName);
                }
                
                // Validation
        
                $errors = $property->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {
        
                    // Save the image on the server
        
                    if(!is_null($img)) {
                        $img->save((IMAGE_FOLDER . $imgName));
                    }
        
                    // Save it on the database
        
                    $property->save();
                };
            };

            $router->render("properties/update", [
                "property" => $property,
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
                        $property = Property::find($id);
                        $property->delete();
                    } 
                };
            };
        }
    }