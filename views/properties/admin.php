<main class="container section">
    <h1>Real State Administrator</h1>
        
    <?php
        if($result) {
            $message = showNotification(intval($result));
            if($message) { ?>
                <p class="alert success"><?php echo esc($message) ?></p>
            <?php }
        }
    ?>

    <a href="/properties/create" class="button green-button">New Property</a>
    <a href="/agents/create" class="button green-button">New Agent</a>
    <a href="/entries/create" class="button green-button">New Entry</a>

    <h2>Properties</h2>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody> <!-- Show the results -->
            <?php foreach($properties as $property): ?>
                <tr>
                    <td><?php echo $property->id; ?></td>
                    <td><?php echo $property->title; ?></td>
                    <td><img src="/images/<?php echo $property->img; ?>" class="timg"></td>
                    <td>$ <?php echo $property->price; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/properties/delete">
                            <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                            <input type="hidden" name="type" value="property">
                            <input type="submit" class="red-button-block" value="Delete">
                        </form>
                        <a href="/properties/update?id=<?php echo $property->id; ?>" class="yellow-button-block">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Agents</h2>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody> <!-- Show the results -->
            <?php foreach($agents as $agent): ?>
                <tr>
                    <td><?php echo $agent->id; ?></td>
                    <td><?php echo $agent->name; ?></td>
                    <td><?php echo $agent->surname; ?></td>
                    <td><?php echo $agent->phone; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/agents/delete">
                            <input type="hidden" name="id" value="<?php echo $agent->id; ?>">
                            <input type="hidden" name="type" value="agent">
                            <input type="submit" class="red-button-block" value="Delete">
                        </form>
                        <a href="/agents/update?id=<?php echo $agent->id; ?>" class="yellow-button-block">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Entries</h2>

    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody> <!-- Show the results -->
            <?php foreach($entries as $entry): ?>
                <tr>
                    <td><?php echo $entry->id; ?></td>
                    <td><?php echo $entry->title; ?></td>
                    <td><img src="/images/<?php echo $entry->img; ?>" class="timg"></td>
                    <td><?php echo $entry->created; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/entries/delete">
                            <input type="hidden" name="id" value="<?php echo $entry->id; ?>">
                            <input type="hidden" name="type" value="entry">
                            <input type="submit" class="red-button-block" value="Delete">
                        </form>
                        <a href="/entries/update?id=<?php echo $entry->id; ?>" class="yellow-button-block">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>