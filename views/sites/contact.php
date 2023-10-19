<main class="container section">
    <h1>Contact</h1>

    <?php
        if($message === "E-mail send successfully") {
            echo "<p class='alert success'>" . $message . "</p>";
        } elseif($message === "E-mail couldn't be send") {
            echo "<p class='alert error'>" . $message . "</p>";
        };
    ?>

    <picture>
        <source src="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Contact Image">
    </picture>

    <h2>Fill the Contact Form</h2>

    <form class="form" action="/contact" method="POST"> <!-- To select the input by clicking the label you must put "for" in the label and the same you put there in "id" in the input -->
        <fieldset>
            <legend>Personal Information</legend>
            <label for="name">Name:</label>
            <input type="text" placeholder="Your Name" id="name" name="contact[name]" required>
            <label for="message">Message:</label>
            <textarea id="message" name="contact[message]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Information about the Property</legend>
            <label for="options">Buy or Sell:</label>

            <select id="options" name="contact[type]" required>
                <option value="" disabled selected>-- Select --</option>
                <option value="Buy">Buy</option>
                <option value="Sell">Sell</option>
            </select>

            <label for="budget">Price or Budget:</label>
            <input type="number" placeholder="Your Price or Budget" id="budget" name="contact[price]" required>
        </fieldset>

        <fieldset>
            <legend>Information about the Property</legend>
            <p>How do you wish to be contacted?</p>

            <div class="contact-way">
                <label for="contact-phone">Phone</label>
                <input type="radio" value="phone" id="contact-phone" name="contact[contact]" required>
                <label for="contact-email">E-mail</label>
                <input type="radio" value="email" id="contact-email" name="contact[contact]" required>
            </div>

            <div id="contact"></div>
        </fieldset>

        <input type="submit" value="Submit" class="green-button">
    </form>
</main>