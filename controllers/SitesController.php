<?php

    namespace Controllers;

    use MVC\Router;
    use Model\Property;
    use Model\Entry;
    use PHPMailer\PHPMailer\PHPMailer;

    class SitesController {
        public static function index (Router $router) {
            $properties = Property::get(3);
            $entries = Entry::get(2);
            $index = true;
            
            $router->render("sites/index", [
                "properties" => $properties,
                "entries" => $entries,
                "index" => $index
            ]);
        }

        public static function aboutus (Router $router) {
            $router->render("sites/about-us");
        }

        public static function properties (Router $router) {
            $properties = Property::all();
            
            $router->render("sites/properties", [
                "properties" => $properties
            ]);
        }

        public static function property (Router $router) {
            $id = validateOrRedirect("/", "property", "Property");

            $property = Property::find($id);

            $router->render("sites/property", [
                "property" => $property
            ]);
        }

        public static function blog (Router $router) {
            $entries = Entry::all();
            
            $router->render("sites/blog", [
                "entries" => $entries
            ]);
        }

        public static function entry (Router $router) {
            $id = validateOrRedirect("/", "property", "Property");

            $entry = Entry::find($id);
            
            $router->render("sites/entry", [
                "entry" => $entry
            ]);
        }

        public static function contact (Router $router) {
            $message = null;

            if($_SERVER["REQUEST_METHOD"] === "POST") {

                $answers = $_POST["contact"];
                
                // Create a new instance of PHPMailer

                $mail = new PHPMailer();

                // Set up SMTP

                $mail->isSMTP();
                $mail->Host = "smtp.mailtrap.io";
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = "a81614f8f52e02";
                $mail->Password = "0be6e339bebc45";
                $mail->SMTPSecure = "tls";

                // Set up the email content

                $mail->setFrom("admin@realstate.com");
                $mail->addAddress("admin@realstate.com", "RealState.com");
                $mail->Subject = "You have a New Message";

                // Enable HTML

                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";

                // Define the content

                $content = "<html>";
                $content .= "<p>You have a New Message</p>";
                $content .= "<p>Name: " . $answers["name"] . "</p>";
                
                // Send email or phone number conditionally

                if($answers["contact"] === "phone") {
                    $content .= "<p>Choosed to be contacted by Phone</p>";
                    $content .= "<p>Phone Number: " . $answers["phone"] . "</p>";
                    $content .= "<p>Date for contact: " . $answers["date"] . "</p>";
                    $content .= "<p>Time for contact: " . $answers["time"] . "</p>";
                } else {
                    $content .= "<p>Choosed to be contacted by E-mail</p>";
                    $content .= "<p>E-mail: " . $answers["email"] . "</p>";
                };

                $content .= "<p>Message: " . $answers["message"] . "</p>";
                $content .= "<p>Buy or Sell: " . $answers["type"] . "</p>";
                $content .= "<p>Price or Budged: $ " . $answers["price"] . "</p>";
                $content .= "</html>";
                $mail->Body = $content;
                $mail->AltBody = "Alternative text without HTML";

                // Send the email

                if($mail->send()) {
                    $message = "E-mail send successfully";
                } else {
                    $message = "E-mail couldn't be send";
                }
            }

            $router->render("sites/contact", [
                "message" => $message
            ]);
        }
    }