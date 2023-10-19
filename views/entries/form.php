<fieldset>
    <legend>General Information</legend>

    <label for="title">Title:</label>
    <input type="text" id="title" name="entry[title]" placeholder="Entry Title" value="<?php echo esc($entry->title); ?>">

    <label for="agent">Agent:</label>
    <select name="entry[idagent]" id="agent">
        <option value="">-- Select --</option>
        <?php foreach($agents as $agent): ?>
        <option <?php echo $entry->idagent === $agent->id ? "selected" : ""; ?> value="<?php echo esc($agent->id); ?>"><?php echo esc($agent->name) . " " . esc($agent->surname); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>

<fieldset>
    <legend>Entry Information</legend>

    <label for="img">Image:</label>
    <input type="file" id="img" name="entry[img]" accept="image/jpeg, image/png">

    <?php if($entry->img): ?>
        <img src="/images/<?php echo $entry->img ?>" class="small-image">
    <?php endif; ?>

    <label for="entry">Entry:</label>
    <textarea id="entry" name="entry[entry]"><?php echo esc($entry->entry); ?></textarea>
</fieldset>