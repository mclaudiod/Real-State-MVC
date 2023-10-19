<main class="container section centered-content">
    <h1><?php echo $property->title ?></h1>

    <img loading="lazy" src="/images/<?php echo $property->img ?>" alt="Image of the Property">

    <div class="property-summary">
        <p class="price">$<?php echo $property->price ?></p>

        <ul class="icons-characteristics">

            <li>
                <img class="icon" src="build/img/icono_dormitorio.svg" alt="Bedrooms Icon" loading="lazy">
                <p><?php echo $property->rooms ?></p>
            </li>

            <li>
                <img class="icon" src="build/img/icono_wc.svg" alt="Bathrooms Icon" loading="lazy">
                <p><?php echo $property->wc ?></p>
            </li>

            <li>
                <img class="icon" src="build/img/icono_estacionamiento.svg" alt="Parking Lots Icon" loading="lazy">
                <p><?php echo $property->parking ?></p>
            </li>
        </ul>

        <p><?php echo $property->description ?></p>
    </div>
</main>