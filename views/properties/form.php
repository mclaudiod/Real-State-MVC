<fieldset>
    <legend>General Information</legend>

    <label for="title">Title:</label>
    <input type="text" id="title" name="property[title]" placeholder="Property Title" value="<?php echo esc($property->title); ?>">

    <label for="price">Price:</label>
    <input type="number" id="price" name="property[price]" placeholder="Property Price" value="<?php echo esc($property->price); ?>">

    <label for="img">Image:</label>
    <input type="file" id="img" name="property[img]" accept="image/jpeg, image/png">

    <?php if($property->img): ?>
        <img src="/images/<?php echo $property->img ?>" class="small-image">
    <?php endif; ?>

    <label for="description">Description:</label>
    <textarea id="description" name="property[description]"><?php echo esc($property->description); ?></textarea>
</fieldset>

<fieldset>
    <legend>Property Information</legend>

    <label for="rooms">Bedrooms:</label>
    <input type="number" id="rooms" name="property[rooms]" placeholder="Property Bedrooms" min="1" max="9" value="<?php echo esc($property->rooms); ?>">

    <label for="wc">Bathrooms:</label>
    <input type="number" id="wc" name="property[wc]" placeholder="Property Bathrooms" min="1" max="9" value="<?php echo esc($property->wc); ?>">

    <label for="parking">Parking Lots:</label>
    <input type="number" id="parking" name="property[parking]" placeholder="Property Parking Lots" min="1" max="9" value="<?php echo esc($property->parking); ?>">
</fieldset>

<fieldset>
    <legend>Agent</legend>

    <label for="agent">Agent:</label>
    <select name="property[idagent]" id="agent">
        <option value="">-- Select --</option>
        <?php foreach($agents as $agent): ?>
        <option <?php echo $property->idagent === $agent->id ? "selected" : ""; ?> value="<?php echo esc($agent->id); ?>"><?php echo esc($agent->name) . " " . esc($agent->surname); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>