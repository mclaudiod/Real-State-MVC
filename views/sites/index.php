<main class="container section">
    <?php include "icons.php"; ?>
</main>

<section class="section container">
    <h2>Houses and Apartments on Sale</h2>

    <?php include "listing.php"; ?>

    <div class="align-right">
        <a href="/properties" class="green-button">See All</a>
    </div>
</section>

<section class="contactus-img">
    <h2>Find the house of your dreams</h2>
    <p>Fill the form and an adviser will contact you shortly</p>
    <a href="/contact" class="yellow-button">Contact Us</a>
</section>

<div class="container section inferior-section"> <!-- Use section when you have a title for a part of the website, except in the case of articles, when it's a bloc entrance, etc-->
    <section class="blog">
        <h3>Our Blog</h3>

        <?php include "blog-listing.php"; ?>
    </section>

    <section class="testimonials">
        <h3>Testimonials</h3>

        <div class="testimonial">
            <blockquote>
                The staff behaviour was excelent, great care and the house that they offered me meets all my expectations.
            </blockquote>
            <p>— Claudio D. Morales</p>
        </div>
    </section>
</div>