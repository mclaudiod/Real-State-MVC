<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Agent;

    class AgentController {
        public static function create(Router $router) {
            
            $agent = new Agent;

            // Array with error messages

            $errors = Agent::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Creates a new instance
        
                $agent = new Agent($_POST["agent"]);
        
                // Validate
        
                $errors = $agent->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {

                    // Save it on the database

                    $agent->save();
                };
            };
            
            $router->render("agents/create", [
                "agent" => $agent,
                "errors" => $errors
            ]);
        }

        public static function update(Router $router) {

            $id = validateOrRedirect("/admin", "agent", "Agent");

            $agent = Agent::find($id);

            // Array with error messages

            $errors = Agent::getErrors();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
        
                // Assign the atributes
                
                $args = $_POST["agent"];
                $agent->synchronize($args);
                
                // Validation
        
                $errors = $agent->validate();
        
                // Check that the errors array is empty
        
                if(empty($errors)) {
        
                    // Save it on the database
        
                    $agent->save();
                };
            };

            $router->render("agents/update", [
                "agent" => $agent,
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
                        $agent = Agent::find($id);
                        $agent->delete();
                    } 
                };
            };
        }
    }