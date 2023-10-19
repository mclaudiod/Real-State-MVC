<fieldset>
    <legend>General Information</legend>

    <label for="name">Name:</label>
    <input type="text" id="name" name="agent[name]" placeholder="Agent Name" value="<?php echo esc($agent->name); ?>">

    <label for="surname">Surname:</label>
    <input type="text" id="surname" name="agent[surname]" placeholder="Agent Surname" value="<?php echo esc($agent->surname); ?>">
</fieldset>

<fieldset>
    <legend>Extra Information</legend>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="agent[phone]" placeholder="Agent Phone Number" value="<?php echo esc($agent->phone); ?>">
</fieldset>