<?php

    use Model\Agent;
    use Model\Property;
    use Model\Entry;

    define("TEMPLATES_URL", __DIR__ . "/templates");
    define("FUNCTIONS_URL", __DIR__ . "functions.php");
    define("IMAGE_FOLDER", $_SERVER["DOCUMENT_ROOT"] . "/images/");

    function includeTemplate(string $name, bool $index = false) {
        include TEMPLATES_URL . "/${name}.php";
    };

    function isAuthenticated() {
        session_start();

        if(!$_SESSION["login"]) {
            header("Location: /");
        };
    };

    function debug($variable) {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    };

    // Escape/Sanitize HTML

    function esc($html) : string {
        $esc = htmlspecialchars($html);
        return $esc;
    };

    // Validate type of content

    function validateContentType($type) {
        $types = ["agent", "property", "entry"];
        return in_array($type, $types);
    };

    // Shows the messages

    function showNotification($code) {
        $message = "";

        switch($code) {
            case 1:
                $message = "Created Successfully";
                break;
            case 2:
                $message = "Updated Successfully";
                break;
            case 3:
                $message = "Deleted Successfully";
                break;
            default:
                $message = false;
                break;
        };

        return $message;
    };

    function validateOrRedirect(string $url, string $var, string $class) {
        
        // Validate ID by valid ID

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(is_numeric($id)) {
            switch ($class) {
                case 'Property':
                    $$var = Property::find($id);
                    break;
                case 'Agent':
                    $$var = Agent::find($id);
                    break;
                case 'Entry':
                    $$var = Entry::find($id);
                    break;
                default:
                    $$var = null;
                    break;
            }
        }
    
        if($$var === null || !$id) {
            header("Location: ${url}");
        };
        return $id;
    }